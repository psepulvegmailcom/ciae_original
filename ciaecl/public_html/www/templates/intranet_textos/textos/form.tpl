 
{tag_volver}
<div class="fieldset_title"  style="text-align:right " ><a href="javascript:seleccionCriterioAvance('');">{id_texto}</a></div>
	
{mensaje_guardar}

 

<fieldset id='formulario_admin'> 
	 
	  <table style="width:99% " border="0">
	  <tr><td rowspan="2" style="vertical-align:top; width:240px; text-align:center ">
	  <a href="javascript:verImagenBloqueGeneral('textos/revision/{id_texto}.jpg');" ><img src="imageview.php?image=textos/revision/{id_texto}.jpg" width="240" border="0"></a>
	  
	  
	  <script> 
	  verImagenBloqueGeneral('textos/revision/{id_texto}.jpg');
	  </script>
	  
	  </td><td style="vertical-align:top ">
	  
		<div id='bloque_extra_criterio_texto_ayuda'></div>
	  <!-- START BLOCK : tabla_nivel_cuento -->
	  <!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_cuento.tpl -->
	  <!-- END BLOCK : tabla_nivel_cuento -->
	  <!-- START BLOCK : tabla_nivel_noticia  -->
	  <!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_noticia.tpl -->
	  <!-- END BLOCK : tabla_nivel_noticia  -->	   
	  <!-- START BLOCK : tabla_nivel_carta -->
	  <!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_carta.tpl -->
	  <!-- END BLOCK : tabla_nivel_carta -->
	  
	  
	  </td></tr>
	  <tr><td style="vertical-align:top; text-align:left">&nbsp;   

	  
	  </td></tr>
	  </table>

	
	 
 	
  
	
</fieldset>
	  
<input type="hidden" name="id_item" value="{id_item}">
<input type="hidden" name="criterio" value="{id_criterio}">

 <input type="hidden" name="id_correccion_dia" value="{id_correccion_dia}"	>
 <input type="hidden" name="id_correccion" value="{id_correccion}">
 <input type="hidden" name="id_tipo_texto" value="{id_tipo_texto}"> 
 <input type="hidden" name="id_texto" value="{id_texto}"> 
 <input type="hidden" name="username" value="{username}"> 
 <input type="hidden" name="orden_tipo_texto" value="{orden_tipo_texto}"> 

<script type="text/javascript">
function seleccionCriterioAvance(criterio)
{
	document.main.criterio.value = criterio;
	process('{opcion_modulo}|modificar|',0);	 
}

function seleccionCriterio(criterio)
{
	document.main.criterio.value = criterio;  
	alert('Para revisar los criterios debe corregirlos de manera consecutiva. Los que ya han sido evaluados no pueden volver a revisarse.');
	
	//process('{opcion_modulo}|modificar|',0);	
} 

function editElement()
{   
   if(confirm('\u00BFEst\u00E1 seguro(a) que desea guardar este criterio? Recuerde que no podr\u00E1 volver a corregirlo'))
   {   
		var seleccion = false;
		
		if(document.main.criterio.value == 5)
		{ 
			seleccion = false;
			for(i=0; ele = document.main.nivel_5_1[i];i++)
			{
				if(ele.checked) 
				{
					seleccion = true;  
				}
			}				
			if(seleccion == false)
			{
				alert('Debe seleccionar todas las alternativas');
				return ''; 
			}
			seleccion = false;
			for(i=0; ele = document.main.nivel_5_2[i];i++)
			{
				if(ele.checked) 
				{
					seleccion = true;  
				}
			}				
			if(seleccion == false)
			{
				alert('Debe seleccionar todas las alternativas');
				return ''; 
			}			
			seleccion = false;
			for(i=0; ele = document.main.nivel_5_3[i];i++)
			{
				if(ele.checked) 
				{
					seleccion = true;  
				}
			}				
			if(seleccion == false)
			{
				alert('Debe seleccionar todas las alternativas');
				return ''; 
			}			
			seleccion = false;
			for(i=0; ele = document.main.nivel_5_4[i];i++)
			{
				if(ele.checked) 
				{
					seleccion = true;  
				}
			}				
			if(seleccion == false)
			{
				alert('Debe seleccionar todas las alternativas');
				return ''; 
			}			
			seleccion = false;
			for(i=0; ele = document.main.nivel_5_5[i];i++)
			{
				if(ele.checked) 
				{
					seleccion = true;  
				}
			}				
			if(seleccion == false)
			{
				alert('Debe seleccionar todas las alternativas');
				return ''; 
			}			 
		}
		else
		{ 
			for(i=0; ele = document.main.nivel[i];i++)
			{
				if(ele.checked) 
				{
					seleccion = true; 
					break;
				}
			}   
		}
		
		
		if(seleccion)
		{
			process('{opcion_modulo}|modificar|guardar|',0);	
		} 
		else
		{
			alert('Debe seleccionar al menos una alternativa ');
			return '';
		}		
   } 
}
 

</script>
{tag_volver}