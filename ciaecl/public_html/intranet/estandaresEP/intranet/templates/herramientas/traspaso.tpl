   <div id="contenido"  >
  <div id="ubica" >
    <ul>
      <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
      <li class="ultimo"><a href="administracion.php" target="_top">Administraci�n</a></li>
      <li class="ultimo">Traspasar est�ndares</li>
    </ul>
  </div>
  <!-- fin ruta -->
  <div class="clear"></div>
  <h1>Traspasar est�ndares</h1>
    <p>
	
	<!-- START BLOCK : bloque_hacer_traspaso -->
	Esta opci�n le permitir� guardar una nueva versi�n de est�ndares y traspasarlo al sistema de revisi�n.<br />
	 <form name="main" target="_self" action="admin_estandares.php"   method="post" enctype="multipart/form-data"> 
	<br />
	Nombre version : <input type="text" name="version_fecha" value="{version_fecha}"><br />(se recominenda mantener la fecha para el orden de las versiones)<br>
	<div style=" padding-left:190px">	 <input  type="button" onclick="javascript:enviar();" name="Hacer traspaso"	 value="Hacer traspaso"	 /></div>
	<input type="hidden" name="accion" value="traspaso" />
 
   </form>
   
	<!-- END BLOCK : bloque_hacer_traspaso -->
	<!-- START BLOCK : bloque_traspaso -->
	La nueva versi�n <strong>{version}</strong> fue creada exitosamente en el sistema de revisi�n de los est�ndares.
	<!-- END BLOCK : bloque_traspaso -->
	 </p>
   <script>
   function enviar()
   {
   		if(confirm('�Esta seguro de hacer el traspaso?'))
		{
			document.main.submit();
		}
   }
   </script>
   

  <p>&nbsp;</p>