<?
 
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
Muchas gracias por contactarse con nosotros. En el siguiente <a href='https://drive.google.com/open?id=0B3bcdl0DdH0GV1hmVkRMWEZ6M0U'> enlace </a> podr� encontrar informaci�n relativa a la bater�a TADI y los servicios asociados a ella. <br> 
Lamentablemente, en este momento se dispone de un stock limitado de bater�as TADI para la venta, pero si gusta, puede seguir el siguiente <a href='https://docs.google.com/a/ciae.uchile.cl/forms/d/1uGWxTmX1S-w6s5OVPmVvuEL5M2bGcuTVhNYkyfsAbvY/viewform'> enlace </a> y completar un formulario con los datos necesarios para la facturaci�n, y de este modo ingresar a la lista de espera. Tenga en consideraci�n que la factura es con la informaci�n de la persona natural o jur�dica que est� realizando la compra. Posteriormente, se le enviar� una cotizaci�n a la fecha y los pasos a seguir dependiendo de la disponibilidad del stock.<br><br>

Le saluda cordialmente,
<br><br>
Equipo TADI<br>
TADI Test de Aprendizaje y Desarrollo Infantil<br>
Centro de Investigaci�n Avanzada en Educaci�n<br>
Universidad de Chile <br>
<br> www.tadi.cl<br> contacto@tadi.cl";
		
 		Funciones::sendEmail($PedidosTadi->email,"Ingreso n� ".$PedidosTadi->id." - Test TADI - CIAE - Universidad de Chile", $texto_email ); 
 		Funciones::sendEmail('contacto@tadi.cl',"Ingreso n� ".$PedidosTadi->id." - Test TADI - CIAE - Universidad de Chile", $texto_email ); 
	}
	
	echo $e->toHtml();
?>