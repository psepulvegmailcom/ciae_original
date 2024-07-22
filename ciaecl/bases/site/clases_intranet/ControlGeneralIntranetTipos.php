<?php

	class ControlGeneralMantenedorTipos extends ControlGeneral
	{
		function ControlGeneralMantenedorTipos($path_admin,$ControlHtml)
		{
			parent::ControlGeneral($path_admin,$ControlHtml); 
			$this->valoresGet   = VarSystem::getGet();	 
			$this->tipo_palabras_clave = '';					
		}
		
		function objetoGuardar()
		{			
	 		if(trim($this->valores['id_item']) != '')
	 		{ 
				$this->ObjetoClase->buscarObjeto($this->valores['id_item']); 
			}
			foreach($this->valores as $var => $val)
			{
				$aux = explode('_',$var,2);
	
				if($aux[0] == 'form')
				{
					$this->ObjetoClase->$aux[1] = $val;
				}
			} 
			if(trim($this->valores['id_item']) != '')
	 		{
				/** edici&oacute;n elemento */            
				$this->ObjetoClase->guardarObjeto($this->valores['id_item']);
			}
			else
			{
	
				$this->ObjetoClase->guardarObjeto();
			}
		}  
		
		function mostrarListado($form_especial)
		{  
			$e = new miniTemplate($this->path_admin.'mant'.$form_especial.'.tpl'); 
			$e->setVariable('opcion_modulo',$this->lastAction[0]); 
			$ListaDeObjetos = $this->ControlClase->obtenerListado();
			 
			// Funciones::mostrarArreglo($ListaDeObjetos[1]);
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$total = count($ListaDeObjetos);  
				for($i=0; $i < $total; $i++)
				{
					$e->addTemplate('lista_item');
					$ListaDeObjetos[$i]['fila'] = $i + 1; 
					$ListaDeObjetos[$i]['id_item'] = $ListaDeObjetos[$i][$this->ObjetoClase->dbKey];
					$e->setVariable('opcion_modulo',$this->lastAction[0]);
					foreach($ListaDeObjetos[$i] as $var => $val)
					{
						$e->setVariable($var,trim($val));
					}  
					if($i%2 == 0)						
					{
						$e->setVariable('class_color','fondo_oscuro');
					}
				}	
			}
			return $e;	  
		}
		
		function mostrarFormularioCentroCosto($form_especial)
		{
			//Funciones::mostrarArreglo($this,true);
			$ControlSitio = new ControlSite;            
            $ListaSitios = $ControlSitio->ListarSite();
            $totalSitio = count($ListaSitios);
			$e = new miniTemplate($this->path_admin.'form'.$form_especial.'.tpl'); 
			$e->setVariable('opcion_modulo',$this->lastAction[0]); 
			$ListaDeObjetos = $this->ControlClase->obtenerElemento($this->valores['id_item']); 
  			
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$this->ObjetoClase->dbKey];
			$ListaDeObjetos[0]['activo_html'] = 'No activo';
			if($ListaDeObjetos[0]['activo'] == '1')
			{
				$ListaDeObjetos[0]['activo_html'] = 'Activo';
			}
			foreach($ListaDeObjetos[0] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}   
			for($i=2007; $i  <= date("Y") ; $i++)
			{                
				$e->addTemplate('bloque_form_agno_inicio');
				$e->setVariable('agno',$i); 
				if($i == $ListaDeObjetos[0]['agno_inicio'])
				{
					$e->setVariable('selected','selected');
				}
				$e->addTemplate('bloque_form_agno_fin');
				$e->setVariable('agno',$i); 
				if($i == $ListaDeObjetos[0]['agno_fin'])
				{
					$e->setVariable('selected','selected');
				}
			}  
			$ControlGestionPersonasVista = new ControlGestionPersonasVista();
			$usuarios = $ControlGestionPersonasVista->obtenerUserId();
			//Funciones::mostrarArreglo($usuarios,true);
			$total = count($usuarios);  
			for($i=0; $i  < $total; $i++)
			{                
				$e->addTemplate('bloque_form_usuario_responsable'); 
				foreach($usuarios[$i] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}   
				if($usuarios[$i]['user_id'] == $ListaDeObjetos[0]['usuario_responsable'])
				{
					$e->setVariable('selected','selected');
				} 
			}  
			return $e;
		}
		
		function mostrarFormulario($form_especial,$ultimaAction)
		{
			//Funciones::mostrarArreglo($this,true);
			$ControlSitio = new ControlSite;            
            $ListaSitios = $ControlSitio->ListarSite();
            $totalSitio = count($ListaSitios);
			$e = new miniTemplate($this->path_admin.'form'.$form_especial.'.tpl'); 
			$e->setVariable('opcion_modulo',$ultimaAction); 
			$ListaDeObjetos = $this->ControlClase->obtenerElemento($this->valores['id_item']); 
  			
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$this->ObjetoClase->dbKey];
			$ListaDeObjetos[0]['activo_html'] = 'No activo';
			if($ListaDeObjetos[0]['activo'] == '1')
			{
				$ListaDeObjetos[0]['activo_html'] = 'Activo';
			}
			foreach($ListaDeObjetos[0] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}   
			for($i=1; $i  < 30 ; $i++)
			{                
				$e->addTemplate('bloque_form_orden');
				$e->setVariable('orden',$i); 
				if($i == $ListaDeObjetos[0]['orden'])
				{
					$e->setVariable('selected','selected');
				}
			} 
            for($i=0; $i  < $totalSitio ; $i++)
			{                
				$e->addTemplate('bloque_form_sitio');
				$e->setVariable('id_site',$ListaSitios[$i]['id_site']); 
                $e->setVariable('titulo_site',$ListaSitios[$i]['titulo_site']);
				if($ListaDeObjetos[0]['id_site'] == $ListaSitios[$i]['id_site'])
				{ 
					$e->setVariable('selected','selected');
				}
			} 
			return $e;
		}
	}

?>