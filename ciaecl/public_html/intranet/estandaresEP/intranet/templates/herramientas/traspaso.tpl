   <div id="contenido"  >
  <div id="ubica" >
    <ul>
      <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
      <li class="ultimo"><a href="administracion.php" target="_top">Administración</a></li>
      <li class="ultimo">Traspasar estándares</li>
    </ul>
  </div>
  <!-- fin ruta -->
  <div class="clear"></div>
  <h1>Traspasar estándares</h1>
    <p>
	
	<!-- START BLOCK : bloque_hacer_traspaso -->
	Esta opción le permitirá guardar una nueva versión de estándares y traspasarlo al sistema de revisión.<br />
	 <form name="main" target="_self" action="admin_estandares.php"   method="post" enctype="multipart/form-data"> 
	<br />
	Nombre version : <input type="text" name="version_fecha" value="{version_fecha}"><br />(se recominenda mantener la fecha para el orden de las versiones)<br>
	<div style=" padding-left:190px">	 <input  type="button" onclick="javascript:enviar();" name="Hacer traspaso"	 value="Hacer traspaso"	 /></div>
	<input type="hidden" name="accion" value="traspaso" />
 
   </form>
   
	<!-- END BLOCK : bloque_hacer_traspaso -->
	<!-- START BLOCK : bloque_traspaso -->
	La nueva versión <strong>{version}</strong> fue creada exitosamente en el sistema de revisión de los estándares.
	<!-- END BLOCK : bloque_traspaso -->
	 </p>
   <script>
   function enviar()
   {
   		if(confirm('¡Esta seguro de hacer el traspaso?'))
		{
			document.main.submit();
		}
   }
   </script>
   

  <p>&nbsp;</p>