<?
class Submit extends HtmlElement {

	var $className = "Submit";
	var $name      = "";
	var $value     = "";
	var $level     = 0;
	var $class     = "button";
	var $show	     = false;
	var $js        = "";

	function Submit($value, $name,$level = 0,$js="") {
		$this->name  = $name;
		$this->value = $value;
		$this->level = $level;
		$this->js    = $js;
	}

	function toHtml() {
		if(!$this->show)
			$this->show=true;
		else
			return '';				
		global $HTTP_POST_VARS;
		
		$javascript = "";			
		if ($this->js!="") {
			$javascript=$this->js;
		}

		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		return("<center><input class='$this->class' type=button name='$this->name' value='$this->value' onclick=\"javascript:process('$this->name','$this->level')\" $javascript ></center>\n");
	}
}
?>
