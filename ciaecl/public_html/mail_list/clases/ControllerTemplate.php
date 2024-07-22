<?
	
	class miniTemplate extends TemplatePower
	{
		function miniTemplate($file) 
		{			
			parent::TemplatePower($file);	
			parent::prepare();									
		}
		
		function setVariable($tag,$value) 
		{
			parent::assign($tag,$this->cleanHtml($value));
		}
		
		function toHtml()
		{
			$output = parent::getOutputContent();
			//$output = htmlspecialchars_decode(	htmlentities($output));
			return $output;
		}
		
		private function cleanHtml($valor)
		{  
			return $valor;			
		}
				
		function printHtml()
		{
			echo parent::getOutputContent();
		}		
		
		function addTemplate($block)
		{
			parent::newBlock($block);					 
		}
		
		function refreshTemplate() {
			parent::gotoBlock( "_ROOT" );		
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
					$this->setVariable("fila",$aux);
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
	}	

?>