<?
class SubmitSpecial extends HtmlElement {

	var $className = "Submit";
	var $name      = "";
	var $value     = "";
	var $level     = 0;
	var $class     = "button";
	var $show		=false;
	var $namefunction ='';

	

	function SubmitSpecial($value, $name,$level = 0,$namefunction) {
		$this->name  = $name;
		$this->value = $value;
		$this->level = $level;
		$this->namefunction = $namefunction;
	}

	function toHtml() {
		if(!$this->show)
			$this->show=true;
		else
			return '';				
		global $HTTP_POST_VARS;
					
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		return("<center>
				<input class='$this->class' type=button name='$this->name' value='$this->value' onclick=\"javascript:$this->namefunction\">
				</center>\n");
	}
}
?>
