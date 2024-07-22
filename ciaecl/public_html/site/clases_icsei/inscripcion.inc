<?php 

	$e 		 = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'inscripcion.tpl'); 
 	$valores = VarSystem::getPost();
 	$valoresGet = VarSystem::getGet();
 	$conPost = true;
 	Funciones::mostrarArreglo($valores,false); 
 	if(count($valores) == 0)
 	{
 		$valores = VarSystem::getGet();
 		$conPost = false;
 	}  
 	

	$ControlPais = new ControlPais();
 	$pais = $ControlPais->getPaises();
	 
	  	
 	$maximo_autores = 15;
 	for($j=1; $j < $maximo_autores;$j++)
 	{
		$e->addTemplate('bloque_envio_autores');
		$e->setVariable('numero_autor',$j);
		$aux = $j + 1;	
		$e->setVariable('numero_autor_siguiente',$aux);	
		$aux = $j - 1;	
		$e->setVariable('numero_autor_anterior',$aux);	
		
	 	for($i=0; $i < count($pais); $i++)
	 	{
	 		$e->addTemplate('bloque_inscripcion_pais');
	 		$e->setVariable('valor',$pais[$i]['pais_id']); 
	 		$e->setVariable('texto',ucwords(strtolower($pais[$i]['pais_en'])));  
	 	} 		
	}
 	
 	
	echo $e->toHtml();
?>