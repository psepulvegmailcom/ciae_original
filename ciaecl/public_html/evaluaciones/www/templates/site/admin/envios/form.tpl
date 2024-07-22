  <script>
  var casoCoordinador = false;
   
    <!-- START BLOCK : bloque_volver_listado -->
  gotoHrefLink('?page={opcion}');
    <!-- START BLOCK : bloque_volver_listado -->
  
  </script>
<input type="hidden" name="id_envio" value="{id_envio}">
<input type="hidden" name="promedio_nota" value="0">

<input type="hidden" name="tipo_revision"  value="evaluacion" /> 
  <!-- START BLOCK : bloque_sesion_llena -->
 <div style="text-align:center"><strong style=" text-align:center;color:#FF0000; font-size:110%">No se puedo agregar este trabajo a la sesión seleccionada porque esta llena, si desea agregarlo debe eliminar un trabajo de esta sesión.</strong></div>
  <!-- END BLOCK : bloque_sesion_llena -->
  
  
  <!-- START BLOCK : bloque_sesion_asignado -->
 <div style="text-align:center"><strong style=" text-align:center;color:#FF0000; font-size:110%">No se puedo agregar este trabajo a la sesión, pues ya esta asignado.</strong></div>
  <!-- END BLOCK : bloque_sesion_asignado -->
  
  
  
<div class="fieldset_title">Datos Autor</div>
 <table width="95%" border="0" cellpadding="3" style="font-size:">  
  <tr>
    <td style=" width:30%"><strong>Email </strong></td>
    <td style="width:70%"> 
        {email}    </td>
  </tr>
 
  <tr>
    <td><strong>Nombre  </strong></td>
    <td>
         {nombre} {apellidos}</td>
  </tr>
   
   <tr>
  <td><strong>Cargo/Rol </strong></td>
  <td>
       {rol} </td></tr>
  
  <tr>
    <td><strong>Instituci&oacute;n  </strong></td>
    <td>
         {institucion} </td>
  </tr>
    <tr>
    <td><strong>Tel&eacute;fono </strong></td>
    <td> {telefono} </td>
  </tr>
  <tr>
    <td><strong>Direcci&oacute;n</strong></td>
    <td> {direccion} </td>
  </tr>
  <tr>
  <td><strong>Ciudad </strong></td>
  <td>
         {ciudad} </td></tr>
  <tr>
    <td><strong>Pa&iacute;s </strong></td>
    <td>
      {pais}
 
  </td>
  </tr> 
   
  <tr>
    <td style=" width:20%"><strong>Comentario Autor   </strong></td>
    <td style="width:70%"> 
        {comentario_autor}    </td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
</table>
  
  
<div class="fieldset_title">Datos Trabajo</div>

 <table width="95%" border="0" cellpadding="3" style="font-size:"> 
   <tr>
    <td style=" width:30%"><strong>Título </strong></td>
    <td style="width:70%"> 
        {titulo}  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
  <tr>
    <td style=" width:20%"><strong>ID </strong></td>
    <td style="width:70%"> 
        {id_envio}    </td>
  </tr>
  <tr>
    <td style=" width:20%"><strong>Email </strong></td>
    <td style="width:70%"> 
        {email}    </td>
  </tr>

  
 
  <tr>
    <td style=" width:20%"><strong>Área </strong></td>
    <td style="width:70%"> 
        {area}    </td>
  </tr>
  <tr>
    <td style=" width:20%"><strong>Comentario Comité Organizador   </strong></td>
    <td style="width:70%"> 
        {comentario_interno}    </td>
  </tr>
  
  <tr>
    <td style=" width:20%"><strong>Archivo</strong></td>
    <td style="width:70%"> 
        <a href="http://www.ciie2012.cl/docs/envios/{archivo}" target="_blank">  Descargar Archivo </a>   </td>
  </tr>
     <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
    <tr>
    <td style=" width:20%"><strong>Tipo de sesión </strong></td>
    <td style="width:70%"> 
        <span style="text-transform:capitalize ">{tipo_sesion_caso}</span>  </td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
