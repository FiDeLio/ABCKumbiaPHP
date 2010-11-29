/******************************************************************************************************************/
/**                                    jquery.cssWithVars.js						 				**/
/**														 			**/
/**		  		    jQuery CSS With Vars Plugin					 				**/
/**														 			**/
/**			                     Version 1.00							 				**/
/**														 			**/
/**   Terms of use:															**/
/**		Dual licensed under the MIT and GPL licenses: 				 	 				**/
/**   		http://www.opensource.org/licenses/mit-license.php 								**/
/**   		http://www.gnu.org/licenses/gpl.html 										**/
/**														 			**/
/**	Usage:												 				**/
/**																	**/
/**	Put this link in the head of the page.											**/
/**																	**/
/**		<link rel="stylesheet" href="path/file" type="text/css" media="csswithvars" />					**/
/**			  change the href for your path to your css page								**/
/**																	**/
/**	Tip: More than one link of this can be used.										**/
/**	Tip: You can have one link with the variables and other link with classes						**/
/**																	**/
/**	Put this script in the head of the page											**/
/**																	**/
/**	    <script type='text/javascript' src='jquery.createCSSwithVars.js'></script>					**/
/**														 			**/	
/**		CSS example:										 				**/
/**														 			**/
/**			------------------------------------------------------------------------------------------------------		**/
/**														 			**/
/**			block_display{					|							**/
/**				display:block;				|- Var								**/
/**			}							|							**/
/**														 			**/
/**			none_display{					|								**/
/**				display:none;				|- Var								**/
/**			}							|							**/
/**														 			**/
/**			yellow_background{				|								**/
/**				background-color: #ff0;		|- Var								**/
/**			}							|							**/
/**														 			**/
/**			350px_width{					|								**/
/**				width:350px;				|- Var								**/
/**			}							|							**/
/**														 			**/
/**			350px_height{					|							**/
/**				height:350px;				|- Var								**/
/**			}							|							**/
/**														 			**/
/**			red_color{						|							**/
/**				color:#f00;					|- Var							**/
/**			}							|							**/
/**														 			**/
/**			solid_black_border_top{			|								**/
/**				border-top:#000 1px solid;		|- Var								**/
/**			}							|							**/
/**														 			**/
/**			solid_black_border_bottom{			|								**/
/**				border-bottom:#000 1px solid;	|- Var								**/
/**			}							|							**/
/**														 			**/
/**			.prueba2{													**/
/**				[block_display]				|- Use of a var					**/
/**				[yellow_background]			|- Use of a var						**/
/**				[350px_width]				|- Use of a var					**/
/**				[350px_height]				|- Use of a var					**/
/**			}														**/
/**														 			**/
/**			.prueba3{													**/
/**				[.prueba2]					|- We can use our classes as variables		**/
/**				[red_color]					|- Use of a var					**/
/**				[solid_black_border_top]		|- Use of a var						**/
/**			}														**/
/**														 			**/
/**			.prueba4{													**/
/**				[.prueba3]					|- We can use our classes as variables		**/
/**				[solid_black_border_bottom]		|- Use of a var					**/
/**				font-size:20px;				|- also accept simple css				**/
/**			}														**/
/**														 			**/
/**														 			**/	
/**			------------------------------------------------------------------------------------------------------		**/
/**														 			**/
/**					This is the interpreted css code				 				**/
/**														 			**/
/**			.prueba2{													**/						
/**				display:block;												**/
/**				background-color: #ff0;										**/
/**				width:350px;												**/
/**				height:350px;												**/
/**				color:#f00;												**/
/**				border-top:#000 1px solid;										**/
/**			}														**/
/**			.prueba3{													**/
/**				display:block;												**/
/**				background-color: #ff0;										**/
/**				width:350px;												**/
/**				height:350px;												**/
/**				color:#f00;												**/
/**				border-top:#000 1px solid;										**/
/**				border-bottom:#000 1px solid;									**/
/**			}														**/
/**			.prueba4{													**/
/**				display:block;												**/
/**				background-color: #ff0;										**/
/**				width:350px;												**/
/**				height:350px;												**/
/**				color:#f00;												**/
/**				border-top:#000 1px solid;										**/
/**				border-bottom:#000 1px solid;									**/
/**				font-size:20px;											**/
/**			}														**/
/**														 			**/
/**			------------------------------------------------------------------------------------------------------		**/
/**														 			**/
/**														 			**/
/**														 			**/
/**	History:												 			**/
/**		1.00 - released (21 March 2009)							 				**/
/**														 			**/
/**	Dependencies: 														**/
/**		jQuery lib	by John Resig					 							**/
/**														 			**/
/**	Compatibility jQuery Libs:													**/
/**		jQuery 1.2.6 - compatible								 				**/
/**		jQuery 1.3.1  - compatible								 				**/
/**														 			**/
/**	Compatibility Browsers:													**/
/**		Internet Explorer 5.5+  - compatible							 			**/
/**		Firefox 1.5+ compatible								 				**/
/**		Safari 3.1+ - compatible								 				**/
/**		Chrome 1.0* - compatible								 				**/
/**														 			**/
/**	Author:															**/
/**		Tomás Corral Casas						 							**/
/**														 			**/
/**	Contact:															**/
/**		amischol@gmail.com						 							**/
/**														 			**/
/******************************************************************************************************************/
(function($){
		  
	$.createCSSwithVars = function()
	{
		var properties  = {};
		
		var cssCreator = {
			version: "1.0",
			init: function(){
				$("link").each(function(i,link){
					var mediaText;
					if(typeof link.media == "string"){
						mediaText = link.media;
					}else{
						mediaText = link.media.mediaText
					}
					if(mediaText == "csswithvars"){
						var urls = ""+link.href;
						$.ajax({
							type: "GET",
							url: urls,
							dataType: "text",
							success: function(data){
								properties.testCSS = data;
								properties.testCSS = properties.testCSS.replace(/\r\n/g,"");
								cssCreator.create();
							},
							error: function(XMLHttpRequest, textStatus, errorThrown){
								throw new Error("Maybe ther is a problem with the conection");
							}
						});
						
					}
				});
			},
			create: function(){
				if(cssCreator.checkForVars()){	
					cssCreator.getCSS();
				}
				cssCreator.putCSSInDocument(properties.testCSS);
			},
			checkForVars: function(){		//This function checks if the document has variables in our css code true (they are found) false (not are found) and then put all the matches in o
				var varsInCSS= properties.testCSS.match(/\[.+\]/g)+"";
				if(typeof varsInCSS != "undefined"){
					var aVars=varsInCSS.replace(/\s/g,",");
					var aVarsNoUnique = aVars.split(",");
					properties.matchedVarsInCSS = jQuery.uniqueValues(aVarsNoUnique);
					return true;
				}
				return false;
			},
			getCSS: function(){			//This function begins our travel about the test to find the vars we put on our code.
				var testToProcess = properties.testCSS;
				if(properties.matchedVarsInCSS !== null){
					for(var i =0; i < properties.matchedVarsInCSS.length; i++){
						testToProcess = cssCreator.lookForVars(testToProcess, properties.matchedVarsInCSS[i]);
					}
				}				
			},
			lookForVars: function(sText, sVar){	//This function looks for vars in our code and put the info on a JSON object, this function returns the string cutted to make a loop
				var posVar = sText.indexOf(sVar);
				
				if(sVar.length >0){
					cssCreator.lookForRules(properties.testCSS,sVar);	
				}
				
				return sText.substr(posVar+sVar.length);
			},
			fixKeyDoubleDotBug: function(sValue){
				var posClau = sValue.indexOf("}");
				
				if( posClau != -1){
					sValue = sValue.substr(0,posClau);
				}
				var posDoubleDot = sValue.indexOf(":");
				
				if(posDoubleDot != -1){
					return false;
				}
				return sValue;
			},
			lookForRules: function(sText,sVar){	//This function looks for rules in our code that match with our variables
				var textForLookRules = properties.testCSS;				
				sVar = sVar.toString();				
				var sVarSpecial = sVar.replace("[","\\[");
				sVarSpecial = sVarSpecial.replace("]","\\]");
				
				sVarSpecial = cssCreator.fixKeyDoubleDotBug(sVarSpecial);
				
				var sVarRegExp = new RegExp(sVarSpecial,"g");
				
				var sRule = sVar.replace("[","");
				sRule = sRule.replace("]","");
				
				sRule = cssCreator.fixKeyDoubleDotBug(sRule);
				
				if(sRule){
					var sRuleRegexp = new RegExp(sRule);
					var posRule = textForLookRules.search(sRuleRegexp);
					
					textForLookRules = textForLookRules.substr(posRule+sRule.length);
					
					var cssInside = textForLookRules.substr(textForLookRules.indexOf("{")+1, textForLookRules.indexOf("}")-1);
								
					properties.testCSS = properties.testCSS.replace(sVarRegExp,cssInside);
				}
				
			},
			putCSSInDocument: function(text){	
				$(document.body).append("<style type='text/css'>"+text+"</style>");
			}
		};
		
	cssCreator.init();	
		
	};
})(jQuery);
$(document).ready(function(){
	$.createCSSwithVars();
});