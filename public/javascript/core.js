/* YAHOO USER INTERFACE 2.5.2 */
var $Event = YAHOO.util.Event;
var $Dom = YAHOO.util.Dom;
var $Connect = YAHOO.util.Connect;
var $Anim = YAHOO.util.Anim;
var $Cookie = YAHOO.util.Cookie;
$Dom.getClassName = function(elm){
		if (elm === null || elm.length === 0){
			return null;
		}				
		if (typeof(elm) == 'object') {
			return elm.className.trim();
		} else {
			var _object = $Dom.get(elm);
			if (_object === null){
				return null;
			}
			var className = _object.className;
			_object = null;			
			return className.trim();	
		}
};
$Dom.setClassName = function(object, _className){
	Object.className = _className;
};


/*
----------------------------------------------------------------------------------
*/
var showError = function(message){
	alert(message);
};
var handleFailure = function(o){	
	showError(o.responseText);	
};
var executeTransaction = function(sUrl, callback, postData){
	var request = $Connect.asyncRequest('POST', sUrl, callback, postData);
};




$Util = {
	Pix2Number : function (strPx) {
		var strNumero = strPx.replace("px", "");
		return parseInt(strNumero, 0);		
	},
	CreateHtmlElement : function(pObj) {
		if (!pObj.elm) { return false; }
		
		var htmlEl = document.createElement(pObj.elm);
		
		for (var cA in pObj) {
			switch (cA.toLowerCase()) {
				case 'elm':
				case 'tojsonstring':
					break;					
				case 'class':
					if (document.all) {
						htmlEl.setAttribute('className', pObj[cA]);
					}
					else {
						htmlEl.setAttribute(cA, pObj[cA]);
					}					
					break;
					
				case 'value':
					htmlEl.setAttribute('defaultValue', pObj[cA]);
					htmlEl.setAttribute(cA, pObj[cA]);
					break;
					
				default:
					htmlEl.setAttribute(cA, pObj[cA]);
					break;					
			}
		}
			
		return htmlEl;
	},
	createText : function(text){
		return document.createTextNode(text);
	},
	
	/*
	Return true when the browser es IE, otherwise false
	*/
	IsIE : function() {
		return YAHOO.util.Event.isIE;
	},
	IsIE6: function() {
		var browser = navigator.appName;
		var result = false;
		if (browser == 'Microsoft Internet Explorer') {
			var version = navigator.appVersion;
			if (version.indexOf('MSIE 6') > 0 ) {
				result =  true;
			}
		} 
		browser = null;
		return result;
	},
	removeChildren: function(obj){
		if (obj === null || obj === undefined){
			return;
		}
		var _obj;
		if (typeof(obj) == 'object') {
			_obj = obj;
		} else {
			_obj = $Dom.get(obj);
			if (_obj === null){
				return;
			}			
		}
				
		this.purge(_obj);
		while (_obj.firstChild) {
		  _obj.removeChild(_obj.firstChild);
		}
		_obj = null;
	},
	purge: function(d){
		var a = d.attributes, i, l, n;
	    if (a) {
	        l = a.length;
	        for (i = 0; i < l; i += 1) {
	            n = a[i].name;
	            if (typeof d[n] == 'function') {
	                d[n] = null;
	            }
	        }
	    }
	    a = d.childNodes;
	    if (a) {
	        l = a.length;
	        for (i = 0; i < l; i += 1) {
	            this.purge(d.childNodes[i]);
	        }
	    }
		a = null;
		i = null;
		l = null;
		n = null;		
	},
	showUrl: function(url){
		window.open(url, '');
	}
};
$Url = {
	/**
	*
	* URL encode / decode
	* http://www.webtoolkit.info/
	*
	**/
    // public method for url encoding	
	encodeUTF8 : function (string) {
		string = string.replace(/\r\n/g,"\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return escape(utftext);			
    },

    // public method for url decoding
    decodeUTF8: function (utftext) {
		utftext = unescape(utftext);
		var string = "";
        var i = 0;
        var c =0, c1 = 0, c2 = 0;

        while ( i < utftext.length ) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
		
        //return _utf8_decode(unescape(string));
    }
};

/**
 * Construye un objeto Size.
 * @constructor  
 * @class Representa un tama�o.<br><br>
 * Esta clase proporciona la utilidad de representar un tama�o
 * y no tiene una m�trica definida ni un uso particular, 
 * de forma que el desarrollador puede dar el uso que se acomode a sus necesidades.
 * <br><br>
 * @param {int} width Ancho.
 * @param {int} height Alto.
 * @see Position
 */
Size = function (width, height) {
	var _self = this;
	
	/**
	 * @ignore
	 */
	this.width = width;
	
	
	/**
	 * @ignore
	 */
	this.height = height;

	
	/**
	 * Asigna el ancho.
	 * @param {int} width El ancho para asignar al objeto.
	 */
	this.setWidth = function (width) { _self.width = width; };
	
	
	/**
	 * Retorna el ancho.
	 * @type int
	 */
	this.getWidth = function () { return _self.width; };
	
	
	/**
	 * Asigna el ancho.
	 * @param {int} height El alto para asignar al objeto.
	 */
	this.setHeight = function (height) { _self.height = height; };
	
	
	/**
	 * Retorna el alto.
	 * @type int
	 */	
	this.getHeight = function () { return _self.height; };
};

String.prototype.iTrim = function() { return this.replace(/( )+/g, ' '); };
String.prototype.lTrim = function() { return this.replace(/\s*((\S+\s*)*)/, '$1'); };
String.prototype.rTrim = function() { return this.replace(/((\s*\S+)*)\s*/, '$1'); };
String.prototype.trim = function() { return this.lTrim().rTrim(); };
String.prototype.replaceAll = function(pcFrom, pcTo){
	var i = this.indexOf(pcFrom);
	var c = this;
	
	while (i > -1){
		c = c.replace(pcFrom, pcTo); 
		i = c.indexOf(pcFrom);
	}
	return c;
};

/**
* Returns a string with character ch n times
**/
function fillString(n,ch){
	var i,newStr;

	newStr = "";
	for (i = 0; i < n; i++){
		newStr = newStr + ch;
	}
	
	return newStr;
}							// fillString

/**
* Removes all ocurrence of characters in chars from string input
**/
function stripChars(s,chs){
	var output = "";  // initialise output string

	for (var i=0; i < s.length; i++){
		if (chs.indexOf(s.charAt(i)) == -1){
			output += s.charAt(i);
		}
	}
		
	return output;
}							// removeChar

/**
* Removes trailing spaces at the left side of str
**/
/*
function ltrim(str){	
	while(str.length > 0 && (str.charAt(0) == " " || str.charCodeAt(0) == 160)){
		str = str.substr(1,str.length);
	}
	return str;
}									// LTrim
*/
/**
* Removes trailing spaces at the right side of str
**/
/*
function rtrim(str){
	while(str.length > 0 && (str.charAt(str.length-1) == " " || str.charCodeAt(str.length-1) == 160)){
		str = str.substr(0,str.length-1);
	}
	
	return str;
}								// RTrim
*/
/**
* Removes trailing spaces at the right and left side of str
**/
/*
function trim(theStr){
	theStr = rtrim(theStr);
	theStr = ltrim(theStr);
	
	return theStr;
}										// Trim
*/
/**
* Returns true if s is an empty string, eg if s is null or s.length === 0 or trim(s) == ""
**/
function isEmpty(s){
	return (s === null || s.length === 0 || (s.trim()) === "");
}								// isEmpty


/*
* Formats a 10 digit rut into ###.###.###-# format
*/
function formatRut(rut){
	var rutDigits,checkDigit,rutValue,newRut;

	// Remove trailing spaces and check taht there really are 10 chars
	rutValue = rut.trim();
	if (rutValue.length != 10){
		return "###.###.###-#";
	}

	rutDigits = rutValue.substr(0,rutValue.length-1);
	checkDigit = rutValue.substr(rutValue.length-1,1);

	// Build new rut with . and -
	newRut = rutDigits.substr(0,3)+".";
	newRut = newRut + rutDigits.substr(3,3)+".";
	newRut = newRut + rutDigits.substr(6,3);

	// Remove trailing 0 

	while (newRut.substr(0,1) == "0" || newRut.substr(0,1) == "."){
	   newRut = newRut.substr(1,newRut.length);
	}

	return newRut+"-"+checkDigit;
}										// formatRut

/*
* Formats a decimal according to nnnnnnnnnn.nnnnnn
*/
function formatDecimal(s){	
	if (s !== null){
		// If we have a , chaarcter we should probably convert
		if (s.indexOf(",") > -1 || (s.indexOf(".") > -1 && s.indexOf(".") != s.lastIndexOf("."))){
			s = stripChars(s,".");
			s = s.replace(/,/,".");
		}
		
	}
	
	return s;
}

/*
------------------------------------------------------------------------------------------------------------
*/


/**
 * Expand a div
 * @param {Object} id
 * @param {Object} image
 * require CSS: elementHidden, elementVisible
 */
var showDiv = function(id, image){
	$Dom.replaceClass(id, 'elementHidden', 'elementVisible');	
	if (image !== null){
		$Dom.get(image.id).src = image.imageUp;
	}
};

/**
 * Hide a div
 * @param {Object} id
 * @param {Object} image
 * require CSS: elementHidden, elementVisible
 */
var hideDiv = function(id, image){	
	$Dom.replaceClass(id, 'elementVisible', 'elementHidden');	
	if (image !== null){
		$Dom.get(image.id).src = image.imageDown;
	}
};

/**
 * Allow expand or contract on div
 * @param {Object} id
 * @param {Object} image
 */
var expandDiv = function(id, image){
	var state = $Dom.getStyle(id, 'visibility');
	if (state == 'hidden'){
		showDiv(id, image);
	} else {
		hideDiv(id, image);
	}
};

/**
 * Set a background color for over
 * @param {Object} obj
 */
var putShadowColor = function(objeto, color){
	currFontColor = $Dom.getStyle(objeto, 'color');
	currBgColor = $Dom.getStyle(objeto, 'background-color');
	
	$Dom.setStyle(objeto, 'background-color',color);
	$Dom.setStyle(objeto, 'color','black');
};

/**
 * Set a background color for over
 * @param (event)		ev
 * @param {parameter} 	obj
 */
var putShadowStyle = function(ev, parameter){
	currBgColor = $Dom.getStyle(parameter.object, 'background-color');	
	currFontColor = $Dom.getStyle(parameter.object, 'color');
	
	$Dom.setStyle(parameter.object, 'background-color', parameter.bgColor);	
	$Dom.setStyle(parameter.object, 'color', parameter.fontColor);	
	
};

/**
 * Set a background color for over
 * @param {Object} obj
 */
var putShadow = function(objeto){
	currFontColor = $Dom.getStyle(objeto, 'color');
	currBgColor = $Dom.getStyle(objeto, 'background-color');
	
	$Dom.setStyle(objeto, 'background-color','#acd6ff');
	$Dom.setStyle(objeto, 'color','black');
};

/**
 * Remove a background color that was setted in putShadow()
 * @param (event)	ev
 * @param {Object} 	obj
 */
var removeShadow = function(ev, objeto){
	if (currBgColor === null){
		$Dom.setStyle(objeto, 'background-color','');
	} else {
		$Dom.setStyle(objeto, 'background-color',currBgColor);
	}
	if (currFontColor === null){
		$Dom.setStyle(objeto, 'color','');
	} else {
		$Dom.setStyle(objeto, 'color',currFontColor);
	}
};

/**
 * Set attributes for event onmouseover in pages of pagination
 * @param {Object} id
 * require CSS: itemPaginationOut, itemPaginationOver
 */
var overPagination = function(id){	
	$Dom.replaceClass(id, 'itemPaginationOut', 'itemPaginationOver');
};

/**
 * Remove attributes that was setted  in overPagination()
 * @param {Object} id
 * require CSS: itemPaginationOver, itemPaginationOut
 */
var outPagination = function(id){	
	$Dom.replaceClass(id, 'itemPaginationOver', 'itemPaginationOut');
};

/**
 * Set attributes for event onmouseover in backward of pagination
 * @param {Object} id
 * @param {Object} type
 * require CSS: itemPaginationOut, itemPaginationOver
 */
var overPaginationNav = function(id, type, pathImages, sufix){	
	if (sufix === undefined || sufix === null){
		sufix = "";
	}
	$Dom.replaceClass(id, 'itemPaginationOut', 'itemPaginationOver');
	if (type == 'left'){
		$Dom.get('imgAnterior' + sufix).src = pathImages + 'navLeft2.gif';
	} else {
		$Dom.get('imgSiguiente' + sufix).src = pathImages + 'navRight2.gif';
	}
};

/**
 * Remove attributes that was setted  in overPaginationNav()
 * @param {Object} id
 * @param {Object} type
 * require CSS: itemPaginationOver, itemPaginationOut
 */
var outPaginationNav = function(id, type, pathImages, sufix){	
	if (sufix === undefined || sufix === null){
		sufix = "";
	}
	$Dom.replaceClass(id, 'itemPaginationOver', 'itemPaginationOut');
	if (type == 'left'){
		$Dom.get('imgAnterior' + sufix).src = pathImages + 'navLeft.gif';
	} else {
		$Dom.get('imgSiguiente' + sufix).src = pathImages + 'navRight.gif';
	}
};

/**
 * Put color effect on blur input
 * @param {Object} obj
 */
var mouseOverInput = function(obj){
	$Dom.setStyle(obj, 'border-style','solid');
	$Dom.setStyle(obj, 'border-color','#009dff');
	$Dom.setStyle(obj, 'border-width','2px');	
};

/**
 * Remove color effect on input
 * @param {Object} obj
 */
var removeMouseOverInput = function(obj){	
	$Dom.setStyle(obj, 'border-style','');
	$Dom.setStyle(obj, 'border-color','');
	$Dom.setStyle(obj, 'border-width','');	
};
/**
 * Select or remove select checkbox
 * @param {Object} obj
 */
var checkAllOptions = function(objeto, className){
 	var _elements = $Dom.getElementsByClassName(className);
	for (var i=0; i < _elements.length;i++){
		_elements[i].checked = objeto.checked;
	}
};

/**
 * Expand a div
 * @param {Object} id
 * @param {Object} image
 * require CSS: elementHidden, elementVisibleAbsolute
 */
var showDivWithoutPosition = function(id, image){	
	$Dom.replaceClass(id, 'elementHidden', 'elementVisibleAbsolute');	
	if (image !== null){
		$Dom.get(image.id).src = image.imageUp;
	}	
};
/**
 * Hide a div
 * @param {Object} id
 * @param {Object} image
 * require CSS: elementVisibleAbsolute, elementHidden
 */
var hideDivWithoutPosition = function(id, image){	
	$Dom.replaceClass(id, 'elementVisibleAbsolute', 'elementHidden');	
	if (image !== null){
		$Dom.get(image.id).src = image.imageDown;
	}	
};

/**
 * Allow expand or contract on div
 * @param {Object} id
 * @param {Object} image
 */
var expandDivWithoutPosition = function(id, image){
	var state = $Dom.getStyle(id, 'visibility');
	if (state == 'hidden'){
		showDivWithoutPosition(id, image);
	} else {
		hideDivWithoutPosition(id, image);
	}
};

/**
 * Return a file name
 * @param (url)	url
 */
var getNameFile = function(url){
	var position = url.lastIndexOf('/');
	if (position != -1){
		return url.substring(position + 1);
	} else {
		return "";
	}
};
/*
 * require CSS: ContainerRowPar, ContainerRowImPar
*/
var getRowClass = function(row){
	if (row % 2 === 0){
		return 'ContainerRowPar';
	} else {
		return 'ContainerRowImPar';
	}
};

/**
 * Update elements from select to another select
 * @param (_from)	select origin
 * @param (_to)		select destiny
 */
var updateSelect = function(_from, _to){	
	var selectFrom = $Dom.get(_from);
	var selectTo = $Dom.get(_to);
	var option;
	
	if (selectFrom === null || selectTo === null){
		return;
	}
	selectTo.length = 0;
	for(var c=0; c < selectFrom.length; c++){
		option = selectFrom[c];
		selectTo.options[selectTo.length] = new Option(option.text, option.value);
		$Dom.addClass(selectTo.options[selectTo.length -1 ], getRowClass(c+1));
	}		
	selectFrom = null;
	selectTo = null;
};

/**
 * Call a keypress event generic from a control with onclick event
 *
 * @param (e)			event
 * @param (buttonId)	control with onclick event
 */
var callKeyPress = function(e, buttonId){
	var t = $Event.getTarget(e);
	var c = $Event.getCharCode(e);	
	if (c == 13) {		
		var _button = $Dom.get(buttonId);
		if (_button !== null){
			_button.onclick();
		}
	}
	t = null;
	c = null;
};
/*
 * require CSS: withInitial, initialHover
 */
var hightLightInitial = function(object){	
	$Dom.replaceClass(object, 'withInitial', 'initialHover');	
};

var removeHightLightInitial = function(object){
	$Dom.replaceClass(object, 'initialHover', 'withInitial');
};

var hightLight = function(object){
 $Dom.replaceClass(object, 'listaData', 'listaDataHover');
};

var removeHightLight = function(object){
 $Dom.replaceClass(object, 'listaDataHover', 'listaData');
};

var changeBackground = function(e, parameter) {
 $Dom.setStyle(parameter.object, 'background-color', parameter.color);
};



/**
 * Select or remove select checkbox
 * @param {Object} obj
 */
 /*
var checkOptions = function(obj){
	var _elements = $Dom.getElementsByClassName('checkitem');
	for (var i=0; i < _elements.length;i++){
		_elements[i].checked = obj.checked;
	}
};
*/


var aLink = function(objeto){
 $Dom.replaceClass(objeto, 'tblCategory', 'tblLightCategory');
};

var removeALink = function(objeto){
 $Dom.replaceClass(objeto, 'tblLightCategory','tblCategory');
};

/**
 * Change menu of Habladas 3.0
 */
var viewMenu = function(){
	$Dom.get('user').value.trim();
	$Dom.get('pass').value.trim();
	var _user = $Dom.get('user').value.length;
	var _pass = $Dom.get('pass').value.length;
	
	if (_user === 0){
		$Dom.get('user').focus();
		return;
	}
	if (_pass === 0){
		$Dom.get('pass').focus();
		return;
	}	
	_user = null;
	_pass = null;
	$Dom.get('datos').submit();
};

var removeObject = function(id){
	var _object = $Dom.get(id);
	if (_object === null){
		return;
	}
	$Util.removeChildren(_object);
	_object = null;
};
var changeImage = function(objeto, image){
	
	if (objeto === null || image === null){
		return;
	}
	
	if (typeof objeto == 'object') {
		objeto.src = image;
	} else {
		var obj = $Dom.get(objeto);
		if (obj === null){
			return;
		} else {
			obj.src = image;
		}
	}
};
var toGo = function(url){
	location.href = url;
};



Array.prototype.exists = function (value) {
	for (var i = 0; i <= this.length; i++) {
		if (this[i] == value) {
			return true;
		}
	}	
	return false;
};
Array.prototype.remove = function(value) {
	// Simple prototype to
	// remove an element from
	// a normal or multidimension Array	
	for (var i = 0; i < this.length; i++) {
		if (this[i] == value) {
			this.splice(i, 1);
		}
		else if (this[i].length > 0) {
			this[i].remove(value);
		}
   }
   return this;
};
/**
 * Return a boolean whith the validation of email
 * @param {strValue} 	value
 *
 */
var validateEmail= function(strValue) {
	var objRegExp  = /^[a-z0-9]([a-z0-9_\-\.]*)@([a-z0-9_\-\.]*)(\.[a-z]{2,3}(\.[a-z]{2}){0,2})$/i;  
  	return objRegExp.test(strValue);
};

/**
 * Return a boolean whith the validation of numeric
 * @param {strValue} 	value
 *
 */
var validateNumeric = function( strValue ) {
	var objRegExp  =  /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/; 
	return objRegExp.test(strValue);
};

/**
 * Return a boolean whith the validation of integer
 * @param {strValue} 	value
 *
 */
var validateInteger = function( strValue ) {
	var objRegExp  = /(^-?\d\d*$)/;
	return objRegExp.test(strValue);
};

/**
 * Return a boolean whith the validation of number phone
 * @param {strValue} 	value
 *
 */
var validatePhone = function(strValue) {
	var objRegExp = /^(\(\d{1,3}\)\s?|\d{1,3}(\s|\-))?\d{1,8}((\s|\-)\d{1,3})?$/;
	return objRegExp.test(strValue);
	
};

/**
 * Return a boolean whith the validation of string
 * @param {strValue} 	value
 *
 */
var validateString = function(strValue) {
	return true;
};

/**
 * Return a boolean whith the validation url image
 * @param {strValue} 	value
 *
 */
var validateUrlImage = function(strValue) {
	return true;
};

/**
 * Return a boolean whith the validation of selectedindex from a select
 * @param {strValue} 	value
 *
 */
var validateList = function(_object){
	if (_object === null){
		return false;
	}
	if (_object.selectedIndex !== 0){
		return true;
	} else {
		return false;
	}
};

/**
 * Return a boolean whith the validation of length from a select
 * @param {strValue} 	value
 *
 */
var validateSelection1 = function(_object){
	if (_object === null){
		return false;
	}
	if (_object.length > 0){
		return true;
	} else {
		return false;
	}
};

/**
 * Return a boolean whith the validation of rut
 * @param {type} 		type of control
 * @param {label} 		label
 *
 */
var validateRut= function(rut, dv){	
	dv = dv.toLowerCase() + '';
	
	var found = false;	
	var _rut = '';	
	var item;
	
	for(var t=0; t < rut.length; t++){
		item = rut.charAt(t);
		if (validateNumeric(item)){
			_rut+= item;
		} else {			
			if (item !== '.'){
				found = true;
				t = rut.length;
			}
		}
	}
	if (found){
		return false;
	}
	if (dv.length != 1){
		return false;
	}
	if (!validateNumeric(dv)){
		if (dv !== 'k'){
			return false;

		}
	}	
	rut = _rut;
	
	if (rut.length < 1 || !validateNumeric(rut)){
		return false;
	}	
	var mult = 1;
	var suma = 0;
	for(var i=rut.length-1; i>=0; i--) {
		mult++;		
		suma+= mult * rut.charAt(i);		
		if (mult == 7){
			mult = 1;
		}		
	}
	var res = (11 - (suma % 11)) + '';	
	var _dv;
	if (res == '10') {
		_dv = 'k';
	} else if (res == '11'){
		_dv = '0';
	} else {
		_dv = res;
	}	
	if (dv == _dv) {
		return true;
	} else {
		return false;
	}
};

/**
 * Remove spaces for all input-text from a form
 * @param {_form} 	form name
 *
 */
var removeSpaceFromForm = function(_form){
	var form = $Dom.get(_form);
	var _inputs = form.getElementsByTagName('input');
	for (var e=0; e < _inputs.length; e++){
		if (_inputs[e].type == 'text'){
			_inputs[e].value = _inputs[e].value.trim();
		}
	}
	form = null;
	_inputs = null;
};
/**
 * Return a message from a type when the control is invalid
 * @param {type} 		type of control
 * @param {label} 		label
 *
 */
var getMessageErrorInvalid = function(type, label) {
	var _message = '';
	switch (type){
		case "numeric":
			_message = label + " no v\u00E1lido.";
			break;
		case "integer":
			_message = label + " no v\u00E1lido.";
			break;
		case "email":
			_message = label + " no v\u00E1lido.";
			break;
		case "phone":
			_message = label + " no v\u00E1lido.";
			break;
		case "rut":
			_message = label + " no v\u00E1lido.";
			break;
		case "image":
			_message = label + " no v\u00E1lida.";
			break;
		case "list":
			_message = "Debe seleccionar un item dentro de " + label + ".";
			break;
		case "selection1":
			_message = "Debe ingresar por lo menos un " + label + ".";
			break;
		default:
			_message = label + " no v\u00E1lido.";
			break;
	}
	return _message;
};

/**
 * Return a message from a type when the control is empty
 * @param {type} 		type of control
 * @param {label} 		label
 *
 */
var getMessageErrorEmpty = function(type, label) {
	var _message = '';
	switch (type){
		case "numeric":
			_message = "Se requiere " + label + ".";
			break;
		case "integer":
			_message = "Se requiere " + label + ".";
			break;
		case "email":
			_message = "Se requiere " + label + ".";
			break;
		case "phone":
			_message = "Se requiere " + label + ".";
			break;
		case "rut":
			_message = "Se requiere " + label + ".";
			break;
		case "image":
			_message = "Se requiere " + label + ".";
			break;
		case "list":
			_message = "Debe seleccionar un item dentro de " + label + ".";
			break;
		case "selection1":
			_message = "Debe ingresar por lo menos un " + label + ".";
			break;
		default:
			_message = "Se requiere " + label + ".";
			break;		
	}
	return _message;
};

/**
 * Return a boolean whith the all validation of controls from a form
 * @param {form} 		form name
 * @param {fiels} 		json with all field to verify
 *
 */
var isValidFieldsForm = function(form, fields){
	removeSpaceFromForm(form);
	var result = true;	
	var TYPE_EMPTY = 1;
	var TYPE_ERROR = 2;
	var TYPE_STRUCTURE = 3;
	var typeMessage = TYPE_ERROR;
	var field;
	var respuesta = {};
	var _message = '';
	
	for(var i=0;i < fields.length; i++){		
		var registro = fields[i];
		if (fields[i].id.length !== 0){
			field = $Dom.get(fields[i].id[0]);						
			if (fields[i].id.length === 1){								
				if (fields[i].obligatory || field.value.length > 0){				
					switch (fields[i].type){
						case "numeric":
							if (field.value.length === 0){
								typeMessage = TYPE_EMPTY;
								result = false;
							} else {
								result = validateNumeric(field.value);
							}
							break;						
						case "integer":
							if (field.value.length === 0){
								typeMessage = TYPE_EMPTY;
								result = false;
							} else {
								result = validateInteger(field.value);
							}
							break;	
						case "email":
							if (field.value.length === 0){
								typeMessage = TYPE_EMPTY;
								result = false;
							} else {
								result = validateEmail(field.value);
							}
							break;
						case "phone":
							if (field.value.length === 0){
								typeMessage = TYPE_EMPTY;
								result = false;
							} else {
								result = validatePhone(field.value);
							}
							break;
						case "image":
							if (field.value.length === 0){
								typeMessage = TYPE_EMPTY;
								result = false;
							} else {
								result = validateUrlImage(field.value);
							}
							break;
						case "list":
							result = validateList(field);
							break;
						case "selection1":
							result = validateSelection1(field);
							break;
						default:
							if (field.value.length === 0){
								typeMessage = TYPE_EMPTY;
								result = false;
							} else {
								result = validateString(field.value);
							}
							break;
					}					
				}					
			} else {					
				if (fields[i].type === "rut"){
					if (fields[i].id.length !== 2){
						typeMessage = TYPE_STRUCTURE;
						result = false;
					} else {
						var rut = $Dom.get(fields[i].id[0]).value;
						var dv = $Dom.get(fields[i].id[1]).value;
						if (rut.length < 1 || dv.length < 1){	
							typeMessage = TYPE_EMPTY;						
							result = false;
						} else {						
							result = validateRut(rut, dv);
						}
						rut = null;
						dv = null;
					}				
				} else {
					typeMessage = TYPE_STRUCTURE;
					result = false;
				}				
			}
			if (!result){
				if (typeMessage == TYPE_STRUCTURE) {
					_message = 'Estructura de datos no v\u00E1lida.';
				} else {
					if (fields[i].showMessage){
						if (typeMessage == TYPE_EMPTY){
							_message = getMessageErrorEmpty(fields[i].type, fields[i].message);
						} else {
							_message = getMessageErrorInvalid(fields[i].type, fields[i].message);
						}
					} else {
						_message = 'Faltan datos.';
					}
				}							
				respuesta = {"result": false, "focus": true, "object": fields[i].id[0], "message": _message};
				i = fields.length;	
			}	
			field = null;
		} else {
			respuesta = {"result": false, "focus": false, "object": null, "message": "Estructura de datos no v\u00E1lida."};
			result = false;
		}	
	}
	if (result){
		respuesta = {"result": true, "focus": false, "object": null, "message": null};
	}	
	
	result = null;
	TYPE_EMPTY = null;
	TYPE_ERROR = null;
	TYPE_STRUCTURE = null;
	typeMessage = null;
	field = null;
	_message = null;
	
	return respuesta;
};




/**
 * Allow only integers
 * @param {e} 		event
 *
 */
var acceptOnlyInteger = function(e){	
	var t = $Event.getTarget(e);
	var c = $Event.getCharCode(e);	
	return (c <= 13 || (c >= 48 && c <= 57) || (c >= 35 && c <= 37) || c == 39 || c == 46);
};

/**
 * Allow only dv in rut
 * @param {e} 		event
 *
 */
var acceptOnlyDvRut = function(e){	
	var t = $Event.getTarget(e);
	var c = $Event.getCharCode(e);		
	return (c <= 13 || (c >= 48 && c <= 57) || (c >= 35 && c <= 37) || c == 39 || c == 46 || c == 107 || c == 75);
};

/**
 * Allow only number phone
 * @param {e} 		event
 *
 */
var acceptOnlyPhone = function(e){	
	var t = $Event.getTarget(e);
	var c = $Event.getCharCode(e);
	return (c <= 13 || (c >= 48 && c <= 57) || (c >= 35 && c <= 37) || (c >= 39 && c <= 41) || (c >= 45 && c <= 46) || c == 32);
};




var showContent = function(o){
	
	if (o.responseText === null) {
		showError("ERROR");
		return;
	}
	var params, _container, _fn, _params;
	
	params = o.argument;
	_container = params.container;
	if (_container.lenght === 0){
		showError("ERROR");
		return;
	}	
	
	$Util.removeChildren(_container);
	$Dom.get(_container).innerHTML = o.responseText;
	
	if (params.callback !== undefined && params.callback !== null){
		if (params.params !== undefined && params.params !== null){			
			_fn = params.callback;
			_params = params.params;
			_fn(_params);
		} else {
			params.callback();
		}
	}
	
	params = null;
	_container = null;
	_fn = null;
	_params = null;
};


