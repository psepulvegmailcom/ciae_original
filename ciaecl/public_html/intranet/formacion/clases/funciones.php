<?php
function GeneralImprimirHeader($menu='')
{
	$e  = new miniTemplate('templates/body.tpl'); 
	$e->setVariable('nombre_usuario',$_SESSION["nom_usuario"]);
	$e->setVariable('fecha',date("d-m-Y H:i:s"));
	if(trim($menu) != '')
	{
		$e->addTemplate($menu);
	}
	echo $e->toHtml(); 
}


function GeneralImprimirFooter()
{
	$e  = new miniTemplate('templates/footer.tpl');  
	echo $e->toHtml(); 
}
?>