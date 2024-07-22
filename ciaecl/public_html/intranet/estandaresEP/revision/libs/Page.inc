<?
class Page extends HtmlElement {

	var $sourceFile       = "";
	var $htmlElement      = array();
	var $registered       = array();
	var $css              = "";
	var $lastAction       = "";
	var $className        = "Page";
	var $useMenu          = false;
	var $printEditorJs    = false;
	var $title			  = "";
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

	function goto($action,$level) {
		$this->setLastAction($action,$level);
		echo "<script> process('$action','$level'); </script>";

	}

	function setTitle($title) {
		$this->title = $title;
	}
	
	function setCss($css) {
		$this->css = $css;
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
  
	function showPage($show=true) {
	
		
		if(!$show)
		{
			ob_start();
		}
		
		
		global $_COOKIE;
		if (isset($_COOKIE['cookie'])) {
			foreach ($_COOKIE['cookie'] as $name => $value) {
				setcookie("cookie[$name]",$value);
			}
		}


			/*echo "<meta http-equiv=\"Content-type\" content=\"text/html;charset=iso-8859-1\" />\n";		
		echo "<meta name=\"Keywords\" content=\"key, words\"/>	\n";	
		echo "<meta name=\"Distribution\" content=\"Global\"/>\n";	
		echo "<meta name=\"Robots\" content=\"index,follow\"/>\n";	
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>$this->title</title>\n";		
		echo "<link rel=\"shortcut icon\" href=\"images/favicon.ico\" />\n";		
	echo "<script languaje=\"javascript\">\n";
		echo "  function clearcookies() {\n";
		if (isset($_COOKIE['cookie'])) {
			foreach ($_COOKIE['cookie'] as $name => $value) {
				echo "      setcookie('cookie[$name]','off');\n";
			}
   	        }
		echo "   }\n";
		echo "</script>\n";*/
		echo '<!-- Copyright 2000-2007 Sidwod Ltda - http://www.sidwod.com .  All rights reserved. -->'."\n";
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>$this->title</title>\n";
		echo '<meta name="keywords" content="'.$this->title.', Sidwod ,Sidwod Ltda." />'."\n";
		echo '<meta name="description" content="'.$this->title.'" />'."\n";
		echo ''."\n";
		echo '<!-- content information -->'."\n";
		echo '<meta http-equiv="content-type" content="application/xhtml+xml;charset=iso-8859-1" />'."\n";
		echo '<meta http-equiv="Content-Language" content="es-ES" />'."\n";
		echo '<meta http-equiv="Content-Style-Type" content="text/css" />'."\n";
		echo '<meta http-equiv="Content-Script-Type" content="text/javascript" />'."\n";
		echo '<meta name="viewport" content="width=1024">'."\n";
		echo '<meta name="Robots" content="Robots" />'."\n";
		echo '<meta http-equiv="pics-label" content=\'(pics-1.1 "http://www.icra.org/ratingsv02.html" l gen true for "http://www.sidwod.com" r (cz 1 lz 1 nz 1 oz 1 vz 1) "http://www.rsac.org/ratingsv01.html" l gen true for "http://www.sidwod.com" r (n 0 s 0 v 0 l 0))\'>'."\n";
		echo '	'."\n";
		echo '<!-- cache options -->'."\n";
		echo '	<meta http-equiv="expires" content="Fri, 26 Mar 1999 23:59:59 GMT" />'."\n";
		echo '	<meta http-equiv="pragma" content="no-cache" />'."\n";
		echo ''."\n";
		echo '<!-- developer info -->'."\n";
		echo '	<meta name="MSSmartTagsPreventParsing" content="true" />'."\n";
		echo '	<meta name="Generator" content="Sidwod Framework version 1.0 - copyright 2007 by  http://www.sidwod.com/"/>'."\n";
		echo '	<meta name="author" content="Sidwod Ltda" />'."\n";
		echo '	<meta name="copyright" content="Copyright (c) 2007 by sidwod "/>'."\n";
		echo '	<meta name="reply-to" content="contact@sidwod.com" />'."\n";
		echo '	<meta name="verify-v1" content="XUzQLG6GZGkLgZK44mEq1ItEviAllSrkkrIQKCQ3SYA=" />'."\n";
		echo '	<link rev="made" href="mailto:contact@sidwod.com" />'."\n";
		echo '	<link rel="Shortcut icon" href="images/favicon.ico" type="image/x-icon" />'."\n";
		echo '<link rel="Home" href="http://www.sidwod.com/" title="Home" />'."\n";
		//old
		/*echo "<script languaje=\"javascript\" src=\"libjs/overlib_mini.js\"></script>\n";*/
		echo "<script languaje=\"javascript\" src=\"libjs/wz_dragdrop.js\"></script>\n\r";
		echo "<script languaje=\"javascript\" src=\"libjs/page.js\"></script>\n\r";
		echo "<script languaje=\"javascript\" src=\"libjs/prototype.js\"></script>\n\r";
		echo "<script languaje=\"javascript\" src=\"libjs/scriptaculous.js\"></script>\n\r";
		echo "<script languaje=\"javascript\" src=\"libjs/prototip.js\"></script>\n\r";
		echo "<script languaje=\"javascript\" src=\"libjs/validadores.js\"></script>\n\r";	
		echo "<script languaje=\"javascript\" src=\"libjs/Function.js\"></script>\n\r";
		echo "<script languaje=\"javascript\" src=\"libjs/Function_site.js\"></script>\n\r";
		echo "<link rel=\"stylesheet\" href=\"".$this->css."\" media=\"all\"></link>\n\r";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/style-form.css\" id='style_form_css' />\n\r";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/prototip_style/prototip.css\" />\n\r";
		echo '<!--[if IE 7]>'."\n";
		/*echo '<script type="text/javascript" src="libjs/ie7/ie7-ie5.js"></script>'."\n";
		echo '<script type="text/javascript" src="libjs/ie7/ie7-css2-selectors.js"></script>'."\n";*/
		echo '<link href="libjs/ie7/IE7.css" rel="stylesheet" type="text/css"/> '."\n";
		echo '<![endif]-->'."\n";
		echo '<!--[if lte IE 6]><![if gte IE 5.5000]>'."\n";
		echo '<style type="text/css" media="screen" >'."\n";
		echo '	@import url("libjs/ie7/IE.css"); '."\n";
		echo '	</style>'."\n";
		echo '	<![endif]><![endif]-->'."\n";
		echo '	<!--[if IE]>'."\n";
		echo '	<style type="text/css" media="screen">'."\n";
		echo '	img, div {behavior: url(libjs/ie7/pngbehavior.htc);}'."\n";
		echo '	</style>'."\n";
		echo '	<![endif]-->'."\n";
		echo '	'."\n";
		echo '	<script type="text/javascript" src="libjs/ie7/webfxlayout.local.js"></script>'."\n\r";
		echo '<!--'."\n";
		echo '	Developed by Sidwod Ltda.'."\n";
		echo '	http://www.sidwod.com'."\n";
		echo '-->'."\n\r";
			
		/*
		
	
		echo "<script languaje=\"javascript\" src=\"libjs/AnchorPosition.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/date.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/PopupWindow.js \"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/CalendarPopup.js\"></script>\n";
		echo "<script languaje=\"javascrip\">
				var cal = new CalendarPopup();
				cal.setDisabledWeekDays(5,6);
				cal.setWeekStartDay(1);
				cal.showNavigationDropdowns();
				</script>";*/
		/*echo "<script language=\"JavaScript\" type=\"text/javascript\"> \n"; 
		require_once 'libjs/layersmenu-browser_detection.js';
 		echo "</script>\n";
		echo "<script language=\"JavaScript\" type=\"text/javascript\" src=\"libjs/layersmenu-library.js\"></script>\n";*/		

		 
		echo "</head>\n";
		echo "<body topmargin='0' leftmargin='0' marginheight='0' marginwidth='0'>\n";
		echo "<div id=\"overDiv\" style=\"width:350px;position:absolute; visibility:hidden; z-index:1000;\"></div>\n";
		echo "<form method=\"POST\" name=\"main\" enctype=\"multipart/form-data\" >\n";
		echo "<input type=\"hidden\" name=\"lastAction\" value=\"$this->lastAction\">\n";
		echo "<input type=\"hidden\" name=\"registered\" value=\"".rawurlencode(serialize($this->registered))."\">\n";

		if(trim($this->textElement) != '')
		{
			echo $this->textElement;
		}
		/*se inicia la impresion de los cosas internas*/
		for($i=0;$i<sizeof($this->htmlElement);$i++) {
			echo $this->htmlElement[$i]->toHtml();
		}
		
		 
		echo "</form>\n";

		echo "</body>\n";
		echo "</html>\n";
		echo '<!-- Copyright 2000-'.date("Y").' Sidwod Ltda - http://www.sidwod.com .  All rights reserved. -->'."\n";
		
		if(!$show)
		{
			$output = ob_get_contents();
			ob_end_clean();			
			return $output;
		}
			
	}
	
	
	


}
?>
