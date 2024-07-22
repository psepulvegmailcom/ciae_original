<?php

$cs = $_GET['cs'];
if(trim($cs) != '')
{
?>
 <meta HTTP-EQUIV="REFRESH" content="0; url=http://www.ciae.uchile.cl/index.php?page=view_postulacion_201511_postdoctorado&guardar=cartas&cs=<?php echo $cs;?>">
<?
}
else
{
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=http://www.ciae.uchile.cl/index.php?page=view_postulacion_201511_postdoctorado">
<?
}?>