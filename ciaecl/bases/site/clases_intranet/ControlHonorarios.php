<?php

	/****************************** CLASES VERSION ANTIGUAS DE HONORARIOS, YA NO SE UTILIZAR&Aacute;N ******************************************/
	class Honorarios extends PersistentObject
	{	
		var $sourceTable = "site_honorario_personas";
		
		function Honorarios()
		{
			parent::PersistentObject();
		}

		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("rut='".$this->rut."'");
			}
			else
			{				  
				$this->saveObject();
			}
		}	
		
		function consultaHonorariosRut($rut)
		{
			$this->loadObject("rut ='".$rut."'");
		}	 
	}
	
	class ControladorHonorarios  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorHonorarios() 
		{  	
			$this->obj 				= new Honorarios();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'rut';
			parent::ControladorDeObjetos();
		}     
	}   

	class HonorariosTitulo extends PersistentObject
	{	
		var $sourceTable = "site_honorario_personas_titulo";
		
		function HonorariosTitulo()
		{
			parent::PersistentObject();
		}  


		function consultaHonorariosRutOrden($rut,$orden)
		{
			$this->loadObject("rut ='".$rut."' AND orden ='".$orden."'");
		}	 	


		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("rut='".$this->rut."' AND orden = ".$this->orden );
			}
			else
			{				  
				$this->saveObject();
			}
		}				
	}	
	
	
	class ControladorHonorariosTitulo  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorHonorariosTitulo() 
		{  	
			$this->obj 				= new HonorariosTitulo();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'rut';
			parent::ControladorDeObjetos();
		}     
		
		function obtenerTitulos($rut)
		{
			$where = "rut = '".$rut."'"; 
			$order = 'orden';
			return parent::getArrayObjects($this->sourceTable,$where,$order) ;
			
		}
	} 

	class HonorariosLabores extends PersistentObject
	{	
		var $sourceTable = "site_honorario_personas_labores";
		
		function HonorariosLabores()
		{
			parent::PersistentObject();
		}  
		
		function consultaHonorariosRutOrden($rut,$orden)
		{
			$this->loadObject("rut ='".$rut."' AND orden ='".$orden."'");
		}	 	

		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("rut='".$this->rut."' AND orden = ".$this->orden );
			}
			else
			{				  
				$this->saveObject();
			}
		}
	}
	
	class ControladorHonorariosLabores  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorHonorariosLabores() 
		{  	
			$this->obj 				= new HonorariosLabores();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'rut';
			parent::ControladorDeObjetos();
		}     
		
		function obtenerLabores($rut)
		{
			$where = "rut = '".$rut."'"; 
			$order = 'orden';
			return parent::getArrayObjects($this->sourceTable,$where,$order) ;
			
		}
	} 	
	
	/************************************************************************/
	
	class GestionTipoHonorariosCalidad extends Objetos
	{
		var $sourceTable =  'site_tipo_honorarios_calidad';
		
		function GestionTipoHonorariosCalidad()
		{ 
			parent::Objetos();
			$this->dbKey 		= 'id_tipo_honorarios_calidad';
		} 
	} 	
	
	class ControlGestionTipoHonorariosCalidad extends ControlObjetos
	{
		function ControlGestionTipoHonorariosCalidad()
		{
			parent::ControlObjetos();
			$this->obj 		= new GestionTipoHonorariosCalidad();
			$this->order 	= 'tipo_honorarios_calidad';		
			parent::prepararObjeto(); 
		} 
	}  
	
	class GestionTipoHonorariosEstados extends Objetos
	{
		var $sourceTable =  'site_tipo_honorarios_estados';
		
		function GestionTipoHonorariosEstados()
		{ 
			parent::Objetos();
			$this->dbKey 		= 'id_tipo_honorarios_estados';
		} 
	} 	
	
	class ControlGestionTipoHonorariosEstados extends ControlObjetos
	{
		function ControlGestionTipoHonorariosEstados()
		{
			parent::ControlObjetos();
			$this->obj 		= new GestionTipoHonorariosEstados();
			$this->order 	= 'tipo_honorarios_estados';		
			parent::prepararObjeto(); 
		} 
	}  
	
	class GestionHonorarios extends Objetos
	{
		var $sourceTable =  'site_gestion_honorarios';
		
		function GestionHonorarios()
		{ 
			parent::Objetos();
			$this->dbKey 		= 'id_honorario';
		} 
		
		function buscarConvenio($numero_convenio)
		{
			parent::buscarPorValor('numero_convenio',$numero_convenio);
		}
		
		function guardarImportacion()
		{ 
			$this->newObject = false; 
			$where = "numero_convenio = '".$this->numero_convenio."'  ";
			return $this->guardarObjetoGenerico($where);
		}
	} 	
	
	class ControlGestionHonorarios extends ControlObjetos
	{
		function ControlGestionHonorarios()
		{
			parent::ControlObjetos();
			$this->obj 		= new GestionHonorarios();
			$this->order 	= 'fecha_creacion DESC, numero_convenio';		
			parent::prepararObjeto(); 
		} 
		
	} 
	
	class GestionHonorariosCuotas extends Objetos
	{
		var $sourceTable =  'site_gestion_honorarios_cuotas';
		
		function GestionHonorariosCuotas()
		{ 
			parent::Objetos();
			$this->dbKey 		= 'id_honorarios';
		} 
		
		function buscarHonorarioCuota($id_honorario,$cuota)
		{
			parent::loadObject(' id_honorario = "'.$id_honorario.'" AND numero_cuota = "'.$cuota.'"');
		} 
		
		function guardarCuotas($id_honorario,$cuota)
		{
			parent::saveObject(' id_honorario = "'.$id_honorario.'" AND numero_cuota = "'.$cuota.'"');
		}
	} 	
	
	class ControlGestionHonorariosCuotas extends ControlObjetos
	{
		function ControlGestionHonorariosCuotas()
		{
			parent::ControlObjetos();
			$this->obj 		= new GestionHonorarios();
			$this->order 	= 'numero_agno ASC,numero_mes ASC';		
			parent::prepararObjeto(); 
		} 
	} 
	
	class ControlGestionHonorariosPersonas extends ControlVistas
	{
		function ControlGestionHonorariosPersonas()
		{		 
			parent::ControlVistas(); 			
			$this->key 			= 'id_honorario';
			$this->sourceTable  = 'view_gestion_honorarios_personas';
			$this->order		= 'fecha_creacion DESC, numero_convenio'; 
			parent::prepararObjecto();		 
		}
		
		function obtenerNoEnviados()
		{
			$this->where = "envio_correo_general = 0 AND id_tipo_estados_honorarios = 'aprobado' ";
			return parent::obtenerListado();
		}
	}
	
	class ControlGestionHonorariosPersonasCuotas extends ControlVistas
	{
		function ControlGestionHonorariosPersonasCuotas()
		{		 
			parent::ControlVistas(); 			
			$this->key 			= 'id_honorario';
			$this->sourceTable  = 'view_gestion_honorarios_personas_cuotas';
			$this->order		= 'id_honorario DESC, numero_cuota,numero_agno,numero_mes '; 
			parent::prepararObjecto();		 
		}
		
		function obtenerCuotasConvenio($id_honorario)
		{
			$this->where = "id_honorario =  ".$id_honorario;
			return parent::obtenerListado();
		}
		
		function obtenerCuotaConvenio($id_honorario,$cuota)
		{
			$this->where = "id_honorario =  ".$id_honorario." AND numero_cuota = ".$cuota;
			return parent::obtenerListado();
		}
		
		function obtenerEnvioBoletas()
		{ 
			$this->where = "envio_correo_general = 1 AND estado = 'pendiente' AND numero_agno <= ".date("Y")." AND numero_mes  <= 2 ";
		//	$this->where = "envio_correo_general = 1 AND estado = 'pendiente' AND numero_agno <= ".date("Y")." AND numero_mes  <= ".date("m")." ";
			return parent::obtenerListado();
		}
	}


?>