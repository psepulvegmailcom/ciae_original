<?php

	include ("config.cfg");


	error_reporting(E_ERROR | E_WARNING | E_PARSE);


	$ControlHtml		= new ControlHtml();
	$ControlHtml->checkIPBlock();
	$valores = VarSystem::getGet();


	 
	if(isset($valores['externo']) && trim($valores['externo']) != '')
	{
		$LogsImagenVisitas = new LogsImagenVisitas();
		$LogsImagenVisitas->tipo_visita = $valores['externo'];
		//$LogsImagenVisitas->agregarVisita();

		$aux = explode("_",$LogsImagenVisitas->tipo_visita);
		if(array_shift($aux) == 'vistas') // contabilizacion de visitas de envio de correos
		{
			$ControladorNoticiasVisitas = new ControladorNoticiasVisitas();
			//$ControladorNoticiasVisitas->registrarVisitaNoticias('0',$valores['externo']);
		}
	}
     

	$tipo = trim($valores['tipo']);
	if(trim($tipo) == '')
	{
		$tipo = 'image';
	}

	$imagedir = VarSystem::getPathVariables('dir_repositorio').$tipo."/";

	if(trim($valores['image']) == '')
	{
		$valores['image'] = $valores['file'];
	}

	$filename_ini 		= $valores['image'];
	$texto		 		= $valores['texto'];


	$image = _clean_input_keys($filename_ini);
	$filename = $imagedir.$image;

	if ($filename == '')
	{
		echo "No hay imagen que mostrar";
		exit;
	}

	if (FALSE === strpos($filename, '.'))
	{
		echo "La imagen no se encuentra";
		exit;
	}

	if(!file_exists($filename))
	{
		$filename = $imagedir.'space.gif';

	}
//echo $filename;
	printImage($filename,$texto);


	function printImage($image_path,$texto='')
	{
	 	header("Pragma: public");
	    header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Cache-Control: no-store, no-cache, must-revalidate");
	    header("Cache-Control: private");
	    header("Content-Transfer-Encoding: binary");
	    header("Content-type: image/jpeg");

		// Load image
		$img = null;
		$ext = strtolower(end(explode('.', $image_path)));
		$image_path = htmlentities($image_path);
		if ($ext == 'jpg' || $ext == 'jpeg')
		{
			$img = @imagecreatefromjpeg($image_path);
		}
		else if ($ext == 'png')
		{
			$img = @imagecreatefrompng($image_path);
		}
		else if ($ext == 'gif')
		{
			$img = @imagecreatefromgif($image_path);
		}
		$imagen_ancho 	= imagesx($img);
		$imagen_alto 	= imagesy($img);

		$maximo = 800;

		if($imagen_ancho > $maximo || $imagen_alto > $maximo)
		{
			/* se modifica */
			$miniatura_ancho_maximo = $maximo;
			$miniatura_alto_maximo 	= $maximo;
			$miniatura_ancho 		= $maximo;
			$miniatura_alto 		= $maximo;

			$proporcion_imagen 		= $imagen_ancho / $imagen_alto;
			$proporcion_miniatura 	= $miniatura_ancho_maximo / $miniatura_alto_maximo;

			//$proporcion_imagen 		= $imagen_alto / $imagen_ancho;
//			$proporcion_miniatura 	= $miniatura_alto_maximo / $miniatura_ancho_maximo;

			if ( $proporcion_imagen > $proporcion_miniatura ){
				$miniatura_ancho = $miniatura_alto_maximo * $proporcion_imagen;
				$miniatura_alto = $miniatura_alto_maximo;
			} else if ( $proporcion_imagen < $proporcion_miniatura ){
				$miniatura_ancho = $miniatura_ancho_maximo;
				$miniatura_alto = $miniatura_ancho_maximo / $proporcion_imagen;
			} else {
				$miniatura_ancho = $miniatura_ancho_maximo;
				$miniatura_alto = $miniatura_alto_maximo;
			}

			$lienzo = @imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );
			@imagecopyresampled($lienzo, $img, 0, 0, 0, 0, $miniatura_ancho, $miniatura_alto, $imagen_ancho, $imagen_alto);
		}
		else
		{
			$lienzo = $img;
		}

		if($imagen_ancho > 1800)
		{
			//$texto .= $image_path.' -- '.$imagen_ancho.' --- '.$imagen_alto;
			/* se guarda una nueva versión de la imagen con tamaño menor */
	    	@imagejpeg($lienzo,$image_path);
		}

		if(trim($texto) != '')
		{
			$texto 		= html_entity_decode($texto);
			$texto 		= str_replace(array('<br />'),array(''),$texto);
			$im 		= imagecreatetruecolor(400, 30);
			$blanco 	= imagecolorallocate($im, 255, 255, 255);
			$tamano 	= 8;
			$y_texto 	= floor($miniatura_alto - $tamano*3.5);
			$x_texto 	= floor($miniatura_ancho - strlen($texto)*$tamano*1.4);
			imagestring($lienzo,$tamano,$x_texto,$y_texto,$texto,$blanco);
		}
	    imagejpeg($lienzo);
	    imagedestroy($img);
	    imagedestroy($lienzo);
	}

	function stripslashes2($string)
	{
	   $string = str_replace("\\\"", "\"", $string);
	   $string = str_replace("\\'", "'", $string);
	   $string = str_replace("\\\\", "\\", $string);
	   return $string;
	}

	function _clean_input_keys($str)
	{
		$str = trim($str);
		$str = stripslashes($str);
		$str = stripslashes2($str);
		$str = preg_replace('/\s\s+/', ' ', $str);
		$str1 = str_replace('./', '', $str);
		$str2 = str_replace('..', '', $str1);
		if ( ! get_magic_quotes_gpc())
		{
		   return addslashes($str2);
		}
		return $str2;
	}
?>
