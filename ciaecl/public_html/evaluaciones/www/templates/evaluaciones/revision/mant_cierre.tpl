

 <script> 
 	function revisarEnvio(id_evaluacion,id_etapa,username_revisado)
	{ 
		document.main.id_evaluacion.value = id_evaluacion;
		document.main.id_etapa.value = id_etapa;
		document.main.username_revisado.value = username_revisado;
		irOpcionFormulario('revisar'); 
	}

 	function revisarEnvioFinal()
	{  
		irOpcionFormulario('revisarFinal'); 
	}	
 </script>