</table>

  
  <!-- START BLOCK : bloque_formulario_revisores_cerrado -->
    <div style="text-align:center"><strong style=" text-align:center;color:#FF0000; font-weight:bold; font-size:120%">Este trabajo tiene evaluación final</strong></div>
  
  <!-- END BLOCK : bloque_formulario_revisores_cerrado -->
  
  
  <!-- START BLOCK : bloque_formulario_revisores --> 
<div class="fieldset_title" id='titulo_revision'>Revisión Trabajo</div>

  <table>
  
  
  
  <tr id='tabla_criterios_titulo'>
  <td colspan="2" style="text-align:center; padding-left:20px"></td>
  </tr>
  <tr  id='tabla_criterios'>
  <td colspan="2"> 
  <table cellspacing="0" style="width:100%;  " cellpadding="0">
     <tr >
      <td >&nbsp;</td>
      <td align="center" colspan="5"><strong>Criterios</strong></td> 
    </tr>
    <tr >
      <td >&nbsp;</td>
      <td align="right" ><div align="center"><strong>1</strong></div></td>
      <td align="right" ><div align="center"><strong>2</strong></div></td>
      <td align="right" ><div align="center"><strong>3</strong></div></td>
      <td align="right" ><div align="center"><strong>4</strong></div></td>
      <td align="right" ><div align="center"><strong>5</strong></div></td>
    </tr>
    <tr>
      <td  style=" border-bottom:1px solid #333333;"style="width:40%" > </td>
      <td style=" border-bottom:1px solid #333333;"><div align="center"><strong>Insuficiente</strong></div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center"><strong>Excelente</strong></div></td>
    </tr>
    <tr>
      <td  class="borde_criterios" >1.- Objetivos o intenciones <img src="www/images/iconos/message-feedback.gif" width="20px" title="El trabajo describe un conjunto claro de objetivos o intenciones para el estudio, que están alineados con el tema del área."></td>
      <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_1" value="1" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_1"  value="2" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_1" value="3"  /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_1" value="4" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_1" value="5" /></center></td>
    </tr>
    <tr>
      <td  class="borde_criterios" >2.- Perspectiva(s) o marco te&oacute;rico <img src="www/images/iconos/message-feedback.gif" width="20px" title="El trabajo describe una clara perspectiva o marco teórico apropiado para el tópico del estudio y el tema del área."></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_2" value="1"/></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_2"   value="2" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_2"  value="3" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_2"   value="4" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_2"  value="5"  /></center></td>
    </tr>
    <tr >
      <td   class="borde_criterios" >3.- M&eacute;todos, t&eacute;cnicas o modos de indagaci&oacute;n <img src="www/images/iconos/message-feedback.gif" width="20px" title="El trabajo describe métodos, técnicas o modos de indagación apropiados para el tópico del estudio."></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_3" value="1"/></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_3"    value="2" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_3"  value="3" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_3"  value="4" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_3" value="5"  /></center></td>
    </tr>
    <tr >
      <td   class="borde_criterios" >4.- Fuentes de informaci&oacute;n, evidencia, objetos o materiales, o su    equivalente, para el caso de trabajos de corte te&oacute;rico o metodol&oacute;gico. <img src="www/images/iconos/message-feedback.gif" width="20px" title=" El trabajo incluye fuentes de información, evidencia, objetos o materiales -o su equivalente, para el caso de trabajos de corte teórico o metodológico- que son apropiados para el tópico del estudio."></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_4"  value="1"/></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_4"   value="2" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_4"  value="3" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_4"  value="4" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_4" value="5"  /></center></td>
    </tr>
    <tr >
      <td   class="borde_criterios" >5.- Resultados y/o conclusiones demostradas o justificaciones para argumentos o puntos de vista <img src="www/images/iconos/message-feedback.gif" width="20px" title="Los resultados y/o conclusiones están claramente corroborados y lógicamente basados en los métodos y datos/evidencias proporcionados en el estudio. "></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_5" value="1"/></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_5"  value="2"  /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_5"  value="3" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_5"  value="4" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_5"  value="5" /></center></td>
    </tr>
    <tr >
      <td   class="borde_criterios" >6.- Importancia cient&iacute;fica o acad&eacute;mica del estudio <img src="www/images/iconos/message-feedback.gif" width="20px" title="El trabajo tiene importancia suficiente como para representar un avance y ser de interés para el área."></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_6" value="1"/></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_6"   value="2" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_6"  value="3" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_6" value="4" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_6" value="5" /></center></td>
    </tr>
    <tr>
      <td  class="borde_criterios" >7.- Uso de fuentes bibliogr&aacute;ficas. <img src="www/images/iconos/message-feedback.gif" width="20px" title="El trabajo hace un uso apropiado de fuentes bibliográficas relevantes y actualizadas para el área."></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_7" value="1"/></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_7"  value="2" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_7"  value="3" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_7" value="4" /></center></td>
       <td  class="borde_criterios" ><center><input type="radio" {formulario_evaluador_disabled}  onClick="javascript:calculoPromedioPuntuacion();" name="criterio_7" value="5" /></center></td>
    </tr>
  </table> <br>
  <br><strong>Promedio Nota Criterio</strong> <span id='promedio_nota_html'>0</span>
  </td>
  </tr>
 
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td style=" width:20%"><strong>Comentario  </strong></td>
    <td style="width:70%"> 
        <textarea name="comentario" {formulario_evaluador_disabled} style="width:100%; height:50px;"></textarea>   </td>
  </tr>
  
    <tr>
    <td style=" width:20%"><strong id='recomendacion_titulo_evaluador'>  Decisión Final </strong></td>
    <td style="width:70%"> 
     
		<!-- START BLOCK : bloque_formulario_alternativas_tipo_sesion --> 
		<input type="radio" name="decision" value="{caso}"   onchange="javascript:habilitarSesiones();" > {texto} <br>
		<!-- END BLOCK : bloque_formulario_alternativas_tipo_sesion -->  
	</td>
  </tr>
     
       
  

  <!-- START BLOCK : bloque_formulario_coordinadores --> 
  
  <script>
  	casoCoordinador = true;  
  </script>
  
   <tr>
    <td   style="text-align:center" colspan="2">&nbsp;</td>
  </tr>   
  
     <tr>
    <td   style="text-align:center" colspan="2"><strong>Trabajos Seleccionados </strong></td>
  </tr>    
  <tr>
    <td   style="text-align:left" colspan="2"  >
