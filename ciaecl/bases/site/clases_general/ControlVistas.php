<?php

	/**
	 * ControlVistas
	 *
	 * @package ciae_web
	 * @author 
	 * @copyright 2016
	 * @version $Id$
	 * @access public
	 */
	class ControlVistas extends ControlObjetos 
	{
		var $obj; 	 
		 
		function ControlVistas($vista='') 
		{			
			parent::ControlObjetos(); 
			$this->key 			= '';
			$this->sourceTable  = '';
			$this->order		= '';			
			$this->obj 			= new Objetos(); 
			$this->sourceTable  = $vista;  
		}  
		
		function prepararObjecto()
		{
			$this->obj->sourceTable = $this->sourceTable;
			$this->obj->dbKey	 	= $this->key;
		}
		
		function eliminarVacias()
		{
			
		}
	}
	
	 
?>