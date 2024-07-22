<?

/**
* Clase que representa un botton en un formulario. 
*
* Esta clase no es un SUBMIT, es solo un boton que usualmente se utiliza con javascript
*
*/


class Button extends HtmlElement {

	/**
	* @var string
	* #access private
	*/
	var $className = "button";
	var $show		=false;
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
	var $jscode    = 0;
	
	var $class     = "button";

	/**
	* Constructor 
	*
	* @param string Texto a mostrar en el boton
	* @param string Nombre del objeto
 	* @param string Codigo javascript asociado con la accion al presionar el boton
	*/
	function Button($value, $name,$js="") {
		$this->name   = $name;
		$this->value  = $value;
		$this->jscode = $js;
	}

	/**
	* Entrega un string con codigo HTML asociado al objeto que esta clase representa.
	*
	* @return string 
	*/
	function toHtml() {
	
		if(!$this->show)
			$this->show=true;
		else
			return '';		
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		return( "<center><input  class='$this->class' type=button name='$this->name' value='$this->value' onclick=\"$this->jscode\"></center>\n");
	}
}
?>
