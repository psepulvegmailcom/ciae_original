<?php

/********************************************************************************************
			CLASES CONTROLADORES DE BOLETINES DEL HOME
********************************************************************************************/

class Boletin extends Objetos 
{		
	var $sourceTable = "site_boletin";
	
	function Boletin() 
	{
		parent::Objetos();
        $this->dbKey = 'id_boletin';
	} 
	
	function obtenerUltimoBoletinSitio($id_site)
	{
		parent::loadObject(' id_site = "'.$id_site.'" ORDER BY '.$this->dbKey.' DESC');
	}
	
	function guardarObjeto()
	{
		if($this->newObject)
		{
			parent::saveObject();
		}
		else
		{ 
			parent::saveObject("id_boletin = '".$this->id_boletin."' AND id_site = '".$this->id_site."'");
		}
	}            
}

class ControlBoletinSite extends ControlVistas
{
	function ControlBoletinSite()
	{		 
		parent::ControlVistas(); 			
		$this->key 			= 'id_boletin';
		$this->sourceTable  = 'view_boletin_site';
		$this->order		= 'agno DESC, mes DESC, id_boletin DESC ';
		parent::prepararObjecto();			 
	}
	
	
/*	function obtenerListado()
	{
		$Site = new Site();
		$sql = "SELECT a.*, b.* FROM ".$this->sourceTable." AS a, ".$Site->sourceTable." as b
		WHERE a.id_site = b.id_site 
		ORDER BY ".$this->order;
		return parent::getQuery($sql);
		//return parent::obtenerListado();
	}*/
}

class ControlBoletin extends ControlObjetos
{
	var $obj; 	 
	var $idioma = '';
	
	function ControlBoletin() 
	{			
		parent::ControlObjetos();
		$this->obj          = new Boletin();
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'id_boletin DESC';  
	} 
	
	function obtenerElemento($id_boletin, $id_site)
	{ 
		$this->where .= "id_boletin = '".$id_boletin."' AND id_site = '".$id_site."'";
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
	}
	
	function obtenerBoletin($idioma='',$site)
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

class ControlGeneralBoletin extends ControlGeneral
{
	function ControlGeneralBoletin($path_admin,$ControlHtml)
	{
		parent::ControlGeneral($path_admin,$ControlHtml); 			
		$this->valores 		= VarSystem::getPost();
        $this->valoresGet   = VarSystem::getGet();	
        $this->ObjetoClase  = new ControlBoletinSite();
        $this->Objeto  		= new Boletin();  
		
		$this->ControlClase = new ControlBoletinSite();
		$this->ObjetoClase  = new Boletin();
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
		$e->setVariable('caso_form','Ingreso'); 
		if(trim($this->valores['id_item']) != '')
		{
			$e->setVariable('caso_form','Modificaci&oacute;n');
			$elemento = $this->ControlObjeto->obtenerElemento($this->valores['id_item'],$this->valores['id_site']); 
			  
			$elemento[0]['fecha_caducidad_html'] = ControladorFechas::invertirFecha($elemento[0]['fecha_caducidad']);             
           	$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$elemento[0]);
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_site',$listado,$elemento[0],'id_site');                                          

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

             for($i=$total_agno; $i >= 2005; $i--)
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
            
             for($i=1; $i <= $total_orden; $i++)
             {
				$e->addTemplate('bloque_form_mes');
				if ($i < 10){
				$e->setVariable('mes','0'.$i);
                }else{
                $e->setVariable('mes',$i);   
                }
			 }
             
             for($i=$total_agno; $i >= 2005; $i--)
             {
				$e->addTemplate('bloque_form_agno');
				$e->setVariable('agno',$i); 
			 }

		}
		return $e;            
	}
	
	function objetoGuardar()
	{     
        if ($this->valores['id_item']=='')
		{   
		   	$this->ObjetoClase->obtenerUltimoBoletinSitio($this->valores['form_id_site']);
		   	$id_next = $this->ObjetoClase->id_boletin + 1;
			$this->valores['id_item2'] = $id_next; 
			$this->valores['form_id_boletin'] = $id_next; 
		}
		else
		{ 
			$this->valores['id_item2'] = $this->valores['id_item'];  
		} 
        if ($this->valores['forma_imagen']!='')
		{
	        $ext = strtolower(end(explode(".", $this->valores['forma_imagen'])));
	        if ($this->valores['id_item']=='')
			{
				$this->valores['id_item3']='00'; 
			}
			else
			{
				$this->valores['id_item3']=$this->valores['id_item'];
			}

	 	    $archivo_salida = $this->valores['id_item3'].'_'.$this->valores['name_img'].'.'.$ext;
	        $archivo_antiguo = VarSystem::getPathVariables('dir_repositorio').'doc/boletin/'.$archivo_salida;
	        $nuevo_nombre = "boletin"."_".$this->valores['id_item2']."_".$this->valores['form_agno'].$this->valores['form_mes'].".".$ext;
	        $archivo_nuevo = VarSystem::getPathVariables('dir_repositorio').'doc/boletin/'.$nuevo_nombre;
	        unlink("$archivo_nuevo");
	        rename("$archivo_antiguo","$archivo_nuevo");
	        $this->valores['form_archivo'] = $nuevo_nombre;
        }
        //Funciones::mostrarArreglo($this->valores,true);
		parent::objetoGuardar();       
	}
	
	function mostrarListado()
	{  
        $this->arregloCamposBusqueda = array('id_boletin','agno','mes', 'titulo_site');  
        $this->arregloCamposOrdenar  = array(array('agno','A&ntilde;o'), array('titulo_site','Sitio'), array('id_boletin','Bolet&iacute;n'));   
		return parent::mostrarListado();   
	}
    
}

?>