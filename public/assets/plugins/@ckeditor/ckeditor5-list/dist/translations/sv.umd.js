/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

( e => {
const { [ 'sv' ]: { dictionary, getPluralForm } } = {"sv":{"dictionary":{"Numbered List":"Numrerad lista","Bulleted List":"Punktlista","To-do List":"Att-göra-lista","Bulleted list styles toolbar":"Verktygsfält för punktlistor","Numbered list styles toolbar":"Verktygsfält för numrerade listor","Toggle the disc list style":"Växla till disklisttypen","Toggle the circle list style":"Växla till cirkellisttypen","Toggle the square list style":"Växla till fyrkantslisttypen","Toggle the decimal list style":"Växla till decimallisttypen","Toggle the decimal with leading zero list style":"Växla till listtypen decimal-med-inledande-nolla","Toggle the lower–roman list style":"Växla till listtypen romerska gemener","Toggle the upper–roman list style":"Växla till listtypen romerska versaler","Toggle the lower–latin list style":"Växla till listtypen latinska gemener","Toggle the upper–latin list style":"Växla till listtypen latinska versaler ","Disc":"Disk","Circle":"Cirkel","Square":"Fyrkant","Decimal":"Decimal","Decimal with leading zero":"Decimal med inledande nolla","Lower–roman":"Romerska gemener","Upper-roman":"Romerska versaler","Lower-latin":"Latinska gemener","Upper-latin":"Latinska versaler","List properties":"Listegenskaper","Start at":"Börja på","Invalid start index value.":"Ogiltigt startvärde på indexet.","Start index must be greater than 0.":"Startindex måste vara större än 0.","Reversed order":"Byt riktning","Keystrokes that can be used in a list":"Tangenter som fungerar i en lista","Increase list item indent":"Öka indrag på listobjekt","Decrease list item indent":"Minska indrag på listobjekt","Entering a to-do list":"Fyller i en att-göra-lista","Leaving a to-do list":"Lämnar en att-göra-lista"},getPluralForm(n){return (n != 1);}}};
e[ 'sv' ] ||= { dictionary: {}, getPluralForm: null };
e[ 'sv' ].dictionary = Object.assign( e[ 'sv' ].dictionary, dictionary );
e[ 'sv' ].getPluralForm = getPluralForm;
} )( window.CKEDITOR_TRANSLATIONS ||= {} );
