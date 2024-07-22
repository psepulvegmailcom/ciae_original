$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase archivo y llamo a la funcion Archivo

		$(".archivo").each(function (ar){
			$(this).bind("change",archivo);
									 });
							}); 

function archivo(){	

	formdataFile = false;
	var idArchivo = $(this).attr('id').substr(0,$(this).attr('id').length-1);
	var nameArchivo = $(this).attr('name').substr(0,$(this).attr('name').length-2); 
	var clickID   = parseInt($(this).parent('div').attr('id').replace('_campos_','')); 
			
    function mostrarArchivoSubido(source, name){
        var list = document.getElementById('lista-archivos'+clickID),		
            li   = document.createElement('li'),
			p    = document.createElement('p'),
			link = document.createElement('a'),
			add  = document.createElement('input');	

		add.type  = 'button';
		p.textContent = name;		
		link.name  = 'eliminar';
		link.id    = name;
		link.textContent = 'eliminar';
		li.appendChild(p);		
		if (source !== "")  {
        li.appendChild(img);
		}
		li.appendChild(link);
        list.appendChild(li);
		
	var imagesCollection = document.getElementsByName( 'eliminar' );
		for( var i = 0, l = imagesCollection.length; i < l; i++ ){
		  (function( currentImage ){			 
			imagesCollection[ i ].addEventListener( 'click', function(e){	
				$(this).parent('li').remove();  	 				
						console.log( 'Image number: ', currentImage ); 						
				document.getElementById(idArchivo).style.display = 'inline';
				document.getElementById(idArchivo+clickID).style.display = 'inline';	   		   			 
			}, 'false' );		
		  })( i );
		 
		}		
			//window.alert(nameArchivo+clickID);
			document.getElementById(idArchivo+clickID).style.display = 'none';			
    }
	    

	
	    //Revisamos si el navegador soporta el objeto FormData
    if(window.FormData){
        formdataFile = new FormData();
    }	
            var i = 0, len = this.files.length, img, reader, file;            
            document.getElementById('responseFile').innerHTML = 'Subiendo...';
            
            //Si hay varias imágenes, las obtenemos una a una
            for( ; i < len; i++){
                fileDoc = this.files[i];
                
                //Una pequeña validación para subir imágenes
                if(!!fileDoc.type.match(/doc.*/) || !!fileDoc.type.match(/xls.*/)){				
                    //Si el navegador soporta el objeto FileReader
                    if(window.FileReader){
                        reader = new FileReader();
                        //Llamamos a este evento cuando la lectura del archivo es completa
                        //Después agregamos la imagen en una lista
                        reader.onloadend = function(ef){						
							mostrarArchivoSubido('',fileDoc.name);						
                        };
                        //Comienza a leer el archivo
                        //Cuando termina el evento onloadend es llamado
                        reader.readAsDataURL(fileDoc);
                    }
                    
                    //Si existe una instancia de FormData
                    if(formdataFile)
                        //Usamos el método append, cuyos parámetros son:
                        //name : El nombre del campo
                        //value: El valor del campo (puede ser de tipo Blob, File e incluso string)
                        formdataFile.append(nameArchivo+'[]', fileDoc);
                }
				else{
					  document.getElementById('responseFile').innerHTML = 'Archivo inv&aacute;lido...';
					  return false;
					}
            }
            	
			    var var_js = $( "#ruta_archivo" ).val();
				var var_item = $( "#item_id" ).val();
				var var_name = gmmktime();
				window.alert(var_js);
            //Por último hacemos uso del método proporcionado por jQuery para hacer la petición ajax
            //Como datos a enviar, el objeto FormData que contiene la información de las imágenes
            if(formdataFile){
                $.ajax({
                   url : 'http://172.16.254.47/dev_ciae/otros_sitios/respaldos_previo_unificacion/ciae_web_2016/02_desarrollo/bases/site/clases_web/uploadFile.php?ruta_archivo='+ var_js +'&id_item='+var_item +'&var_name='+var_name,
                   type : 'POST',
                   data : formdataFile,
                   processData : false, 
                   contentType : false, 
                   success : function(res){
                       document.getElementById('responseFile').innerHTML = res;
                   }                
                });
      }
			
}

 
$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase bt_agregacampos y llamo a la funcion Clonar
		$(".bt_agregacampos").each(function (el){
			$(this).bind("click",Clonar);
									 });
							}); 
	
