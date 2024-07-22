<?php
class OverLib extends HtmlElement {

	var $className = "OverLib";
	var $title     = "";
	var $jsOnclick = "";
	var $text      = "";
	var $link	   = "";
	var $ow 	   = 330;
	var $ox        = 310;
	var $oy		   = 180;
	var $closeClick = true;
	var $onMouse = false;
	
	function OverLib($title,$link,$text,$jsOnclick='') 
	{		
		$this->title     = $title;
		$this->jsOnclick = $jsOnclick;
		$this->text      = $text;
		$this->link      = $link;		
	}

	function cleanText()
	{

		$caracterOrigen 	= array("\n","'",'"',')','(');
		$caracterReemplazo  = array(' ',"`",'&#34:','&#41;','&#40;');		
		
		$this->text 		= str_replace($caracterOrigen,$caracterReemplazo,$this->text);				
		$this->link 		= str_replace($caracterOrigen,$caracterReemplazo,$this->link);
		
		//	$this->text 		=  htmlspecialchars($this->text);
	}
	
	function setW($w)
	{
		$this->ow 	   = $w;
	}

	function closeNoClick()
	{
		$this->closeClick = false;
	}
	
	function setX($x)
	{
		$this->ox 	   = $x;
	}	

	function setY($y)
	{
		$this->oy 	   = $y;
	}		
	
	function onMouse()
	{
		$this->onMouse = !$this->onMouse;
	}	
	
	function toHtml() 
	{
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		
		$this->cleanText();		
		
		$script = "<a href='#' ";
		
		$script .= $this->toHtmlOnlyScript();
		$script .= ">".$this->link."</a>";
		return($script);
	}
	
	function toHtmlOnlyScript()
	{
		$script = "";
		if(trim($this->jsOnclick)!='')
			$script .= " onclick=\"javascript:".$this->jsOnclick.";\" ";
		
		if($this->closeClick)
			$closeD = "return nd();";
		else
			$closeD = "cClick();";
		
		$over = " return overlib('".$this->text."', STICKY, CAPTION,'".$this->title."', WIDTH, ".$this->ow.", CENTER";
		
		if(!$this->onMouse)
			$over .= " , FIXY, ".$this->oy.",FIXX, ".$this->ox;
		
		$over .= " ) 	";
		
		//cClick();
		$script .= " onmouseover=\"".$over." \" onmouseout=\"".$closeD."\"	";
		//eval($over);
		return $script;
	}
}
?>
