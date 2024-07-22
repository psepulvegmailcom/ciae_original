
 <!-- INCLUDE BLOCK : www/templates/general/page_header.tpl -->
<br />
<div style="text-align:center; padding-top:250px; padding-bottom:50px;  ">
<big><strong> {mensaje_extra}</strong><br /><br />
Esta p&aacute;gina se redireccionar&aacute; en 5 segundos a la p&aacute;gina principal.</big>
 </div>
 
<input type="hidden" name="registered" value="a%3A0%3A%7B%7D">
<input type="hidden" name="langSite" value="es" />
<input type="hidden" name="nameSite" value="{sitio}" />
<input type="hidden" name="lastAction" value="logout">
</form>
<script type="text/javascript">
function cerrarSesion()
{
	window.location = "{page_url_index}?page=logout";
}
setTimeout("cerrarSesion();",5000);
</script> 
 <!-- INCLUDE BLOCK : www/templates/general/page_footer.tpl -->