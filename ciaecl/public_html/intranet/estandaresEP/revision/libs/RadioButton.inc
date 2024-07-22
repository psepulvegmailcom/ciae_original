<?

/**
* Clase que representa un RadioBotton en un formulario. 
*
*
*/


class RadioButton extends HtmlElement {

	/**
	* @var string
	* #access private
	*/
	var $className = "RadioButton";

	/**
	* @var string
	* #access private
	*/
	var $name      = "";

	/**
	* @var string
	* #access private
	*/
	var $value     = "";

	/**
	* @var string
	* #access private
	*/
	var $text     = "";

	/**
	* @var string
	* #access private
	*/
	var $jscode    = 0;

	/**
	* @var string
	* #access private
	*/
	var $default    = 0;

	/**
	* Constructor 
	*
	* @param string Texto a mostrar en el boton
	* @param string Nombre del objeto
 	* @param string Codigo javascript asociado con la accion al presionar el boton
	*/
	function RadioButton($name, $value,$text,$def="",$js="") {
		$this->name    = $name;
		$this->value   = $value;
		$this->text    = $text;
		$this->jscode  = $js;
		$this->default = $def; 
	}

	/**
	* Entrega un string con codigo HTML asociado al objeto que esta clase representa.
	*
	* @return string 
	*/
	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");

		if ($this->default==$this->value) {
			$check = "CHECKED";
		}
		return("<input type=radio name='$this->name' value='$this->value' onclick=\"$this->jscode\" $check> $this->text\n");
	}
}
?>
