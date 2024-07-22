<?

/**
* Abstraccion de una ventana de confirmacion de una accion. 
* Esta ventana es movible sobre la pantalla. 
*
* se le deben indicar dos acciones asociadas al metodo lastAction() con sus niveles respectivos.
*/

class Confirm extends FloatingFrame {

	/**
	* @var string
	* @access private
	*/
	var $sourceFile       = "";

	/**
	* @var array 
	* @access private
	*/
	var $htmlElement      = array();

	/**
	* @var string
	* #access private
	*/
	var $css              = "";

	/**
	* @var string
	* #access private
	*/
	var $lastAction       = "";

	/**
	* @var string
	* #access private
	*/
	var $className        = "Confirm";

	/**
	* @var string
	* #access private
	*/
	var $text             = "";

	/**
	* @var string
	* #access private
	*/
	var $accept           = "";

	/**
	* @var integer
	* #access private
	*/
	var $level            = 0;

	/**
	* @var string
	* #access private
	*/
	var $cancel           = "";

	/**
	* @var integer
	* #access private
	*/
	var $callevel         = 0;
	
	/**
	* Constructor 
	*
	* @param string accion a realizar en caso de confirmar la accion.
	* @param string nivel donde se realizara la accion confirmada
	* @param string Mensaje a mostrar en el cuadro de texto.
	* @param string accion a realizar en el caso de cancelar la accion.
	* @param string nivel asociado a la accion de cancelacion.
	*
	*
	*/
	function Confirm($accept,$level,$msg,$cancel="cancel",$canlevel="") {

		parent::FloatingFrame("confirm",1,2);
		$this->setTitle("Mensaje");
		$this->setBorder("1");
		$this->text = $msg;
		$this->add(1,1,"<center>$this->text</center>");
		$this->setLeft("25%");
		$this->setWidth("50%");
		$this->setTop("20%");
		$this->accept  = $accept;
		$this->level   = $level;
		$this->cancel  = $cancel;
		$this->canlevel = $canlevel;
		
		if ($canlevel=="") {
			$this->canlevel = $level;
		}

		$bf = new Form(2,1);
		
		$bf->add(1,1,new Button("Si","ok","setVisibility('confirm',false);process('$this->accept','$this->level');"));
		$bf->add(2,1,new Button("No","cancel","setVisibility('confirm',false);process('$this->cancel','$this->canlevel');"));

		$this->add(1,2,$bf);

	}

	/**
	* Asigna el ancho del elemento representado.  
	*
	* @param string ancho asignado, este puede ser en pixeles o porcentaje. 
	*/

	function setWidth($w) {
		$this->setFrameWidth($w);
	}
}
?>
