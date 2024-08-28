/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

( e => {
const { [ 'da' ]: { dictionary, getPluralForm } } = {"da":{"dictionary":{"Special characters":"Specialtegn","All":"Alle","Arrows":"Pile","Currency":"Valuta","Latin":"Latin","Mathematical":"Matematisk","Text":"Tekst","leftwards simple arrow":"venstrepegende simpel pil","rightwards simple arrow":"højrepegende simpel pil","upwards simple arrow":"opadgående simpel pil","downwards simple arrow":"nedadgående simpel pil","leftwards double arrow":"venstrepegende dobbeltpil","rightwards double arrow":"højrepegende dobbeltpil","upwards double arrow":"Opadpegende dobbeltpil","downwards double arrow":"nedadpegende dobbeltpil","leftwards dashed arrow":"venstrepegende stiplet pil","rightwards dashed arrow":"højrepegende stiplet pil","upwards dashed arrow":"opadpegende stiplet pil","downwards dashed arrow":"nedadpegende stiplet pil","leftwards arrow to bar":"venstrepegende pil mod bjælke","rightwards arrow to bar":"højrepegende pil mod bjælke","upwards arrow to bar":"opadpegende pil mod bjælke","downwards arrow to bar":"nedadpegende pil mod bjælke","up down arrow with base":"Op- og nedadpegende pil med streg under","back with leftwards arrow above":"tilbage med venstrepegende pil over","end with leftwards arrow above":"afslut med venstrepegende pil over","on with exclamation mark with left right arrow above":"til med udråbstegn med pil mod venstre og højre over","soon with rightwards arrow above":"snart med højrepegende pil over","top with upwards arrow above":"top med opadpegende pil over","Dollar sign":"Dollartegn","Euro sign":"Eurotegn","Yen sign":"Yen-tegn","Pound sign":"Pund-tegn","Cent sign":"Cent-tegn","Euro-currency sign":"Euro-valutategn","Colon sign":"Kolontegn","Cruzeiro sign":"Cruzeiro-tegn","French franc sign":"Franske franc-tegn","Lira sign":"Lira-tegn","Currency sign":"Valuta-tegn","Bitcoin sign":"Bitcoin-tegn","Mill sign":"Mill-tegn","Naira sign":"Naira-tegn","Peseta sign":"Peseta-tegn","Rupee sign":"Rupee-tegn","Won sign":"Won-tegn","New sheqel sign":"Ny Shekel-tegn","Dong sign":"Dong-tegn","Kip sign":"Kip-tegn","Tugrik sign":"Tugrik-tegn","Drachma sign":"Drakmer-tegn","German penny sign":"Tysk penny-tegn","Peso sign":"Peso-tegn","Guarani sign":"Guarani-tegn","Austral sign":"Austral-tegn","Hryvnia sign":"Hryvnia-tegn","Cedi sign":"Cedi-tegn","Livre tournois sign":"Livre tournois-tegn","Spesmilo sign":"Spesmilo-tegn","Tenge sign":"Tenge-tegn","Indian rupee sign":"Indisk rupee-tegn","Turkish lira sign":"Tyrkisk lira-tegn","Nordic mark sign":"Nordisk mark-tegn","Manat sign":"Manat-tegn","Ruble sign":"Rubel-tegn","Latin capital letter a with macron":"Latinsk stort bogstav a med macron","Latin small letter a with macron":"Latinsk lille bogstav a med macron","Latin capital letter a with breve":"Latinsk stort bogstav a med en breve","Latin small letter a with breve":"Latinsk lille bogstav a med en breve","Latin capital letter a with ogonek":"Latinsk stort bogstav a med ogonek","Latin small letter a with ogonek":"Latinsk lille bogstav a med ogonek","Latin capital letter c with acute":"Latinsk stort bogstav c med accent","Latin small letter c with acute":"Latinsk lille bogstav c med accent","Latin capital letter c with circumflex":"Latinsk stort bogstav c med cirkumfleks","Latin small letter c with circumflex":"Latinsk ille bogstav c med cirkumfleks","Latin capital letter c with dot above":"Latinsk stort bogstav c med prik over","Latin small letter c with dot above":"Latinsk lille bogstav c med prik over","Latin capital letter c with caron":"Latinsk stort bogstav c med caron","Latin small letter c with caron":"Latinsk lille bogstav c med caron","Latin capital letter d with caron":"Latinsk stort bogstav d med caron","Latin small letter d with caron":"Latinsk lille bogstav d med caron","Latin capital letter d with stroke":"Latinsk stort bogstav d med streg","Latin small letter d with stroke":"Latinsk lille bogstav d med streg","Latin capital letter e with macron":"Latinsk stort bogstav e med macron","Latin small letter e with macron":"Latinsk lille bogstav e med macron","Latin capital letter e with breve":"Latinsk stort bogstav e med en breve","Latin small letter e with breve":"Latinsk lille bogstav e med en breve","Latin capital letter e with dot above":"Latinsk stort bogstav e med en prik over","Latin small letter e with dot above":"Latinsk lille bogstav e med en prik over","Latin capital letter e with ogonek":"Latinsk stort bogstav e med ogonek","Latin small letter e with ogonek":"Latinsk lille bogstav e med ogonek","Latin capital letter e with caron":"Latinsk stort bogstav e med caron","Latin small letter e with caron":"Latinsk lille bogstav e med caron","Latin capital letter g with circumflex":"Latinsk stort bogstav g med cirkumfleks","Latin small letter g with circumflex":"Latinsk lille bogstav g med cirkumfleks","Latin capital letter g with breve":"Latinsk stort bogstav g med en breve","Latin small letter g with breve":"Latinsk lille bogstav g med en breve","Latin capital letter g with dot above":"Latinsk stort bogstav g med en prik over","Latin small letter g with dot above":"Latinsk lille bogstav g med en prik over","Latin capital letter g with cedilla":"Latinsk stort bogstav g med cedille","Latin small letter g with cedilla":"Latinsk lille bogstav g med cedille","Latin capital letter h with circumflex":"Latinsk stort bogstav h med cirkumfleks","Latin small letter h with circumflex":"Latinsk lille bogstav h med cirkumfleks","Latin capital letter h with stroke":"Latinsk stort bogstav h med streg","Latin small letter h with stroke":"Latinsk lille bogstav h med streg","Latin capital letter i with tilde":"Latinsk stort bogstav i med tilde","Latin small letter i with tilde":"Latinsk lille bogstav i med tilde","Latin capital letter i with macron":"Latinsk stort bogstav i med macron","Latin small letter i with macron":"Latinsk lille bogstav i med macron","Latin capital letter i with breve":"Latinsk stort bogstav i med en breve","Latin small letter i with breve":"Latinsk lille bogstav i med en breve","Latin capital letter i with ogonek":"Latinsk stort bogstav i med ogonek","Latin small letter i with ogonek":"Latinsk lille bogstav i med ogonek","Latin capital letter i with dot above":"Latinsk stort bogstav i med en prik over","Latin small letter dotless i":"Latinsk lille i uden prik","Latin capital ligature ij":"Latinsk stort sammensat ij","Latin small ligature ij":"Latinsk lille sammensat ij","Latin capital letter j with circumflex":"Latinsk stort bogstav j med cirkumfleks","Latin small letter j with circumflex":"Latinsk lille bogstav j med cirkumfleks","Latin capital letter k with cedilla":"Latinsk stort bogstav k med cedille","Latin small letter k with cedilla":"Latinsk lille bogstav k med cedille","Latin small letter kra":"Latinsk lille bogstav kra","Latin capital letter l with acute":"Latinsk stort bogstav l med akut accent","Latin small letter l with acute":"Latinsk lille bogstav l med akut accent","Latin capital letter l with cedilla":"Latinsk stort bogstav l med cedille","Latin small letter l with cedilla":"Latinsk lille bogstav l med cedille","Latin capital letter l with caron":"Latinsk stort bogstav l med caron","Latin small letter l with caron":"Latinsk lille bogstav l med caron","Latin capital letter l with middle dot":"Latinsk stort bogstav l med prik i midten","Latin small letter l with middle dot":"Latinsk lille bogstav l med prik i midten","Latin capital letter l with stroke":"Latinsk stort bogstav l med streg","Latin small letter l with stroke":"Latinsk lille bogstav l med streg","Latin capital letter n with acute":"Latinsk stort bogstav n med akut accent","Latin small letter n with acute":"Latinsk lille bogstav n med akut accent","Latin capital letter n with cedilla":"Latinsk stort bogstav n med cedille","Latin small letter n with cedilla":"Latinsk lille bogstav n med cedille","Latin capital letter n with caron":"Latinsk stort bogstav n med caron","Latin small letter n with caron":"Latinsk lille bogstav n med caron","Latin small letter n preceded by apostrophe":"Latinsk lille bogstav n med apostrof inden ","Latin capital letter eng":"Latinsk stort bogstav eng","Latin small letter eng":"Latinsk lille bogstav eng","Latin capital letter o with macron":"Latinsk stort bogstav o med macron","Latin small letter o with macron":"Latinsk lille bogstav o med macron","Latin capital letter o with breve":"Latinsk stort bogstav o med en breve","Latin small letter o with breve":"Latinsk lille bogstav o med en breve","Latin capital letter o with double acute":"Latinsk stort bogstav o med dobbelt akut accent","Latin small letter o with double acute":"Latinsk lille bogstav o med dobbelt akut accent","Latin capital ligature oe":"Latinsk stort sammensat oe","Latin small ligature oe":"Latinsk lille sammensat oe","Latin capital letter r with acute":"Latinsk stort bogstav r med akut accent","Latin small letter r with acute":"Latinsk lille bogstav r med akut accent","Latin capital letter r with cedilla":"Latinsk stort bogstav r med cedille","Latin small letter r with cedilla":"Latinsk lille bogstav r med cedille","Latin capital letter r with caron":"Latinsk stort bogstav r med caron","Latin small letter r with caron":"Latinsk lille bogstav r med caron","Latin capital letter s with acute":"Latinsk stort bogstav s med akut accent","Latin small letter s with acute":"Latinsk lille bogstav s med akut accent","Latin capital letter s with circumflex":"Latinsk stort bogstav s med cirkumfleks","Latin small letter s with circumflex":"Latinsk lille bogstav s med cirkumfleks","Latin capital letter s with cedilla":"Latinsk stort bogstav s med cedille","Latin small letter s with cedilla":"Latinsk lille bogstav s med cedille","Latin capital letter s with caron":"Latinsk stort bogstav s med caron","Latin small letter s with caron":"Latinsk lille bogstav s med caron","Latin capital letter t with cedilla":"Latinsk stort bogstav t med cedille","Latin small letter t with cedilla":"Latinsk lille bogstav t med cedille","Latin capital letter t with caron":"Latinsk stort bogstav t med caron","Latin small letter t with caron":"Latinsk lille bogstav t med caron","Latin capital letter t with stroke":"Latinsk stort bogstav t med streg","Latin small letter t with stroke":"Latinsk lille bogstav t med streg","Latin capital letter u with tilde":"Latinsk stort bogstav u med tilde","Latin small letter u with tilde":"Latinsk lille bogstav u med tilde","Latin capital letter u with macron":"Latinsk stort bogstav u med macron","Latin small letter u with macron":"Latinsk lille bogstav u med macron","Latin capital letter u with breve":"Latinsk stort bogstav u med en breve","Latin small letter u with breve":"Latinsk lille bogstav u med en breve","Latin capital letter u with ring above":"Latinsk stort bogstav u med ring over","Latin small letter u with ring above":"Latinsk lille bogstav u med ring over","Latin capital letter u with double acute":"Latinsk lille bogstav u med dobbelt akut accent","Latin small letter u with double acute":"Latinsk stort bogstav u med dobbelt akut accent","Latin capital letter u with ogonek":"Latinsk stort bogstav u med ogonek","Latin small letter u with ogonek":"Latinsk lille bogstav u med ogonek","Latin capital letter w with circumflex":"Latinsk stort bogstav w med cirkumfleks","Latin small letter w with circumflex":"Latinsk lille bogstav w med cirkumfleks","Latin capital letter y with circumflex":"Latinsk stort bogstav y med cirkumfleks","Latin small letter y with circumflex":"Latinsk lille bogstav y med cirkumfleks","Latin capital letter y with diaeresis":"Latinsk stort bogstav y med trema","Latin capital letter z with acute":"Latinsk stort bogstav z med akut accent","Latin small letter z with acute":"Latinsk lille bogstav z med akut accent","Latin capital letter z with dot above":"Latinsk stort bogstav z med en prik over","Latin small letter z with dot above":"Latinsk lille bogstav z med en prik over","Latin capital letter z with caron":"Latinsk stort bogstav z med caron","Latin small letter z with caron":"Latinsk lille bogstav z med caron","Latin small letter long s":"Latinsk lille bogstav langt s","Less-than sign":"Mindre end-tegn","Greater-than sign":"Større end-tegn","Less-than or equal to":"Mindre end eller lig med-tegn","Greater-than or equal to":"Større end eller lig med-tegn","En dash":"En-bindestreg","Em dash":"Em-bindestreg","Macron":"Macron","Overline":"Streg over","Degree sign":"Grad-tegn","Minus sign":"Minus-tegn","Plus-minus sign":"Plus-minus-tegn","Division sign":"Divisionstegn","Fraction slash":"Brøk-tegn","Multiplication sign":"Gangetegn","Latin small letter f with hook":"Latinsk lille bogstav f med krog","Integral":"Integral","N-ary summation":"Sum-tegn","Infinity":"Uendelig","Square root":"Kvadratrod","Tilde operator":"Tilde-operator","Approximately equal to":"Nogenlunde lig med","Almost equal to":"Næsten lig med","Not equal to":"Ikke lig med","Identical to":"Lig med","Element of":"Element af","Not an element of":"Ikke et element af","Contains as member":"Element i","N-ary product":"Sumprodukttegn","Logical and":"Logisk og","Logical or":"Logisk eller","Not sign":"Ikke-tegn","Intersection":"Intersektion","Union":"Union","Partial differential":"Delvis differential","For all":"For alle","There exists":"Der eksisterer","Empty set":"Tomt sæt","Nabla":"Nabla","Asterisk operator":"Asterisk-operator","Proportional to":"Proportionelt med","Angle":"Vinkel","Vulgar fraction one quarter":"En kvart","Vulgar fraction one half":"En halv","Vulgar fraction three quarters":"Trekvart","Single left-pointing angle quotation mark":"Enkelt venstrepegende vinkel citationstegn","Single right-pointing angle quotation mark":"Enkelt højrepegende vinkel citationstegn","Left-pointing double angle quotation mark":"Venstrepegende dobbeltvinklet citationstegn","Right-pointing double angle quotation mark":"Højrepegende dobbeltvinklet citationstegn","Left single quotation mark":"Venstre enkelt citationstegn","Right single quotation mark":"Højre enkelt citationstegn","Left double quotation mark":"Venstre dobbelt citationstegn","Right double quotation mark":"Højre dobbelt citationstegn","Single low-9 quotation mark":"Enkelt lav-9 citationstegn","Double low-9 quotation mark":"Dobbelt lav-9 citationstegn","Inverted exclamation mark":"Omvendt udråbstegn","Inverted question mark":"Omvendt spørgsmålstegn","Two dot leader":"Dobbelt punktum","Horizontal ellipsis":"Horisontal ellipse","Double dagger":"Dobbeltobelisk","Per mille sign":"Promilletegn","Per ten thousand sign":"Per titusind-tegn","Double exclamation mark":"Dobbelt udråbstegn","Question exclamation mark":"Spørgsmålstegn-udråbstegn","Exclamation question mark":"Udråbstegn-spørgsmålstegn","Double question mark":"Dobbelt spørgsmålstegn","Copyright sign":"Copyright-tegnb","Registered sign":"Registreret-tegn","Trade mark sign":"Varemærke-tegn","Section sign":"Sektionstegn","Paragraph sign":"Paragraftegn","Reversed paragraph sign":"Omvendt paragraftegn","Character categories":"Tegnkategorier"},getPluralForm(n){return (n != 1);}}};
e[ 'da' ] ||= { dictionary: {}, getPluralForm: null };
e[ 'da' ].dictionary = Object.assign( e[ 'da' ].dictionary, dictionary );
e[ 'da' ].getPluralForm = getPluralForm;
} )( window.CKEDITOR_TRANSLATIONS ||= {} );
