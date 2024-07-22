

$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase archivo y llamo a la funcion Archivo

		$(".archivoClon").each(function (ar){
			$(this).bind("change",archivo);
									 });
							}); 
				var cantArch = 0;

function archivo(){	

	formdataFile = false;
	var idArchivo = $(this).attr('id').substr(0,$(this).attr('id').length-1);
	var nameArchivo = $(this).attr('name').substr(0,$(this).attr('name').length-2); 
	var clickID   = parseInt($(this).parent('div').attr('id').replace('_campos_','')); 
	
	var nombreGlobal = gmmktime();

    function mostrarArchivoSubido(source, name){
				cantArch = cantArch +1;
				if(cantArch > 1){
					return false;
					}	
        var list = document.getElementById('lista-archivos'+clickID),		
            li   = document.createElement('li'),
			p    = document.createElement('p'),
			link = document.createElement('a'),
			add  = document.createElement('input'),
			valor =	document.createElement('input'),
			valorName =	document.createElement('input');
			valor.type = 'hidden';
			valorName.type = 'hidden';

		add.type  = 'button';
		p.textContent = name;		
		link.name  = 'eliminar';
		link.id    = name;
		link.textContent = 'eliminar';
		valor.id = 'archivo_'+clickID;
		valor.name = 'formlink_file_'+clickID;		
		valor.value = name;
		valorName.id = 'name_file_'+clickID;
		valorName.name = 'name_file_'+clickID;		
		valorName.value = nombreGlobal;
		li.appendChild(p);		
		if (source !== "") 
		{
        	li.appendChild(img);
		}
		li.appendChild(link);
		li.appendChild(valor);
		li.appendChild(valorName);
        list.appendChild(li);
		
	var imagesCollection = document.getElementsByName( 'eliminar' );
		for( var i = 0, l = imagesCollection.length; i < l; i++ )
		{
		  (function( currentImage )
		   {			 
			imagesCollection[ i ].addEventListener( 'click', function(e){	
				$(this).parent('li').remove();  	 				
						console.log( 'Image number: ', currentImage ); 						
				document.getElementById(idArchivo).style.display = 'inline';
				document.getElementById(idArchivo+clickID).style.display = 'inline';	   		   			 
			}, 'false' );		
		  })( i );
		 
		}		
			//window.alert(nameArchivo+clickID);
			//document.getElementById(idArchivo+clickID).style.display = 'none';	
			return false;		
    }
	    	
	    //Revisamos si el navegador soporta el objeto FormData
    if(window.FormData){
     var   formdataFile = new FormData();
    }	
            var i = 0, len = this.files.length, img, readerfile, file;            
            document.getElementById('responseFile').innerHTML = 'Subiendo...';
            //Si hay varias imágenes, las obtenemos una a una
            for( ; i < len; i++){				
              var  fileDoc = this.files[i];
                
                //Una pequeña validación para subir imágenes
                //if(!!fileDoc.type.match(/doc.*/) || !!fileDoc.type.match(/xls.*/) || !!fileDoc.type.match(/pdf.*/) || !!fileDoc.type.match(/ppt.*/))
				
				var extension = fileDoc.name.split('.').pop().toLowerCase();				 
				var allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx','jpg','png'];
				if(allowed.indexOf(extension) > -1) {				
                    //Si el navegador soporta el objeto FileReader
                    if(window.FileReader){
                        readerfile = new FileReader();
                        //Llamamos a este evento cuando la lectura del archivo es completa
                        //Después agregamos la imagen en una lista
                        readerfile.onload = function(ef){								
							mostrarArchivoSubido('',fileDoc.name);						
                        };
                        //Comienza a leer el archivo
                        //Cuando termina el evento onloadend es llamado
                        readerfile.readAsDataURL(fileDoc);
                    }
                    
                    //Si existe una instancia de FormData
                    if(formdataFile)
                        //Usamos el método append, cuyos parámetros son:
                        //name : El nombre del campo
                        //value: El valor del campo (puede ser de tipo Blob, File e incluso string)
                        formdataFile.append(nameArchivo+'[]', fileDoc);
						//window.alert(fileDoc);
                }
				else{
					  window.alert('Archivo inv\u00E1lido...');
					  //document.getElementById('responseFile').innerHTML = 'Archivo inv&aacute;lido...';
					  return false;
					}
            }
            	var var_js = $( "#ruta_archivo" ).val();
				var var_item = $( "#item_id" ).val();
				//var var_name = gmmktime();
				//window.alert(var_name);
			
            //Por último hacemos uso del método proporcionado por jQuery para hacer la petición ajax
            //Como datos a enviar, el objeto FormData que contiene la información de las imágenes
			if (cantArch==2){
				return false;
				} else {
					var host = getAbsolutePath();
					//window.alert(host);
            if(formdataFile){
                $.ajax({
                   url : host+'interno/uploadFile.php?ruta_archivo='+ var_js +'&id_item='+var_item +'&var_name='+nombreGlobal,
                   type : 'POST',
                   data : formdataFile,
                   processData : false, 
                   contentType : false, 
                   success : function(res){
                       document.getElementById('responseFile').innerHTML = res;
					  // alert(res);
					    $("#"+'name_file_'+clickID).val(res);
                   }                
                });
     }
				}
}

 
$(document).ready(function() {

	//ACA le asigno el evento click a cada boton de la clase bt_agregacampos y llamo a la funcion Clonar
		$(".bt_agregacampos").each(function (el){			
			$(this).bind("click",Clonar);
									 });
							});	 
				var cant = 0;
