<?php

/** *
* Abstraccion de un Frame o cuadro contenedor de objetos. 
* Es como una tabla, pero que tiene funcionalidades extras.
*
* Sirve mucho como contenedor de objetos y ayuda con el layout de una pagina.
*
*/
class Frame extends HtmlElement {

	/** *
	* Nombre de la Clase. NO CAMBIAR!!
	* @var string
	* #access private
	*/
	var $className     = "Frame";

	/** *
	* @var string
	* #access private
	*/
	var $Handle        = array();

	/** *
	* @var string
	* #access private
	*/
	var $menuSelector  = array();

	/** *
	* @var integer 
	* #access private
	*/
	var $hor           = 0;

	/** *
	* @var integer
	* #access private
	*/
	var $ver           = 0;

	/** *
	* @var integer
	* #access private
	*/
	var $border        = 0;

	/** *
	* @var string
	* #access private
	*/
	var $color         = "";

	/** *
	* @var string
	* #access private
	*/
 	var $align         = "center";

	/** *
	* @var string
	* #access private
	*/
	var $style         = "Frame";

	/** *
	* @var string
	* #access private
	*/
	var $bgcolor       = "";

	/** *
	* @var integer
	* #access private
	*/
 	var $padding       = 0;

	/** *
	* @var string
	* #access private
	*/
	var $width         = "100%";

	/** *
	* @var string
	* #access private
	*/
	var $title         = "";

	/** *
	* @var array
	* #access private
	*/
 	var $cellWidth     = array();

	/** *
	* @var array
	* #access private
	*/
	var $cellHeight    = array();

	/** *
	* @var array
	* #access private
	*/
	var $cellVAlign    = array();

	/** *
	* @var array
	* #access private
	*/
	var $cellAlign     = array();

	/** *
	* @var array
	* #access private
	*/
	var $cellJS      = array();
	var $cellColSpan = array();
	
	/** *
	* Constructor 
	*
	* @param string $1 Numero de columnas del Frame 
	* @param string $2 Numero de Filas del Frame 
	*/
	function Frame($horizontal,$vertical) {

		$this->hor = $horizontal;
		$this->ver = $vertical;

	}


	/** *
	* Asigna un estilo de colores y formas al Frame. Esto viene dado del CSS asociado a la pagina. 
	*
	* @param string $1 Nombre del estilo 
	*/
	function setStyle($s) {
		$this->style = $s;
	}

	/** *
	* Establece un Titulo al frame. este quedara escrito sobre el Frame al estilo ventana de unix o windows. 
	*
	*
	* @param string $1 Texto a poner como titulo 
	*/
	function setTitle($t) {
		$this->title = $t;
	}

	/** *
	* Asigna la Alineacion interna de una celda en particular. 
	* Estas pueden ser Center, Left o Right.
	*
	* @param integer $1 Columna a cambiar la alineacion
	* @param integer $2 Fila a cambiar la alineacion
	* @param string $3 Alineacion a usar.
	*/
	function setCellAlign($x,$y,$a) {
		$this->cellAlign[$x][$y] = $a;
   	} 

	/** *
	* Asigna el Ancho de una celda en particular. 
	* Este puede ser dado en pixeles (px) o en porcentaje (%)
	*
	* @param integer $1 Columna a cambiar el ancho 
	* @param integer $2 Fila a cambiar el ancho
	* @param string $3 Ancho de la Columna 
	*/
	function setCellWidth($x,$y,$w) {
		$this->cellWidth[$x][$y] = $w;
	}

	/** *
	* Asigna el Alto de una celda en particular. 
	* Este puede ser dado en pixeles (px) o en porcentaje (%)
	*
	* @param integer $1 Columna a cambiar el alto
	* @param integer $2 Fila a cambiar el alto
	* @param string $3 Alto de la Columna 
	*/
	function setCellHeight($x,$y,$h) {
		$this->cellHeight[$x][$y] = $h;
	}

	/** *
	* Asigna la Alineacion Vertical de una celda en particular. 
	* Esta puede Top, Center, Buttom.
	*
	* @param integer $1 Columna a cambiar 
	* @param integer $2 Fila a cambiar
	* @param string $3 Alineacion Vertical a usar 
	*/
	function setCellVAlign($x,$y,$a) {
		$this->cellVAlign[$x][$y] = $a;
	}

	function setColSpan($x,$y,$a) {
		$this->cellColSpan[$x][$y] = $a;
	}

