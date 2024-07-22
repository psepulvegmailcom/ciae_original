 
			<table id="tabla_noborder">
				<tr>
					<th    rowspan="2"  width="25%"> &Aacute;rea  {persona_texto_area} </th>
					<th      rowspan="2"  width="50%" align="center">Subárea {persona_texto_area}    </th>
					<th    colspan="2">   </th>
				</tr>
				<tr> 
					<th align="center" colspan="2">  </th> 
				</tr>
				<!-- START BLOCK : bloque_ate_area -->				
				
				
				<tr>
				<td  rowspan="{total_filas}"  ><strong>{bloque_ate_area_area}</strong></td>
				 {bloque_ate_area_fila_experiencia}
				 </tr>
				<!-- START BLOCK : bloque_ate_area_programa -->
				<tr>
				{bloque_ate_area_fila_experiencia}
				</tr>
				<!-- END BLOCK : bloque_ate_area_programa -->
				 
			<!-- END BLOCK : bloque_ate_area -->
			
				 </table>

	 
	 


 

 <script>
	function verFormularioPopupEspecial(opcion,rut)
	{  
		var	nombre = 'ventana_extra_lista_portafolio_recurso_ficha';
		var	url ='indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option='+opcion+'&rut='+rut ;
		  var nuevo_ventana = window.open(url,nombre,optionOpenW);
	}
	
	function verFormularioPopup(opcion,nombre)
	{
		if(nombre == '')
			nombre = 'ventana_extra'; 
		  var nuevo_ventana = window.open('indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option='+opcion,nombre,optionOpenW);
	}
</script>
					 
 