<strong>Sesión Regular de Trabajo</strong> (Cupos disponibles: {total_cupos_area_regular} | Cupos utilizados: {total_cupos_area_regular_usados})

<ul>
<!-- START BLOCK : bloque_formulario_seleccion_regular_lista --> 

<li style=" text-transform:capitalize ">ID {id_envio} <em>"{titulo}" </em>- {autor}</li>
<!-- END BLOCK : bloque_formulario_seleccion_regular_lista --> 
</ul>

</td>
  </tr>    
  <tr>
    <td   style="text-align:left" colspan="2"  >
<strong>Sesión de Posters</strong> (Cupos disponibles: {total_cupos_area_poster} | Cupos utilizados: {total_cupos_area_poster_usados})
<ul>
<!-- START BLOCK : bloque_formulario_seleccion_poster_lista --> 
<li style=" text-transform:capitalize ">ID {id_envio} <em>"{titulo}" </em>- {autor}</li>
<!-- END BLOCK : bloque_formulario_seleccion_poster_lista --> 
</ul>
	
	<script>
	if({total_cupos_area_regular} == {total_cupos_area_regular_usados})
	{
		for (var i=0;i<document.main.decision.length;i++)
		{
			if (document.main.decision[i].value == 'regular_simple_seleccionar' || document.main.decision[i].value == 'regular_poster_seleccionar')
			{
				document.main.decision[i].disabled = true;
			}
		} 
	}
	if({total_cupos_area_poster} == {total_cupos_area_poster_usados})
	{
		for (var i=0;i<document.main.decision.length;i++)
		{
			if (document.main.decision[i].value == 'poster_seleccionar' || document.main.decision[i].value == 'regular_poster_no_seleccionar_si_poster')
			{
				document.main.decision[i].disabled = true;
			}
		} 
	}
	
	</script>
	</td>
  </tr>  
  
   
  <!-- END BLOCK : bloque_formulario_coordinadores --> 
   <tr>
    <td   style="text-align:center" colspan="2">&nbsp;</td>
  </tr> 
     <tr id='fila_boton_guardar'>
    <td>&nbsp;</td>
    <td>  <input   type="button" class="buttontype" onclick="javascript:enviarRevision();"  title="Guardar" value="Guardar y Volver a Listado" /> </td>
  </tr>
  
  <tr>
    <td style=" width:20%"> </td>
    <td style="width:70%">    </td>
  </tr>
  </table>
  
  <!-- END BLOCK : bloque_formulario_revisores -->
  
    <!-- START BLOCK : bloque_formulario_admin --> 
