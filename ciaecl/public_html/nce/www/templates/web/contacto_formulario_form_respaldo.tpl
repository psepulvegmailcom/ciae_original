
<!-- START BLOCK : bloque_mensaje_enviado -->
<p><strong>{langSite_contacto_mensaje_enviado}</strong></p>
<!-- END BLOCK : bloque_mensaje_enviado -->
<lable>{langSite_general_nombre}</label><br />
<input type="text" name="nombre" maxlength="255" class="search_box"  style="width:90% "><br />
<lable>{langSite_general_email}</label><br />
<input type="text" name="email" maxlength="255" class="search_box"  style="width:90% "><br />
<br /><lable>{langSite_general_mensaje}</label><br />
<textarea name='mensaje' class="search_box"  style="width:90%; height:80px "></textarea><br />
<br />
<br /> 
<input type="hidden" name='caso' value="guardar">
<input type="button" onclick="javascript:EnviarFormulario()" name="Enviar" value="{langSite_contact_enviar_simple}" >



<br />

 