<?php			

  	include_once 'config.cfg';   
    /*lectura de variables del POST*/
    $variablesPost= array('_POST');
    foreach($variablesPost as $i => $varPost)
       if(count($$varPost) > 0 )
          foreach($$varPost as $var => $value)
               $$var=$value;

	/************************************************************************************************************
						CHEQUEOS PARA LOGIN DEL SISTEMA
	*************************************************************************************************************/
	
	$indexOutput = '';
	if(!VarConfig::estadoDebug)
	{
		error_reporting(0);  /* NO MUESTRE LOS ERRORES EN PANTALLA */
		Funciones::mostrarArreglo($_POST,false);
		Funciones::mostrarArreglo($_FILES,false); 
	}
	$ControlHtml	= new ControlHtml();	 	
	$needlogin 		= VarSystem::getVariable('needlogin');
	$opcion 		= VarSystem::getVariable('opcion');
		
	if(trim($neddlogin) == '' && trim($opcion) == '')
	{
		echo error_ext_unknow;
	}
	else
	{
		if((bool)$needlogin)
		{
			if((bool)$ControlHtml->theSession->autenticate)
			{
				$show = true;
			}
			else
			{
				$show = false;
			}
		}
		else
		{
			$show = true;
		}
		
			
		if(	$show)
		{
			$contentFrame = new HtmlFile(VarSystem::getPathVariables('dir_clases')."externas/ext_".$opcion.".inc");	
			echo $contentFrame->toHtml();
		}
		else
		{
			echo error_ext_logeo;
		}
	} 
	if(VarConfig::estadoDebug)
	{ 
		echo $indexOutput;
	}	
?>