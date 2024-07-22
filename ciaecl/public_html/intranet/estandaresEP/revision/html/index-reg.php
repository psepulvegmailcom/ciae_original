<?php			

  	include "../config.cfg";  
        /*lectura de variables del POST*/
        $variablesPost= array('_POST');
        foreach($variablesPost as $i => $varPost)
                if(count($$varPost) > 0 )
                        foreach($$varPost as $var => $value)
                                $$var=$value;

	 
	/************************************************************************************************************
						CHEQUEOS PARA LOGIN DEL SISTEMA
	*************************************************************************************************************/
  
  	
  
	$ControlHtml				= new ControlHtml();
	$ControlHtml->prepareHtml();
	$ControlHtml->showIndex();
	
	
?>
