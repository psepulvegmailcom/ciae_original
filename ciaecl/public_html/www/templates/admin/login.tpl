
        <div id="contenido_inter">
<table id="tabla_noborder_admin"  class="tabla_noborder_admin"   style="border:none "   >
<tr>
<td  style="border:none "   width="30%" >&nbsp;</td>
<td  style="border:none "     colspan="2" >&nbsp;</td>
<!--<th colspan="2"><h3>Ingreso Administraci&oacute;n</h3></th>-->

<td  style="border:none "   width="30%">&nbsp;</td>
</tr>
<tr>{error}
<td  style="border:none "  >&nbsp;</td>
<td  style="border:none "   colspan="2">&nbsp;<font color="red" ><strong>{mensaje_login_error}</strong></font></td> 
<td  style="border:none "  >&nbsp;</td>
</tr>
<tr>
<td  style="border:none "  >&nbsp;</td>
<td  style="border:none "  ><strong style="font-size:12px;">Usuario:</strong></td>
<td  style="border:none "  ><input type="text"  name="login_nombre"  style="border: 1px solid #ccc; font-size:12px;  border-radius: 4px;width:200px; height:24px;" maxlength="100"/></td>
<td  style="border:none "  >&nbsp;</td>
</tr>


<tr>
<td  style="border:none "  >&nbsp;</td>
<td  style="border:none "  ><strong style="font-size:12px;">Clave:</strong></td>
<td  style="border:none "  ><input type="password" name="login_clave"   style="border: 1px solid #ccc; font-size:12px;  border-radius: 4px;width:200px;height:24px;" maxlength="100"/></td>
<td  style="border:none "  >&nbsp;</td>
</tr>
<tr>
<td  style="border:none "   colspan="4">&nbsp;</td> 
</tr>
<tr>

<td  style="border:none "  >&nbsp;</td>
<td  style="border:none "   colspan="2"><button type="button" onClick="chequeoPass();"><span><big>Ingresar</big></span></button></td>
<td  style="border:none "  >&nbsp;</td>
</tr>
</table>
</div>

	<br><br><br><br><br><br>

	<input type="hidden" name="login_username" value="" />
	<input type="hidden" name="login_challenge" value="d6dcb1c752ae7a7dcdc59978be2b7113" />
	<input type="hidden" name="login_response"  value="" />	
	<input type="hidden" name="login_password"  value="" />	
	<input type="hidden" name="login_porlogin" value="1" />
	<input type="hidden" name="login_checkcaptcha" value="0" />
	<script type="text/javascript">
	document.main.lastAction.value = '';
	</script>