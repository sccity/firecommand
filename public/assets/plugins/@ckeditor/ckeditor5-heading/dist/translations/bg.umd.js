/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

( e => {
const { [ 'bg' ]: { dictionary, getPluralForm } } = {"bg":{"dictionary":{"Paragraph":"Параграф","Heading":"Заглавие","Choose heading":"Избери заглавие","Heading 1":"Заглавие 1","Heading 2":"Заглавие 2","Heading 3":"Заглавие 3","Heading 4":"Заглавие 4","Heading 5":"Заглавие 5","Heading 6":"Заглавие 6","Type your title":"Напишете заглавието си","Type or paste your content here.":"Напишете или поставете съдържанието си тук."},getPluralForm(n){return (n != 1);}}};
e[ 'bg' ] ||= { dictionary: {}, getPluralForm: null };
e[ 'bg' ].dictionary = Object.assign( e[ 'bg' ].dictionary, dictionary );
e[ 'bg' ].getPluralForm = getPluralForm;
} )( window.CKEDITOR_TRANSLATIONS ||= {} );
