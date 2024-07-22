<?php
 session_start();
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
	//echo "aprieto cerrar sesion";
 }

 if(($_GET["login"])){
   $etiq_boton = "Cerrar Sesión";
   $url="index.php";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración de Documentos</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="800" border="0" align="center">
  <tr>
    <th height="29" colspan="2" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="365" height="29" scope="col"><div align="left" class="titulos">Publicaci&oacute;n de Documentos</div></th>
    <td width="366" class="texto_libre" scope="col"><div align="right">
      <?php if(isset($_SESSION["nom_usuario"])) echo "Usuario Conectado: ".$_SESSION["nom_usuario"]; ?>
    </div>    </td>
  </tr>
  
  <tr>
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td width="18%" scope="col"><div align="center"><a href="temas.php" class="texto_libre" target="fprincipal">Areas Tem&aacute;ticas </a></div></td>
        <th width="3%" scope="col">&nbsp;</th>
        <td width="25%" scope="col"><div align="center"><a href="busqueda_archivos.php" class="texto_libre" target="fprincipal">B&uacute;squeda de Documentos</a></div></td>
        <th width="4%" scope="col">&nbsp;</th>
        <?php
		if(($_SESSION["per_usuario"]=="0")||($_SESSION["per_usuario"]=="1")||($_SESSION["per_usuario"]=="2")){
		?>
        <td width="19%" scope="col"><div align="center"><a href="usuarios.php?BTUsuarios=Usuarios" class="texto_libre" target="fprincipal">
          <?php if($_SESSION["per_usuario"]=="1") echo "Cuentas de Usuario"; else echo "Mi Cuenta";?>
        </a></div></td>
        <?php
		}
		?>
        <th width="3%" scope="col">&nbsp;</th>
        <td width="23%" scope="col"><div align="center"><a href="<?php echo $url."?logout=logout";?>" class="texto_libre" target="<?php echo $target; ?>"><?php echo $etiq_boton; ?></a></div></td>
        <th width="5%" scope="col">&nbsp;</th>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <th height="600" colspan="2" scope="col"><iframe align="middle" frameborder="0" name="fprincipal" scrolling="auto" src="<?php echo $url_principal; ?>" width="100%" height="100%"></iframe></th>
  </tr>
</table>
</body>
</html>
