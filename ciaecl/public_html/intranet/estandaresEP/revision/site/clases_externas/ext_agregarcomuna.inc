<?php
	$FormGeneral 	= new FormGeneral();
	$id_region  	= VarSystem::getVariable('region');	
	$comuna_name  	= VarSystem::getVariable('comuna_name');	
	$comuna_sel		= VarSystem::getVariable('comuna_sel');
 	  
	if(trim($id_region) != '' && $id_region > 0)
	{	   
		echo $FormGeneral->showComunaByRegionOption($comuna_name,$id_region,$comuna_sel); //showComunaByRegion($id_region);
	}
	else
		echo "";
?>