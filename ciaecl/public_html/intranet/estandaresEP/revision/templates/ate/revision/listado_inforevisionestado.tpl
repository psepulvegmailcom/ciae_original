<!-- START BLOCK : enrevision_vista_simple --> 
document.getElementById('info_estado_oferente_{id_oferente}').innerHTML = document.getElementById('info_estado_oferente_{id_oferente}').innerHTML  + '<center><a  title="Cambiar Estado Postulaci&oacute;n" href="javascript:ate_cambiarEstadoOferenteVista({id_oferente});"><img src="images/iconos/cambiar.png" border=0></a> </center>'; 
<!-- END BLOCK : enrevision_vista_simple -->
 


<!-- START BLOCK : revision_vista_estado_select -->
quitarCargandoImagen('info_estado_oferente_{id_oferente}');
document.getElementById('info_estado_oferente_{id_oferente}').innerHTML = '
<select name="revision_cambio_estado_{id_oferente}"  id="revision_cambio_estado_{id_oferente}" >' + 
<!-- START BLOCK : revision_vista_estado_select_option -->
'<option value="{id_estado}"  {selected} 
onClick="javascript:ate_cambiarEstadoOferenteCambio({id_oferente},'+ "'{id_estado_original}','{estado_original_texto}','{id_estado}','{estado_texto}');"+ '">{estado_texto}</option>' +
<!-- END BLOCK : revision_vista_estado_select_option -->
+ '</select>';
<!-- END BLOCK : revision_vista_estado_select -->
