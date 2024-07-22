<?php

$cs = $_GET['cs'];
$ps = $_GET['ps'];
if(trim($ps) != '')
{
	$ps = 'view_postulacion_'.$ps;
}
else
{
	$ps = 'home';
}
if(trim($cs) != '')
{
?>
 <meta HTTP-EQUIV="REFRESH" content="0; url=http://www.ciae.uchile.cl/index.php?page=<? echo $ps;?>&guardar=cartas&cs=<?php echo $cs;?>&ps=<?php echo $_GET['ps'];?>">
<?
}
else
{
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=http://www.ciae.uchile.cl/index.php?page=<? echo $ps;?>">
<?
}?>