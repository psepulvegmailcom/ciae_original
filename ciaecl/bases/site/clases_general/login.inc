<? 
	global $ControlHtml;  	 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'general/version_login.tpl');   
	echo $e->toHtml();  
?>	