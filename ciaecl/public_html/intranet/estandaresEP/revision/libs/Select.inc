<?
class Select extends FormControl{

	var $className = "Select";
	var $name      = ""; 
	var $data      = array();
	var $tip       = "";
	var $key       = "";
	var $field     = "";
 	var $size      = 0;
	var $sel       = 0;
	var $nullData  = "";
	var $nullValue = "0";
	var $jsCode    = "";
	var $width     = "";
	var $multiple  = "";
	var $disable   = "";

	function Select($name,$arrayData,$key,$field,$size = 0,$value = 0,$nullData ="",$nullValue="0",$jsCode="",$width="") {
		$this->name      = $name;
		$this->data      = $arrayData;
		$this->key       = $key;
		$this->field     = $field;
		$this->size      = $size;
		$this->value     = $value;
		$this->nullData  = $nullData;
		$this->nullValue = $nullValue;
		$this->jsCode    = $jsCode;
		$this->width     = $width;
	}

	function setMultiple($size=10){
		$this->multiple=" multiple";
		$this->size=$size;
	}
	
	function setDisable()
	{
		$this->disable=" DISABLED ";
	}
	
	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");

		$select = "";
		$selwidth = "";

		if ($this->width!="") {
			$selwidth="width='$this->width'";
		}
	
		if (is_array($this->value)) {
			$this->multiple="MULTIPLE";
		}
	
		if ($this->jsCode=="") {
	        	$select = " <SELECT id=\"$this->name\" NAME=\"$this->name\" SIZE=\"$this->size\" $selwidth $this->multiple $this->disable>
		";
		} else {
				$select = " <SELECT id=\"$this->name\" NAME=\"$this->name\"  SIZE=\"$this->size\" ONCHANGE=\"$this->jsCode\" $selwidth $this->multiple $this->disable>
		";
		}
		if ($this->nullData!="" && $this->nullValue!="") {
			$select = $select . " 	<OPTION VALUE=\"".$this->nullValue."\">".$this->nullData." </OPTION>	";
		}
		for($i=0;$i<sizeof($this->data);$i++) 
		{
			$select = $select . "		<OPTION VALUE=\"".$this->data[$i][$this->key]."\" ";
			if (!is_array($this->value)) {
				if ($this->value!="") 
				{				
					if ($this->value == $this->data[$i][$this->key]) {
						$select = $select .  "SELECTED ";
					}
				}
			} else {
				foreach($this->value as $val) {
					if ($val == $this->data[$i][$this->key]) {
						$select = $select .  "SELECTED ";
					}
				}
			}
			$select = $select . ">".$this->data[$i][$this->field]."</OPTION>";
		}
		$select = $select . "	</SELECT>";
		return ($select);
	}
}
?>
