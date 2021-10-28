/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2021 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */

/* global GLPI */

import SearchTokenizer, {Token} from "../../js/modules/SearchTokenizer";

describe('Search Tokenizer', () => {

   const stripExtraWhitespace = (input) => {
      return input.replace(/[^\S ]+|[ ]{2,}/gi,'');
   };

   test('Tokenize', () => {
      const untagged_tokens = [
         new Token('This', null, false, 0),
         new Token('is', null, false, 1),
         new Token('a', null, false, 2),
         new Token('te:st', null, false, 3),
      ];
      let tokenizer = new SearchTokenizer();
      //strings with colons quoted to be treated as a string when no allowed tags specified (All tags allowed by default)
      let result = tokenizer.tokenize('This is a "te:st"');

      expect(result.getFullPhrase()).toBe('This is a te:st');
      expect(result.getUntaggedTerms()).toStrictEqual(untagged_tokens);
      expect(result.getTaggedTerms().length).toBe(0);

      tokenizer = new SearchTokenizer({
         name: {
            description: ''
         }
      });
      expect(tokenizer.isAllowedTag('name')).toBeTrue();
      expect(tokenizer.isAllowedTag('content')).toBeFalse();

      result = tokenizer.tokenize('This is a te:st name:"Test"');
      expect(result.getFullPhrase()).toBe('This is a te:st');
      expect(result.getUntaggedTerms()).toStrictEqual(untagged_tokens);
      expect(result.getTaggedTerms().length).toBe(1);
      let name_tags = result.getTag('name');
      expect(name_tags.length).toBe(1);
      expect(name_tags[0]).toStrictEqual(new Token('Test', 'name', false, 4));

      result = tokenizer.tokenize('This is a te:st -name:"Test"');
      expect(result.getFullPhrase()).toBe('This is a te:st');
      expect(result.getUntaggedTerms()).toStrictEqual(untagged_tokens);
      expect(result.getTaggedTerms().length).toBe(1);
      name_tags = result.getTag('name');
      expect(name_tags.length).toBe(1);
      expect(name_tags[0]).toStrictEqual(new Token('Test', 'name', true, 4));

      tokenizer = new SearchTokenizer({
         name: {
            description: ''
         }
      }, true);
      // "te" is not an allowed tag so we expect "te:st" to be dropped
      result = tokenizer.tokenize('This is a te:st -name:"Test"');
      expect(result.getFullPhrase()).toBe('This is a');
      expect(result.getUntaggedTerms()).toStrictEqual([
         new Token('This', null, false, 0),
         new Token('is', null, false, 1),
         new Token('a', null, false, 2),
      ]);
      expect(result.getTaggedTerms().length).toBe(1);
      name_tags = result.getTag('name');
      expect(name_tags.length).toBe(1);
      expect(name_tags[0]).toStrictEqual(new Token('Test', 'name', true, 3));

      // "te" is not an allowed tag, but it is quoted so we expect it to be treated as a string and not a tagged value
      result = tokenizer.tokenize('This is a "te:st" -name:"Test"');
      expect(result.getFullPhrase()).toBe('This is a te:st');
      expect(result.getUntaggedTerms()).toStrictEqual(untagged_tokens);
      expect(result.getTaggedTerms().length).toBe(1);
      name_tags = result.getTag('name');
      expect(name_tags.length).toBe(1);
      expect(name_tags[0]).toStrictEqual(new Token('Test', 'name', true, 4));
   });

   test('Allowed Tags', () => {
      let tokenizer = new SearchTokenizer();
      // All tags allowed by default
      expect(tokenizer.isAllowedTag('name')).toBeTrue();
      expect(tokenizer.isAllowedTag('content')).toBeTrue();

      tokenizer = new SearchTokenizer({
         name: {
            description: ''
         }
      });
      expect(tokenizer.isAllowedTag('name')).toBeTrue();
      expect(tokenizer.isAllowedTag('content')).toBeFalse();
   });

   test('Tags Helper Content', () => {
      const tokenizer = new SearchTokenizer({
         name: {
            description: 'The name'
         },
         content: {
            description: 'The content'
         },
         milestone: {
            description: 'Is a milestone',
            autocomplete_values: ['true', 'false']
         }
      });

      let content = stripExtraWhitespace(tokenizer.getTagsHelperContent());
      expect(content).toBe(stripExtraWhitespace(`
      Allowed tags:</br>
      <ul>
         <li>name: The name</li>
         <li>content: The content</li>
         <li>milestone: Is a milestone</li>
      </ul>
      `));
   });

   test('Autocomplete', () => {
      const tokenizer = new SearchTokenizer({
         name: {
            description: 'The name'
         },
         content: {
            description: 'The content'
         },
         milestone: {
            description: 'Is a milestone',
            autocomplete_values: ['true', 'false']
         }
      });

      let content = tokenizer.getAutocompleteHelperContent('name');
      expect(stripExtraWhitespace(content)).toBe(`name: The name</br><ul></ul>`);
      content = tokenizer.getAutocompleteHelperContent('content');
      expect(stripExtraWhitespace(content)).toBe(`content: The content</br><ul></ul>`);
      content = tokenizer.getAutocompleteHelperContent('milestone');
      expect(stripExtraWhitespace(content)).toBe(`milestone: Is a milestone</br><ul><li>true</li><li>false</li></ul>`);
      expect(tokenizer.getAutocompleteHelperContent('invalid_tag')).toBeNull();

      tokenizer.allowed_tags['itemtype'] = {
         description: 'The itemtype'
      };
      content = tokenizer.getAutocompleteHelperContent('itemtype');
      expect(stripExtraWhitespace(content)).toBe(`itemtype: The itemtype</br><ul></ul>`);

      tokenizer.setAutocomplete('itemtype', ['Project', 'ProjectTask']);
      content = tokenizer.getAutocompleteHelperContent('itemtype');
      expect(stripExtraWhitespace(content)).toBe(`itemtype: The itemtype</br><ul><li>Project</li><li>ProjectTask</li></ul>`);

      tokenizer.clearAutocomplete();
      content = tokenizer.getAutocompleteHelperContent('itemtype');
      expect(stripExtraWhitespace(content)).toBe(`itemtype: The itemtype</br><ul></ul>`);
   });

   test('Popover Content', () => {
      const tokenizer = new SearchTokenizer({
         name: {
            description: 'The name'
         },
         content: {
            description: 'The content'
         },
         milestone: {
            description: 'Is a milestone',
            autocomplete_values: ['true', 'false']
         }
      });
      let filter_text = 'This is a test name:Name content:Content milestone:true';
      const tag_helper = stripExtraWhitespace(tokenizer.getTagsHelperContent());
      const autocomplete_name = stripExtraWhitespace(tokenizer.getAutocompleteHelperContent('name'));
      const autocomplete_content = stripExtraWhitespace(tokenizer.getAutocompleteHelperContent('content'));
      const autocomplete_milestone = stripExtraWhitespace(tokenizer.getAutocompleteHelperContent('milestone'));

      let content = stripExtraWhitespace(tokenizer.getPopoverContent(filter_text, 0));
      expect(content).toBe(tag_helper);
      content = stripExtraWhitespace(tokenizer.getPopoverContent(filter_text, 5));
      expect(content).toBe(tag_helper);
      content = stripExtraWhitespace(tokenizer.getPopoverContent(filter_text, 21));
      expect(content).toBe(autocomplete_name);
      content = stripExtraWhitespace(tokenizer.getPopoverContent(filter_text, 34));
      expect(content).toBe(autocomplete_content);
      content = stripExtraWhitespace(tokenizer.getPopoverContent(filter_text, 52));
      expect(content).toBe(autocomplete_milestone);
   });
});
