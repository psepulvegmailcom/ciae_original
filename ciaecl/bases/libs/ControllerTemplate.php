<?php
 
	
	class miniTemplate extends TemplatePower
	{
		function miniTemplate($file) 
		{			
			parent::TemplatePower($file);	
			parent::prepare();  
			$this->template_file = $file;
			$this->obtenerVariableTemplate();
			$this->publicarVariableIdioma(); 
		}
		
		function publicarVariableIdioma($bloque='_ROOT')
		{
			global $ControlHtml; 
			if(!isset($ControlHtml))
			{ 
				/* PARA SITIOS ESTERNOS QUE NO UTILIZAN ControlHtml*/
				//$ControlHtml = new ControlHtml();
			 	$ControlHtml->ControlIdioma = new ControlIdioma(); 
			} 
			
			$prefijo = 'langSite'; 
			//Funciones::mostrarArreglo(array($bloque,$this->template_file,$this->variables),true); 
			$variables_bloque = $this->variables[$bloque];
			//Funciones::mostrarArreglo($variables,true);
			
			$this->setVariable('langSiteEspecial_seleccionado',VarSystem::obtenerIdiomaActual()); 
			
			
			$this->setVariable('langSiteEspecial_url_completo_idioma_traducir','n.n');
			if(VarSystem::obtenerIdiomaActual() != 'es')
			{
				$this->setVariable('langSiteEspecial_url_completo_unicode',Funciones::cleanCharURL(VarSystem::getUrl()));
				$this->setVariable('langSiteEspecial_url_completo_idioma_traducir',VarSystem::obtenerIdiomaActual());
				$this->setVariable('langSiteEspecial_url_completo_idioma_origen','es');
				$this->setVariable('langSiteEspecial_traducir_google',$ControlHtml->ControlIdioma->obtenerVariable('traducir_google'));
			} 
			if(array($variables_bloque) && count($variables_bloque) > 0)
			{
				//Funciones::mostrarArreglo($variables_bloque,true);
				foreach($variables_bloque as $i => $variable)
				{
					//echo $i.' '.$variable.'<br>lllllll ';
					$aux = explode('_',$variable);
					//Funciones::mostrarArreglo($aux,true);
					if($aux[0] == $prefijo)
					{  
						unset($aux[0]);
						$variable_idioma = implode('_',$aux); 
						//echo $variable.' '.$variable_idioma.'<br>';
						$this->setVariable($variable,$ControlHtml->ControlIdioma->obtenerVariable($variable_idioma));
					} 
				}  
			}
		} 
		
		function setVariable($tag,$value) 
		{
			parent::assign($tag,$this->cleanHtml($value));
		}
		
		function toHtml()
		{			
			$output = parent::getOutputContent(); 
			return $output;
		}
		
		private function cleanHtml($valor)
		{  
			return Funciones::TextoSimple(Funciones::cleanHtml($valor));			
		}
				
		function printHtml()
		{
			echo parent::getOutputContent();
		}	
		
		function addTemplate($block)
		{ 
			parent::newBlock($block);  
			$this->publicarVariableIdioma($block);	 					 
		}
		
		function refreshTemplate() {
			parent::gotoBlock( "_ROOT" );		
		}		
		
		function showDataSimple($data)
		{  
			foreach($data as $var => $val)
			{  
				$this->setVariable($var, $this->cleanHtml(trim($val)));  
			}		  
		}

		function showData($data)
		{ 
			$this->refreshTemplate(); 
			foreach($data as $var => $val)
			{ 
				if(is_array($val))
				{
					$this->showBlock($var,$val);
				}
				else
				{ 
					 $this->setVariable($var,$this->cleanHtml($val)); 
				}
			}		 
			$this->refreshTemplate(); 
		}

		function showBlock($bloque,$data,$html_decode = false)
		{   		 			
			if(is_array($data))
			{
				$this->refreshTemplate(); 		
				$total = count($data);				
				for($i=0; $i < $total; $i++)
				{
					$this->addTemplate($bloque); 
					$aux = $i + 1; 
					$this->setVariable("fila",trim($aux));
					$fila_color = 'fila_fondo_claro';
					if($i%2 == 0)						
					{					
						$fila_color = 'fila_fondo_oscuro'; 
					} 				
					$this->setVariable('class_color',$fila_color);  
					 
					foreach($data[$i] as $var => $val)
					{ 	 
						$val = $this->cleanHtml($val);
						if($html_decode)
							$val = html_entity_decode($val);
						$this->setVariable($var,$val); 
					}
				}
				$this->refreshTemplate();
			}
		}

		function showBlockSelect($bloque,$data,$selected='')
		{    		 
			$this->refreshTemplate(); 
			foreach($data as $id => $valor)
			{   				
				$this->addTemplate($bloque); 			 
				$this->setVariable("id",$id); 
				$this->setVariable("valor",$this->cleanHtml($valor)); 
				if($selected == $id)
				{
					$this->setVariable('selected','selected');
					$this->setVariable('checked','checked');
				}			 
			}
			$this->refreshTemplate();  
		} 
		
		function obtenerVariableTemplate()
		{
			$this->variables = array();
			$bloques = $this->index;
			//Funciones::mostrarArreglo($bloques,true);
			foreach($bloques as $bloque => $i)
			{
				$definiciones = $this->defBlock[$bloque];
				//Funciones::mostrarArreglo($definiciones,true);	
				$this->variables[$bloque] = array();
				foreach($definiciones as $tipo => $valor)
				{
					$aux = explode('_',$tipo);
					$aux = explode(':',$aux[1]);
					if($aux[0] == 'V')
					{
						$aux2 = explode('_',$valor);
						//Funciones::mostrarArreglo($aux2,true);
						$this->variables[$bloque][] = $valor;
					} 	
				}
			}   
			//Funciones::mostrarArreglo($variables,true); 
		} 
		
		function obtenerVariables()
		{
			return $this->variables;
		}
	}	

?>