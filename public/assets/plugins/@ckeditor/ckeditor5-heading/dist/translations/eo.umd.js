/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

( e => {
const { [ 'eo' ]: { dictionary, getPluralForm } } = {"eo":{"dictionary":{"Paragraph":"Paragrafo","Heading":"Ĉapo","Choose heading":"Elektu ĉapon","Heading 1":"Ĉapo 1","Heading 2":"Ĉapo 2","Heading 3":"Ĉapo 3","Heading 4":"","Heading 5":"","Heading 6":"","Type your title":"","Type or paste your content here.":""},getPluralForm(n){return (n != 1);}}};
e[ 'eo' ] ||= { dictionary: {}, getPluralForm: null };
e[ 'eo' ].dictionary = Object.assign( e[ 'eo' ].dictionary, dictionary );
e[ 'eo' ].getPluralForm = getPluralForm;
} )( window.CKEDITOR_TRANSLATIONS ||= {} );
