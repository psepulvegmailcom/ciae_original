	function revisionClausulasInscripcion()
    {  	  
        
        revisionFechasExtras();
        
        
        if(trim(document.main.tipo_inscripcion_actual.value) != '' && document.main.form_tipo_inscripcion.value != document.main.tipo_inscripcion_actual.value)
        {
            document.main.form_tipo_inscripcion.value = document.main.tipo_inscripcion_actual.value;
        }
        
        changeTextId('mensaje_clausulas','');
        var seleccion_situacion = emptyCheckValue('form_inicia_situacion_academica'); 
        var seleccion_sede 		= emptyCheckValue('form_inicia_rendicion_sede'); 
        var seleccion_fecha		= emptyCheckValue('form_inicia_rendicion_fecha'); 
        var seleccion_carrera 	= checkSelectedMultipleValue('form_inicia_situacion_academica_carrera');   
        
        if(document.main.tipo_inscripcion_actual.value == '2016-ValidacionPruebaINICIA_nocumple')
        {    
            alert('Ud no cumple con los requisitos, por lo que no puede participar en esta actividad, muchas gracias por su compresion');
            recorreArregloVaciar('form_inicia_rendicion_sede');
            recorreArregloVaciar('form_inicia_rendicion_fecha');
        }
        
        if(document.main.asistencia_anterior.value == 'doble-doble')
        {
            alert('Ud ya participo anteriormente en esta activiad, por lo que ya cumplio con la cantidad maxima, no puede participar nuevamente, muchas gracias por su compresion');
            recorreArregloVaciar('form_inicia_rendicion_sede');
            recorreArregloVaciar('form_inicia_rendicion_fecha'); 
        }  
    } 
    
    if(fin_inscripcion == 'inicio' && trim(document.main.rut_consultado.value) == '')
    {
	     //mensaje de cierre de alguna carrera
    }   
     
    function recorreArregloVaciar(nombre_arreglo)
    {
    	var x 		= document.main.elements;	 
		for (var i=0 ; i < x.length ; i++)
		{		
			if(x[i].name == nombre_arreglo )
			{ 		
				x[i].checked  = false;	
			}
		}  
    }