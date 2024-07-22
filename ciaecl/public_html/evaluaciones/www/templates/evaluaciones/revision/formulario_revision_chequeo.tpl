 <script>
	function guardarDetalleFormulario()
	{  
		<!-- START BLOCK : bloque_lista_envio_pregunta_texto_revision -->
		if(document.main.revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}.value == '')
		{ 
			alert('Debe responder todas las preguntas');
			document.main.revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}.focus();
			return false;
		}
		
		var total_revision = wordCount('revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}') ;
		var diferencia = 70 - total_revision;
		if(diferencia < 0)
		{
			alert('Debe ingresar maximo 70 palabras en cada respuesta');
			document.main.revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}.focus();
			return false;
		} 
		<!-- END BLOCK : bloque_lista_envio_pregunta_texto_revision -->
        <!-- START BLOCK : bloque_lista_envio_pregunta_nota_revision -->
		 total_seleccion = 0;
		 for (i=0;i<document.main.revision_nota_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}.length;i++)
		 {
       		if (document.main.revision_nota_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}[i].checked)
          	{
				total_seleccion = 1;
			}
    	 } 
		 if(total_seleccion == 0)
		 { 
			alert('Debe asignarle nota a cada una de las preguntas de los archivos revisados');
			return false;
		 }
         <!-- START BLOCK : bloque_lista_envio_pregunta_nota_revision -->
		return true;
	} 
 </script>