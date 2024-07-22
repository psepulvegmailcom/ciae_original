<?
class IFrame extends HtmlElement {

	var $sourceFile       = "";
	var $className        = "IFrame";
	var $width            = "100%";
	var $height           = "100%";
	
	function IFrame($name,$file,$w,$h) {
		$this->name = $name;
		$this->sourceFile = $file;
		$this->width = $w;
		$this->height = $h;	
	}

	/**
	* Entrega un string con codigo HTML asociado al objeto que esta clase representa.
	*
	* @return string 
	*/
	function toHtml() {
		return("<iframe name='$this->name' src='$this->sourceFile' width='$this->width' height='$this->height'></iframe>\n");
	}
}
?>
