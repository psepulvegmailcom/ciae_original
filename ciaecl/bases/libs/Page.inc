<?php
class Page extends HtmlElement {

	var $sourceFile       = "";
	var $htmlElement      = array();
	var $registered       = array();
	var $css              = "";
	var $lastAction       = "";
	var $className        = "Page";
	var $useMenu          = false;
	var $printEditorJs    = false;
	var $body_title		  = '';
	var $body_description = '';
	var $title			  = "";
	var $body_img	 	  = "";
	var $textElement      = ''; 
	
	function Page() {

		global $lastAction;
		$this->lastAction = $lastAction;
		global $_HIDDENVARS;
		$_HIDDENVARS=array();
		global $registered;
		if (is_array(unserialize(rawurldecode($registered)))) {
			$this->registered = unserialize(rawurldecode($registered));
		}
	} 

	function add($element) {
	
		if ($element->className=="LayersMenu") {
			$this->useMenu = true;
			$this->menuObject = $element;
		}

		if ($element->useMenu) {
			$this->useMenu = true;
			$this->menuObject = $element->menuObject;
		}

		array_push($this->htmlElement,$element);
		return($element);
	}	

	function register($name,$value) {
		$this->registered[$name] = $value;
	}

	function unregister($name) {
		unset($this->registered[$name]);
	}

	function isRegistered($name) {
		return(array_key_exists($name,$this->registered));
	}
	
	function getRegister($name) {
		return($this->registered[$name]);
	}
	
	function lastAction($action,$level = 0) {

		$la = strtok($this->lastAction,"|");
		for($i=0;$i<$level;$i++)
			$la=strtok("|");
		if ($action == $la) {
			return(true);
		}
	}

	function setLastAction($action,$level) {
		$theLastActionArray = explode("|",$this->lastAction);

		$theLastActionArray[$level] = $action;
		$this->lastAction=$theLastActionArray[0];
		for($i=1;$i<20;$i++) {
			$element = $theLastActionArray[$i];
			$this->lastAction = $this->lastAction."|".$element;
		}
		echo "<script> document.main.lastAction.value='$this->lastAction'</script>";
	}

	function mygoto($action,$level) {
		$this->setLastAction($action,$level);
		echo "<script> process('$action','$level'); </script>";

	}

	function setTitle($title) {
		$this->title = trim($title);
	}
	
	function setCss($css) {
		$this->css = $css;
	} 
	
	function setUrlRoot($url) {
		$this->url_root = $url;
	}
	
	function setEmail($email) {
		$this->email = $email;
	}

	function setMutex($name,$value) {
		$cookieName = "cookie[$name]";
		if (@setcookie($cookieName,$value)) {
			global $_COOKIE;
			$_COOKIE['cookie'][$name] = $value;
			return(true);
		} else {
			echo "<script languaje=\"javaScript\"> setcookie('$cookieName','$value') </script>\n";
			global $_COOKIE;
			$_COOKIE['cookie'][$name] = $value;
		}	
		return(true);
	}

	function getMutex($name) {
		global $_COOKIE;
		$value = $_COOKIE['cookie'][$name];
		return($value);
	}

	function printMenuHeaders() {
		if ($this->useMenu) {
			$this->menuObject->printHeader();
		}
	}
  
	function setImagenFondo($img) /* para compartir en facebook */
	{
		if(trim($img) != '')
		{
			$this->body_img = $this->url_root.''.$img; 
		}
	}
	
	function setTitleSite($title)
	{ 
		$title = Funciones::cleanHtml($title);
		$title = str_replace(array('"','&amp;',"'"),array('&quot;','&','&#039;'),$title);
		$this->body_title = $title;
	}
	
	function setSitio($sitio,$es_admin,$tipo_dispositivo)
	{
		$this->sitio_actual_admin = $es_admin;
		$this->sitio_actual = $sitio;
		$this->tipo_dispositivo = $tipo_dispositivo;
	}
	
	function setDescriptionSite($description)
	{
		$description = Funciones::cleanHtml($description);
		$description = str_replace(array('"','&amp;',"'"),array('&quot;','&','&#039;'),$description);
		$this->body_description = $description;
	} 

	function showPage($show=true) 
	{		
		if(!$show)
		{
			ob_start();
		}	
		
		global $_COOKIE;
		if (isset($_COOKIE['cookie'])) 
		{
			foreach ($_COOKIE['cookie'] as $name => $value) 
			{
				setcookie("cookie[$name]",$value);
			}
		} 
		
		if(trim($this->body_title) == '')
		{
			$this->body_title = $this->title;
		}
		
		if(trim($this->body_description) == '')
		{
			$this->body_description =	$this->title;
		}

		if(trim($this->body_img) == '')
		{
			$this->body_img =	$this->url_root.'imageview.php?image=banner/equipo_ciae_2017.jpg';
		}		
		 
		$page_header 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'page_header.tpl');
		$page_header->setVariable('page_title',$this->title);
		$page_header->setVariable('page_body_title',$this->body_title);
		$page_header->setVariable('page_body_description',$this->body_description);
		$page_header->setVariable('page_body_img',$this->body_img);		 	
		$page_header->setVariable('page_time',time());
		$page_header->setVariable('page_css',$this->css);
		$page_header->setVariable('page_url_root',$this->url_root);
		$page_header->setVariable('page_url_argv',$_SERVER['argv'][0]); 
		$page_header->setVariable('page_email',$this->email);
		$css_ie7 = str_replace('.css','_ie7.css',$this->css);
		$page_header->setVariable('page_css_ie7',$css_ie7);
		$css_ie6 = str_replace('.css','_ie6.css',$this->css);
		$page_header->setVariable('page_css_ie6',$css_ie6);
		$page_header->setVariable('body_img',$this->body_img);
		$page_header->setVariable('page_lastAction',$this->lastAction);
		$page_header->setVariable('page_registered',rawurlencode(serialize($this->registered)));  

		if($this->sitio_actual_admin)
		{
			$page_header->addTemplate('inclusion_script_admin'); 
		} 
		else
		{
			if($this->tipo_dispositivo != 'desktop')
			{
				$page_header->addTemplate('inclusion_responsivo'); 
			} 
		}
		echo $page_header->toHtml(); 

		if(trim($this->textElement) != '')
		{
			echo $this->textElement;
		}
		/** SE INICIA LA IMPRESION DE LOS COSAS INTERNAS */
		for($i=0;$i<sizeof($this->htmlElement);$i++) 
		{
			echo $this->htmlElement[$i]->toHtml();
		}		  
		
		$page_footer 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'page_footer.tpl');
		$page_footer->setVariable('page_agno',date("Y"));
		 
		$pie =  new miniTemplate(VarSystem::getPathVariables('dir_template_general').'pie/'.VarConfig::sitio_www.'.tpl');
		
		$pie->setVariable('page_url_root', VarConfig::path_site_www_root);
		$pie->setVariable('page_email', VarConfig::site_email);
		$page_footer->setVariable('pie_sitio',$pie->toHtml()); 
		echo $page_footer->toHtml(); 

		if(!$show)
		{
			$output = ob_get_contents();
			ob_end_clean();			
			return $output;
		}			
	}
}
?>
