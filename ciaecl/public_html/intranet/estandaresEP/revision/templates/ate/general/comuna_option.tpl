		
		var theSelect 	= searchElement('{select_name}'); 
		<!-- START BLOCK : comuna_defecto -->		
		var obj 		= document.createElement('option');
		var value     	= '';
		var text      	='Seleccione Comuna';		
		obj.text = text;
		obj.value = value;  
		obj.selected = true; 
		theSelect.options[0] = obj; 
		<!-- END BLOCK : comuna_defecto -->
		
		<!-- START BLOCK : comuna -->
			
		var obj 			= document.createElement('option'); 
		var text 			= '{comuna_nombre}';
		var value 			= '{comuna_id}';  	
		obj.text 		= text;
		obj.value 		= value; 
		obj.selected 	= {selected}; 
		theSelect.options[{select_option_id}] = obj;  		 
		<!-- END BLOCK : comuna -->