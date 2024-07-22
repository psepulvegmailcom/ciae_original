<?

/**
* Control de Formulario para definir variables escondidas 
*
*/
class Hidden extends FormControl {

	/**
	* @var string
	* #access private
	*/
	var $className = "Hidden";


	/**
	* Constructor
	*
	* @param string $1 Nombre de la Variable 
	* @param string $2 Valor de la Variable
	*/
	function Hidden($name, $value) {
		$this->name  = $name;
		$this->value = $value;
	}

	/**
	* Entrega un string con codigo HTML asociado al objeto que esta clase representa.
	*
	* @return string 
	*/
	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		return("<input type=Hidden name='$this->name' value='$this->value'>\n");
	}
}
?>
