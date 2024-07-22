<?php 

/** CONTROLADOR GENERAL Y GLOBAL DE LOS MANTENEDORES CONTROLADORES DE OBJETOS  */
/**
 * MantenedoresGeneralObjeto
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class MantenedoresGeneralObjeto
{   
  /**
   * MantenedoresGeneralObjeto::MantenedoresGeneralObjeto()
   *
   * @return void
   */
	function MantenedoresGeneralObjeto()
	{ 
		 
	}
	
  /**
   * MantenedoresGeneralObjeto::guardarObjetoSimple()
   *
   * @param mixed $ObjetoClase
   * @param mixed $valores
   * @return
   */
	function guardarObjetoSimple($ObjetoClase,$valores)
	{ 
 		if(trim($valores['id_item']) != '')
 		{
			/** EDICION ELEMENTO */
			$ObjetoClase->buscarObjeto($valores['id_item']);
		}
		foreach($valores as $var => $val)
		{
			$aux = explode('_',$var);
			if($aux[0] == 'form')
			{
				$aux = str_replace('form_','',$var);
				
				$aux_fecha = explode('fecha',$var);
				if(count($aux_fecha) > 1)
				{ 
 					$val = ControladorFechas::invertirFecha($val);
				}  
				$val = Funciones::TextoSimple($val);
				$ObjetoClase->$aux = $val;
			}
		}
		//Funciones::mostrarArreglo($ObjetoClase);
		if(trim($valores['id_item']) != '')
 		{
			/** EDICION ELEMENTO */
			$ObjetoClase->guardarObjeto($valores['id_item']);
		}
		else
		{
			$ObjetoClase->guardarObjeto(); 
		}
		return $ObjetoClase; 
	}
	
	function eliminarObjetoSimple($ObjetoClase,$valores)
	{ 
 		if(trim($valores['id_item']) != '')
 		{
			/** EDICION ELEMENTO */
			$ObjetoClase->buscarObjeto($valores['id_item']);
			$ObjetoClase->eliminarObjeto($valores['id_item']);
		} 
	} 
	
	function activarObjetoSimple($ObjetoClase,$valores,$valor_activar='')
	{ 
 		if(trim($valores['id_item']) != '' && trim($valor_activar) != '')
 		{ 
			$ObjetoClase->buscarObjeto($valores['id_item']); 
			if($ObjetoClase->$valor_activar == 1)
				$ObjetoClase->$valor_activar = '0';
			else
				$ObjetoClase->$valor_activar = 1;
				 
			$ObjetoClase->guardarObjeto($valores['id_item']);
		} 
	}	
}

