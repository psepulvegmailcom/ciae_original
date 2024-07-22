<?php

/********************************************************************************************
			CLASES CONTROLADORES DE BOLETINES DEL HOME
********************************************************************************************/

class BoletinEspeciales extends Objetos 
{		
	var $sourceTable = "site_boletin_especiales";
	
	function BoletinEspeciales() 
	{
		parent::Objetos();
        $this->dbKey = 'id_boletin';
	} 
            
}

class ControlBoletinEspecialesSite extends ControlVistas
{
	function ControlBoletinEspecialesSite()
	{		 
		parent::ControlVistas(); 			
		$this->key 			= 'id_boletin';
		$this->sourceTable  = 'view_boletin_especiales_site';
		$this->order		= ' id_noticia DESC, agno DESC, mes DESC ';	
		parent::prepararObjecto();		 
	}
}

class ControlBoletinEspeciales extends ControlObjetos
{
	var $obj; 	 
	var $idioma = '';
	
	function ControlBoletinEspeciales() 
	{			
		parent::ControlObjetos();
		$this->obj          = new BoletinEspeciales();
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'id_boletin DESC';  
	} 
	
	function obtenerBoletinEspeciales($idioma='',$site)
	{		
		$this->where = 'activo=1 and tipo="principal"';
		if(trim($idioma) != '')
		{
			$this->where .= " AND (idioma = 'nn' OR idioma = '".$idioma."') AND  id_site=".$site."";
		}
		$this->order = 'orden ASC, rand() ';
		$this->select = " '' as active";
		return parent::obtenerListado();
	} 
	 
} 


class ControlGeneralBoletinEspeciales extends ControlGeneral
{
	function ControlGeneralBoletinEspeciales($path_admin,$ControlHtml)
	{
		parent::ControlGeneral($path_admin,$ControlHtml); 			
		$this->valores 		= VarSystem::getPost();
        $this->valoresGet   = VarSystem::getGet();	
        $this->ObjetoClase  = new ControlBoletinEspeciales();
        $this->Objeto  		= new BoletinEspeciales();  		
		$this->ControlClase = new ControlBoletinEspecialesSite();
		$this->ObjetoClase  = new BoletinEspeciales();
	}

	function eliminarObjeto()
	{ 		
		$this->ObjetoClase->buscarObjeto($this->valores['id_item']);		
		if(trim($this->ObjetoClase->imagen) != '' && file_exists(VarSystem::getPathVariables('dir_repositorio').'doc/boletin/'.$this->ObjetoClase->imagen))
		{
			@unlink(VarSystem::getPathVariables('dir_repositorio').'doc/boletin/'.$this->ObjetoClase->imagen);
		} 
		$this->MantenedoresGeneralObjeto->eliminarObjetoSimple($this->ObjetoClase,$this->valores);		 
	}	
     
	function mostrarFormulario()
	{	  			 
		$e = new miniTemplate($this->path_admin.'formulario.tpl');
        $e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
        $e->setVariable('opcion_modulo',$this->lastAction[0]); 
        $e->setVariable('path_archivo','doc/boletin/'); 
        $e->setVariable('boletin_id',$this->valores['id_item']);  
		$total_orden = 12;
		$total_agno = Date('Y'); 
		$listado = $this->ControlHtml->elUsuarioSitios;
        $this->ObjetoNoticia      = new ControlNoticias();
        $elementoNoticia = $this->ObjetoNoticia->obtenerNoticiasBoletinEspecial();       
        //Funciones::mostrarArreglo($valores,true);
		$e->setVariable('caso_form','Ingreso'); 
		if(trim($this->valores['id_item']) != '')
		{
			$e->setVariable('caso_form','Modificaci&oacute;n');
			$elemento = $this->ControlObjeto->obtenerElemento($this->valores['id_item']);              
           	$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$elemento[0]);            
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_noticia',$elementoNoticia,$elemento[0],'id_noticia');  
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_site',$listado,$elemento[0],'id_site');                          
            //Funciones::mostrarArreglo($elementoNoticia,true); 
             if(trim($elemento[0]['archivo'])!='')
			 {                    
                $e->addTemplate('bloque_form_archivo');
                $e->setVariable('boletin_archivo',$elemento[0]['archivo']); 
             } 
             
             for($i=1; $i <= $total_orden; $i++)
             {
				$e->addTemplate('bloque_form_mes');
                if ($i < 10){
				$e->setVariable('mes','0'.$i);
                }else{
                $e->setVariable('mes',$i);   
                }
				if(($i > 9)&&($elemento[0]['mes'] == $i))
				{
					$e->setVariable('selected','selected');
				}else if(($i < 10)&&($elemento[0]['mes'] == '0'.$i)){
				    $e->setVariable('selected','selected');
				}
			 }
             
             for($i=2005; $i <= $total_agno; $i++)
             {
				$e->addTemplate('bloque_form_agno');
				$e->setVariable('agno',$i);
				if($elemento[0]['agno'] == $i)
				{
					$e->setVariable('selected','selected');
				}
			 }
             
		} 
		else
		{ 
			$listado = array_merge(array(array('id_site' => '','nombre_site' => '', 'titulo_site' => '')),$listado);  
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_site',$listado); 
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_noticia',$elementoNoticia); 
            
             for($i=1; $i <= $total_orden; $i++)
             {
				$e->addTemplate('bloque_form_mes');
				if ($i < 10){
				$e->setVariable('mes','0'.$i);
                }else{
                $e->setVariable('mes',$i);   
                }
			 }
            
             for($i=2005; $i <= $total_agno; $i++)
             {
				$e->addTemplate('bloque_form_agno');
				$e->setVariable('agno',$i); 
			 }

		}
		return $e;            
	}
	
	function objetoGuardar()
	{    
	   $id = $this->ObjetoClase->getLastId('id_boletin');
        if ($this->valores['id_item']==''){  $this->valores['id_item2']=$id+1; }else{ $this->valores['id_item2']=$this->valores['id_item'];  };
        if ($this->valores['forma_imagen']!=''){
        $ext = strtolower(end(explode(".", $this->valores['forma_imagen'])));
        if ($this->valores['id_item']==''){$this->valores['id_item3']='00'; }else{  $this->valores['id_item3']=$this->valores['id_item'];}
 	    $archivo_salida = $this->valores['id_item3'].'_'. $this->valores['name_img'].'.'.$ext;
        $archivo_antiguo = VarSystem::getPathVariables('dir_repositorio').'doc/boletin/'.$archivo_salida;
        $nuevo_nombre = "boletin"."_".$this->valores['id_item2']."_".$this->valores['form_agno'].$this->valores['form_mes'].".".$ext;
        $archivo_nuevo   = VarSystem::getPathVariables('dir_repositorio').'doc/boletin/'.$nuevo_nombre;
        unlink("$archivo_nuevo");
        rename("$archivo_antiguo","$archivo_nuevo");
        $this->valores['form_archivo'] = $nuevo_nombre;
        }
		parent::objetoGuardar();       
	}
	
	function mostrarListado()
	{ 		
		$this->arregloCamposBusqueda = array('titulo','agno','mes','nombre_site');
        $this->arregloCamposOrdenar  = array(array('titulo','T&iacute;tulo'), 
                                array('agno','A&ntilde;o'), 
                                array('mes','Mes'),
                                array('nombre_site','Sitio')); 
		return parent::mostrarListado();   
	}
    
}

?>