function Clonar(){
				cant = cant +1;
				if(cant > 2){
					return false;
					}
				var clickID = parseInt($(this).parent('div').attr('id').replace('_campos_','')); 
				// Genero el nuevo numero id
	 
				if(clickID > 1)
				{
					window.alert('Agregar solo 2 link por cada vez que guarde');
					return false;
				}			
				var newID = (clickID+1);
				$newClone = $('#_campos_'+clickID).clone(true);
				$newClone.attr('id','_campos_'+newID);	
				//$newClone.attr('class','_campos_'+newID); 
	 
				$newClone.children('ul').empty();
				$newClone.children('ul').attr('id',"lista-archivos"+newID).val('');
				$newClone.children('label').attr('id',"titulo_formulario_links"+newID);	
				$newClone.children('label').attr('id',"titulo_formulario_links"+newID).text('Link externo '+newID+' (ingresar url o archivo)');
	
				$newClone.children('select').eq(0).attr('id',"orden"+newID).val('');
	
				$newClone.children('input').eq(0).attr('id',"file"+newID).val('');
 				$newClone.children('input').eq(0).attr('name',"file["+newID+"]").val('');
				$newClone.children('input').eq(0).attr('value',"").val('');
				$newClone.children('input').eq(1).attr('id',"bt"+newID).val(''); 
				$newClone.children('input').eq(1).attr('value',"").val('');
				$newClone.children('input').eq(3).attr('id',"doc"+newID).val('');
 				$newClone.children('input').eq(3).attr('name',"formlink[archivo]["+newID+"]").val('');
				$newClone.children('input').eq(3).attr('value',"").val('');
	
	 
	
 				//$newClone.children('input').eq(0).attr('id',"texto"+newID).val('');
 				//$newClone.children('input').eq(0).attr('name',"formlink[texto]["+newID+"]").val('');
//				$newClone.children('input').eq(0).attr('value',"formlink[texto][]").val('');
//				$newClone.children('input').eq(1).attr('id',"url"+newID).val('');
//				$newClone.children('input').eq(1).attr('name',"formlink[url]["+newID+"]").val('');
//				$newClone.children('input').eq(2).attr('id',"orden"+newID).val('');
//				$newClone.children('input').eq(2).attr('name',"formlink[orden]["+newID+"]").val('');
//				$newClone.children('input').eq(3).attr('id',"file").val('');
//				$newClone.children('input').eq(3).attr('name',"file[]").val('');
//				$newClone.children('input').eq(3).attr('id',"archivo"+newID).val('');
//				$newClone.children('input').eq(3).attr('style','');				
//				$newClone.children('input').eq(2).val('');
//				$newClone.children('input').eq(3).val('');
//				$newClone.children('input').eq(3).text('');
//				$newClone.children('input').eq(4).attr('id',newID); 
	
	
				$newClone.insertAfter($('#_campos_'+clickID));

				//Cambio el signo "+" por el signo "-" y le quito el evento Clonar
				$("#"+clickID).val('-').unbind("click",Clonar);

				//Ahora le asigno el evento delRow para que borre la fila en caso de hacer click
				$("#"+clickID).bind("click",delRow);
	
	 
				 
				
	}
	
