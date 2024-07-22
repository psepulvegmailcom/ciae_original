
<!-- START BLOCK : bloque_mensaje_enviado -->
<p><strong>{langSite_contacto_mensaje_enviado}</strong></p>
<!-- END BLOCK : bloque_mensaje_enviado -->
<lable>{langSite_general_nombre}</label><br />
<input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="Ingrese su nombre completo"><br />
<lable>{langSite_general_email}</label><br />
<input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese su email"><br />
<br /><lable>{langSite_general_mensaje}</label><br />
<textarea name='mensaje' class="form-control" rows="5"></textarea><br />
<br />
<br /> 
<input type="hidden" name='caso' value="guardar">
<input type="button" onclick="javascript:EnviarFormulario()" name="Enviar" class="btn btn-primary" value="{langSite_contact_enviar_simple}" >
 

<br />

 