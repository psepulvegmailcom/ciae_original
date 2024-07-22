<?php
 
	
	class Noticias extends PersistentObject
	{	
		var $sourceTable = "site_noticias";
		
		function Noticias(){
			parent::PersistentObject();
		}
	}

	/*class ControladorHTMLNoticias  extends ControladorDeObjetos
	{  
		function ControladorNoticias() 
		{  
			$this->path = VarSystem::getPathVariables('dir_template')."general/noticias/";
			$this->control = new ControladorNoticias();
		}
		
		function showNoticia($id_noticia)
		{  
			$tpl = new TemplatePower( $this->path."pub_noticias.tpl" );
			$tpl->prepare();
			$noticia = $this->control->getNoticia($id_noticia); 
			$tpl->assign('noticia_titulo', Funciones::cleanHtmlTxt($noticia->titulo_interno ));
			$tpl->assign('noticia_id_noticia', $noticia->id_noticia); 
			$tpl->assign('noticia_epigrafe', $noticia->epigrafe);
			$tpl->assign('noticia_fecha_noticia', ControladorFechas::invertirFecha($noticia->fecha_noticia));
			$tpl->assign('noticia_fecha_caducidad', ControladorFechas::invertirFecha($noticia->fecha_caducidad));
			 
			$tpl->assign('noticia_noticia',   Funciones::cleanHtmlTxt($noticia->noticia) );
			$tpl->assign('noticia_bajada_noticia', Funciones::cleanHtmlTxt($noticia->bajada_noticia)); 
			 
			if(trim($noticia->imagen_noticia) != '')
			{ 
				$tpl->newBlock( "noticia_bloque_img" );
				$tpl->assign('noticia_imagen_noticia',$noticia->imagen_noticia);
				$tpl->assign('noticia_imagen_noticia_descripcion', Funciones::cleanHtmlTxt($noticia->imagen_noticia_descripcion)); 
				$tpl->assign('noticia_imagen_noticia_lado', $noticia->imagen_noticia_lado);  
			}  
			
			if(trim($noticia->fuente) != '')
			{
				$tpl->newBlock( "noticia_tag_bloque" );
				$tpl->assign('noticia_tag', $noticia->fuente);
				if($noticia->idioma == 'en')
					$tpl->assign('noticia_tag_idioma', 'Source');
				else
					$tpl->assign('noticia_tag_idioma', 'Fuente');
			}
			if(trim($noticia->edicion) != '')
			{
				$tpl->newBlock( "noticia_tag_bloque" );
				$tpl->assign('noticia_tag', $noticia->edicion);
				if($noticia->idioma == 'en')
					$tpl->assign('noticia_tag_idioma', 'Edition');
				else
					$tpl->assign('noticia_tag_idioma', 'Edici&oacute;n');
			}
			if(trim($noticia->autor) != '')
			{
				$tpl->newBlock( "noticia_tag_bloque" );
				$tpl->assign('noticia_tag', $noticia->autor);
				if($noticia->idioma == 'en')
					$tpl->assign('noticia_tag_idioma', 'By');
				else
					$tpl->assign('noticia_tag_idioma', 'Autor');
			}
			
			$tpl->newBlock( "noticia_tag_bloque" );
			$tpl->assign('noticia_tag', ControladorFechas::invertirFecha($noticia->fecha_noticia));
			if($noticia->idioma == 'en')
				$tpl->assign('noticia_tag_idioma', 'Date');
			else
				$tpl->assign('noticia_tag_idioma', 'Fecha'); 
				
			$tpl->gotoBlock( "_ROOT" );	
			return $tpl; 
		}
	}*/

	class ControladorNoticias  extends ControladorDeObjetos
	{ 
 
		var $orderField  = "fecha_noticia";		
		var $obj; 
		function ControladorNoticias() 
		{ 
			/* coneccion interna*/	
			$this->obj 						= new Noticias();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		} 
		 
		function deleteNoticia($id)
		{
			$this->obj->destroyObject("id_noticia=".$id);
		}
		 
		function guardarNoticia()
		{
			if(trim($this->obj->id_noticia) != '')
			{
				$this->obj->newObject = false;
				$this->obj->saveObject('id_noticia='.$this->obj->id_noticia);
			}
			else
			{				
				$this->obj->newObject = true;
				$this->obj->saveObject();
			}
		}
		 
		function getAgnosDisponibles()
		{
			$sql = 'SELECT DATE_FORMAT( fecha_caducidad , "%Y" ) AS fecha 
					FROM  '.$this->sourceTable.'
					GROUP by fecha';

			return parent::getQuery($sql);
		}
		
		function getListaNoticias($idioma='',$publicar=true,$fechacaducidad='')
		{ 
			$order = '  id_noticia DESC';
			$table = '';
			$where = " ( idioma='nn' ";
			if(trim($idioma) != '')
			{
				$where .= "  OR idioma='".$idioma."'  )";
			} 
			else
			{
				$where .= " OR idioma!='nn' ) ";
			} 
		  
			 $where .= " AND publicar = 1 ";	
			//echo $where; 
			return(parent::getArrayObjects($table,$where,$order));
		} 
		
		function getNoticia($id,$completar=true)
		{
			$this->obj->loadObject('id_noticia='.$id);
			if($completar)
			{
				if(trim($this->obj->titulo_interno) == '')
					$this->obj->titulo_interno = $this->obj->titulo;
				if(trim($this->obj->bajada_noticia) == '')
					$this->obj->bajada_noticia = $this->obj->bajada_home;
			}
			$noticia->noticia =  htmlentities($noticia->noticia);
			return $this->obj;
		} 	
	}
	
	class Consultas extends PersistentObject
	{	
		var $sourceTable = "site_consultas";
		
		function Consultas()
		{
			parent::PersistentObject();
		} 
			
		
		function guardarElemento()
		{
			if(!$this->newObject)
			{ 
				parent::saveObject("id_consulta='".$this->id_consulta."'");
			}
			else
			{				  
				parent::saveObject();
			}
		}
		
		function obtenerElemento($id_consulta)
		{
			$this->loadObject("id_consulta =".$id_consulta);
		}
	}
	
	class ControladorConsultas  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorConsultas() 
		{ 	
			$this->obj 			= new Consultas();
			$this->sourceTable 	= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		} 
		
		function obtenerListado($id_consulta='')
		{
			$order = 'respuesta_enviada ASC, fecha DESC';
			$where = '';
			if(trim($id_consulta) != '')
			{
				$where = 'id_consulta='.$id_consulta;
			}
			return parent::getArrayObjects($this->sourceTable,$where,$order); 
		}
	}
	

?>