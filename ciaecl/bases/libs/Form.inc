<?php

/** *
* Abstraccion de un Formulario.  
* Esta clase tambien provee funciones de validacion de not null sobre los controles asociados a este formulario
*
*/

class Form extends Frame {

	var $panel          = "";
	var $table          = "";
	var $validation     = array();
	var $class			= "Form";


	
	/** *
	* Constructor 
	*
	* @param string Numero de Columnas del formulario
 	* @param string Numero de Filas del formulario
	*/
	function Form($col,$row) {
		$this->panel = new Table(1,2);
		$this->table = new Table($col,$row);
		$this->table->setStyle($this->class);
	}


	/** *
	* Agrega un control de formulario en la posicion indicada 
	*
	* @param string Columna donde se agregara el control 
	* @param string Fila donde se agregara el control.
	* @param string referencia al Control a ingresar.
	* @param string true si este control esta afecto a validacion. false de lo contrario
	*/
	function add($x,$y,$element,$validate = false) {
		$this->table->add($x,$y,$element);
		if ($validate) {
			$this->validation[$x][$y] =& $element;
		}
	}

	/** *
	* Asigna el ancho al borde del formulario 
	*
	* @param string numero de 1 a 10 que indica el ancho del borde. 0 para no poner borde 
	*/
	function setBorder($b) {
		$this->table->setBorder($b);
	}
	
	function setStyle($style) {
		$this->table->setStyle($style);
	}
	
	/** *
	* Obtiene la tabla asociada al formulario 
	*
	* @return Table 
	*/
	function getTable() {
		return($this->table);
	}

	
	
	/** *
	* Limpia los datos ingresados en los controles. 
	*
	*/
	function clean() {
	
	
		for($i=1;$i<=$this->table->hor;$i++) {
			
			for($j=1;$j<=$this->table->ver;$j++) {
			
			
				if ($this->table->Handle[$i][$j]->className=="InputText") {
					$this->table->Handle[$i][$j]->value = "";
				}
				
				if ($this->table->Handle[$i][$j]->className=="PasswordText") {
					$this->table->Handle[$i][$j]->value = "";
				}				
				
				/** limpia textarea*/
				if ($this->table->Handle[$i][$j]->className=="TextArea") {
					$this->table->Handle[$i][$j]->value = "";
				}
				
				/** limpia frame*/
				if ($this->table->Handle[$i][$j]->className=="Frame") {
					$k=1;
					foreach($this->table->Handle[$i][$j]->Handle as $v) {	
						if($this->table->Handle[$i][$j]->Handle[$k][1]->className=='InputText')						
						  $this->table->Handle[$i][$j]->Handle[$k][1]->value='';	  					   
					    $k++;
					}
				}
				
				
				/** limpia select*/
				if ($this->table->Handle[$i][$j]->className=="Select") {
					$this->table->Handle[$i][$j]->value = -1;
					
				}
				
			}
		}
		
		
	}
	
	/** *
	* Valida el ingreso del formulario sobre los controles que fueron indicados que estan afectos a validacion.
	*
	* @return boolean true si el formulario no tiene controles requeridos que estan vacios, false de lo contrario. 
	*/
 	function validate() {
		$ret = true; 
		for($i=1;$i<= $this->table->hor ;$i++) 
		{
			for($j=1;$j<=$this->table->ver;$j++) 
			{
				if ($this->validation[$i][$j]!="" && is_object($this->validation[$i][$j])) 
				{
					
					$variable=$this->validation[$i][$j]->name;	
					$this->validation[$i][$j]->setValue(trim($_POST[$variable]));
					
					if ($this->validation[$i][$j]->isEmpty())
					{
						$element = $this->validation[$i][$j];
						$element->setValidation(" * Obligatorio * ");
						$this->table->add($i,$j,$element,true);
						$ret = false;
					}
				}
			}
		}
		return($ret);
	}

	/** *
	* Entrega un string con codigo HTML asociado al objeto que esta clase representa.
	*
	* @return string 
	*/
	function toHtml() {
		$this->panel->add(1,1,$this->table);
		return($this->panel->toHtml());
	}	
}
?>