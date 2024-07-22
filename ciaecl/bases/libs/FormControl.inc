<?php

/** *
* Abstraccion de un control de un formulario. Todos los controles de los formulario heredan de esta clase. 
*
*/

class FormControl extends HtmlElement {

	/** *
	* Nombre de la Clase. NO CAMBIAR!!
	* @var string
	* #access private
	*/
	var $className = "FormControl";

	/** *
	* @var string
	* #access private
	*/
	var $name      = "";

	/** *
	* @var string
	* #access private
	*/
	var $value     = "";

	/** *
	* @var string
	* #access private
	*/
	var $validText = "";

	/** *
	* Constructor 
	*/
	function FormControl() {

	}

	/** *
	* Indica si el valor del control es nulo o no 
	*
	* @return boolean 
	*/
	function isEmpty() {
		return(trim($this->value) == "");
	}

	function setValue($value) {
		$this->value=$value;
	}

	/** *
	* Especifica si este control esta sujeto al control de validacion del formulario
	*
	* @param boolean true para validar el contenido del control, false para no validar el contenido del control
	*/
	function setValidation($v) {
		$this->validText = $v;
	}

}
?>