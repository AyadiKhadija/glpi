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

namespace Glpi\Api\HL\Controller;

use Entity;
use Glpi\Api\HL\Doc as Doc;
use Glpi\Api\HL\Route;
use Glpi\Api\HL\Search;
use Glpi\Http\JSONResponse;
use Glpi\Http\Request;
use Glpi\Http\Response;
use Group;
use Profile;
use User;

/**
 * @phpstan-type EmailData = array{id: int, email: string, is_default: int, _links: array{'self': array{href: non-empty-string}}}
 */
#[Route(path: '/Administration', tags: ['Administration'])]
final class AdministrationController extends AbstractController
{
    use CRUDControllerTrait;

    public static function getRawKnownSchemas(): array
    {
        return [
            'User' => [
                'x-itemtype' => User::class,
                'type' => Doc\Schema::TYPE_OBJECT,
                'properties' => [
                    'id' => [
                        'type' => Doc\Schema::TYPE_INTEGER,
                        'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                        'description' => 'ID',
                        'x-readonly' => true,
                    ],
                    'username' => [
                        'x-field' => 'name',
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Username',
                    ],
                    'realname' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Real name',
                    ],
                    'firstname' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'First name',
                    ],
                    'phone' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Phone number',
                    ],
                    'phone2' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Phone number 2',
                    ],
                    'mobile' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Mobile phone number',
                    ],
                    'emails' => [
                        'type' => Doc\Schema::TYPE_ARRAY,
                        'description' => 'Email addresses',
                        'items' => [
                            'type' => Doc\Schema::TYPE_OBJECT,
                            'x-join' => [
                                'table' => 'glpi_useremails',
                                'fkey' => 'id',
                                'field' => 'users_id'
                            ],
                            'properties' => [
                                'id' => [
                                    'type' => Doc\Schema::TYPE_INTEGER,
                                    'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                                    'description' => 'ID',
                                ],
                                'email' => [
                                    'type' => Doc\Schema::TYPE_STRING,
                                    'description' => 'Email address',
                                ],
                                'is_default' => [
                                    'type' => Doc\Schema::TYPE_BOOLEAN,
                                    'description' => 'Is default',
                                ],
                                'is_dynamic' => [
                                    'type' => Doc\Schema::TYPE_BOOLEAN,
                                    'description' => 'Is dynamic',
                                ],
                            ]
                        ]
                    ],
                    'comment' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Comment',
                    ],
                    'is_active' => [
                        'type' => Doc\Schema::TYPE_BOOLEAN,
                        'description' => 'Is active',
                    ],
                    'is_deleted' => [
                        'type' => Doc\Schema::TYPE_BOOLEAN,
                        'description' => 'Is deleted',
                    ],
                    'password' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'format' => Doc\Schema::FORMAT_STRING_PASSWORD,
                        'description' => 'Password',
                        'x-writeonly' => true,
                    ],
                    'password2' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'format' => Doc\Schema::FORMAT_STRING_PASSWORD,
                        'description' => 'Password confirmation',
                        'x-writeonly' => true,
                    ],
                ]
            ],
            'Group' => [
                'x-itemtype' => Group::class,
                'type' => Doc\Schema::TYPE_OBJECT,
                'properties' => [
                    'id' => [
                        'type' => Doc\Schema::TYPE_INTEGER,
                        'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                        'description' => 'ID',
                        'x-readonly' => true,
                    ],
                    'name' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Name',
                    ],
                    'comment' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Comment',
                    ],
                    'completename' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Complete name',
                    ],
                    'parent' => [
                        'type' => Doc\Schema::TYPE_OBJECT,
                        'x-itemtype' => Group::class,
                        'x-join' => [
                            'table' => 'glpi_groups',
                            'fkey' => 'groups_id',
                        ],
                        'description' => 'Parent group',
                        'properties' => [
                            'id' => [
                                'type' => Doc\Schema::TYPE_INTEGER,
                                'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                                'description' => 'ID',
                            ],
                            'name' => [
                                'type' => Doc\Schema::TYPE_STRING,
                                'description' => 'Name',
                            ],
                        ]
                    ],
                    'level' => [
                        'type' => Doc\Schema::TYPE_INTEGER,
                        'description' => 'Level',
                    ],
                ]
            ],
            'Entity' => [
                'x-itemtype' => Entity::class,
                'type' => Doc\Schema::TYPE_OBJECT,
                'properties' => [
                    'id' => [
                        'type' => Doc\Schema::TYPE_INTEGER,
                        'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                        'description' => 'ID',
                        'x-readonly' => true,
                    ],
                    'name' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Name',
                    ],
                    'comment' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Comment',
                    ],
                    'completename' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Complete name',
                    ],
                    'parent' => [
                        'type' => Doc\Schema::TYPE_OBJECT,
                        'x-itemtype' => Entity::class,
                        'x-join' => [
                            'table' => 'glpi_entities',
                            'fkey' => 'entities_id',
                        ],
                        'description' => 'Parent entity',
                        'properties' => [
                            'id' => [
                                'type' => Doc\Schema::TYPE_INTEGER,
                                'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                                'description' => 'ID',
                            ],
                            'name' => [
                                'type' => Doc\Schema::TYPE_STRING,
                                'description' => 'Name',
                            ],
                        ]
                    ],
                    'level' => [
                        'type' => Doc\Schema::TYPE_INTEGER,
                        'description' => 'Level',
                    ],
                ]
            ],
            'Profile' => [
                'x-itemtype' => Profile::class,
                'type' => Doc\Schema::TYPE_OBJECT,
                'properties' => [
                    'id' => [
                        'type' => Doc\Schema::TYPE_INTEGER,
                        'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                        'description' => 'ID',
                        'x-readonly' => true,
                    ],
                    'name' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Name',
                    ],
                    'comment' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Comment',
                    ],
                ]
            ],
            'EmailAddress' => [
                'x-itemtype' => \UserEmail::class,
                'type' => Doc\Schema::TYPE_OBJECT,
                'properties' => [
                    'id' => [
                        'type' => Doc\Schema::TYPE_INTEGER,
                        'format' => Doc\Schema::FORMAT_INTEGER_INT64,
                        'description' => 'ID',
                    ],
                    'email' => [
                        'type' => Doc\Schema::TYPE_STRING,
                        'description' => 'Email address',
                    ],
                    'is_default' => [
                        'type' => Doc\Schema::TYPE_BOOLEAN,
                        'description' => 'Is default',
                    ],
                    'is_dynamic' => [
                        'type' => Doc\Schema::TYPE_BOOLEAN,
                        'description' => 'Is dynamic',
                    ],
                ]
            ]
        ];
    }

    #[Route(path: '/User', methods: ['GET'])]
    #[Doc\Route(
        description: 'List or search users',
        responses: [
            ['schema' => 'User[]']
        ]
    )]
    public function searchUsers(Request $request): Response
    {
        return Search::searchBySchema($this->getKnownSchema('User'), $request->getParameters());
    }

    #[Route(path: '/Group', methods: ['GET'])]
    #[Doc\Route(
        description: 'List or search groups',
        responses: [
            ['schema' => 'Group[]']
        ]
    )]
    public function searchGroups(Request $request): Response
    {
        return Search::searchBySchema($this->getKnownSchema('Group'), $request->getParameters());
    }

    #[Route(path: '/Entity', methods: ['GET'])]
    #[Doc\Route(
        description: 'List or search entities',
        responses: [
            ['schema' => 'Entity[]']
        ]
    )]
    public function searchEntities(Request $request): Response
    {
        return Search::searchBySchema($this->getKnownSchema('Entity'), $request->getParameters());
    }

    #[Route(path: '/Profile', methods: ['GET'])]
    #[Doc\Route(
        description: 'List or search profiles',
        responses: [
            ['schema' => 'Profile[]']
        ]
    )]
    public function searchProfiles(Request $request): Response
    {
        return Search::searchBySchema($this->getKnownSchema('Profile'), $request->getParameters());
    }

    /**
     * @param int $users_id
     * @return EmailData[]
     */
    private function getEmailDataForUser(int $users_id): array
    {
        global $DB;

        $iterator = $DB->request([
            'FROM' => \UserEmail::getTable(),
            'WHERE' => [
                'users_id' => $users_id,
            ],
        ]);
        $emails = [];
        foreach ($iterator as $data) {
            $emails[] = [
                'id' => (int) $data['id'],
                'email' => (string) $data['email'],
                'is_default' => (int) $data['is_default'],
                '_links' => [
                    'self' => [
                        'href' => self::getAPIPathForRouteFunction(self::class, 'getMyEmail', ['id' => $data['id']]),
                    ],
                ],
            ];
        }
        return $emails;
    }

    #[Route(path: '/User/me', methods: ['GET'])]
    #[Doc\Route(
        description: 'Get the current user',
        responses: [
            ['schema' => 'User']
        ]
    )]
    public function me(Request $request): Response
    {
        $my_user_id = $this->getMyUserID();
        return Search::getOneBySchema($this->getKnownSchema('User'), ['id' => $my_user_id], $request->getParameters());
    }

    #[Route(path: '/User/me/emails', methods: ['GET'])]
    #[Doc\Route(
        description: 'Get the current user\'s email addresses',
        responses: [
            ['schema' => 'EmailAddress[]']
        ]
    )]
    public function getMyEmails(Request $request): Response
    {
        return new JSONResponse($this->getEmailDataForUser($this->getMyUserID()));
    }

    #[Route(path: '/User/me/emails', methods: ['POST'])]
    #[Doc\Route(
        description: 'Create a new email address for the current user',
        parameters: [
            [
                'name' => 'email',
                'type' => 'string',
                'description' => 'The email address to add',
                'required' => true,
                'location' => Doc\Parameter::LOCATION_BODY,
            ],
            [
                'name' => 'is_default',
                'type' => 'boolean',
                'description' => 'Whether this email address should be the default one',
                'required' => false,
                'location' => Doc\Parameter::LOCATION_BODY,
            ],
        ],
    )]
    public function addMyEmail(Request $request): Response
    {
        if (!$request->hasParameter('email')) {
            return self::getInvalidParametersErrorResponse([
                'missing' => ['email'],
            ]);
        }
        $new_email = $request->getParameter('email');
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            return self::getInvalidParametersErrorResponse([
                'invalid' => [
                    ['name' => 'email', 'reason' => 'The provided email address does not appear to be formatted as an email address']
                ],
            ]);
        }
        // Check if the email address is already in the DB
        $emails = $this->getEmailDataForUser($this->getMyUserID());
        foreach ($emails as $email) {
            if ($email['email'] === $new_email) {
                return new JSONResponse(
                    self::getErrorResponseBody(self::ERROR_ALREADY_EXISTS, 'The provided email address is already associated with this user'),
                    409,
                    [
                        'Location' => self::getAPIPathForRouteFunction(self::class, 'getMyEmail', ['id' => $email['id']])
                    ]
                );
            }
        }

        // Create the new email address
        $email = new \UserEmail();
        $emails_id = $email->add([
            'users_id' => $this->getMyUserID(),
            'email' => $new_email,
            'is_default' => $request->hasParameter('is_default') ? $request->getParameter('is_default') : false,
        ]);
        return self::getCRUDCreateResponse($emails_id, self::getAPIPathForRouteFunction(self::class, 'getMyEmail', ['id' => $emails_id]));
    }

    #[Route(path: '/User/me/emails/{id}', methods: ['GET'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Get a specific email address for the current user',
        responses: [
            ['schema' => 'EmailAddress']
        ]
    )]
    public function getMyEmail(Request $request): Response
    {
        $emails = $this->getEmailDataForUser($this->getMyUserID());
        foreach ($emails as $email) {
            if ($email['id'] == $request->getAttribute('id')) {
                return new JSONResponse($email);
            }
        }
        return self::getNotFoundErrorResponse();
    }

    #[Route(path: '/User', methods: ['POST'])]
    #[Doc\Route(description: 'Create a new user', parameters: [
        [
            'name' => '_',
            'location' => Doc\Parameter::LOCATION_BODY,
            'type' => Doc\Schema::TYPE_OBJECT,
            'schema' => 'User',
        ]
    ])]
    public function createUser(Request $request): Response
    {
        return Search::createBySchema($this->getKnownSchema('User'), $request->getParameters(), [self::class, 'getUserByID']);
    }

    #[Route(path: '/User/{id}', methods: ['GET'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Get a user by ID',
        responses: [
            ['schema' => 'User']
        ]
    )]
    public function getUserByID(Request $request): Response
    {
        return Search::getOneBySchema($this->getKnownSchema('User'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/User/username/{username}', methods: ['GET'], requirements: ['username' => '[a-zA-Z0-9_]+'])]
    #[Doc\Route(
        description: 'Get a user by username',
        responses: [
            ['schema' => 'User']
        ]
    )]
    public function getUserByUsername(Request $request): Response
    {
        return Search::getOneBySchema($this->getKnownSchema('User'), $request->getAttributes(), $request->getParameters(), 'username');
    }

    #[Route(path: '/User/{id}', methods: ['PATCH'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Update a user by ID',
        parameters: [
            [
                'name' => '_',
                'location' => Doc\Parameter::LOCATION_BODY,
                'type' => Doc\Schema::TYPE_OBJECT,
                'schema' => 'User',
            ]
        ],
        responses: [
            ['schema' => 'User']
        ]
    )]
    public function updateUserByID(Request $request): Response
    {
        return Search::updateBySchema($this->getKnownSchema('User'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/User/username/{username}', methods: ['PATCH'], requirements: ['username' => '[a-zA-Z0-9_]+'])]
    #[Doc\Route(
        description: 'Update a user by username',
        parameters: [
            [
                'name' => '_',
                'location' => Doc\Parameter::LOCATION_BODY,
                'type' => Doc\Schema::TYPE_OBJECT,
                'schema' => 'User',
            ]
        ],
        responses: [
            ['schema' => 'User']
        ]
    )]
    public function updateUserByUsername(Request $request): Response
    {
        return Search::updateBySchema($this->getKnownSchema('User'), $request->getAttributes(), $request->getParameters(), 'username');
    }

    #[Route(path: '/User/{id}', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    #[Doc\Route(description: 'Delete a user by ID')]
    public function deleteUserByID(Request $request): Response
    {
        return Search::deleteBySchema($this->getKnownSchema('User'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/User/username/{username}', methods: ['DELETE'], requirements: ['username' => '[a-zA-Z0-9_]+'])]
    #[Doc\Route(description: 'Delete a user by username')]
    /**
     * @param Request $request
     * @return Response
     */
    public function deleteUserByUsername(Request $request): Response
    {
        return Search::deleteBySchema($this->getKnownSchema('User'), $request->getAttributes(), $request->getParameters(), 'username');
    }

    #[Route(path: '/Group', methods: ['POST'])]
    #[Doc\Route(description: 'Create a new group', parameters: [
        [
            'name' => '_',
            'location' => Doc\Parameter::LOCATION_BODY,
            'type' => Doc\Schema::TYPE_OBJECT,
            'schema' => 'Group',
        ]
    ])]
    public function createGroup(Request $request): Response
    {
        return Search::createBySchema($this->getKnownSchema('Group'), $request->getParameters(), [self::class, 'getGroupByID']);
    }

    #[Route(path: '/Group/{id}', methods: ['GET'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Get a group by ID',
        responses: [
            ['schema' => 'Group']
        ]
    )]
    public function getGroupByID(Request $request): Response
    {
        return Search::getOneBySchema($this->getKnownSchema('Group'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Group/{id}', methods: ['PATCH'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Update a group by ID',
        parameters: [
            [
                'name' => '_',
                'location' => Doc\Parameter::LOCATION_BODY,
                'type' => Doc\Schema::TYPE_OBJECT,
                'schema' => 'Group',
            ]
        ],
        responses: [
            ['schema' => 'Group']
        ]
    )]
    public function updateGroupByID(Request $request): Response
    {
        return Search::updateBySchema($this->getKnownSchema('Group'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Group/{id}', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    #[Doc\Route(description: 'Delete a group by ID')]
    public function deleteGroupByID(Request $request): Response
    {
        return Search::deleteBySchema($this->getKnownSchema('Group'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Entity', methods: ['POST'])]
    #[Doc\Route(description: 'Create a new entity', parameters: [
        [
            'name' => '_',
            'location' => Doc\Parameter::LOCATION_BODY,
            'type' => Doc\Schema::TYPE_OBJECT,
            'schema' => 'Entity',
        ]
    ])]
    public function createEntity(Request $request): Response
    {
        return Search::createBySchema($this->getKnownSchema('Entity'), $request->getParameters(), [self::class, 'getEntityByID']);
    }

    #[Route(path: '/Entity/{id}', methods: ['GET'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Get an entity by ID',
        responses: [
            ['schema' => 'Entity']
        ]
    )]
    public function getEntityByID(Request $request): Response
    {
        return Search::getOneBySchema($this->getKnownSchema('Entity'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Entity/{id}', methods: ['PATCH'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Update an entity by ID',
        parameters: [
            [
                'name' => '_',
                'location' => Doc\Parameter::LOCATION_BODY,
                'type' => Doc\Schema::TYPE_OBJECT,
                'schema' => 'Entity',
            ]
        ],
        responses: [
            ['schema' => 'Entity']
        ]
    )]
    public function updateEntityByID(Request $request): Response
    {
        return Search::updateBySchema($this->getKnownSchema('Entity'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Entity/{id}', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    #[Doc\Route(description: 'Delete an entity by ID')]
    public function deleteEntityByID(Request $request): Response
    {
        return Search::deleteBySchema($this->getKnownSchema('Entity'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Profile', methods: ['POST'])]
    #[Doc\Route(description: 'Create a new profile', parameters: [
        [
            'name' => '_',
            'location' => Doc\Parameter::LOCATION_BODY,
            'type' => Doc\Schema::TYPE_OBJECT,
            'schema' => 'Profile',
        ]
    ])]
    public function createProfile(Request $request): Response
    {
        return Search::createBySchema($this->getKnownSchema('Profile'), $request->getParameters(), [self::class, 'getProfileByID']);
    }

    #[Route(path: '/Profile/{id}', methods: ['GET'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Get a profile by ID',
        responses: [
            ['schema' => 'Profile']
        ]
    )]
    public function getProfileByID(Request $request): Response
    {
        return Search::getOneBySchema($this->getKnownSchema('Profile'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Profile/{id}', methods: ['PATCH'], requirements: ['id' => '\d+'])]
    #[Doc\Route(
        description: 'Update a profile by ID',
        parameters: [
            [
                'name' => '_',
                'location' => Doc\Parameter::LOCATION_BODY,
                'type' => Doc\Schema::TYPE_OBJECT,
                'schema' => 'Profile',
            ]
        ],
        responses: [
            ['schema' => 'Profile']
        ]
    )]
    public function updateProfileByID(Request $request): Response
    {
        return Search::updateBySchema($this->getKnownSchema('Profile'), $request->getAttributes(), $request->getParameters());
    }

    #[Route(path: '/Profile/{id}', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    #[Doc\Route(description: 'Delete a profile by ID')]
    public function deleteProfileByID(Request $request): Response
    {
        return Search::deleteBySchema($this->getKnownSchema('Profile'), $request->getAttributes(), $request->getParameters());
    }
}
