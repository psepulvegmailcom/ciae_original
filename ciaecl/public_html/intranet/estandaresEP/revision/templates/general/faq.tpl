<div style="float:right">	<a href="javascript:process('home',0)" >&lt;&lt; Volver</a></div><br /><br />

 <!-- START BLOCK : lista_item_FAQ_seleccionada -->
<li class="lista_principal"><strong><!--{faq_orden}.- -->{faq_selected}</strong></li>
 
<div style='margin: 5px 0 0 25px; text-align:justify'>{respuesta_selected}</div> 
<script>
document.location.href = '#top';
</script>
 <!-- END BLOCK : lista_item_FAQ_seleccionada -->

 <!-- START BLOCK : lista_item_FAQ_no_seleccionada -->
 
<li class="lista_principal">
								<a href="#faq_aspec" title="Aspectos Generales" >Aspectos Generales</a></li>
								<li  class="lista_principal">
								<a href="#faq_regis" title="Registro ATE" >Registro ATE</a></li>
								<li  class="lista_principal">
								<a href="#faq_contr" title="Contratación de una ATE" >Contratación de una ATE</a></li>
								<li  class="lista_principal">
								<a href="#faq_inscr" title="Inscripción y encuesta de satisfacción de usuarios con servicios ATE" >Inscripción y encuesta de satisfacción de usuarios con servicios ATE</a></li>

 <!-- END BLOCK : lista_item_FAQ_no_seleccionada -->

<div style="border-bottom:1px dotted #333333; width:100%; text-align:center; margin:15px 0px 15px 0px;">&nbsp;</div>

<!-- START BLOCK : lista_item_FAQ_tema -->
<a name="faq_{tema_prefijo}"></a>
<h3>{tema}</h3>
<ul>
<!-- START BLOCK : lista_item_FAQ -->		
<li class="lista_principal"><a  href="javascript:ate_view_faq({id_faq});"><!--{faq_orden}.- -->{faq}</a></li> 
<!-- END BLOCK : lista_item_FAQ -->
</ul>
<br>
<a href="#top" >Subir</a> <br>
<!-- END BLOCK : lista_item_FAQ_tema -->

		