<?php

	
 	/** **************************************************************************************
	 *
	 * Postulacion
	 *   
	 * @author Paulina Sepulveda - psepulve@gmail.com  
	 * @copyright 2015 
	 * @info objeto base de Postulacion
	 *
	 *****************************************************************************************/
	 
	class Postulacion extends Objetos
	{	
		var $sourceTable = 'site_postulaciones';	
		
		/**
		* Postulacion::Postulacion()		
		* @info inicializacion del objeto  
		* @return void
		*/
		function Postulacion()
		{
			parent::Objetos();
			$this->dbKey	= 'email';
		} 
		
		function buscarPostulacion($email_md5,$postulacion)
		{
			parent::loadObject(' email_md5 = "'.$email_md5.'" AND postulacion = "'.$postulacion.'"'); 
		}
		
		function buscarPostulacionEmail($email,$postulacion)
		{
			parent::loadObject(' email = "'.$email.'" AND postulacion = "'.$postulacion.'"'); 
		}
	} 

	/** **************************************************************************************
	 *
	 * ControlPostulacion
	 *  
	 * @author Paulina Sepulveda - psepulve@gmail.com 
	 * @copyright 2015 
	 * @info Controlador de objeto base de Postulacion
	 *
	 *****************************************************************************************/
	 
	class ControlPostulacion extends ControlObjetos
	{
		/**
		* ControlPostulacion::ControlPostulacion()
		* @info inicializacion del objeto control
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