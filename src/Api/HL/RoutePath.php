<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

namespace Glpi\Api\HL;

use Glpi\Api\HL\Controller\AbstractController;
use Glpi\Http\Request;
use Glpi\Http\Response;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * @phpstan-type RoutePathCacheHint {key: string, path: string, compiled_path: string, methods: string[], priority: int, security: int}
 */
final class RoutePath
{
    /**
     * The Route attribute
     * @var Route
     */
    private ?Route $route = null;

    /**
     * @var ReflectionClass<AbstractController>
     */
    private ?ReflectionClass $controller = null;

    /**
     * @var ReflectionMethod
     */
    private ?ReflectionMethod $method = null;

    /**
     * The relative URI path with placeholder requirements inlined
     * @var string
     */
    private ?string $compiled_path;

    /**
     * Key used to identify the controller and method this route is linked to.
     * Used for hydration.
     * @var string
     */
    private string $key;

    /**
     * @var string The non-compiled path
     */
    private string $path;

    /**
     * @var array The list of HTTP methods this route is linked to
     */
    private array $methods;

    /**
     * @var int The priority of this route
     */
    private int $priority;

    /**
     * @var int The security level of this route
     */
    private int $security;

    /**
     * @param class-string<AbstractController> $class
     * @param string $method
     */
    public function __construct(string $class, string $method, string $path, array $methods, int $priority, int $security, ?string $compiled_path = null)
    {
        $this->key = $class . '::' . $method;
        $this->path = $path;
        $this->methods = $methods;
        $this->priority = $priority;
        $this->security = $security;
        $this->compiled_path = $compiled_path;
    }

    /**
     * @param Route $route Route Attribute instance
     * @param class-string<AbstractController> $class Controller class name
     * @param string $method Controller method name
     */
    public static function fromRouteAttribute(Route $route, string $class, string $method): self
    {
        $path = new self(
            $class,
            $method,
            $route->path,
            $route->methods,
            $route->priority,
            $route->security_level
        );
        $path->controller = new ReflectionClass($class);
        $path->method = $path->controller->getMethod($method);
        $path->route = $route;
        $path->mergeControllerRouteData();
        $path->compilePath();

        return $path;
    }

    private function hydrate(): void
    {
        $is_hydrated = $this->route !== null && $this->controller !== null && $this->method !== null;
        if (!$is_hydrated) {
            [$controller, $method] = explode('::', $this->key);
            try {
                $this->controller = new ReflectionClass($controller);
                $this->method = $this->controller->getMethod($method);
                if (!$this->method->isPublic()) {
                    throw new \Exception('Method is not public');
                }
                $route_attributes = $this->method->getAttributes(Route::class);
                if (count($route_attributes) === 0) {
                    throw new \Exception("RoutePath has no Route attribute");
                }
                $this->route = $route_attributes[0]->newInstance();
            } catch (\Exception $e) {
                trigger_error("Unable to hydrate RoutePath {$this->key}: {$e->getMessage()}", E_USER_ERROR);
            }
            $this->mergeControllerRouteData();
            $this->compilePath();
        }
    }

    private function getRoute(): Route
    {
        $this->hydrate();
        return $this->route;
    }

    public function getRoutePath(): string
    {
        return $this->path;
    }

