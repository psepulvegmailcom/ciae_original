<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Inscripci&oacute;n lanzamiento libro "Lo aprend&iacute; en la escuela.
&iquest;C&oacute;mo se logran procesos de mejoramiento escolar?"
</div>

 
<table class="tabla_simple" border="0">
 <input type="hidden"  name="form_tipo_inscripcion" value="20140514_lanzamientolibrotrayectoria">
<tr>
<td style="width:60% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_lanzamientolibrotrayectoria.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
 <div id='inscripcion_programa'>  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/lanzamientolibrotrayectoria_programa.tpl --> 
 
 
 </div>
  
 
  
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl -->  
 
   
 

 <li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li>
  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha :</strong><br>
      Mi&eacute;rcoles  14 de mayo, 18.30 horas.</li>   
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Lugar: </strong><br>
       Sal&oacute;n  Am&eacute;rica, Biblioteca Nacional <br>
        (Avenida  Libertador Bernardo O'Higgins 651, Santiago, entrada por Moneda). 
    </li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Organiza: </strong><br>    
    Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n (CIAE) y Unicef  </li>     
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Costo: </strong><br>  sin costo  </li>      
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Consultas o dudas: </strong><br><a href="mailto:comunicaciones@ciae.uchile.cl" >comunicaciones@ciae.uchile.cl</a> </li>   
    
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />

 <p> 
 </p>
</td>
 </tr> 
 <tr>
 <td colspan="2">  <div style="text-align:center ">
 <table  style="width:100%">
 <tr>
 <td style="vertical-align:middle; text-align:center"> <img src="imageview.php?image=noticias/LogoPIA.jpg" width="150px"><br>Anillo SOC1104</td> 
 <td style="vertical-align:middle; text-align:center"> <img src="imageview.php?image=noticias/LOGO2011.jpg" width="150px"></td>
  <td style="vertical-align:middle; text-align:center"> <img src="imageview.php?image=noticias/logo_BNacional.jpg" width="150px"></td>
  <td style="vertical-align:middle; text-align:center"> <img src="imageview.php?image=noticias/UNICEF.jpg" width="150px"></td>
 </tr>
 </table>
 
 </div></td>
 </tr>
</table>

<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha');   
	hiddenId('inscripcion_programa');
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
ocultarDiv();

mostrarDiv('inscripcion_programa');
 
	 

</script>
<div id='test'></div>
<script type="text/javascript">  

function enviarFormulario()
{    
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/celular.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/region.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/cargo.tpl --> 
	enviarFormularioBase();
}  
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->