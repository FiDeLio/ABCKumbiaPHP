var validarUsuarioCartola = function(){
	var vRut = $Dom.get('vRut');
	var vSoc = $Dom.get('vSoc');
	var vParam = 'vRut='+vRut.value+'&vSoc='+vSoc.value;
	var varTmp = '';
	if(validarRut(vRut.value))
		loadPage({  'title': 'Cartola Clientes'
				  , 'back': null
	        	  , 'url':'cartola/list.xml'
		          , 'parameter': vParam
		          , 'calendar':false
	    	      , 'iframe':false
	        	  , 'sourcePath':''});
};

var validarRut = function(vRut){
	var intRut, strDv;
	if(vRut.length > 0){
		if(vRut.indexOf('-') > 0){
			var arRut = vRut.split('-');
			intRut = parseInt(arRut[0],10);
			strDv = arRut[1];
			if(getDv(intRut) == strDv.toUpperCase()){
				return true;
			}else{
				alert("Ingrese un Rut Valido");
				return false;
			}
		}else{
			alert("Ingrese un Rut Valido");
			return false;
		}
	}else{
		alert("Ingrese un Rut Valido");
		return false;
	}
};

//DCC UChile.
var getDv = function (T){
	var M=0,S=1;
	for(;T;T=Math.floor(T/10))
	S=(S+T%10*(9-M++%6))%11;
	return S?S-1:'K';
};

var generaPDF = function(vRut,vSoc){
	
	var vRutObj = $Dom.get("vRut");
	vRutObj.value = vRut;
	
	if(validaCuentas()){
		var vForm = $Dom.get("dataCartola");
		vForm.action='pdf/cartolaPdf.xml';
		vForm.submit();
	}
};

var validaCuentas = function(){
	var obj = document.getElementsByName("cuentaSel");
	if(typeof(obj.length) == "undefined"){
		if(obj.checked)
			return true;
		alert("Seleccione la cuenta.");
		return false;
	} else {
		for(var i = 0; i < obj.length; i++)
			if(obj[i].checked)
				return true;
		alert("Seleccione al menos una cuenta.");
		return false;
	}
};