    public function getRoutePathWithParameters(array $params = []): string
    {
        $path = $this->getRoutePath();
        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }
        return $path;
    }

    public function isValidPath($path): bool
    {
        // Ensure no placeholders are left
        $dynamic_expandable_placeholders = array_filter($this->getRouteRequirements(), static function ($v, $k) {
            return is_callable($v);
        }, ARRAY_FILTER_USE_BOTH);
        $leftover_placeholders = [];
        preg_match_all('/\{([^}]+)\}/', $path, $leftover_placeholders);
        // Remove dynamic expandable placeholders
        $leftover_placeholders = array_diff($leftover_placeholders[1], array_keys($dynamic_expandable_placeholders));
        return count($leftover_placeholders) === 0;
    }

    public function getCompiledPath(): string
    {
        if ($this->compiled_path === null) {
            $this->hydrate();
        }
        return $this->compiled_path;
    }

    /**
     * @return string[]
     */
    public function getRouteMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return array<string, string>
     */
    public function getRouteRequirements(): array
    {
        return $this->getRoute()->requirements;
    }

    public function getRoutePriority(): int
    {
        return $this->priority;
    }

    public function getRouteSecurityLevel(): int
    {
        return $this->security;
    }

    /**
     * @return string[]
     */
    public function getRouteTags(): array
    {
        return $this->getRoute()->tags;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        $this->hydrate();
        return $this->controller->getName();
    }

    public function getControllerInstance(): AbstractController
    {
        /** @var ?AbstractController $instance */
        static $instance = null;
        if ($instance === null) {
            $this->hydrate();
            $instance = $this->controller->newInstance();
        }
        return $instance;
    }

    /**
     * @return ReflectionMethod
     */
    public function getMethod(): ReflectionMethod
    {
        $this->hydrate();
        return $this->method;
    }

    /**
     * @return Doc\Route[]
     */
    public function getRouteDocs(): array
    {
        $this->hydrate();
        $controller_doc_attrs = $this->controller->getAttributes(Doc\Route::class);
        /** @var Doc\Route $controller_doc_attr */
        $controller_doc_attr = count($controller_doc_attrs) ? reset($controller_doc_attrs)->newInstance() : null;
        $doc_attrs = $this->getMethod()->getAttributes(Doc\Route::class);
        $docs = [];

        foreach ($doc_attrs as $doc_attr) {
            /** @var Doc\Route $doc */
            $doc = $doc_attr->newInstance();
            if ($controller_doc_attr !== null) {
                $doc = new Doc\Route($doc->getDescription(), $doc->getMethods(), array_merge($controller_doc_attr->getParameters(), $doc->getParameters()), $doc->getResponses());
            }
            $docs[] = $doc;
        }
        return $docs;
    }

    public function getRouteDoc(string $method): ?Doc\Route
    {
        $docs = $this->getRouteDocs();
        $result = null;
        foreach ($docs as $doc) {
            if (empty($doc->getMethods())) {
                // Non-specific. Store in $result in case a specific doc is found later
                $result = $doc;
            } else if (in_array($method, $doc->getMethods(), true)) {
                // Specific. Return immeditately
                return $doc;
            }
        }
        return $result;
    }

    private function setPath(string $path)
    {
        $this->path = $path;
        $this->route->path = $path;
    }

    private function setPriority(int $priority)
    {
        $this->priority = $priority;
        $this->route->priority = $priority;
    }

    /**
     * Combine data from the class Route attribute (if present) with the method's own attribute
     *
     * Must be called during or after hydration only.
     * @return void
     */
    private function mergeControllerRouteData(): void
    {
        $controller_attributes = $this->controller->getAttributes(Route::class);
        if (count($controller_attributes)) {
            $controller_route = $controller_attributes[0]->newInstance();
            // Prefix route path with controller path, making sure the route path already starts with a slash
            $path = '/' . ltrim($this->route->path, '/');
            $this->setPath($controller_route->path . $path);

            // Merge requirements and tags
            $this->route->requirements = array_merge($controller_route->requirements, $this->route->requirements);
            $this->route->tags = array_merge($controller_route->tags, $this->route->tags);

            if ($controller_route->priority !== Route::DEFAULT_PRIORITY && $this->route->priority === Route::DEFAULT_PRIORITY) {
                $this->setPriority($controller_route->priority);
            }
            // None of the other properties have meaning when on a class
        }
    }

    /**
     * "Compile" the path by replacing placeholders with regex patterns from the requirements or default patterns
     *
     * Must be called during or after hydration only.
     * @return void
     */
    private function compilePath(): void
    {
        $compiled_path = $this->getRoutePath();

        // Replace all placeholders with their matching requirement or a default pattern (letters,  numbers, underscore only)
        $compiled_path = preg_replace_callback('/(\{[^}]+\})/', function ($matches) {
            $name = $matches[1];
            $name = substr($name, 1, -1);
            if (isset($this->route->requirements[$name])) {
                if (is_callable($this->route->requirements[$name])) {
                    $reqs = $this->route->requirements[$name]();
                } else {
                    $reqs = is_array($this->route->requirements[$name]) ? $this->route->requirements[$name] : [$this->route->requirements[$name]];
                }
                return '(' . implode('|', $reqs) . ')';
            }
            return '([a-zA-Z0-9_]+)';
        }, $compiled_path);

        if ($compiled_path === null) {
            throw new \RuntimeException('Failed to compile path');
        }

        // Ensure the compiled path starts with a slash but does not end with one (unless the path is just '/')
        if ($compiled_path !== '/') {
            if ($compiled_path[0] !== '/') {
                $compiled_path = '/' . $compiled_path;
            }
            $compiled_path = rtrim($compiled_path, '/');
        }
        $this->compiled_path = $compiled_path;
    }

    /**
     * @throws ReflectionException
     */
    public function invoke(Request $request): Response
    {
        $response = $this->getMethod()->invoke($this->getControllerInstance(), $request);
        if ($response instanceof Response) {
            return $response;
        }
        throw new \RuntimeException('Controller method must return a Response object');
    }

    /**
     * Get a minimal representation of this route path that can be cached, used for basic matching, and for recreating the full object
     * @return array
     * @phpstan-return RoutePathCacheHint
     */
    public function getCachedRouteHint(): array
    {
        $this->hydrate();
        return [
            'key' => $this->key,
            'path' => $this->path,
            'compiled_path' => $this->compiled_path,
            'methods' => $this->methods,
            'priority' => $this->priority,
            'security' => $this->security,
        ];
    }
}
