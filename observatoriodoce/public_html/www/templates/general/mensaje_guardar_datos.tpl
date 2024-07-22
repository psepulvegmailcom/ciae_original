
<div   id='save_mensaje'   style=" right:0px; padding:15px; "  >				
	<div  id='save_mensaje_interno' style="font-weight:normal; right:120px; vertical-align:middle" class="mensaje_{caso_mensaje}" >
	<img src='cea/images/iconos/mensaje_{caso_mensaje}.gif' id='save_mensaje_img'  />
		<strong>{mensaje_texto}</strong> <br /><br />
		<!-- START BLOCK : mensaje_mensaje_body_error -->
		<small>Por favor int&eacute;ntelo nuevamente. 
		<br />Si el problema persiste comun&iacute;quese con la administraci&oacute;n del sistema, <br />Disculpe las molestias</small>
		<!-- END BLOCK : mensaje_mensaje_body_error -->
	</div>
</div> 
			<!-- START BLOCK : mensaje_mensaje_body_cerrar -->
			<script type="text/javascript">
				setTimeout("hiddenId('save_mensaje_interno')",13000);
				setTimeout("hiddenId('save_mensaje_img')",13000);
				setTimeout("hiddenId('save_mensaje')",13000);
			</script> 
			<!-- END BLOCK : mensaje_mensaje_body_cerrar -->