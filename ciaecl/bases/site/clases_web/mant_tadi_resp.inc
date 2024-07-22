<?php
 
	global $ControlHtml; 
	$valores = VarSystem::getPost(); 
	if(count($valores) == 0)
	{	
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'textos_externos/redirigir_tadi_nulo.tpl');
	}
	else
	{
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'textos_externos/redirigir_tadi.tpl');
	    $PedidosTadi = new PedidosTadi();
		foreach($valores as $var => $val)
		{ 
			if($var == 'enviar')
			{
				continue;
			}
			$PedidosTadi->$var = $val;
			//echo $var.' '.$val.'<br>';   
			//echo '<br>';
		}
		$PedidosTadi->fecha = date("Y-m-d");
		$PedidosTadi->guardarObjeto();
		//print_r($PedidosTadi);
			
		 
		//print_r($valores);
		
		$texto_email = "Estimado/a cliente:<br><br>
Muchas gracias por contactarse con nosotros. En el siguiente <a href='https://drive.google.com/open?id=0B3bcdl0DdH0GV1hmVkRMWEZ6M0U'> enlace </a> podr&aacute; encontrar informaci&oacute;n relativa a la bater&iacute;a TADI y los servicios asociados a ella. <br> 
Lamentablemente, en este momento se dispone de un stock limitado de bater&iacute;as TADI para la venta, pero si gusta, puede seguir el siguiente <a href='https://docs.google.com/a/ciae.uchile.cl/forms/d/1uGWxTmX1S-w6s5OVPmVvuEL5M2bGcuTVhNYkyfsAbvY/viewform'> enlace </a> y completar un formulario con los datos necesarios para la facturaci&oacute;n, y de este modo ingresar a la lista de espera. Tenga en consideraci&oacute;n que la factura es con la informaci&oacute;n de la persona natural o jur&iacute;dica que est&aacute; realizando la compra. Posteriormente, se le enviar&aacute; una cotizaci&oacute;n a la fecha y los pasos a seguir dependiendo de la disponibilidad del stock.<br><br>

Le saluda cordialmente,
<br><br>
Equipo TADI<br>
TADI Test de Aprendizaje y Desarrollo Infantil<br>
Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n<br>
Universidad de Chile <br>
<br> www.tadi.cl<br> contacto@tadi.cl";
		
 		Funciones::sendEmail($PedidosTadi->email,"Ingreso n ".$PedidosTadi->id." - Test TADI - CIAE - Universidad de Chile", $texto_email ); 
 		Funciones::sendEmail('contacto@tadi.cl',"Ingreso n ".$PedidosTadi->id." - Test TADI - CIAE - Universidad de Chile", $texto_email ); 
	}
	
	echo $e->toHtml();
?>