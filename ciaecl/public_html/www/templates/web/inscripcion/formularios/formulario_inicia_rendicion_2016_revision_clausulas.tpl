	function revisionClausulasInscripcion()
    {  	  
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
        
        if(document.main.asistencia_anterior.value == 'doble-doble' || document.main.tipo_inscripcion_actual.value == '2016-ValidacionPruebaINICIA_nodenuevo')
        {
            alert('Ud ya participo anteriormente en esta activiad, por lo que ya cumplio con la cantidad maxima, no puede participar nuevamente, muchas gracias por su compresion');
            recorreArregloVaciar('form_inicia_rendicion_sede');
            recorreArregloVaciar('form_inicia_rendicion_fecha'); 
        } 
        
        if(document.main.asistencia_anterior.value == 'doble-simple' && seleccion_fecha == '20160423-jornada_completa')
        {
            alert('Ud ya ha rendido 3 pruebas previamente, por lo que ahora solo puede participar en media jornada, muchas gracias por su compresion');
             
            recorreArregloVaciar('form_inicia_rendicion_fecha');
        
        }
    }
     
    
    
    if(trim(document.main.rut_consultado.value) != '')
    {
 		if(academica_carrera_base == 'basica_general')
        {        	
			alert('La carrera de Educacion Basica no se encuentra disponible para este nueva fecha');
            recorreArregloVaciar('form_inicia_rendicion_sede');
            recorreArregloVaciar('form_inicia_rendicion_fecha');
            
            var m2 = searchElement('form_inicia_situacion_academica_carrera');            
            var m2len = m2.length;
            m2.options[m2len]= new Option('Pedagogia en Educacion Basica','basica_general');
            selectValue('form_inicia_situacion_academica_carrera','basica_general'); 
        } 	     
        revisionClausulasInscripcion(); 
    } 
    
    if(fin_inscripcion == 'inicio' && trim(document.main.rut_consultado.value) == '')
    {
	     //mensaje de cierre de alguna carrera
    }   
    
    alert('Los cupos para inscripciones en Vina del Mar y Concepcion se encuentran cerradas');  
    
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