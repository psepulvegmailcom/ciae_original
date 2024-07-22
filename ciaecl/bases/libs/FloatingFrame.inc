<?php

/** *
* Clase que representa un cuadro de dialogo flotante en la pantalla. 
* Esta clase se puede usar para construir ventanas de dialogos entre el sitio web y el usuario
* 
*/

class FloatingFrame extends Frame {

	/** *
	* @var string
	* #access private
	*/
	var $sourceFile       = "";

	/** *
	* @var string
	* #access private
	*/
	var $className        = "FloatingFrame";

	/** *
	* @var string
	* #access private
	*/
	var $name             = "";

	/** *
	* Distancia entre el inicio de la pagina y el inicio del frame.
	* puede ser en porcentajes (%) o en pixeles (px)
	* @var string
	* #access private
	*/
	var $top              = '0px'; //'200px';

	/** *
	* Distancia entre el lado izquierdo de la pagina y el inicio del costado del frame.
	* puede ser en porcentajes (%) o en pixeles (px)
	* @var string
	* #access private
	*/
	var $left             = '0px'; //'200px';

	/** *
	* Ancho del frame en pantalla. 
	* puede ser en porcentajes (%) o en pixeles (px)
	* @var string
	* #access private
	*/
	var $width_frame      = '100px';

	/** *
	* Alto del frame en pantalla. 
	* puede ser en porcentajes (%) o en pixeles (px)
	* @var string
	* #access private
	*/
	var $height_frame     = '100px';

	/** *
	* @var string 
	* #access private
	*/
	var $vis              = 'visible';
	
	var $movible = true;

	/** *
	* Constructor
	*
	* @param string Nombre del frame
	* @param string distancia en porcentaje (%) o pixeles (px) entre el lado izquierdo de la pagina y el frame.
	* @param string distancia en porcentaje (%) o pixeles (px) entre el lado superior de la pagina y el frame.
	*/
	function FloatingFrame($name,$h,$v) {
 		$this->name = $name;
		parent::Frame($h,$v);
	}

	/** *
	* Especifica la distancia en porcentaje (%) o en pixeles (px) entre el lado izquierdo de la pagina y el frame.
	*
	* @param string distancia en porcentaje (%) o pixeles (px). 
	*/
	function setLeft($l) {
		$this->left=$l;
	}

	/** *
	* Especifica la distancia en porcentaje (%) o en pixeles (px) entre el lado superior de la pagina y el frame.
	*
	* @param string distancia en porcentaje (%) o pixeles (px). 
	*/
	function setTop($t) {
		$this->top=$t;
	}

	/** *
	* Especifica el ancho  en porcentaje (%) o en pixeles (px) del frame.
	*
	* @param string ancho en porcentaje (%) o pixeles (px). 
	*/
	function setFrameWidth($w) {
		$this->width_frame=$w;
	}

	/** *
	* Especifica el alto en porcentaje (%) o en pixeles (px) del frame.
	*
	* @param string alto en porcentaje (%) o pixeles (px). 
	*/
	function setFrameHeight($h) {
		$this->height_frame=$h;
	}

	/** *
	* Especifica si el frame esta visible o no. 
	*
	* @param string "visible" para indicar que el frame esta visible o "hide" para indicar que el frame esta escondido.
	*/
	function setVisibility($v) {
		$this->vis = $v;
	}

	function noMovible()
	{
		$this->movible = false;
	}
	
	/** *
	* Entrega un string con codigo HTML asociado al objeto que esta clase representa.
	*
	* @return string 
	*/
	function toHtml() 
	{
		$this->addHtml("
		<!-- frame message -->
		<div id='$this->name'  style='visibility:$this->vis; position:absolute; left: $this->left;  top: $this->top; width: $this->width_frame; height: $this->height_frame;z-index: 100; ' >\n");
		parent::toHtml();
		$this->addHtml("</div>");
		
		if($this->left == '0px' || $this->top== '0px')
			$this->addHtml("<!-- change position -->\n <script>centerPositionDiv('$this->name');</script>");
			
		$this->addHtml("<!-- frame message -->\n");
		
		if($this->movible)
			$this->addHtml("<script type=\"text/javascript\">	SET_DHTML(\"$this->name\"); </script>\n");
		
		

		return($this->toString());
	}
}
?>