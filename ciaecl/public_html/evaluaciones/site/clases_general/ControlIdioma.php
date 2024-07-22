<?php

class ControlIdioma
{
	var $valores;

	function ControlIdioma($idioma='nn')
	{
		$filename = VarSystem::getPathVariables('path_lang').'es_lang.php'; /**** LENGUAJE NEUTRO *****/
		require_once $filename;
		$this->valores	= $valoresIdioma;
		$this->idioma 	= $idioma;  
		$filename_extra = VarSystem::getPathVariables('path_lang').$this->idioma.'_lang.php';
		if(file_exists($filename_extra))
		{
			require_once $filename_extra;
		}	 
		$this->valores = array_merge($this->valores,$valoresIdioma);
		
	}
	
	function obtenerIdioma()
	{
		return $this->idioma;
	}

	function obtenerVariable($variable)
	{
		$valor = '';
		if(isset($this->valores[$variable]))
		{
			$valor = $this->valores[$variable];
		}
		//Funciones::mostrarArreglo($this->valores);	
		if(!is_array($valor))
		{
			$valor = trim($valor);
		}
		return  $valor ;
	}
	 
	function publicarTextoTemplate($e,$lang='')
	{ 
		//$e->refreshTemplate();
		if(trim($lang) != '')
		{					
			$e->setVariable('menu_lang',$lang);
		} 
		foreach($this->valores as $var => $val)
		{ 
			if(is_array($val))
			{
				continue;
			}
			$e->setVariable('lang_'.$var,$val);				
		}
		return $e;
	}
	 
}
?>