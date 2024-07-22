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

		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
		echo "<meta http-equiv=\"Content-type\" content=\"text/html;charset=iso-8859-1\" />";
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
		echo "</script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/prototype.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/scriptaculous.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/page.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/wz_dragdrop.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/AnchorPosition.js\"></script>\n";
		
		echo "<script languaje=\"javascript\" src=\"libjs/overlib_mini.js\"></script>\n";
		echo "<div id=\"overDiv\" style=\"width:350px;position:absolute; visibility:hidden; z-index:1000;\"></div>\n"; 	
		
		echo "<script languaje=\"javascript\" src=\"libjs/date.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/PopupWindow.js \"></script>\n";				
		echo "<script languaje=\"javascript\" src=\"libjs/CalendarPopup.js\"></script>\n";
		echo "<script languaje=\"javascrip\">
				var cal = new CalendarPopup();
				cal.setDisabledWeekDays(5,6);
				cal.setWeekStartDay(1);
				cal.showNavigationDropdowns();
				</script>";
		echo "<script languaje=\"javascript\" src=\"libjs/Function.js\"></script>\n";
		echo "<script languaje=\"javascript\" src=\"libjs/Function_site.js\"></script>\n";
		echo "<script language=\"JavaScript\" type=\"text/javascript\"> \n"; 
		require_once 'libjs/layersmenu-browser_detection.js';
 		echo "</script>\n";
		echo "<script language=\"JavaScript\" type=\"text/javascript\" src=\"libjs/layersmenu-library.js\"></script>\n";		
		echo "<link rel=\"stylesheet\" href=\"$this->css\"></link>\n";
		echo "</head>\n";
		echo "<body topmargin='0' leftmargin='0' marginheight='0' marginwidth='0' onLoad='javascript:clearAll();'>\n";
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
		
		if(!$show)
		{
			$output = ob_get_contents();
			ob_end_clean();			
			return $output;
		}
			
	}
	
	
	


}
?>
