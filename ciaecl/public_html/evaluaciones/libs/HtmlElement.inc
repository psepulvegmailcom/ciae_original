<?
/** *
* HtmlElement - Abstraccion de un elemento HTML 
*	
* Esta clase es la base de un elemento HTML cualquiera.
* Todas las clases que son abstracciones de un objeto HTML heredan desde esta clase.
*
*/
class HtmlElement {

	var $className     = "HtmlElement";
	var $useMenu       = false;
	var $menuObject    = "";
	var $link          = "";
	var $html          = array();
	var $style         = "";

	/** *
	* Obtener el nombre de clase 
	*/
	function getClassName() {
		return($this->className);
	}
	function setLink($link) {
		$this->link = $link;
	}
	function setStyle($s) {
		$this->style = $s;
	}

	function printHtml() {
		foreach($this->html as $line) {
			echo $line;
		}
	}
	function addHtml($html) {
		array_push($this->html,$html);
	}
	
	function cleanHtml() {
		$this->html=array();
	}
	
		
	function toString() {
		$html = "";
		foreach($this->html as $line) {
			$html = $html . $line;
		}
		return($html);
	}

}
?>