<?php			

  	include "../config.cfg";  
        /*lectura de variables del POST*/
        $variablesPost= array('_POST');
        foreach($variablesPost as $i => $varPost)
                if(count($$varPost) > 0 )
                        foreach($$varPost as $var => $value)
                                $$var=$value;

	 
	/*****************************************************************************************
						CHEQUEOS PARA LOGIN DEL SISTEMA
	******************************************************************************************/ 
  
  	$GET 	= VarSystem::getGet();
	$POST 	= VarSystem::getPost(); 
	$indexOutput = '';		
  
	$ControlHtml				= new ControlHtml();
	$ControlHtml->prepareHtml(); 
	$ControlHtml->showIndex(); 
	
	if(VarConfig::estadoDebug)
	{
		Funciones::mostrarArreglo($POST); 
		Funciones::mostrarArreglo($GET); 
		Funciones::mostrarArreglo($_SESSION);
		global $indexOutput;
		echo $indexOutput;  
	}
	else
	{ 
		error_reporting(0);
	}	
?>