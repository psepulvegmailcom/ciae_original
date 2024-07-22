
<!-- INCLUDE BLOCK : templates/ubicacion.tpl -->
 <form name="main" target="_self" action="admin_ep_dominio.php" method="post">  
<div class="conte"  style="	vertical-align:top" >
	<div style="text-align:right;">
	<a href="#" onclick="document.forms.main.submit();return false">
	<img  title="Crear nuevo documento"  src="images/interior/icochico_doc2.gif" alt="nuevo"  height="50" border="0" id="Image2"   /></a> 
	</div> 
	<table align="center" cellspacing="0" class="dato" style="	vertical-align:top" >
     <tbody>
		<tr><th style="width:80%">Dominio</th><th>Versión</th></tr> 
	</tbody>
	<!-- START BLOCK : bloque_listado -->
	<tr><td>{dominio}</td><td>{version}</td></tr> 
	<!-- END BLOCK : bloque_listado -->
	</table>
</div>
<input type="hidden" name="accion"  />
<input type="hidden" name="id_version"  value="{id_version}"/>
</form>