/** CONTROLADOR GENERAL Y GLOBAL DE LOS MANTENEDORES CON TEMPLATE */
/**
 * MantenedoresGeneral
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class MantenedoresGeneral extends ControlObjetos
{   
  /**
   * MantenedoresGeneral::MantenedoresGeneral()
   *
   * @return void
   */
	function MantenedoresGeneral()
	{ 
		 
	} 
	
	
	function buscardorGeneral($valores,$ControlObjeto,$tipoBusqueda)
	{
		
		list($strQryRes, $strQry, $order) = parent::obtenerQryPorBusqueda($valores,$tipoBusqueda);
		   if($valores["busca_areaProyecto"]!=''){
		   		$listadoN = $ControlObjeto->obtenerListadoPorBusquedaPorArea($strQryRes, $strQry, $order);
		   	  }else
		   if($valores["busca_tipo"]=='medios'){
		   		$listadoN = $ControlObjeto->obtenerListadoPorBusquedaPrensa($strQryRes, $strQry, $order);
		   	  }else
		   if($valores["boletin"]=='boletin'){
		   		$listadoN = $ControlObjeto->obtenerListadoPorBusquedaBoletin($strQryRes, $strQry, $order);
		   	  }else	 
				 {	  
		   		$listadoN = $ControlObjeto->obtenerListadoPorBusqueda($strQryRes, $strQry, $order);		   
		   }
		   $FormGeneral = new FormGeneral();
		   $total = count($listadoN);
		   list($pagina,$inicio,$final) = $FormGeneral->paginamientoReseteo();
		   $tamPag = $final;
			if(trim($pagina) != '')
			{
				$pagina = $valores["pagina"];
			}  			
			list($limite,$numPags) =  $FormGeneral->paginamientoLimite($pagina,$tamPag,$total); 
			
			if ($numPags < 11){
			 	$final=$numPags;
			 }else{
				$final=10;
			}

			$ControlPublicaciones = new ControlPublicaciones();
			
			if($valores["busca_areaProyecto"]!=''){
				$listado 	= $ControlObjeto->obtenerListadoPorBusquedaPorArea($strQryRes,$strQry, $order, $limite);
			}else
				if($valores["busca_tipo"]=='medios'){
				$listado 	= $ControlObjeto->obtenerListadoPorBusquedaPrensa($strQryRes,$strQry, $order, $limite);
			}
			else
				if($valores["boletin"]=='boletin'){
				$listado 	= $ControlObjeto->obtenerListadoPorBusquedaBoletin($strQryRes,$strQry, $order, $limite);
			}
			else{
				$listado 	= $ControlObjeto->obtenerListadoPorBusqueda($strQryRes,$strQry, $order, $limite);
					
			}
			if(!isset($pagina))
			{
		   			//list($pagina,$inicio,$final) = $ControlHtml->FormGeneral->paginamientoReseteo();
			  }
			  else
			  {				
				    list($inicio,$final) = $FormGeneral->paginamientoNumeroPaginas($pagina,$tamPag,$numPags);
			  }
		
		
		//
		return array($listado,$inicio,$final,$numPags);
	}
	
  /**
   * MantenedoresGeneral::mostrarListadoGenerico()
   *
   * @param mixed $e
   * @param mixed $listado
   * @param mixed $bloque
   * @return
   */
	function mostrarListadoGenerico($e,$listado,$bloque)
	{
		$total = count($listado);  
		for($i=0; $i < $total; $i++)
		{
			$e->addTemplate($bloque);
			$listado[$i]['fila'] = $i + 1;  
			foreach($listado[$i] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}  
			$e->setVariable('class_color','fondo_claro');
			if($i%2 == 0)						
			{
				$e->setVariable('class_color','fondo_oscuro');
			}
		}			
		return $e; 
	}
	
	
	
  /**
   * MantenedoresGeneral::mostrarListado()
   *
   * @param mixed $e
   * @param mixed $listado
   * @param mixed $llave
   * @param mixed $opcion
   * @return
   */
	function mostrarListado($e,$listado,$llave,$opcion)
	{
		$total = count($listado);  
		for($i=0; $i < $total; $i++)
		{
			$e->addTemplate('lista_item');
			$listado[$i]['fila'] = $i + 1; 
			$listado[$i]['id_item'] = $listado[$i][$llave];
			 
			//Funciones::mostrarArreglo($listado[$i]);
			$e->setVariable('opcion_modulo',$opcion);
			foreach($listado[$i] as $var => $val)
			{ 
				$val = Funciones::TextoSimple(trim($val));
				$e->setVariable($var,trim($val));
				$aux_fecha = explode('fecha',$var);
				if(count($aux_fecha) > 1)
				{ 
					$val = ControladorFechas::invertirFecha($val);
					$e->setVariable($var.'_html',$val);
				} 
			}  
			$e->setVariable('class_color','fondo_claro');
			if($i%2 == 0)						
			{
				$e->setVariable('class_color','fondo_oscuro');
			}
		}			
		return $e; 
	}
	
  /**
   * MantenedoresGeneral::transformarSalto()
   *
   * @param mixed $seleccion
   * @return
   */
	function transformarSalto($seleccion)
	{
		foreach($seleccion as $var => $val)
		{
			$seleccion[$var] = nl2br($val);
		} 
		return $seleccion;
	}
	
  /**
   * MantenedoresGeneral::limpiezaCaracteres()
   *
   * @param mixed $seleccion
   * @return
   */
	function limpiezaCaracteres($seleccion)
	{ 
		foreach($seleccion as $var => $val)
		{ 
			$val = Funciones::LimpiarSaltosLinea($val);
			$val = Funciones::LimpiarEspacios($val);
			$seleccion[$var] = trim($val);
		} 
		//Funciones::mostrarArreglo($val,true);
		return $seleccion;
	}
	
  /**
   * MantenedoresGeneral::mostrarElementoValores()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @return
   */
	function mostrarElementoValores($e,$seleccion)
	{			
		if(is_array($seleccion))
		{
			foreach($seleccion as $var => $val)
			{  
				$val = Funciones::TextoSimple(trim($val));
				$e->setVariable($var,$val);
				$aux_fecha = explode('fecha',$var);
				if(count($aux_fecha) > 1)
				{ 
					$val = ControladorFechas::invertirFecha($val);
					$e->setVariable($var.'_html',$val);
				}  
				$e->setVariable('checked_'.$var.'_'.$val,'checked');
			}
		} 
		return $e; 
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccionOrden()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @param integer $total
   * @return
   */
	function mostrarSeleccionOrden($e,$seleccion,$total=30)
	{
		for($i=1; $i  < $total ; $i++)
		{
			$e->addTemplate('bloque_form_orden');
			$e->setVariable('orden',$i); 
			if($i == $seleccion['orden'])
			{
				$e->setVariable('selected','selected');
			}
		} 
		return $e;
	}
		
  /**
   * MantenedoresGeneral::mostrarSeleccionEstado()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @param string $llave
   * @return
   */
	function mostrarSeleccionEstado($e,$seleccion,$llave ='activo')
	{  
		$e->setVariable('checked_'.$seleccion[$llave],'checked'); 
		return $e;
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccionBinario()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @param string $llave
   * @return
   */
	function mostrarSeleccionBinario($e,$seleccion,$llave ='activo')
	{  
		$e->setVariable('checked_'.$llave.'_'.$seleccion[$llave],'checked'); 
		return $e;
	}
	
	
	function asignarValoresExternosObjeto($objeto,$valores,$prefijo='form')
	{
		foreach($valores as $var => $val)
		{
			$aux = explode('_',$var);
			if($aux[0] == $prefijo)
			{
				unset($aux[0]);
				$var = implode('_',$aux);
				$objeto->$var = $val;
			}
		}  
		return $objeto;
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccion()
   *
   * @param mixed $e
   * @param mixed $bloque
   * @param mixed $listado
   * @param mixed $seleccion
   * @param mixed $llave
   * @return
   */
	function mostrarSeleccion($e,$bloque,$listado,$seleccion=array(),$llave='')
	{
		$total = count($listado);
		$largo_texto = 100;
		for($i=0; $i < $total;$i++)
		{
			$e->addTemplate($bloque);
			foreach($listado[$i] as $var => $val)
			{
				$len = strlen($val); 
				if($len > $largo_texto)
				{
					$val = substr($val,0,$largo_texto).'...';
				}
				$e->setVariable($var,trim($val));
			}  
			if(trim($llave) != '' && count($seleccion) > 0)
			{
				if($listado[$i][$llave] == $seleccion[$llave])
				{
					$e->setVariable('selected','selected');
				}
			}
		}
		return $e;
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccionMultiple()
   *
   * @param mixed $e
   * @param mixed $bloque
   * @param mixed $listado
   * @param mixed $seleccion
   * @param mixed $llave
   * @return
   */
	function mostrarSeleccionMultiple($e,$bloque,$listado,$seleccion,$llave)
	{
		$total = count($listado);
		$i_aux = 0;
		for($i=0; $i < $total;$i++)
		{
			$e->addTemplate($bloque);
			foreach($listado[$i] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}  
			if($listado[$i][$llave] == $seleccion[$i_aux][$llave])
			{
				$e->setVariable('selected','selected');
				$i_aux++;
			}
		}
		return $e;
	}	

  /**
   * MantenedoresGeneral::mostrarPersonasEdicionListado()
   *
   * @param mixed $e
   * @param mixed $listado
   * @param mixed $opcion
   * @return
   */
	function mostrarPersonasEdicionListado($e,$listado,$opcion)
	{
		// Funciones::mostrarArreglo($listado,true);
		/** PERSONAS EXISTENTES */
		$total = count($listado);
		if(is_array($listado) && $total > 0)
		{
			for($i = 0; $i < $total; $i++)
			{
				$e->addTemplate('bloque_form_persona_extra');
	
				$e->setVariable('opcion_modulo',$opcion); 				
				if(trim($listado[$i]['nombre_publicacion']) == '')
				{
					if($listado[$i]['id_persona'] > 1)
					{
						$listado[$i]['nombre_publicacion'] = $listado[$i]['apellido_paterno'].', '.$listado[$i]['nombre'][0].'.';	
					}
					else
					{
						$listado[$i]['nombre_publicacion'] = $listado[$i]['nombre_extra'];
					}					
				} 
				foreach($listado[$i] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}				
			}
		}
		/** PERSONAS PARA INGRESAR */
		$nuevos = 5;
		$total_orden =30;
		$ControlClase = new ControlPersonaObjeto();
		$personas = $ControlClase->obtenerListado();
		$personas[0]['nombre'] = '(nombre extra)';
		$total_personas = count($personas);
		for($i=0; $i < $nuevos; $i++)
		{
			$e->addTemplate('bloque_form_persona_extra_ingreso');
			
			for($j=0; $j < $total_personas; $j++)
			{
				$e->addTemplate('bloque_form_persona_extra_ingreso_nombre');
				foreach($personas[$j] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}
			}
			
			for($j=1; $j < $total_orden ; $j++)
			{
				$e->addTemplate('bloque_form_persona_extra_ingreso_orden');
				$e->setVariable('orden',$j);  
			} 
		} 
		return $e;
	} 
	
	function colorFilaGenerico($e,$i)
	{		
		$e->setVariable('class_color','fondo_oscuro');
		if($i%2 == 0)						
		{
			$e->setVariable('class_color','fondo_claro');
		}
		return $e;
	}
}
?>