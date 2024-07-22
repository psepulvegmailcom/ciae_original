<?php
 include ("header.php"); 
 if($_GET["error"]){
   $cod_error=$_GET["error"];
   $url_principal="error.php?error=$cod_error"; 
   }
 else
   $url_principal="temas.php"; 


 if(($_POST["logout"]=="logout")||($_GET["logout"]=="logout")){
	session_destroy();  
	unset($_SESSION["id_usuario"]);
    unset($_SESSION["per_usuario"]);
    unset($_SESSION["nom_usuario"]);
	//echo "apreto cerrar sesion";
 }

 if(($_GET["login"])){
   $etiq_boton = "Cerrar Sesión";
   $url="herramientas.php?id_tema=30";
   $target="_parent";
   //echo "aprieto login";
   
 }else{
   if(isset($_SESSION['id_usuario']) ){
     $etiq_boton = "Cerrar Sesión";
     $url="index.php";
     $target="_parent";
     //echo "no aprieto login, pero todavia hay sesion";
   }else{
     $url="login.php";
     $etiq_boton = "Iniciar Sesión Investigadores";
     $target="fprincipal";
     //echo "no existe sesion";
    }
  }  
 $funcionBusqueda = new rules();
 $tipo = $_GET["tipo_tema"];
 if(! isset($tipo)) $tipo = "0";

 if (isset($_SESSION['id_usuario'])) {
      $usuario = $_SESSION["id_usuario"];
      $perfil =  $_SESSION["per_usuario"];
      $nombre =  $_SESSION["nom_usuario"];
	  $sql = $funcionBusqueda->ListarDiarios($conn, $perfil, $usuario, $tipo);	  
	  	    	 
 }else //usuario publico
    $sql = $funcionBusqueda->ListarDiarios($conn, "0", $usuario, $tipo);
	
 

?>
<meta http-equiv="Refresh" content="0; url=diario.php">
 