function delRow() {
// Funcion que destruye el elemento actual una vez echo el click
$(this).parent('div').remove();
 
}

$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase imagenMultiple y llamo a la funcion imagenMultiple
		$(".imagenMultipleGaleria").each(function (im){
			$(this).bind("change",imagenMultipleGaleria);
									 });
							}); 
						
function imagenMultipleGaleria(){
		
        formdata = false;
		var nameImagen = $(this).attr('name').substr(0,$(this).attr('name').length-2);
		var nombreGlobal = gmmktime();
		
    function mostrarImagenSubida(source, name){
        var list = document.getElementById('lista-imagenes-galeria'),
            li   = document.createElement('li'),
			p   = document.createElement('p'),
            img  = document.createElement('img'),
			link = document.createElement('a'),
			//br = document.createElement('br'),
			//input = document.createElement('input'),
			space = document.createElement('space');

		/*	input.type = 'file';
			input.setAttribute("class", "imagenMultipleGaleria");
			input.setAttribute("value", name);
			input.setAttribute("disabled","disabled"); */
			var clickID = $("[name*=form_galeria]").size();
			
		// Genero el nuevo numero id
		 var newID = (clickID+1);


		img.src = source;
		img.width = '120';
		img.height = '90';
		img.id= name;
		img.name = 'form_galeria_'+clickID;
		//input.name = 'form_galeria_'+clickID;
		p.textContent = name;		
		link.name = 'eliminar';
		link.id = name;
		//link.textContent= 'eliminar';
		li.appendChild(p);		
		if (source !== "")  {
        li.appendChild(img);
		}
		li.appendChild(space);
		li.appendChild(link);
		//li.appendChild(br);	
		//li.appendChild(input);		
        list.appendChild(li);
	
		
		
	var imagesCollection = document.getElementsByName( 'eliminar' );
		for( var i = 0, l = imagesCollection.length; i < l; i++ ){
		  (function( currentImage ){			 
			imagesCollection[ i ].addEventListener( 'click', function(e){	
				$( e.target ).closest( "li" ).remove();   	 				
						console.log( 'Image number: ', currentImage ); 			   		   			 
			}, 'false' );		
		  })( i );

		 
		}		
		//document.getElementById('images').style.display = 'none';
    }
	
    
    //Revisamos si el navegador soporta el objeto FormData
    if(window.FormData){
        formdata = new FormData();
       // document.getElementById('btnSubmit').style.display = 'none';
    }

	
    //Aplicamos la subida de imágenes al evento change del input file
     
            var i = 0, len = this.files.length, img, reader, file;            
            document.getElementById('responseGaleria').innerHTML = 'Subiendo...';
            
            //Si hay varias imágenes, las obtenemos una a una
            for( ; i < len; i++){
                file = this.files[i];
                
                //Una pequeña validación para subir imágenes
                if(!!file.type.match(/image.*/)){
                    //Si el navegador soporta el objeto FileReader
                    if(window.FileReader){
						
                        reader = new FileReader();
                        //Llamamos a este evento cuando la lectura del archivo es completa
                        //Después agregamos la imagen en una lista
                        reader.onloadend = function(e){
							if(!!file.type.match(/image.*/)){
                            mostrarImagenSubida(e.target.result,file.name);
							} else{
							mostrarImagenSubida('',file.name);
							}
                        };
                        //Comienza a leer el archivo
                        //Cuando termina el evento onloadend es llamado
                        reader.readAsDataURL(file);
                    }
                    
                    //Si existe una instancia de FormData
                    if(formdata)
                        //Usamos el método append, cuyos parámetros son:
                            //name : El nombre del campo
                            //value: El valor del campo (puede ser de tipo Blob, File e incluso string)
                        formdata.append(nameImagen+'[]', file);
                }
            }
				var var_js = $( "#ruta_galeria" ).val();
				var var_item = $( "#id_noticia_galeria" ).val();
				//var var_name = gmmktime();
				 //window.alert(var_js);
			
            //Por último hacemos uso del método proporcionado por jQuery para hacer la petición ajax
            //Como datos a enviar, el objeto FormData que contiene la información de las imágenes
            if(formdata){
				var host = getAbsolutePath();
                $.ajax({
                   url : host+'interno/uploadFile.php?ruta_galeria='+ var_js+'&id_item='+var_item +'&var_name='+nombreGlobal,
				   type : 'POST', 
                   data : formdata,
                   processData : false, 
                   contentType : false, 
                   success : function(resp){
                       document.getElementById('responseGaleria').innerHTML = resp;
                   }                
                });
            }
    }


