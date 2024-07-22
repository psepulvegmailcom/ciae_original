	function revisionClausulasInscripcion()
    {  	 
		var x 		= document.main.elements;	 
		for (var i=0 ; i < x.length ; i++)
		{		
			if(x[i].name == 'form_inicia_rendicion_fecha' )
			{
				x[i].disabled = false;		
				x[i].checked  = false;	
			}
		}     
        changeTextId('mensaje_clausulas','');
        var seleccion_situacion = emptyCheckValue('form_inicia_situacion_academica'); 
        var seleccion_sede 		= emptyCheckValue('form_inicia_rendicion_sede'); 
        var seleccion_carrera 	= checkSelectedMultipleValue('form_inicia_situacion_academica_carrera'); 
        
        var x 		= document.main.elements;	 
        for (var i=0 ; i < x.length ; i++)
        {		  
            if(x[i].name == 'form_inicia_rendicion_fecha' && (x[i].value == '10 de mayo 2014 / jornada manana' || x[i].value == '10 de mayo 2014 / jornada tarde' || x[i].value == '10 de mayo 2014 / dia completo'))
            { 
            	 
            }
        } 
    }