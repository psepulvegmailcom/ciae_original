<?php

class Textos extends Objetos
{		
	var $sourceTable = "site_textos";
	
	function Textos() 
	{
		parent::Objetos();
	}	
}

class ControlTextos extends ControlObjetos
{
	function ControlTextos()
	{
		parent::ControlObjetos();
		$this->obj = new Textos(); 
		$this->key = 'id_texto';
		$this->sourceTable = $this->obj->sourceTable;
	} 
}
?>