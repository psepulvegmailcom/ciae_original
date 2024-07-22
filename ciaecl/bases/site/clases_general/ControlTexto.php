<?php

class Textos extends Objetos
{		
	var $sourceTable = "site_textos";
	
	function Textos() 
	{
		parent::Objetos();
        $this->dbKey = 'id_texto';
	}	
}

class ControlTextos extends ControlObjetos
{
	function ControlTextos()
	{
		parent::ControlObjetos();
		$this->obj = new Textos(); 
		$this->key 		= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	} 
}

class ControlGeneralTextos extends ControlGeneral
{
	function ControlGeneralTextos($path_admin,$ControlHtml)
	{
		parent::ControlGeneral($path_admin,$ControlHtml); 			
		$this->valores 		= VarSystem::getPost();	 
		$this->ControlClase = new ControlTextos();
		$this->ObjetoClase  = new Textos();
        $this->FormGeneral  = new FormGeneral(); 
	}

	function eliminarObjeto()
	{ 
		
		$this->ObjetoClase->buscarObjeto($this->valores['id_item']);
		
		if(trim($this->ObjetoClase->imagen) != '' && file_exists(VarSystem::getPathVariables('dir_repositorio').'image/banner/'.$this->ObjetoClase->imagen))
		{
			@unlink(VarSystem::getPathVariables('dir_repositorio').'image/banner/'.$this->ObjetoClase->imagen);
		} 
		$this->MantenedoresGeneralObjeto->eliminarObjetoSimple($this->ObjetoClase,$this->valores);
		 
	}	
     
	function mostrarFormulario()
	{	  			 
		$e = new miniTemplate($this->path_admin.'formulario.tpl');
        $e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
        $e->setVariable('opcion_modulo',$this->lastAction[0]); 
        $e->setVariable('path_imagen','image/noticias/'); 
        $e->setVariable('texto_id',$this->valores['id_item']);  
		$total_orden = 20;
		 
		$listado = $this->ControlHtml->elUsuarioSitios;       
        //Funciones::mostrarArreglo($this->lastAction[0],true);
		$e->setVariable('caso_form','Ingreso'); 
		if(trim($this->valores['id_item']) != '')
		{
			$e->setVariable('caso_form','Modificaci&oacute;n');
            $e->setVariable('form_texto_editor',$this->FormGeneral->showEditorHTML('texto_edicion'));  
			$elemento = $this->ControlObjeto->obtenerElemento($this->valores['id_item']);   
			$elemento[0]['fecha_caducidad_html'] = ControladorFechas::invertirFecha($elemento[0]['fecha_caducidad']);             
           	$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$elemento[0]);
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_site',$listado,$elemento[0],'id_site'); 
                                                   
             if(trim($elemento[0]['imagen'])!='')
			 {                    
                $e->addTemplate('bloque_form_imagen');
                $e->setVariable('imagen',$elemento[0]['imagen']); 
             } 
             
             for($i=0; $i <= $total_orden; $i++)
             {
				$e->addTemplate('bloque_form_orden');
				$e->setVariable('orden',$i);
				if($elemento[0]['orden'] == $i)
				{
					$e->setVariable('selected','selected');
				}
			 }
		} 
		else
		{ 
			$listado = array_merge(array(array('id_site' => '','nombre_site' => '', 'titulo_site' => '')),$listado); 
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_site',$listado); 
            $e->setVariable('form_texto_editor',$this->FormGeneral->showEditorHTML('form_texto_es'));
             for($i=0; $i <= $total_orden; $i++)
             {  
				$e->addTemplate('bloque_form_orden');
				$e->setVariable('orden',$i); 
			}
		}
		return $e;            
	}
	
	function objetoGuardar()
	{ 	
		parent::objetoGuardar();
	}
	
	function mostrarListado()
	{
        //$where = $this->obtenerWhereSqlSite();
	   	//$this->ControlClase->where = $where;
        $order = 'id_texto ASC';
	    $this->ControlClase->order = $order;     
		$e = parent::mostrarListado();
		return $e;
	}
    
}

?>