$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase imagenMultiple y llamo a la funcion imagenMultiple
		$(".imagenMultiple").each(function (im){
			$(this).bind("change",imagenMultiple);
									 });
							}); 
			var cantImg = 0;					
function imagenMultiple(){
		var imgID = parseInt($(this).attr('id').replace('images',''));
        formdata = false;
		var nameImagen = $(this).attr('name').substr(0,$(this).attr('name').length-2);
		var nombreGlobal = gmmktime();
	
    function mostrarImagenSubida(source, name){
			cantImg = cantImg +1;

				if(cantImg > 1){
					return false;
					}
        var list = document.getElementById('lista-imagenes'+imgID),
            li   = document.createElement('li'),
			p   = document.createElement('p'),
            img  = document.createElement('img'),
			link = document.createElement('a'),
			space = document.createElement('space'),
			valor =	document.createElement('input'),
			valorName =	document.createElement('input');
			valor.type = 'hidden';
			valorName.type = 'hidden';
			var clickID = $("[name*=form_galeria]").size();
			
		// Genero el nuevo numero id
		 var newID = (clickID+1);
		// window.alert(clickID);


		img.src = source;
		img.width = '120';
		img.height = '90';
		img.id= name;
		img.name = 'form_galeria_'+clickID;
		//input.name = 'form_galeria_'+clickID;
		valor.id = 'forma_imagen';
		valor.name = 'forma_imagen';		
		valor.value = name;
		valorName.id = 'name_img';
		valorName.name = 'name_img';		
		valorName.value = nombreGlobal;
		p.textContent = name;		
		link.name = 'eliminar';
		link.id = name;
		link.textContent= 'eliminar';
		li.appendChild(p);		
		if (source !== "")  {
        li.appendChild(img);
		}
		li.appendChild(space);
		li.appendChild(link);
		//li.appendChild(br);	
		//li.appendChild(input);
		li.appendChild(valor);
		li.appendChild(valorName);			
        list.appendChild(li);
		
		
	var imagesCollection = document.getElementsByName( 'eliminar' );
		for( var i = 0, l = imagesCollection.length; i < l; i++ ){
		  (function( currentImage ){			 
			imagesCollection[ i ].addEventListener( 'click', function(e){	
				$( e.target ).closest( "li" ).remove();   	 				
						console.log( 'Image number: ', currentImage ); 			   		   			 
			}, 'false' );		
		  })( i );

		 
		}		
		//document.getElementById('images').style.display = 'none';
    }
	
    
    //Revisamos si el navegador soporta el objeto FormData
    if(window.FormData){
        formdata = new FormData();
       // document.getElementById('btnSubmit').style.display = 'none';
    }

	
    //Aplicamos la subida de imágenes al evento change del input file
     
            var i = 0, len = this.files.length, img, reader, file;            
            //document.getElementById('response').innerHTML = 'Subiendo...';
            
            //Si hay varias imágenes, las obtenemos una a una
            for( ; i < len; i++){
                file = this.files[i];
                
                //Una pequeña validación para subir imágenes
                if(!!file.type.match('image/jpeg') || !!file.type.match('image/jpg') || !!file.type.match('image/png')){
                    //Si el navegador soporta el objeto FileReader
                    if(window.FileReader){
                        reader = new FileReader();
                        //Llamamos a este evento cuando la lectura del archivo es completa
                        //Después agregamos la imagen en una lista
                        reader.onloadend = function(e){
							if(!!file.type.match(/image.*/)){
                            mostrarImagenSubida(e.target.result,file.name);
							} else{
							mostrarImagenSubida('',file.name);
							}
                        };
                        //Comienza a leer el archivo
                        //Cuando termina el evento onloadend es llamado
                        reader.readAsDataURL(file);
                    }
                    
                    //Si existe una instancia de FormData
                    if(formdata)
                        //Usamos el método append, cuyos parámetros son:
                            //name : El nombre del campo
                            //value: El valor del campo (puede ser de tipo Blob, File e incluso string)
                        formdata.append(nameImagen+'[]', file);
                }
				else{
					  window.alert('Archivo inv\u00E1lido...');
					  //document.getElementById('responseFile').innerHTML = 'Archivo inv&aacute;lido...';
					  return false;
					}
            }
			var var_js = $( "#ruta_imagen" ).val();
			var var_id = $( "#valor_id" ).val();
			//window.alert(var_id);	
            //Por último hacemos uso del método proporcionado por jQuery para hacer la petición ajax
            //Como datos a enviar, el objeto FormData que contiene la información de las imágenes
            if(formdata){
				var host = getAbsolutePath();
                $.ajax({
                   url : host+'interno/uploadFile.php?ruta_galeria='+ var_js +'&id_item='+var_id +'&var_name='+nombreGlobal,
				   type : 'POST',
                   data : formdata,
                   processData : false, 
                   contentType : false, 
                   success : function(resp){
                       /*document.getElementById('response'+imgID).innerHTML = resp;*/
					   
					   if(document.getElementById('nombre_campo_imagen'+imgID))
					   {						   
						   if(resp != 'error')
						   {							   
								var var_aux = $( "#nombre_campo_imagen"+imgID ).val(); 
							   
							    $("#"+var_aux).val(resp);
							   /* alert(var_aux +' '+resp);
							   alert(document.getElementById(var_aux).value);
							   document.getElementById(var_aux).value = resp;
							   alert(document.getElementById(var_aux).value);*/
						   }
					   }
                   }                
                });
            }
    }

