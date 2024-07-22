<div id="acceso">
	<img src="images/acceso.gif" alt="Acceso al Sistema" />
    
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <form name="fagregartema"  target="_parent" action="sesion.php" method="post" >
			<tr>
              <td scope="col">Usuario:</td>
              <td scope="col"><label>
                <input name="usuario" class="bloque" type="text" id="usuario" size="12" />
              </label></td>
              <td scope="col">&nbsp;</td>
            </tr>
            <tr>
              <td>Clave:</td>
              <td><input name="contrasena" class="bloque" type="password" id="contrasena" size="12" /></td>
              <td><label>
			  <a class="enlace" href="#" onclick="document.forms.fagregartema.submit();return false">
      			<img src="images/bot_ingresar.gif" border="0" alt="ingreso">
    		  </a></label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><img src="images/bot_cancelar.gif" alt="Cancelar" width="69" height="17" border="0" onClick="tb_remove()"/></td>
            </tr>
			</form>
        </table>
      </div>