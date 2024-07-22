<?php
 	  
	class ControlDocumentoWord 
	{
		function ControlDocumentoWord()
		{			 
			$this->path_informe_template 	= VarSystem::getPathVariables('dir_repositorio').'doc/documentos_template/';
			$this->path_tmp 				= VarSystem::getPathVariables('dir_repositorio_tmp');  
		} 
		
		function prepararTemplate($archivo)
		{
			$this->PHPWord = new PHPWord();			 
			$this->nombre_archivo = $archivo;
			$this->document = $this->PHPWord->loadTemplate($this->path_informe_template.$archivo.'.docx',$this->path_tmp); 
		}
		
		function setValue($variable,$valor)
		{
			//print_r($this->document);
			$this->document->setValue($variable,$valor);  
		} 
		
		function generarDocumento($archivo_tmp='')
		{		   
			if(trim($archivo_tmp) != '')
			{
				$archivo = $archivo_tmp.'-'.time().'.docx';
			}
			else
			{				
				$archivo = $this->nombre_archivo.'-'.time().'.docx';
			}
			$this->document->save($this->path_tmp.$archivo); 
			return $archivo; 	     
		} 
	}
	
?>