$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase imagenMultiple y llamo a la funcion imagenMultiple
		$(".ArchivoUnico").each(function (au){
			$(this).bind("change",ArchivoUnico);
									 });
							}); 
						
function ArchivoUnico(){
		var FileId = parseInt($(this).attr('id').replace('Archivo',''));
        formdata = false;
		var nameImagen = $(this).attr('name').substr(0,$(this).attr('name').length-2);
		var nombreGlobal = gmmktime();
	
    function mostrarImagenSubida(source, name){

        var listA = document.getElementById('lista-archivoUnico'+FileId),
            liA   = document.createElement('li'),
			pA   = document.createElement('p'),
            imgA  = document.createElement('img'),
			link = document.createElement('a'),
			space = document.createElement('space'),
			valorA =	document.createElement('input'),
			valorNameA =	document.createElement('input');
			valorA.type = 'hidden';
			valorNameA.type = 'hidden';
			var clickIDA = $("[name*=form_galeria]").size();
			
		// Genero el nuevo numero id
		 var newIDA = (clickIDA+1);
		// window.alert(clickID);


		imgA.src = source;
		imgA.width = '120';
		imgA.height = '90';
		imgA.id= name;
		imgA.name = 'form_galeria_'+clickIDA;
		//input.name = 'form_galeria_'+clickID;
		valorA.id = 'forma_imagen';
		valorA.name = 'forma_imagen';		
		valorA.value = name;
		valorNameA.id = 'name_img';
		valorNameA.name = 'name_img';		
		valorNameA.value = nombreGlobal;
		pA.textContent = name;		
		link.name = 'eliminar';
		link.id = name;
		link.textContent= 'eliminar';
		liA.appendChild(pA);		
		if (source !== "")  {
        liA.appendChild(imgA);
		}
		liA.appendChild(space);
		liA.appendChild(link);
		//li.appendChild(br);	
		//li.appendChild(input);
		liA.appendChild(valorA);
		liA.appendChild(valorNameA);			
        listA.appendChild(liA);
		
		
	var imagesCollection = document.getElementsByName( 'eliminar' );
		for( var i = 0, l = imagesCollection.length; i < l; i++ ){
		  (function( currentImage ){			 
			imagesCollection[ i ].addEventListener( 'click', function(e){	
				$( e.target ).closest( "li" ).remove();   	 				
						console.log( 'Image number: ', currentImage ); 			   		   			 
			}, 'false' );		
		  })( i );

		 
		}		
		//document.getElementById('images').style.display = 'none';
    }
	
    
    //Revisamos si el navegador soporta el objeto FormData
    if(window.FormData){
        formdata = new FormData();
       // document.getElementById('btnSubmit').style.display = 'none';
    }

	
    //Aplicamos la subida de imágenes al evento change del input file
     
            var i = 0, len = this.files.length, img, reader, file;            
            //document.getElementById('response').innerHTML = 'Subiendo...';
            
            //Si hay varias imágenes, las obtenemos una a una
            for( ; i < len; i++){
                file = this.files[i];
                
                //Una pequeña validación para subir imágenes
                var extension = file.name.split('.').pop().toLowerCase();				 
				var allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx','jpg','png'];
				if(allowed.indexOf(extension) > -1) {
                    //Si el navegador soporta el objeto FileReader
                    if(window.FileReader){
                        reader = new FileReader();
                        //Llamamos a este evento cuando la lectura del archivo es completa
                        //Después agregamos la imagen en una lista
                        reader.onloadend = function(e){

							mostrarImagenSubida('',file.name);

                        };
                        //Comienza a leer el archivo
                        //Cuando termina el evento onloadend es llamado
                        reader.readAsDataURL(file);
                    }
                    
                    //Si existe una instancia de FormData
                    if(formdata)
                        //Usamos el método append, cuyos parámetros son:
                            //name : El nombre del campo
                            //value: El valor del campo (puede ser de tipo Blob, File e incluso string)
                        formdata.append(nameImagen+'[]', file);
                }
				else{
					  window.alert('Archivo inv\u00E1lido...');
					  //document.getElementById('responseFile').innerHTML = 'Archivo inv&aacute;lido...';
					  return false;
					}
            }
			var var_js = $( "#ruta_archivo" +FileId).val();
			var var_item = $( "#item_id" ).val();
			var var_valor = $( "#valor_id" ).val();
			if (var_item ==''){
				var_item = var_valor;
			}
            //Por último hacemos uso del método proporcionado por jQuery para hacer la petición ajax
            //Como datos a enviar, el objeto FormData que contiene la información de las imágenes
            if(formdata){
				var host = getAbsolutePath();
				//alert(host);
                $.ajax({
					url : host+'interno/uploadFile.php?ruta_archivo='+ var_js +'&id_item='+var_item +'&var_name='+nombreGlobal,
				   type : 'POST',
                   data : formdata,
                   processData : false, 
                   contentType : false, 
                   success : function(resp){
                       /*document.getElementById('responseArchivoUnico'+FileId).innerHTML = resp; */
					   if(document.getElementById('nombre_campo_archivo'+FileId))
					   {
						   if(resp != 'error')
						   {							   
								var var_aux = $( "#nombre_campo_archivo"+FileId ).val(); 
							    $("#"+var_aux).val(resp); 
						   }
					   }
                   }                
                });
            }
    }							