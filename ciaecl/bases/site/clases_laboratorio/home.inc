<? 
	global $ControlHtml;  	 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_home.tpl'); 
	
	 
	echo $e->toHtml();
?>	