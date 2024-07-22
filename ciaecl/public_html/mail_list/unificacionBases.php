<title>Unificacion de bases</title>

<a href='unificacionBases.php?u=e889760b9a85dc871b2052565fd1147c'>Refrescar</a> <br><br>
<?php

include('email_conexion.php');  
 //print_r($listado);
?> 
<form name="main" method="post" action="http://listasciae.uchile.cl/lists/uelt.php"  target="_blank">  
<pre> 
<textarea name="email_agregar" style="height:100px; width:90%">
<?php
	$salida = envioEmail::obtenerCorreosUltimaActualizacion();
	$total = count($salida);
	$con_contenido = false;
	if(is_array($salida) && $total > 0)
	{
		$insert = "";
		$con_contenido = true;
		for($i=0; $i < $total; $i++)
		{
			echo $salida[$i]['email']."\n";
			//$insert .= "Insert into phplist_user_user (  email  , confirmed , blacklisted , optedin , bouncecount , entered , modified , uniqid  , htmlemail ,    password , passwordchanged , disabled  ) VALUE ('".$salida[$i]['email']."',1,0,0,0,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".md5(date('Y-m-d H:i:s').$salida[$i]['email'])."',1,'','".date('Y-m-d')."','0');\n ";	
		} 
	}
?></textarea><br> 
---------------------------
<br>  
<textarea name="email_eliminar" style="height:100px; width:90%"><?php 
	$salida = envioEmail::obtenerListadoInactivos();
	$total = count($salida); 
	for($i=0; $i < $total; $i++)
	{
		if($salida[$i]['email'] == 'envioprueba@ciae.uchile.cl'  || $salida[$i]['email'] == 'informaciones@ciae.uchile.cl'  || $salida[$i]['email'] == 'lista-seminarios@ciae.uchile.cl'  || $salida[$i]['email'] == 'udec@ciae.uchile.cl'  || $salida[$i]['email'] == 'ucv@ciae.uchile.cl'  || $salida[$i]['email'] == 'ucvl@ciae.uchile.cl'  )
		{
			continue;	
		}
		echo $salida[$i]['email']."\n";
		//echo "UPDATE phplist_user_user SET blacklisted = '1' WHERE email = '".$salida[$i]['email']."';\n";
	}
	
	//echo "UPDATE phplist_user_user SET blacklisted = '1' WHERE email LIKE '%@ciae.uchile.cl';\n";
//	echo "UPDATE phplist_user_user SET blacklisted = '1' WHERE email LIKE '%@udec.cl';\n";
//	echo "UPDATE phplist_user_user SET blacklisted = '0' WHERE email = 'envioprueba@ciae.uchile.cl';\n";
//	echo "UPDATE phplist_user_user SET blacklisted = '0' WHERE email = 'informaciones@ciae.uchile.cl';\n"; 
//	echo "UPDATE phplist_user_user SET blacklisted = '0' WHERE email = 'lista-seminarios@ciae.uchile.cl';\n";
//	echo "UPDATE phplist_user_user SET blacklisted = '0' WHERE email = 'udec@ciae.uchile.cl';\n"; 
 	
	
	//echo "SELECT   ll.name, COUNT(lu.listid) as total FROM phplist_list as ll, phplist_listuser as lu , phplist_user_user as uu  WHERE ll.id = lu.listid AND uu.id = lu.userid AND uu.blacklisted = 0 AND  lu.listid > 1 GROUP BY lu.listid  ORDER BY total;\n";
	//echo "SELECT   ll.name,lu.listid, COUNT(lu.listid) as total FROM phplist_list as ll, phplist_listuser as lu , phplist_user_user as uu  WHERE ll.id = lu.listid AND uu.id = lu.userid AND uu.blacklisted = 0 AND  lu.listid > 1 GROUP BY lu.listid HAVING total < 2200 ORDER BY total;";
	echo "\n\n";
 
?></textarea><br> 
	<script>
	<?php
		if($con_contenido)
		{
			echo "document.main.submit();";
		}
	?>
	</script>
</form>
<?php   
$segundos_extras =  0;  
$minutos_extras = 20;  
 

$segundos_extra_js = (($minutos_extras * 60) + $segundos_extras) * 1000 ;
$actual          = mktime(date("H")+1, date("i"), date("s") , date("m")  , date("d"), date("Y"));
$anterior        = mktime(date("H")+1, date("i")+$minutos_extras, date("s") +$segundos_extras, date("m")  , date("d"), date("Y"));
echo "---------------------------<br><br>## ".date("d-m-Y H:i:s", $actual)." <br>## ".date("d-m-Y H:i:s", $anterior)."   (".($segundos_extra_js/1000)." segundos => ".$minutos_extras." minutos => ".$segundos_extra_js.")<br><br>";
?>
<script>
	setTimeout(function(){
   window.location.reload(1);
}, <? echo  $segundos_extra_js;?>);
</script><br><br><br><br><br><br><br>
---------------------------
<?php
	
	echo "DELETE FROM phplist_user_blacklist  ;\n"; 
 	echo "DELETE FROM phplist_user_blacklist_data ;\n"; 
 	echo "REPLACE INTO phplist_user_blacklist_data (email,name, data) SELECT  email , 'reason' as name, 'Eliminado manualmente por rebote por psepulve' as data FROM phplist_user_user where blacklisted = 1;\n"; 
 	echo "REPLACE INTO phplist_user_blacklist (email,added) SELECT  email , '".date('Y-m-d H:i:s')."' as added FROM phplist_user_user where blacklisted = 1;\n"; 
 	
 	echo "SELECT count(email) FROM phplist_user_user where blacklisted = 1;\n"; 
 	echo "SELECT count(email) FROM phplist_user_blacklist  ;\n"; 
 	echo "SELECT count(email) FROM phplist_user_blacklist_data ;\n"; 
	 echo "SELECT count(userid) as total ,  userid FROM phplist_listuser where userid > 4  GROUP by userid having count(userid) > 1 order by userid;\n\n\n\n\n";
	envioEmail::actualizacionFechaRevision();
	echo " <br>DELETE FROM phplist_listuser where userid = xxxx limit 1;<br>";
	?>
</pre>