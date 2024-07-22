<!-- START BLOCK : vista_simple --> 
document.getElementById('info_tipo_oferente_{id_oferente}').innerHTML = document.getElementById('info_tipo_oferente_{id_oferente}').innerHTML  + '<center><a  title="Cambiar Tipo Postulaci&oacute;n" href="javascript:ate_cambiarTipoOferenteVista({id_oferente});"><img src="images/iconos/cambiar.png" border=0></a> </center>'; 
<!-- END BLOCK : vista_simple -->
 


<!-- START BLOCK : revision_vista_select -->
quitarCargandoImagen('info_tipo_oferente_{id_oferente}');
document.getElementById('info_tipo_oferente_{id_oferente}').innerHTML = '
<select name="cambio_tipo_{id_oferente}"  id="cambio_tipo_{id_oferente}" >' + 
<!-- START BLOCK : revision_vista_select_option -->
'<option value="{id_tipo}"  {selected} 
onClick="javascript:ate_cambiarTipoOferenteCambio({id_oferente},'+ "'{id_tipo_original}','{tipo_original}','{id_tipo}','{tipo_texto}');"+ '">{tipo_texto}</option>' +
<!-- END BLOCK : revision_vista_select_option -->
+ '</select>';
<!-- END BLOCK : revision_vista_select -->