<div class="fieldset_title">Revisión Trabajo</div>
  <table  style="width:100%">
  <tr><td style="width:30%" ><strong>Estado</strong></td><td>
  <select name="estado"  >
  <option value="activo"  {selected_activo}>Activo</option>
  <option value="repetido" {selected_repetido}>Repetido</option>
  <option value="fuera_de_ambito" {selected_fuera_de_ambito}>Fuera de ámbito</option>
  <option value="archivo_dañado" {selected_archivo_dañado}>Archivo Dañado</option>
  </select>
  
  </td></tr>

  <tr><td ><strong>Área</strong></td><td>
  <select name="area"  >
	  <option value="1"  {selected_area_1}>Política Educativa </option> 	 
	  <option value="2"  {selected_area_2}>Educación Superior </option>	 
	  <option value="3"  {selected_area_3}>Gestión Educativa </option>	 
	  <option value="4"  {selected_area_4}>Enseñanza Aprendizaje 	</option> 
	  <option value="5"  {selected_area_5}>Docentes 	 </option>
	  <option value="6"  {selected_area_6}>TIC y Educación 	 </option>
	  <option value="7"  {selected_area_7}>Neurociencias y Cognición 	</option> 
	  <option value="8"  {selected_area_8}>Historia de la Educación</option> 
  </select> 
  </td></tr> 
    <tr>
    <td  ><strong>Comentario  Comité Organizador</strong></td>
    <td  > 
        <textarea name="comentario" style="width:100%; height:100px;">{comentario_interno}</textarea>   </td>
  </tr> 
   <tr>
    <td>&nbsp;</td>
    <td>  <input   type="button" class="buttontype"   onclick="javascript:guardarEstado();"   title="Guardar" value="Guardar" /> </td>
  </tr>
  </table>
  <!-- END BLOCK : bloque_formulario_admin -->
  
<div class="fieldset_title">Resultados y Comentarios de Evaluación</div>
  <table style="width:100% ">
  <!-- START BLOCK : bloque_revisiones --> 
    <tr> 
	<td  colspan="2"  class="borde_criterios" > 
		<br /><strong>Usuario : </strong>{username}<br />
		<strong>Fecha</strong> {fecha_html}<br />
	   <strong>Comentario:</strong> {comentario}<br />
	   <strong>Decisión :</strong> <font style="text-transform:capitalize" >{decision_html}</font>  <br />
	   <strong>Tipo Decisión :</strong> <font style="text-transform:capitalize" >{tipo_revision_html} </font><br />
		     <!-- START BLOCK : bloque_revisiones_nota -->
	  <strong>Criterios:</strong> <br />
	  

	   <ol>
		<li>Objetivos o intenciones: <strong>{criterio_1}</strong></li>
		<li>Perspectiva(s) o marco teórico: <strong>{criterio_2}</strong></li>
		<li>Métodos, técnicas o modos de indagación: <strong>{criterio_3}</strong></li>
		<li>Fuentes de información, evidencia, objetos o materiales, o su equivalente, para el caso de trabajos de corte teórico o metodológico: <strong>{criterio_4}</strong></li>
		<li>Resultados y/o conclusiones demostradas o justificaciones para argumentos o puntos de vista:<strong> {criterio_5}</strong></li>
		<li>Importancia científica o académica del estudio:<strong> {criterio_6}</strong></li>
		<li>Uso de fuentes bibliográficas: <strong>{criterio_7}</strong></li>
	   </ol>
	   <strong>Promedio nota criterios: </strong>{promedio_nota}
	     <!-- END BLOCK : bloque_revisiones_nota --> 
		 <br /> 
      </td>
  </tr>
  
  <!-- END BLOCK : bloque_revisiones --> 
     
  <tr>
  <td colspan="2">{no_hay_comentarios}</td></tr>
  </table>


