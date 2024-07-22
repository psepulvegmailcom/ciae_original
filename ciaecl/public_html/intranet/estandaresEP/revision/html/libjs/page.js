

function selectMonth(ts) {
	document.main.CalendarDate.value=ts;
	document.main.submit();
}

function selectDay(ts,p,l) {
	document.main.CalendarDate.value=ts;
	process(p,l);
}

function process(name,level) 
{

   lastActions = document.main.lastAction.value;

   j = 0;
   k = lastActions.length;
   i = 0;
   actions = Array();
   actions = lastActions.split("|");
   actions[level] = name;
   
   newLastActions = "";

   for(i=0;i<(level+1);i++) {
       newLastActions = newLastActions + (actions[i]+"|");
   }

   document.main.lastAction.value = newLastActions;


   clearcookies();
   document.main.submit();
}
function clearAll() {
   //document.main.lastAction.value='';
}

function setcookie(name,value){
   cookiestring=name+"="+escape(value);
   document.cookie=cookiestring;
}

/*function para marcar o desmarcar los checkbox de busqueda*/
function marcarTodo(name_form,thestate)
{
	var formulario=document.forms[name_form];
	  for (var i=0;i<formulario.elements.length;i++)
	  {
			 var e = formulario.elements[i];		
			 if (e.type == 'checkbox')
				 e.checked = thestate;						 		 
	  }
} 



/*insercion de funcion de validacionde email de formularios*/
 function validaEmail(control){
	var str=control.value;
	if(str=='')				
		return true;
		
	var at='@'
	var dot='.'
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	var msg='El email debe ser válido';
	if (str.indexOf(at)==-1){
	   alert(msg)
	   return false
	}
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	   alert(msg)
	   return false
	}	
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert(msg)
		return false
	}	
	if (str.indexOf(at,(lat+1))!=-1){
		alert(msg)
		return false
	}	
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert(msg)
		return false
	}	
	if (str.indexOf(dot,(lat+2))==-1){
		alert(msg)
		return false
	}			
	if (str.indexOf(' ')!=-1){
		alert(msg)
		return false
	}	
	return true					
}

function fullScreen(theURL) {
window.open(theURL, '', 'menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no,scrollbars=auto');
}

/**************************** FUNCIONES AJAX ************************************/
function objetoAjax()
{
	var xmlhttp=false;
	try {
		   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		   try {
			  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		   } catch (E) {
				   xmlhttp = false;
		   }
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		   xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function repairAjaxIE()
{
	var ahora = new Date();
	var salida = "&repairIE="+ahora.getTime();
	return salida; 	
}




function HttpRequest(url){
	var pageRequest = false //variable to hold ajax object
 

	if (!pageRequest && typeof XMLHttpRequest != 'undefined')
	   pageRequest = new XMLHttpRequest()

	if (pageRequest){ //if pageRequest is not false
	   pageRequest.open('GET', url, false) //get page synchronously 
	   pageRequest.send(null)
	   embedpage(pageRequest)
	 }
}

function embedpage(request){
	//if viewing page offline or the document was successfully retrieved online (status code=2000)
	if (window.location.href.indexOf("http")==-1 || request.status==200)
	   document.write(request.responseText)
}