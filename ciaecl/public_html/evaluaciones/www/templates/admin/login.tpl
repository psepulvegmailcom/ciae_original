
<!-- <div class="titulo_inter">           </div> -->
       <div id="contenido_inter">
<table id="tabla_noborder_admin"  class="tabla_noborder_admin"     >
<tr>
<td width="30%">&nbsp;</td>
<th colspan="2"><h3>Ingreso </h3></th>

<td width="30%">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td colspan="2">&nbsp;<font color="red" ><strong>{error}</strong></font></td> 
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>Usuario:</td>
<td><input type="text"  name="login_nombre" ></td>
<td>&nbsp;</td>
</tr>


<tr>
<td>&nbsp;</td>
<td>Clave:</td>
<td><input type="password" name="login_clave" ></td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td> 
</tr>
<tr>

<td>&nbsp;</td>
<td colspan="2"><button type="button" onClick="chequeoPass();"><span><big>Ingresar</big></span></button></td>
<td>&nbsp;</td>
</tr>
 
</table>  
<div style="padding-top:30px;" >
{informacion_extra}
</div>
</div>


	<input type="hidden" name="login_username" value="">
	<input type="hidden" name="login_challenge" value="d6dcb1c752ae7a7dcdc59978be2b7113">
	<input type="hidden" name="login_response"  value="">	
	<input type="hidden" name="login_password"  value="">	
	<input type="hidden" name="login_porlogin" value="1">
	<input type="hidden" name="login_checkcaptcha" value="0">
	<script>
	document.main.lastAction.value = '';
	</script>
   