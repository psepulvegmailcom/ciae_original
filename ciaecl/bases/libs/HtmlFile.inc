<?php
class HtmlFile extends HtmlElement { 
	var $className = "HtmlFile";
	var $file      = "";

	function HtmlFile($file) {
		$this->file = $file;
	}

	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");

		// $url="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].$this->file;

		ob_start();
		include $this->file;
		$valor = ob_get_contents();
		ob_end_clean();




		return($valor);	
		
	}
}
?>
