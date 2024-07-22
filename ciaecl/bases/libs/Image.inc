<?php
class Image extends HtmlElement {

	var $sourceFile       = "";
	var $className        = "Image";
	var $file             = "";
	var $width            = "";
	var $height           = "";
	var $kar              = false;

	function Image($file,$w,$h) {
 		$this->file   = $file;
 		$this->width  = $w;
 		$this->height = $h;
	}

	function setWidth($w) {
		$this->width=$w;

		if ($this->kar) {
			$size = getimagesize($this->file);
			$this->height=($w/$size[0])*$size[1];
		}
		
	}

	function setHeight($h) {
		$this->height=$h;

		if ($this->kar) {
			$size = getimagesize($this->file);
			$this->width=($h/$size[1])*$size[0];
		}

	}

	function setScale($factor) {

		$size = getimagesize($this->file);
		$this->width  = $size[0]*$factor;
 		$this->height = $size[1]*$factor;
	
	}

	function setKeepAspectRatio($b) {
		$this->kar = $b;
	}
	
	function toHtml() {
		if ($this->link!="") {
			$this->addHtml("<a href='$this->link'>");
		}
		$this->addHtml("<img src='$this->file' width='$this->width' height='$this->height'>");
		if ($this->link!="") {
			$this->addHtml("</a>");
		}
		return ($this->toString());
	}
}
?>
