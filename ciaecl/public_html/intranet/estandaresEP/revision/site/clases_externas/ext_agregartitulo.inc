<?
	$e 				= new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/registro/form_registro_titulos.tpl');
	$ControlOferenteInfoTitulos = new ControlOferenteInfoTitulos(); 
	$tipos_titulos 				= $ControlOferenteInfoTitulos->getTipoTitulos(); 

	
	$proximo			= VarSystem::getVariable('proximo'); 
	$proximo_mas			= VarSystem::getVariable('proximo_sgte');  
	$e->setVariable('proximo_div',$proximo_mas);


	$e->addTemplate('bloque_titulo_persona');
	$e->setVariable('id_titulo','-'.$proximo);

	$total_tipo = count($tipos_titulos);
	for($j=0; $j < $total_tipo; $j++)
	{
		$e->addTemplate('bloque_titulo_persona_tipo');
		$e->setVariable('id_titulo',$tipos_titulos[$j]['id_titulo']);
		$e->setVariable('titulo',$tipos_titulos[$j]['titulo']); 
	} 
 

	echo Funciones::cleanHtml($e->toHtml());
?>