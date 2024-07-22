<a name="formulario"></a>
 <div class="contenido_titulo_separador">	 Seminarios en vivo y online  “Ense&ntilde;anza de Habilidades de Modelamiento Matem&aacute;tico en las escuelas Finlandesas”
</div>

 <input type="hidden" name="form_tipo_inscripcion" value="20121205-JouniViiri">
 
<table class="tabla_simple" border="0">
 
<tr>
<td style="width:60% ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_simple.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
 
   <div id='inscripcion_programa' style=" width:600px "> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/20121205_programa.tpl -->
 </div>
 
   <div id='inscripcion_relator' style=" width:600px "> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/20121205_relator.tpl -->
 </div>
  
 
  
</td>
<td>
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Informaci&oacute;n Importante</strong>  </a></li>

<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_relator');"><strong>Relator</strong>  </a></li>
 <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha:</strong> 05 de diciembre de 2012</li> 
 <li  class="lateral_inscripcion"style="font-size:13px; "  ><strong>Hora:</strong> 14:00 -19:00 hrs  </li>
 <li  class="lateral_inscripcion"style="font-size:13px; "  ><strong>Presentador:</strong> Dr. Jouni Viiri del Departamento de Educaci&oacute;n de la Universidad de Jyvaskyla, Finlandia  </li>
  

 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Modalidad:</strong> V&Iacute;a internet. En vivo y online.    <br>  El seminario ser&aacute; en ingl&eacute;s, es gratuito y se transmitir&aacute; v&Iacute;a streaming.    </li>  
 
  
 <li class="lateral_inscripcion" style="font-size:13px; " ><strong>Contacto: </strong><br> Mar&Iacute;a Ang&eacute;lica Palavicino<br>
 <a href="mailto:contacto@torneoslatinoamericanos.org">contacto@torneoslatinoamericanos.org</a><br>
Tel&eacute;fono: (56 2) 9782590

</li><br><br>
<p style="text-align:center ">
<img src="http://www.ciae.uchile.cl/imageview.php?image=noticias/TORNEO LOGO.png" width="150px">
</p>
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />
 <p> 
 </p>
</td>
 </tr> 
</table>
<script type="text/javascript">
hiddenId('no_estacionamiento'); 
 

function ocultarDiv()
{
	hiddenId('inscripcion_ficha'); 
	hiddenId('inscripcion_relator');  
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