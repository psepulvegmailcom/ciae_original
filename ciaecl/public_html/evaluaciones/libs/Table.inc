<?
class Table extends HtmlElement {

	var $className     = "Table";
	var $Handle        = array();
	var $class         = array();
	var $hor           = 0;
	var $ver           = 0;
	var $border        = 0;
	var $color         = "";
	var $bgcolor       = "";
	var $padding       = 0;
	var $width         = "100%";
	var $cellWidth     = array();
	var $style         = "";
	var $cellVAlign    = array();

	function Table($horizontal,$vertical) {
		$this->hor = $horizontal;
		$this->ver = $vertical;
	}

	function setStyle($style) {
		$this->style=$style;
	}

	function setColStyle($col,$style) {
		for($i=1;$i<=$this->ver;$i++) {
			$this->class[$col][$i] = $style;
		}
	}

	function setColWidth($col,$w) {
		for($i=1;$i<=$this->ver;$i++) {
			$this->cellWidth[$col][$i] = $w;
		}
	}
	function setCellStyle($x,$y,$style) {
		$this->class[$x][$y] = $style;
	}

	function setCellWidth($x,$y,$w) {
		$this->cellWidth[$x][$y] = $w;
	}

	function setCellAlign($x,$y,$a) {
		$this->cellAlign[$x][$y] = $a;
	}

	function setCellVAlign($x,$y,$a) {
		$this->cellVAlign[$x][$y] = $a;
	}

	function setBorder($border) {
		$this->border = $border;
	}

	function setAlign($a) {
		$this->align = $a;
	}

	function setWidth($w) {
		$this->width = $w;
	}

	function setCellPadding($padding) { 
		$this->padding = $padding;
	}

	function add($x,$y,$thing) {
		$this->Handle[$x][$y] =& $thing;
		return($this->Handle[$x][$y]);
	}

	function toHtml() {
		$this->html = array();
		$this->buildHtml();
		return($this->toString());
	}

	function buildHtml() {
			
		$style = "";
		if ($this->style!="") {
			$style = "class=$this->style";
		}
		if ($this->align!="") {
			$this->addHtml("<".$this->align.">");
		}
		$this->addHtml("<table $style border=$this->border width=$this->width cellpadding=$this->padding cellspacing=0>\n"); 
		for($i=0;$i<$this->ver;$i++) {
			$this->addHtml("<tr $style>");
			for($j=0;$j<$this->hor;$j++) {
				$valing="valing = center";
				if ($this->cellVAlign[$j+1][$i+1]!="") {
					$valign = "valign = ".$this->cellVAlign[$j+1][$i+1];
				}
				$align = "left";
				if ($this->cellAlign[$j+1][$i+1]!="") {
					$align = "align=".$this->cellAlign[$j+1][$i+1];
				}
				if ($this->cellWidth[$j+1][$i+1]!="") {
					$this->addHtml("<td class='".$this->class[$j+1][$i+1]."' $align width=".$this->cellWidth[$j+1][$i+1]." $valign>\n");
				} else {
					$this->addHtml("<td class='".$this->style."' $align $valign>\n");
				}
		
				if (is_object($this->Handle[$j+1][$i+1])) {
					$this->addHtml($this->Handle[$j+1][$i+1]->toHtml());
				} else {
					$this->addHtml($this->addHtml($this->Handle[$j+1][$i+1]));
				}
				$this->addHtml("</td>\n");
			}
			$this->addHtml("</tr>\n");
		}
		$this->addHtml("</table>\n");
		if ($this->align!="") {
			$this->addHtml("</".$this->align.">\n");
		}
	}
}
?>