function Clonar(){
				
				var clickID = parseInt($(this).parent('div').attr('id').replace('_campos_','')); 
				// Genero el nuevo numero id
				var newID = (clickID+1);

				$newClone = $('#_campos_'+clickID).clone(true);
				$newClone.attr('id','_campos_'+newID);				
				$newClone.children('input').eq(0).attr('id',"texto"+newID).val('');
				$newClone.children('input').eq(0).attr('name',"formlink[texto]["+newID+"]").val('');
				$newClone.children('input').eq(1).attr('id',"url"+newID).val('');
				$newClone.children('input').eq(1).attr('name',"formlink[url]["+newID+"]").val('');
				$newClone.children('input').eq(2).attr('id',"orden"+newID).val('');
				$newClone.children('input').eq(2).attr('name',"formlink[orden]["+newID+"]").val('');
				$newClone.children('input').eq(3).attr('id',"archivo"+newID).val('');
				$newClone.children('input').eq(3).attr('name',"file[]").val('');
				$newClone.children('input').eq(3).attr('style','');
				$newClone.children('ul').empty();
				$newClone.children('ul').attr('id',"lista-archivos"+newID).val('');
				$newClone.children('input').eq(2).val('');
				$newClone.children('input').eq(3).val('');
				$newClone.children('input').eq(3).text('');
				$newClone.children('input').eq(4).attr('id',newID);
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
                if(!!file.type.match(/image.*/) || !!file.type.match(/doc.*/) || !!file.type.match(/xls.*/)){
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
				var var_raiz = $( "#ruta_raiz" ).val();
				// window.alert(var_js);
			
            //Por último hacemos uso del método proporcionado por jQuery para hacer la petición ajax
            //Como datos a enviar, el objeto FormData que contiene la información de las imágenes
            if(formdata){
                $.ajax({
                   url : 'http://172.16.254.47/dev_ciae/otros_sitios/respaldos_previo_unificacion/ciae_web_2016/02_desarrollo/bases/site/clases_intranet/upload/upload.php?ruta_galeria='+ var_js,
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
function imagenMultiple(){
		
        formdata = false;
		var nameImagen = $(this).attr('name').substr(0,$(this).attr('name').length-2);
	
    function mostrarImagenSubida(source, name){
        var list = document.getElementById('lista-imagenes'),
            li   = document.createElement('li'),
			p   = document.createElement('p'),
            img  = document.createElement('img'),
			link = document.createElement('a'),

			space = document.createElement('space');
			var clickID = $("[name*=form_galeria]").size();
			
		// Genero el nuevo numero id
		 var newID = (clickID+1);
		 window.alert(clickID);


		img.src = source;
		img.width = '120';
		img.height = '90';
		img.id= name;
		img.name = 'form_galeria_'+clickID;
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
                if(!!file.type.match(/image.*/) || !!file.type.match(/doc.*/) || !!file.type.match(/xls.*/)){
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
			
			
            //Por último hacemos uso del método proporcionado por jQuery para hacer la petición ajax
            //Como datos a enviar, el objeto FormData que contiene la información de las imágenes
			var var_js = $( "#ruta_imagen" ).val();
			var var_item = $( "#item_id" ).val();
			var var_name = gmmktime();
            if(formdata){
                $.ajax({
                   url : 'http://172.16.254.47/dev_ciae/otros_sitios/respaldos_previo_unificacion/ciae_web_2016/02_desarrollo/bases/site/clases_web/uploadFile.php?ruta_galeria='+ var_js +'&id_item='+var_item +'&var_name='+var_name,
                   data : formdata,
                   processData : false, 
                   contentType : false, 
                   success : function(resp){
                       document.getElementById('response').innerHTML = resp;
                   }                
                });
            }
    }
							