<!-- START BLOCK : enrevision_vista_simple -->
document.getElementById('info_oferente_porrevisar_{id_oferente}').innerHTML = '<center><a  title="Cambiar Usuario Revisor" href="javascript:ate_cambiarOferenteRevisorVista({id_oferente});"><img src="images/iconos/cambiar.png" border=0></a> </center>'; 
<!-- END BLOCK : enrevision_vista_simple -->

<!-- START BLOCK : enrevision_vista_revisor_select -->
quitarCargandoImagen('info_oferente_porrevisar_{id_oferente}');
document.getElementById('info_oferente_{id_oferente}').innerHTML = '
<select name="revision_cambio_revisor_{id_oferente}"  id="revision_cambio_revisor_{id_oferente}" >' + 
<!-- START BLOCK : enrevision_vista_revisor_select_option -->
'<option value="{revisor}"  {selected} onClick="javascript:ate_cambiarOferenteRevisorCambio({id_oferente},'+ "'{revisor_original}','{revisor}');"+ '">{revisor}</option>' +
<!-- END BLOCK : enrevision_vista_revisor_select_option -->
+ '</select>';
<!-- END BLOCK : enrevision_vista_revisor_select -->

 
