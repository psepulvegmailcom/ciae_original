<pre>
<?php
function obtenerListaArchivos($dir,$p=true,$recursivo=true) 
{
    $d 	= dir($dir);
	$x	= array(); 
    while (false !== ($r = $d->read())) 
	{
        if($r!="." && $r!=".." && (($p==false&&is_dir($dir.$r))||$p==true) && $r != '.svn') 
		{
            $x[$r] = (is_dir($dir.$r)?array():(is_file($dir.$r)?true:false));
        }
    }
    foreach ($x as $key => $value) 
	{
        if (is_dir($dir.$key."/") && $recursivo) 
		{
            $x[$key] = obtenerListaArchivos($dir.$key."/",$p);
        }
    }
    ksort($x);
    return $x;
}
 
function LimpiarDirectorio($archivos,$path)
{ 
	//echo $path.'<br>';
	if(is_array($archivos))
	{	
		//print_r($archivos);
		foreach($archivos as $archivo => $tipo)
		{		  
			if(is_array($tipo)) //es directorio
			{
				$path_archivo = $path.$archivo.'/';
				$nuevo_path = str_replace('public_html/docs/','public_html/docs2dd/',$path_archivo);
				//mkdir($nuevo_path,0755);
				echo "mkdir('".$nuevo_path."');<br>";
				LimpiarDirectorio($tipo,$path_archivo);
			} 
		}
	} 	
}

 
$path = "/home/ciaecl/domains/ciae.uchile.cl/public_html/docs/"  ; 
$nombre_usuario = "apache";
$limite = 555;
// Establecer el usuario 
 
$archivos 	=  obtenerListaArchivos($path) ; 	
//print_r($archivos);
$nuevo_path = str_replace('public_html/docs/','public_html/docs2dd/',$path);
//mkdir($nuevo_path,0755);
//echo "mkdir('".$nuevo_path."');<br>";


  


//LimpiarDirectorio($archivos,$path);   
   

?>
</pre>