	/** *
	* Especifica el ancho del borde del frame 
	* Este numero puede ir de 1 a 10, 0 significa sin borde.
	*
	* @param integer $1 Ancho del borde 
	*/
	function setBorder($border) {
		$this->border = $border;
	}

	/** *
	* Especifica el ancho del frame completo. 
	* Este puede ser dado en pixeles (px) o en porcentaje (%)
	*
	* @param string $1 Ancho del Frame 
	*/
	function setWidth($w) {
		$this->width = $w;
	}

	/** *
	* Especifica la Alineacion del frame completo. 
	* Este valor pueder ser Left, Right, Center 
	*
	* @param string $1 Alienacion a Usar. 
	*/
	function setAlign($a) {
		$this->align=$a;
	}

	/** *
	* Especifica los bordes internos o padding entre celdas. 
	* Este puede ser dado en pixeles (px) o en porcentaje (%)
	*
	* @param string $1 Padding a usar entre celdas. 
	*/
	function setCellPadding($padding) {
		$this->padding = $padding;
	}

	/** *
	* Agrega un elemento a una celda del Frame.  Si el elemento es un LayersMenu, debe indicarse el 4to argumento con el nombre del menu asociado.
	*
	* @param integer $1 Columna donde se agregara el nuevo elemento
	* @param integer $2 Fila donde se agregara el nuevo elemento
	* @param string $3 Referencia al nuevo elemento a agregar
	* @param string $4 Solo en el caso que el elemento sea un LayersMenu, Indicar el nombre del menu.
	*/
	function add($x,$y,$thing, $menu="",$js="") {
	
		$this->Handle[$x][$y] = $thing;
		
		if ($thing->className=="LayersMenu") {
			$this->useMenu = true;
			$this->menuObject = $thing;
			$this->menuSelector[$x][$y] = $menu;
		}

		if ($js!="") {
			$this->cellJS[$x][$y] = $js;
		}

		if ($thing->useMenu) {
			$this->useMenu = true;
			$this->menuObject = $thing->menuObject;
		}
		return($this->Handle[$x][$y]);
	}


	function toHtml() {	
	
		$this->buildHtml();
		return($this->toString());
	}

	/** *
	* construye el codigo HTML asociado al objeto que esta clase representa.
	*
	* @return string 
	*/
	function buildHtml() {

		$this->addHtml("\n\n	<$this->align>\n	<table class=$this->style border=$this->border width=$this->width cellpadding=$this->padding cellspacing=0>\n\n");

		if (trim($this->title)!="") {
			$this->addHtml("	<tr>\n<td class=\"".$this->style."Title\" colspan=".$this->hor.">\n$this->title</td>\n</tr>\n");

		}

		for($i=0;$i<$this->ver;$i++) 
		{
			$this->addHtml("	<tr>\n");
				
			for($j=0; $j < $this->hor ;$j++) 
			{

				$width   ="";
				$height  ="";
				$valign  ="valign=top";
				$align   ="align=left";
				$js      ="";
				$colspan ="";

				if ($this->cellWidth[$j+1][$i+1]!="") {
					$width = "width=".$this->cellWidth[$j+1][$i+1];
				}

				if ($this->cellHeight[$j+1][$i+1]!="") {
					$height = "height=".$this->cellHeight[$j+1][$i+1];
				}

				if ($this->cellVAlign[$j+1][$i+1]!="") {
					$valign = "valign = ".$this->cellVAlign[$j+1][$i+1];
				}
				if ($this->cellAlign[$j+1][$i+1]!="") {
					$align = "align=".$this->cellAlign[$j+1][$i+1];
				}
 
				if ($this->cellColSpan[$j+1][$i+1]!="") {
					$colspan = "colspan=".$this->cellColSpan[$j+1][$i+1];
				}
				if ($this->cellJS[$j+1][$i+1]!="") {
					$js = $this->cellJS[$j+1][$i+1];
				}
 
				$this->addHtml("	<td $align $width $height $valign $colspan $js>");

				if (is_object($this->Handle[$j+1][$i+1])) {
		
		 
					if ($this->Handle[$j+1][$i+1]->className=="LayersMenu") {
						$this->addHtml($this->Handle[$j+1][$i+1]->toHtml($this->menuSelector[$j+1][$i+1]));
					} else {
						$this->addHtml($this->Handle[$j+1][$i+1]->toHtml());
					}

				} else { 
					$this->addHtml($this->Handle[$j+1][$i+1]);
				}
				$this->addHtml("	</td>\n");
			}
			$this->addHtml("	</tr>\n");
		}

		$this->addHtml("	</$this->align>\n	</table>\n");
	}
}
?>