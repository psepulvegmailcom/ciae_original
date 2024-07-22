//----------------------------------FUNCIONES GENERICAS---------------------------------------------------------//
function mail(texto){

    var mailres = true;            
    var cadena = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890@._-";
    
    var arroba = texto.indexOf("@",0);
    if ((texto.lastIndexOf("@")) != arroba) arroba = -1;
    
    var punto = texto.lastIndexOf(".");
                
     for (var contador = 0 ; contador < texto.length ; contador++){
        if (cadena.indexOf(texto.substr(contador, 1),0) == -1){
            mailres = false;
            break;
     }
    }

    if ((arroba > 1) && (arroba + 1 < punto) && (punto + 2 < (texto.length)) && (mailres == true) && (texto.indexOf("..",0) == -1))
     mailres = true;
    else
     mailres = false;
                
    return mailres;
} 


function vacio(cadena)  
   {                                    // DECLARACION DE CONSTANTES  
     var blanco = " \n\t" + String.fromCharCode(13); // blancos  
                                        // DECLARACION DE VARIABLES  
     var i;                             // indice en cadena  
     var es_vacio;                      // cadena es vacio o no  
     for(i = 0, es_vacio = true; (i < cadena.length) && es_vacio; i++) // INICIO  
       es_vacio = blanco.indexOf(cadena.charAt(i)) != - 1;  
     return(es_vacio);  
}  
   
function pasarEdit(form) {
    if (form.temas1.selectedIndex==-1) return;
    var valor=form.temas1.value;
    var txt=form.temas1.options[form.temas1.selectedIndex].text;
    form.temas1.options[form.temas1.selectedIndex]=null;
    var opc = new Option(txt,valor);
    eval(form.temas2.options[form.temas2.options.length]=opc);    
}

function pasarEdit2(form) {
    if (form.temas2.selectedIndex==-1) return;
    var valor=form.temas2.value;
    var txt=form.temas2.options[form.temas2.selectedIndex].text;
    form.temas2.options[form.temas2.selectedIndex]=null;
    var opc = new Option(txt,valor);
    eval(form.temas1.options[form.temas1.options.length]=opc);    
	form.temas2.options[form.temas2.options.length-1].selected=true;   
}

function seleccionarEdit(form) {
    var i;
    for(i=0; i< form.temas2.options.length; i++)
       form.temas2.options[i].selected=true;  
  
    return true;
}

function pasarInsert(form) {
    if (form.temas1.selectedIndex<0) return;
    var valor=form.temas1.value;
    var txt=form.temas1.options[form.temas1.selectedIndex].text;
    form.temas1.options[form.temas1.selectedIndex]=null;
    var opc = new Option(txt,valor);
    eval(form.temas2.options[form.temas2.options.length]=opc);    
}

function pasarInsert2(form) {
    if (form.temas2.selectedIndex<=0) return;
    var valor=form.temas2.value;
    var txt=form.temas2.options[form.temas2.selectedIndex].text;
    form.temas2.options[form.temas2.selectedIndex]=null;
    var opc = new Option(txt,valor);
    eval(form.temas1.options[form.temas1.options.length]=opc);    
	form.temas2.options[form.temas2.options.length-1].selected=true;   
}

function seleccionarInsert(form) {
    var i;
    for(i=0; i< form.temas2.options.length; i++)
       form.temas2.options[i].selected=true;  
  
    return true;
}
//----------------------------------FUNCIONES VALIDACIONES---------------------------------------------------------//
function fValidaEditTema(form, msg){
  if(vacio(form.area.value)) {
      alert('El campo Area se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.descripcion.value)) {
      alert('El campo Descripción se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  
  if(confirm(msg)) return true; else return false;
}

function fValidaBuscar(form){
  if(vacio(form.buscado.value)) {
    alert('El texto de busqueda se encuentra vacío. Por favor verifique.');	
    return false;
  }
  if(form.buscado.value=="Ingresar la palabra clave a buscar") {
    alert('Debe ingresar un texto a buscar. Por favor verifique.');	
    return false;
  }
  
  return true;
}



function fValidaAgregaUsuario(form, msg){
  if(vacio(form.nombre.value)) {
      alert('El campo Nombre se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.apellido.value)) {
      alert('El campo Apellido se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.correo.value)) {
      alert('El campo Correo Electronico se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
 /* if(vacio(form.usuario.value)) {
      alert('El campo Usuario se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }*/
  if(vacio(form.pass.value)) {
      alert('El campo Contraseña se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.pass2.value)) {
      alert('El campo Repite Contraseña se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(mail(form.correo.value)==false){
      alert('El campo Correo contiene una dirección no válida, por favor verifique.');	
      return false;
  }
  if((form.pass.value)!=(form.pass2.value)) {
      alert('Las contraseñas ingresadas no coinciden, por favor verifique.');	
      return false;
  }
  
  if(confirm(msg)) return true; else return false;
}


function fValidaEditArchivo(form, msg){

if(vacio(form.titulo.value)) {
      alert('El campo Titulo se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.pais.value)) {
      alert('El campo País se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.bajada.value)) {
      alert('El campo Descripción se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }

 /*if(form.temas2.selectedIndex < 0) {
      alert('Debe seleccionar al menos un Tema asociado al archivo.');	
      return false;
 }*/

  if(confirm(msg)) {return true;} else return false;

}

function fValidaInsertArchivo(form, msg){
 if(vacio(form.titulo.value)) {
      alert('El campo Titulo se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.pais.value)) {
      alert('El campo País se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.bajada.value)) {
      alert('El campo Descripción se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
  if(vacio(form.archivo.value)) {
      alert('Falta seleccionar el archivo a subir. Por favor ingrese toda la información.');	
      return false;
  }

  if(confirm(msg)) {return true;} else return false;

}

function fValidaInsertComentario(form, msg){

/* if(vacio(form.titulo.value)) {
      alert('El campo Titulo se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }*/
  if(vacio(form.autor.value)) {
      alert('El campo Nombre se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }
 
  if(vacio(form.correo.value)) {
     alert('El campo Correo se encuentra vacío. Por favor ingrese toda la información.');	
	 return false; 
  }
  
  if(mail(form.correo.value)==false){
      alert('El campo Correo contiene una dirección no válida, por favor verifique.');	
      return false;
  }

  if(vacio(form.comentario.value)) {
      alert('El campo Comentario se encuentra vacío. Por favor ingrese toda la información.');	
      return false;
  }

  if(confirm(msg)) {return true;} else { return false };

}

