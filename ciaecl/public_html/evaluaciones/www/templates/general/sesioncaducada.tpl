
 <!-- INCLUDE BLOCK : www/templates/general/page_header.tpl -->
<br>
<div style="text-align:center; padding-top:250px; padding-bottom:50px; color:#FFFFFF;">
<big><strong> {mensaje_extra}</strong><br /><br />
Esta página se redireccionará en 5 segundos a la página principal.</big>
 </div>
 
<input type="hidden" name="registered" value="a%3A0%3A%7B%7D">
<input type="hidden" name="langSite" value="es" />
<input type="hidden" name="nameSite" value="ciie2010_admin" />
<input type="hidden" name="lastAction" value="logout">
</form>
<script>
function cerrarSesion()
{
window.location = "admin.php?page=logout";
}
setTimeout("cerrarSesion();",5000);
</script> 
 <!-- INCLUDE BLOCK : www/templates/general/page_footer.tpl -->