<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Convocatoria postdoctoral Fondecyt 2020

</div>

<table class="tabla_simple" border="0">
 <tr>
<td style="width:65%; padding:0 20px 0 20px; ">

     
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpl -->
 
<div id='inscripcion_ficha'>  
    <!-- START BLOCK : bloque_formulario --> 
	   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_201909_beca_postdoctoral.tpl -->
    <!-- END BLOCK : bloque_formulario --> 
</div>
  
  <!-- INCLUDE BLOCK : www/templates/web/inscripcion/201909_beca_postdoctoral-programa.tpl --> 
 
 
<div id='inscripcion_programa'  >  
</div>
 

   
</td>
<td>
 

<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 

<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Formulario de Postulaci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_convocatoria');"><strong>Informaci&oacute;n general</strong></a></li>
 <!--li class="lateral_inscripcion" style="font-size:15px; " ><a href="download.php?file=noticias/Diplomado_ME_informacion_2019.pdf"><strong>Descargar programa completo</strong>  </a></li--> 


<!-- <li class="lateral_inscripcion" style="font-size:15px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Programa</strong>  </a></li> --><br />
<br>
      
       <li  class="lateral_inscripcion" style="font-size:13px; "  id="informacion_lugar"  >Plazo m&aacute;ximo de env&iacute;o de antecedentes: <strong>10 de septiembre</strong>, completando el formulario de postulaci&oacute;n y adjuntando antecedentes.<br>
      <li  class="lateral_inscripcion" style="font-size:13px; "  >Enlace de inter&eacute;s:<a href="https://www.conicyt.cl/fondecyt/2018/11/15/concurso-postdoctorado-2020/" target="_blank">https://www.conicyt.cl/fondecyt/2018/11/15/concurso-postdoctorado-2020/</a>,
  <br>
        <br>
           
           
  <!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl -->  
           
        <p style="text-align:center"> 
             
          <br> <br>
          <br> <br>
          <br> <br>
             
             
          <br>
          <br>
             
             
        </p>
           
           
    </td>
 </tr> 
 
 <tr>
 <td colspan="2">  <div style="text-align:left ">
 
  
 </div></td>
 </tr>
</table>
<script type="text/javascript">
 

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/general_menu_textos.tpl -->

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/mostrar_ficha.tpls -->

<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/cerradas_cupo_online.tpl --> 

function ocultarDiv()
{
	hiddenId('inscripcion_ficha');   
	hiddenId('inscripcion_programa');
	hiddenId('inscripcion_convocatoria');
	hiddenId('inscripcion_info_extra');
	hiddenId('inscripcion_convocatoria_plan');
	hiddenId('inscripcion_convocatoria_docente');
	hiddenId('inscripcion_convocatoria_general');
	hiddenId('inscripcion_convocatoria_requisitos'); 
	hiddenId('inscripcion_convocatoria_afiche'); 
}
ocultarDiv();

mostrarDiv('inscripcion_ficha');
</script>
