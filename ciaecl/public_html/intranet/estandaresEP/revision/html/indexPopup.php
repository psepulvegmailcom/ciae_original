<?php			

  	include "../config.cfg";  
    /*lectura de variables del POST*/
    $variablesPost= array('_POST');
    foreach($variablesPost as $i => $varPost)
            if(count($$varPost) > 0 )
                    foreach($$varPost as $var => $value)
                            $$var=$value;

	
	/**************************************************************************************************
						CHEQUEOS PARA LOGIN DEL SISTEMA
	***************************************************************************************************/

	if(!VarConfig::estadoDebug)
		error_reporting(0); /* no muestre los errores en pantalla */
	
	$ControlHtml				= new ControlHtml();	
	$ControlHtml->setPopup();  
	if(count($_POST) == 0)
	{
		$ControlHtml->prepareHtml(trim($_GET['option'])."|",$_GET['id_oferente'],$_GET['caso_revision']);   
	}
	else
	{
	 	$ControlHtml->prepareHtml();
	}  
	$ControlHtml->showIndex(); 
?> 