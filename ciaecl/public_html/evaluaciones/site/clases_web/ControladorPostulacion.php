<?php

	
 	/** **************************************************************************************
	 *
	 * Postulacion
	 *   
	 * @author Paulina Sep�lveda - psepulve@gmail.com  
	 * @copyright 2015 
	 * @info objeto base de Postulacion
	 *
	 *****************************************************************************************/
	 
	class Postulacion extends Objetos
	{	
		var $sourceTable = 'site_postulaciones';	
		
		/**
		* Postulacion::Postulacion()		
		* @info inicializaci�n del objeto  
		* @return void
		*/
		function Postulacion()
		{
			parent::Objetos();
			$this->dbKey	= 'email';
		} 
	} 

	/** **************************************************************************************
	 *
	 * ControlPostulacion
	 *  
	 * @author Paulina Sep�lveda - psepulve@gmail.com 
	 * @copyright 2015 
	 * @info Controlador de objeto base de Postulacion
	 *
	 *****************************************************************************************/
	 
	class ControlPostulacion extends ControlObjetos
	{
		/**
		* ControlPostulacion::ControlPostulacion()
		* @info inicializaci�n del objeto control
		* @return void
		*/	
		function ControlPostulacion()
		{
			parent::ControlObjetos();
			$this->obj	    = new Postulacion();
			parent::prepararObjeto();  
			$this->order	= 'apellidos ASC';		
		}	 
	}
	

?>