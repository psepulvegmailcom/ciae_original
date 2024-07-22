<a name="formulario"></a>
 <div class="contenido_titulo_separador">	 Curso "Modelos de an&aacute;lisis multi-nivel  en la investigacion educacional"
</div>

 <input type="hidden" name="form_tipo_inscripcion" value="20121126-cursoDupriez">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:60% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_simple_rut.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas_20121126.tpl -->
 
 
 </div>
 
  <div id='inscripcion_programa' style=" width:600px "> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/20121126-cursoDupriez_programa.tpl -->
 </div>
 
  
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li>
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> 26 - 29 de noviembre de 2012</li>  
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Expositor:</strong> Vincent Dupriez, GIRSEF, Universidad Cat&oacute;lica de Lovaina </li>  
  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Lugar:</strong> Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n, Universidad de Chile, Santiago de Chile.   </li>  
  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Cupos limitados:   </strong>
m&aacute;ximo 25 personas
</li> 
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Costo Inscripci&oacute;n: </strong>
$50.000  
</li> 
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Contacto: </strong> <a href="mailto:ciae@uchile.cl" >ciae@uchile.cl</a> 
</li> 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />
 <p> 
 </p>
</td>
 </tr> 
</table>
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