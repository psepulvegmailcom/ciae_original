<?php

	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession;  
	$lastAction 	= $ControlHtml->lastActionArray; 
	$FormGeneral 			= new FormGeneral();  
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'catalogo_base.tpl'); 

	/*LECTURA DE CATALOGO*/
	$ControlCategoriaCatalogo 	= new  ControlCategoriaCatalogo();
	$ControlProductoCatalogo 	= new ControlProductoCatalogo();
	$CategoriaCatalogo = new CategoriaCatalogo();

	$page 			= VarSystem::getVariable('page','GET');
	$subcategoria 	= VarSystem::getVariable('subcategoria','GET');
	if($subcategoria == 2)
		$subcategoria = 10;
	if($subcategoria == 1)
		$subcategoria = 20;


	$producto 		= VarSystem::getVariable('producto','GET');
	$valores 		= VarSystem::getPost(); 
	$producto_sel	= $valores['producto_sel'];

	$aux 			= explode('_',$page);
	$categoria_sel 	= end($aux);

	if($subcategoria != 0)
	{
		$CategoriaCatalogo->obtenerCategoria($subcategoria); 
		$categoria_sel = $CategoriaCatalogo->categoria_id_padre;
	}

	$e->setVariable('subcategoria',$subcategoria);  
	$e->setVariable('page',$page); 

	/* MENU SELECCIONADO */
	$CategoriaCatalogo->obtenerCategoria($categoria_sel); 

	$e->setVariable('menu_destado',$CategoriaCatalogo->categoria);
	
	$ListaDeObjetos = $ControlCategoriaCatalogo->obtenerCategoriaCatalogo($categoria_sel); 	
	$total 				= count($ListaDeObjetos);
	if(is_array($ListaDeObjetos) && $total > 0)
	{
		for($i=0; $i < $total; $i++)
		{ 
			$e->addTemplate('bloque_catalogo_menu_destacado_submenu');
			$e->setVariable('subcategoria',$ListaDeObjetos[$i]['id_categoria']);  
			$e->setVariable('submenu',$ListaDeObjetos[$i]['categoria']);
			$e->setVariable('page',$page);
		}	
	}

	/* MENUS DE CATALOGOS */
	$ListaDeObjetos 	= $ControlCategoriaCatalogo->obtenerCategoriaCatalogo(); 	 	
	$total 				= count($ListaDeObjetos);
	if(is_array($ListaDeObjetos) && $total > 0)
	{
		for($i=0; $i < $total; $i++)
		{ 
			if($categoria_sel == $ListaDeObjetos[$i]['id_categoria'])
				continue;
			$e->addTemplate('bloque_catalogo_menu_simple');
			$e->setVariable('menu',$ListaDeObjetos[$i]['categoria']);
			$ListaDeObjetosSubmenu = $ControlCategoriaCatalogo->obtenerCategoriaCatalogo($ListaDeObjetos[$i]['id_categoria']); 
			$totalSubmenu 				= count($ListaDeObjetosSubmenu);
			if(is_array($ListaDeObjetosSubmenu) && $totalSubmenu > 0)
			{
				for($j=0; $j < $totalSubmenu; $j++)
				{ 
					$e->addTemplate('bloque_catalogo_menu_simple_submenu');
					$e->setVariable('subcategoria',$ListaDeObjetosSubmenu[$j]['id_categoria']);  
					$e->setVariable('submenu',$ListaDeObjetosSubmenu[$j]['categoria']);
					$e->setVariable('page',$page);
				}	
			}
		}	
	}
 

	/* MUESTRA DE PRODUCTOS */
	if(trim($producto) != '' || count($producto_sel) > 0)
	{
		if(count($producto_sel) == 0)
		{
			$producto_sel[0] = $producto;
			$e->addTemplate('bloque_catalogo_detalle');  
		}
		else
		{
			$e->addTemplate('bloque_catalogo_comparacion');  
		}
		$total = count($producto_sel);
 
		for($i=0; $i < $total; $i++)
		{
			$bloque_tmp = '';
			$producto = $producto_sel[$i];
			if($total > 1)
			{
				$bloque_tmp = '_comparacion';
				$e->addTemplate('bloque_catalogo_comparacion_detalle');
			}

			/* SE MUESTRA EL PRODUCTO SELECCIONADO */ 
			$campos = array('campo_capacidad' => 'Capacidad','campo_peso_medio' => 'Peso Medio', 	'campo_palos' => 'Palos', 	'campo_tamano_bolsa_transporte' => 'Tamaño bolsa transporte', 	'campo_tejido' => 'tejido', 	'campo_area' => 'Área', 	'campo_caracteristicas' => 'Características','campo_categoria' => 'Categoría', 'campo_peso' => 'Peso','campo_altura' => 'Altura', 	'campo_parantes' => 'Parantes','campo_vestibulo' => 'Vestíbulo','campo_puerta' => 'Puerta','campo_area_vestibulo' =>'Área Vestíbulo','campo_tela'=>'Tela','campo_talla' => 'Talla','campo_temp' => 'temperatura','campo_peso_total_medio' => 'peso total medio','campo_peso_relleno' =>'peso relleno','campo_longitud_exterior' => 'longitud exterior ','campo_altura_max' => 'altura max usuario','campo_circ_hombro' => 'circ hombro','campo_circ_cadera' => 'circ cadera','campo_circ_pie' => 'circ pie','campo_tejido_exterior' => 'tejido exterior' ,'campo_largo' => 'Largo','campo_dimensiones'=>'Dimensiones','campo_volumen'=>'Volumen','campo_volumen_stdn'=>'Volumen STDN','campo_ajuste'=>'Ajustes','campo_peso_aprox'=>'Peso Aprox.',    'campo_acceso' => 'Acceso','campo_rango_confort' => 'Rango Confort');

			$ListaDeObjetos 	= $ControlProductoCatalogo->obtenerProducto($producto ); 
			if(trim($ListaDeObjetos[0]['precio']) != 0)
				$ListaDeObjetos[0]['precio'] 	= '$'.Funciones::formatoNumero($ListaDeObjetos[0]['precio']);	
			else
				$ListaDeObjetos[0]['precio'] 	= $ListaDeObjetos[0]['precio_extra'];
	 
			$ListaDeObjetos[0]['color'] 		= nl2br($ListaDeObjetos[0]['color'] );	 
			$ListaDeObjetos[0]['campo_caracteristicas'] = str_replace(array("\n","\r"),array(" "," "),$ListaDeObjetos[0]['campo_caracteristicas'] );	 
			$ListaDeObjetos[0]['sufijo'] = strtoupper($ListaDeObjetos[0]['sufijo']);

			$e->setVariable('subcategoria',$subcategoria);  
			$e->setVariable('page',$page); 
			foreach($ListaDeObjetos[0] as $campo => $valor)
			{			
				$e->setVariable($campo,$valor); 
				$aux = explode('_',$campo);
				if($aux[0] == 'campo' && trim($valor) != '')
				{
					$e->addTemplate('bloque_catalogo_detalle_campo'.$bloque_tmp);
					$e->setVariable('valor_campo',nl2br($valor)); 
					$e->setVariable('nombre_campo',$campos[$campo]); 
					$e->refreshTemplate();
				}
			}	
			if(trim($ListaDeObjetos[0]['tecnologia']) != '')
			{
				$e->addTemplate('bloque_catalogo_detalle_tecnologia'.$bloque_tmp);
				$e->setVariable('tecnologia',nl2br($ListaDeObjetos[0]['tecnologia'])); 
				$e->refreshTemplate();
			}
		}
	}
	else
	{  
		$orden_opcion	= array('producto' => 'Producto','precio' => 'Precio' ); 
		$e->addTemplate('bloque_catalogo_listado');
		/* SE MUESTRAN LOS PRDUCTOS POR CATEGORIA */  

		if($categoria_sel == 3 && trim($subcategoria) == '')
		{
			$subcategoria = '10 OR id_categoria = 20'; 
		} 
		$ListaDeObjetos 	= $ControlProductoCatalogo->obtenerProductosCatalogo($subcategoria); 
		if(trim($subcategoria) == '')
		{
			$ListaDeObjetos 	= $ControlProductoCatalogo->obtenerProductosCatalogoRaiz($categoria_sel);
		}
		$total 				= count($ListaDeObjetos);

		$e->setVariable('paginamiento_orden',$FormGeneral->showPaginamientoOrden($orden_opcion));
		$e->setVariable('paginamiento',$FormGeneral->showPaginamiento($total));
		$valores_paginamiento 		= $FormGeneral->getValoresPaginamiento( $total); 
		  
		$aux = 0; 
		if(is_array($ListaDeObjetos) && $total > 0)
		{
			for($i = $valores_paginamiento['inicio']; $i < $valores_paginamiento['fin']; $i++)
			{   
				if($i%3 == 0)
				{
					$e->addTemplate('bloque_catalogo_detalle_fila');
					$aux = 0;
				}

				if($aux == 0)
					$aux_bloque = 'bloque_catalogo_detalle_fila_izq';
				elseif($aux == 1)
					$aux_bloque = 'bloque_catalogo_detalle_fila_centro';
				else
					$aux_bloque = 'bloque_catalogo_detalle_fila_der';
				$aux++; 
				$e->addTemplate($aux_bloque);
				$e->setVariable('id_producto',$ListaDeObjetos[$i]['id_producto']);  
				$e->setVariable('producto',$ListaDeObjetos[$i]['producto']);				 
				$e->setVariable('sufijo',strtoupper($ListaDeObjetos[$i]['sufijo']));
				if(trim(Funciones::formatoNumero($ListaDeObjetos[$i]['precio'])) != 0)
					$e->setVariable('precio','$'.Funciones::formatoNumero($ListaDeObjetos[$i]['precio']));
				else
					$e->setVariable('precio',$ListaDeObjetos[$i]['precio_extra']);
				$e->setVariable('opcion',$_SERVER['QUERY_STRING']);
				$e->setVariable('subcategoria',$subcategoria);  
				$e->setVariable('page',$page);
			}	
		}	
		else
			$e->addTemplate('bloque_catalogo_detalle_fila_vacia');
		 
	}
	echo $e->toHtml();
?>