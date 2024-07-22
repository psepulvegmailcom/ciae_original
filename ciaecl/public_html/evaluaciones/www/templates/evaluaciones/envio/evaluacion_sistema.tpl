 <!-- INCLUDE BLOCK : www/templates/evaluaciones/base_header.tpl -->
<div class="separador_areas">Evaluación Final </div>

<table  class="tabla_formulario">
<tr><th style="text-align:left ">1.- Por favor, evalúe su experiencia con el sistema de revisión por pares en la escala del 1 al 7</th></tr>
<tr><td>
	<table style="width:100% ">
	<tr><td width="30%">&nbsp;</td><td style="text-align:center "><strong>1</strong></td><td style="text-align:center "><strong>2</strong></td><td style="text-align:center "><strong>3</strong></td><td style="text-align:center "><strong>4</strong></td><td style="text-align:center "><strong>5</strong></td><td style="text-align:center "><strong>6</strong></td><td style="text-align:center "><strong>7</strong></td></tr>
	<tr><td> ¿El sistema es útil? </td><td style="text-align:center "><input type="radio" value="1" name="evaluacion_final_1_1"></td><td style="text-align:center "><input type="radio" value="2" name="evaluacion_final_1_1"></td><td style="text-align:center "><input type="radio" value="3" name="evaluacion_final_1_1"></td><td style="text-align:center "><input type="radio" value="4" name="evaluacion_final_1_1"></td><td style="text-align:center "><input type="radio" value="5" name="evaluacion_final_1_1"></td><td style="text-align:center "><input type="radio" value="6" name="evaluacion_final_1_1"></td><td style="text-align:center "><input type="radio" value="7" name="evaluacion_final_1_1"></td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td> ¿Ha aprendido con el uso del sistema? </td><td style="text-align:center "><input type="radio" value="1" name="evaluacion_final_1_2"></td><td style="text-align:center "><input type="radio" value="2" name="evaluacion_final_1_2"></td><td style="text-align:center "><input type="radio" value="3" name="evaluacion_final_1_2"></td><td style="text-align:center "><input type="radio" value="4" name="evaluacion_final_1_2"></td><td style="text-align:center "><input type="radio" value="5" name="evaluacion_final_1_2"></td><td style="text-align:center "><input type="radio" value="6" name="evaluacion_final_1_2"></td><td style="text-align:center "><input type="radio" value="7" name="evaluacion_final_1_2"></td></tr>
		<tr><td> Comentario </td><td colspan="7"> <textarea style="width:100%; height:100px " name="evaluacion_final_1_3"></textarea></td></tr>
	</table>
</td></tr>
<tr><th style="text-align:left "><strong> 2.- ¿Usted cree que el uso de este concepto será beneficioso para la solución de tareas en su escuela u organización?</strong></th></tr>
<tr><td><input type="radio" name="evaluacion_final_2_1" value="si"> Si <input type="radio" name="evaluacion_final_2_1" value="no"> No </td></tr>
<tr>
  <th style="text-align:left "><strong> 3.- En caso de responder afirmativemente la pregunta anterior, indique los posibles beneficios a su organización. En caso de responder negativamente, indique porque no ser&iacute;a beneficioso.</strong></th>
</tr>
<tr><td><textarea style="width:100%; height:100px " name="evaluacion_final_3_1"></textarea></td></tr>
<tr><th style="text-align:left "><strong> 4.- Por favor, proporcione cualquier sugerencia que pueda tener en relación con la programación, los plazos o las asignaciones</strong></th></tr>
<tr><td><textarea style="width:100% ; height:100px" name="evaluacion_final_4_1"></textarea></td></tr>

<tr><td    style="text-align:center ">
<button type="button" onClick="javascript:guardarFormulario();"><span>Enviar</span></button> 
<button onclick="javascript:cancelarFormulario();" type="button" title="Cancelar"><span>Cancelar</span></button> 
</td></tr>
</table>

<script>
function guardarDetalleFormulario()
{ 
	 var total_seleccion = 0;
	 for (i=0;i<document.main.evaluacion_final_1_1.length;i++)
	 {
		if (document.main.evaluacion_final_1_1[i].checked)
		{
			total_seleccion = 1;
		}
	 } 
	 if(total_seleccion == 0)
	 { 
		showAlert('Debe completar todos los campos solicitados (1.1)');
		return false;
	 } 
	 total_seleccion = 0;
	 for (i=0;i<document.main.evaluacion_final_1_2.length;i++)
	 {
		if (document.main.evaluacion_final_1_2[i].checked)
		{
			total_seleccion = 1;
		}
	 } 
	 if(total_seleccion == 0)
	 { 
		showAlert('Debe completar todos los campos solicitados (1.2)');
		return false;
	 }

	 total_seleccion = 0;
	 for (i=0;i<document.main.evaluacion_final_2_1.length;i++)
	 {
		if (document.main.evaluacion_final_2_1[i].checked)
		{
			total_seleccion = 1;
		}
	 } 
	 if(total_seleccion == 0)
	 { 
		showAlert('Debe completar todos los campos solicitados (2.1)');
		return false;
	 } 

	if(trim(document.main.evaluacion_final_4_1.value) == '')
	{
		showAlert('Debe completar todos los campos solicitados (4.1)');
		return false;
	}
	if(trim(document.main.evaluacion_final_3_1.value) == '')
	{
		showAlert('Debe completar todos los campos solicitados (3.1)');
		return false;
	}
	if(trim(document.main.evaluacion_final_1_3.value) == '')
	{
		showAlert('Debe completar todos los campos solicitados (1.3)');
		return false;
	}
	 
	process('{opcion_modulo}|guardar|guardar_final',0);
	 
}
</script>
  <!-- INCLUDE BLOCK : www/templates/evaluaciones/base_footer.tpl -->