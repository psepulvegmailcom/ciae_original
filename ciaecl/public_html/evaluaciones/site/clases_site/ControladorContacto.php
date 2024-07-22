<?php
class ControladorContacto
{
	function ControladorContacto()
	{
		$this->template = 'contacto_respaldo.tpl'; 
		$this->tipo 	= 'contacto';
		$this->asunto 	= 'Contacto Sitio';
		$this->extra	= ''; 
	}
	
	function envioDocumentos($extra)
	{
		$this->template 	= 'contacto_respaldo.tpl'; 
		$this->tipo 		= 'documento_trabajo';	
		$this->asunto 		= 'Comentario Documento de Trabajo Sitio ';
		$this->extra		= "  (".$extra.")";
	}	
	
	function enviarContacto($valores)
	{
		$valores['email'] = trim($valores['email']);
		$valores['mensaje'] = $valores['mensaje'].$this->extra;
  		$mensaje 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').$this->template);
  		$mensaje->setVariable('nombre',$valores['nombre']);
  		$mensaje->setVariable('email',$valores['email']);
  		$mensaje->setVariable('mensaje',$valores['mensaje']); 
		Funciones::sendEmail($valores['email'],$this->asunto.VarConfig::site_title,$mensaje->toHtml());
		
		//Funciones::mostrarArreglo($cartaContacto->toHtml());
		
		$Contacto = new Contacto();
		$Contacto->nombre 	= $valores['nombre'];
		$Contacto->email 	= $valores['email'];
		$Contacto->mensaje 	= $valores['mensaje'];
		$Contacto->tipo = $this->tipo;
		$Contacto->agregarObjeto();
		
		$ControladorInscripcionBase = new ControladorInscripcionBase();
		$ControladorInscripcionBase->insertarContacto($valores['nombre'],$valores['email']);			 
		
	}
}
?>