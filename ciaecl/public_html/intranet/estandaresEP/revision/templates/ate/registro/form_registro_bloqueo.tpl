	var restriccionBloqueo = '|';
	<!-- START BLOCK : bloque_bloqueo_restriccion -->
	restriccionBloqueo = restriccionBloqueo+'{variable}|';
	<!-- END BLOCK : bloque_bloqueo_restriccion -->
	
	/* bloqueos de todo el formulario de los oferentes */
	
	var x = document.main.elements;	
	for (var i=0 ; i < x.length ; i++)
	{			      			
		if(x[i].type != 'hidden' && x[i].name != '' && x[i].name)
		{		
			var find = restriccionBloqueo.indexOf('|'+x[i].name+'|');	 					 				
			if(find > -1)
			{
				continue; 			
			} 
			if((x[i].type == 'checkbox'  || x[i].type == 'radio')  && !x[i].checked)
			{
				x[i].disabled = true;
				continue;
			}  
			ele 			= document.createElement('input');  
			ele.type 		= 'hidden';  
			ele.value 		= x[i].value;  
			ele.name 		= x[i].name; 				
			document.main.appendChild(ele);  
			x[i].disabled 	= true;
		}
	}
	
	if(document.getElementById('ate_institucion_zona_cobertura_boton'))
	{
		hiddenId('ate_institucion_zona_cobertura_boton');
	}