<?php

/********************************************************************************************
			CLASES CONTROLADORES DE BANNER DEL HOME
********************************************************************************************/

class Banner extends Objetos
{
	var $sourceTable = "site_banner";

	function Banner()
	{
		parent::Objetos();
        $this->dbKey = 'id_banner';
	}
}

class ControlBannerSite extends ControlVistas
{
	function ControlBannerSite()
	{
		parent::ControlVistas();
		$this->key 			= 'id_banner';
		$this->sourceTable  = 'view_bannner_site';
		$this->order		= 'activo DESC,id_site,tipo DESC, orden,idioma ASC';
		parent::prepararObjecto();
	}
}

class ControlBanner extends ControlObjetos
{
	var $obj;
	var $idioma = '';

	function ControlBanner()
	{
		parent::ControlObjetos();
		$this->obj          = new Banner();
        $this->key 			= $this->obj->dbKey;
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'id_banner DESC';
	}

	function obtenerBannerPie($idioma='',$site)
	{
		$this->where = 'activo=1 and tipo="pie"';
		if(trim($idioma) != '')
		{
			$this->where .= " AND (idioma = 'nn' OR idioma = '".$idioma."') AND  id_site=".$site."";
		}
		$this->order = 'orden ASC, rand()  ';
		$this->select = " '' as active";
		return parent::obtenerListado();
	}

	function obtenerBanner($idioma='',$site)
	{
		$this->where = 'activo=1 and tipo="principal"';
		if(trim($idioma) != '')
		{
			$this->where .= " AND (idioma = 'nn' OR idioma = '".$idioma."') AND  id_site=".$site."";
		}
		$this->order = 'orden ASC, rand() ';
		$this->select = " '' as active";

		$output = parent::obtenerListado();
		for($i=0; $i < count($output);$i++)
		{
			$output[$i]['link'] = str_replace("&amp","&",$output[$i]['link']);
			$output[$i]['link'] = str_replace("&amp","&",$output[$i]['link']);

			$output[$i]['link'] = str_replace("&externo=banner","",$output[$i]['link']);
			$output[$i]['link'] = str_replace("externo=banner","",$output[$i]['link']);
			// $output[$i]['link'] = $output[$i]['link']."&externo=banner";
		}

		return $output;
	}

	function caducarBanner($fecha,$id_site)
	{
		$where_string = "fecha_caducidad <= '".$fecha."' AND activo = 1 AND fecha_caducidad > '0000-00-00' AND id_site = '".$id_site."' ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET activo = 0 WHERE ".$where_string;
		//echo $sql.'<br>';
		parent::getQuery($sql);
	}
}

class ControlGeneralBanner extends ControlGeneral
{
	function ControlGeneralBanner($path_admin,$ControlHtml)
	{
		parent::ControlGeneral($path_admin,$ControlHtml);
		$this->valores 		= VarSystem::getPost();
        $this->valoresGet   = VarSystem::getGet();
        $this->ObjetoClase  = new ControlBanner();
        $this->Objeto  		= new Banner();

		$this->ControlClase = new ControlBannerSite();
		$this->ObjetoClase  = new Banner();
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
        $e->setVariable('path_imagen','image/banner/');
        $e->setVariable('banner_id',$this->valores['id_item']);
		$total_orden = 20;

		$listado = $this->ControlHtml->elUsuarioSitios;
        //$listado = $this->ObjetoSitio->obtenerListado();
        //Funciones::mostrarArreglo($listado,true);
		$e->setVariable('caso_form','Ingreso');
		if(trim($this->valores['id_item']) != '')
		{
			$e->setVariable('caso_form','Modificaci&oacute;n');
			$elemento = $this->ControlObjeto->obtenerElemento($this->valores['id_item']);
			$elemento[0]['fecha_caducidad_html'] = ControladorFechas::invertirFecha($elemento[0]['fecha_caducidad']);
           	$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$elemento[0]);
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_site',$listado,$elemento[0],'id_site');
           // Funciones::mostrarArreglo($listado,true);
             if(trim($elemento[0]['imagen'])!='')
			 {
                $e->addTemplate('bloque_form_imagen');
                $e->setVariable('banner_imagen',$elemento[0]['imagen']);
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
		$this->valores['form_link'] = str_replace(';','',$this->valores['form_link']);
		parent::objetoGuardar();
	}

	function mostrarListado()
	{
        $this->arregloCamposBusqueda = array('titulo','bajada','tipo','nombre_site');

        $this->arregloCamposOrdenar = array(array('titulo','T&iacute;tulo'),
                                array('tipo','Tipo'),
                                array('id_site','Sitio'));
        return parent::mostrarListado();
	}

}

?>