<input type="hidden" value="mant_envios" name="opcion" /> 
  

<script>  
<!-- START BLOCK : bloque_formulario_cambio_definitivo_evaluador -->
hidetr('fila_boton_guardar');
<!-- END BLOCK : bloque_formulario_cambio_definitivo_evaluador -->


<!-- START BLOCK : bloque_formulario_cambio_coodinador -->
if(casoCoordinador)
{
	hidetr('tabla_criterios');
	hidetr('tabla_criterios_titulo');
}
<!-- END BLOCK : bloque_formulario_cambio_coodinador -->


function habilitarSesiones()
{ 
	if(casoCoordinador)
	{  
		document.main.tipo_revision.value = 'definitivo'; 
		var estado_disabled = true;
		if(document.main.decision.value == 'elegible')
		{
			document.main.lista_espera.disabled = false;	
		}
		if(document.main.decision.value == 'seleccionado')
		{
			estado_disabled = false;
		}
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{	 
			 if(x[i].name == 'sesion')
			 {
				x[i].disabled = estado_disabled;
			 }
			 else
			 {
				var subname = x[i].name.substring(0,8); 
				if(subname == 'eliminar')
				 {
					x[i].disabled = estado_disabled;
				 }						
			 }
		} 		
	}
}

function guardarEstado()
{
	if(confirm('¿Esta seguro de hacer estos cambios en este trabajo?'))
	{
		process('guardar_estado',2);
	}
}
function enviarRevision()
{   
	var  tiene = false;
	 
	 if(!casoCoordinador)
	 {
	  <!-- START BLOCK : bloque_chequeos_criterios -->
	  	tiene = false;
		for (var i=0;i<document.main.criterio_{criterio}.length;i++)
		{
		   if (document.main.criterio_{criterio}[i].checked)
		   {
			 tiene = true;
			}
		} 
		if(!tiene)
		{
			alert('Debe evaluar el criterio {criterio}');
			return false;
		}
	  <!-- END BLOCK : bloque_chequeos_criterios -->
  	}
	if(document.main.decision.value == '')
	{
		alert('Debe seleccionar una decision sobre el trabajo');
		return false;
	}

	if(casoCoordinador && document.main.decision.value == 'seleccionado')
	{
		var indica_sesion = false;
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{	 
			 if(x[i].name == 'sesion' && x[i].checked)
			 {
				indica_sesion = true;
			 } 
		} 
		if(!indica_sesion)
		{
			alert('Para los trabajos seleccionados debe indicar en que sesion la incluira');
			return false;
		}
	} 
	 process('guardar',2); 
}

<!-- START BLOCK : bloque_cambio_recomendacion_titulo_evaluador -->
	cambiarTexto('recomendacion_titulo_evaluador','Recomendación');
<!-- END BLOCK : bloque_cambio_recomendacion_titulo_evaluador -->
<!-- START BLOCK : bloque_cambio_recomendacion_titulo_administrador -->
	cambiarTexto('recomendacion_titulo_evaluador','Recomendación');
<!-- END BLOCK : bloque_cambio_recomendacion_titulo_administrador -->


function calculoPromedioPuntuacion()
{
	var total_valores = 7;
	var suma_nota = 0;
	var promedio = 0; 
	  <!-- START BLOCK : bloque_chequeos_criterios_calculo -->
	  	 
		for (var i=0;i<document.main.criterio_{criterio}.length;i++)
		{
		   if (document.main.criterio_{criterio}[i].checked)
		   {
			 suma_nota = suma_nota + parseInt(document.main.criterio_{criterio}[i].value);
			}
		} 

	  <!-- END BLOCK : bloque_chequeos_criterios_calculo -->
	promedio = suma_nota / total_valores;
	promedio = Math.round(promedio*100)/100; 
	document.main.promedio_nota.value = promedio;
	cambiarTexto('promedio_nota_html',promedio); 
}

</script>