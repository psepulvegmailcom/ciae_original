
 <div id="content_header{sufijo_nav}"> 
 <div style="float:left; padding:0  0 0 10px;"> <strong>Barra de Navegación </strong> (no guarda los cambios del formulario) </div>
		<ul id="mainNav" class="fiveStep"> 
		 
<!-- START BLOCK : tpl_botones_pasos -->		
				<li class="{class_step}"><a  href="javascript:ate_registro_paso('{tpl_botones_paso_id}',0);" > <em style="font-weight:normal;">{tpl_botones_paso_id_paso}</em> </a></li>
<!-- END BLOCK : tpl_botones_pasos --> 
		</ul>
</div>

 <!-- INCLUDE BLOCK : ../templates/ate/revision/form_registro_bloqueo_inclusion.tpl -->
<h2>{titulo_menu}</h2>  

	
{informacion_extra}

<br  /> 
<br  /> 
<!-- Botones de formulario superiores -->
<div id='bloque_botones_sup' style="padding-bottom:15px;"> 
 <center> 
	<button onclick="chequeoTipoDatos('mi_registro|{tpl_guardar_formulario}',0);" type="button" title="Guarda la información ingresada"><span>Guardar </span></button> 
		<!-- START BLOCK : tpl_botones_seguir_registro_up -->
		<button onclick="chequeoTipoDatos('mi_registro|{tpl_guardar_formulario_seguir}',0);" type="button" title="Guarda la información ingresada y pasa el paso siguiente"><span>Guardar y Seguir </span></button>
		<!-- END BLOCK : tpl_botones_seguir_registro_up --> 
	<!--<button onclick="chequeoTipoDatos('',0);" type="button" title="Sale del formulario sin guardar"><span>Salir </span></button>
	-->
		<button onclick="chequeoTipoDatos('registro_revision|only_revision',0);" type="button"><span>Estado Actual de su Registro</span></button>
	<!-- START BLOCK : tpl_botones_enviar_registro_up -->
		<!--<button onclick="chequeoTipoDatos('registro_revision',0);" type="button"><span>Enviar Registro</span></button>-->
	<!-- END BLOCK : tpl_botones_enviar_registro_up --> 
	<button onclick="cancelarForm();" type="button" title="Cancela los cambios realizados en el formulario"><span>Cancelar </span></button>
</div>
</center>
<!-- tooltip de ayuda general de formularios-->
<br /> (*) Campos Obligatorios.  <br />
Posando el mouse sobre <img src="images/Info.ico" border='0'   /> podrá encontrar ayuda relacionada al formulario. <br />
Recuerde "Guardar" o "Guardar y Seguir" cada vez que complete la información solicitada.<br />

<div id='carga_informacion' class="div_oculto" style="text-align:center">
<img src="images/spinner.gif" border="0" />
</div>
{tpl_formulario}
<br /><br />
 <!-- Botones de formulario inferiores -->
 <div id='bloque_botones_inf' style="padding-top:15px;"> 
 	<center>
		<button onclick="chequeoTipoDatos('mi_registro|{tpl_guardar_formulario}',0);" type="button" title="Guarda la información ingresada"><span>Guardar </span></button> 
		<!-- START BLOCK : tpl_botones_seguir_registro_down -->
		<button onclick="chequeoTipoDatos('mi_registro|{tpl_guardar_formulario_seguir}',0);" type="button" title="Guarda la información ingresada y pasa el paso siguiente"><span>Guardar y Seguir </span></button>
		<!-- END BLOCK : tpl_botones_seguir_registro_down --> 
	<!--	<button onclick="chequeoTipoDatos('',0);" type="button" title="Sale del formulario sin guardar">
			<span>Salir </span>
		</button>-->
		<button onclick="chequeoTipoDatos('registro_revision|only_revision',0);" type="button"><span>Estado Actual de su Registro</span></button>
		<!-- START BLOCK : tpl_botones_enviar_registro_down -->
		<!--<button onclick="chequeoTipoDatos('registro_revision',0);" type="button"><span>Enviar Registro</span></button>-->
		<!-- END BLOCK : tpl_botones_enviar_registro_down -->
		<button onclick="cancelarForm();" type="button" title="Cancela los cambios realizados en el formulario"><span>Cancelar </span></button>
	</center> 
 </div>
   
<input type="hidden" name="guardar_caso" value="guardar_{tpl_guardar_formulario}" /> 
<script>
	function irPaso(action,level)
	{	
		if(confirm('Esta acción no guardará los cambios realizados en este formulario ¿Esta seguro de continuar?'))
		{
			document.main.guardar_caso.value = '';
			process(action,level);
		}
	}
	function cancelarForm()
	{
		document.main.reset();
	}	 
</script>

	 