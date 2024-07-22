<?php

 include ("include.php");
 global $conn;
// if($_POST["BTIngresar"]=="Ingresar"){
   $funcionBusqueda = new rules();
   $usu=$_POST["usuario"];
   $pass=$_POST["contrasena"];
   $url = $funcionBusqueda->BuscarUsuario($conn, $usu, $pass);
   header("Location:$url");
// } 
?>
