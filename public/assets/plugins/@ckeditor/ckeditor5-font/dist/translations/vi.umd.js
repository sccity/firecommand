/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

( e => {
const { [ 'vi' ]: { dictionary, getPluralForm } } = {"vi":{"dictionary":{"Font Size":"Cỡ chữ","Tiny":"Bé","Small":"Nhỏ","Big":"Lớn","Huge":"Khổng lồ","Font Family":"Họ chữ","Default":"Mặc định","Font Color":"Màu chữ","Font Background Color":"Màu nền chữ","Document colors":"Màu văn bản"},getPluralForm(n){return 0;}}};
e[ 'vi' ] ||= { dictionary: {}, getPluralForm: null };
e[ 'vi' ].dictionary = Object.assign( e[ 'vi' ].dictionary, dictionary );
e[ 'vi' ].getPluralForm = getPluralForm;
} )( window.CKEDITOR_TRANSLATIONS ||= {} );
