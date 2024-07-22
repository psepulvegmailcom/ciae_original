<?php

 $url = "https://www.ciae.uchile.cl/imageview.php?image=".$_GET['image'];
   

header("Location: $url");
 die();
 
 
?>