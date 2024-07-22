<?php
class Message extends FloatingFrame {

	var $sourceFile       = "";
	var $htmlElement      = array();
	var $className        = "Message";
	var $text             = "";
	var $level            = "";
	var $action           = "";
	
	function Message($msg,$action="",$level="",$butons=0) {
		parent::FloatingFrame("msg",1,2);
		$this->setTitle("Mensaje");
		$this->setBorder("1");
		$this->setFrameWidth('300px');
		$this->text = $msg;
		$this->add(1,1,"<center class='mensajeResultado'><br><br>$this->text<br><br></center>");
		$this->setLeft("35%");
		$this->setTop("30%");
		$this->action = $action;
		$this->level = $level;

		if ($buttons==0) {
			if ($action!="" && $level!="") {
				$this->add(1,2,new Button("OK","OK","setVisibility('msg',false);process('$this->action','$this->level')"));
			} else {
				$this->add(1,2,new Button("OK","OK","setVisibility('msg',false);"));
			}
		}
	}

	function setWidth($w) {
		$this->setFrameWidth($w);
	}
}
?>
