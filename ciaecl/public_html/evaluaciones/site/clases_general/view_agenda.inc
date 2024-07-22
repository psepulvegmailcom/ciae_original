<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray;  
	$FormGeneral 			= new FormGeneral();

	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'agenda.tpl'); 	
	
	$id_elemento = VarSystem::getVariable('id_elemento','GET');  
	 
	$ControlAgenda 		= new  ControlAgenda();
	
	$ControlAgenda->setIdioma($ControlHtml->langSite);
	$ControlAgenda->setDateFormat($ControlHtml->ControlIdioma->obtenerVariable('date_format_sql'));
	
	/* CONSULTA ELEMENTO PARTICULAR */
	if($id_elemento != '' && is_finite($id_elemento))
	{
		$e->setVariable('tag_volver',$FormGeneral->showVolver('view_agenda'));
		$objetos 	= 	$ControlAgenda->getLista($id_elemento);  
	  	$e->addTemplate('lista_item_select');   
		$e->setVariable('titulo',Funciones::TextoSimple($objetos[0]['titulo'])); 
		$e->setVariable('contenido', Funciones::TextoSimple($objetos[0]['contenido'],true)); 
	  	$e->addTemplate('lista_item_select_valor');    
		$e->setVariable('valor_titulo',$ControlHtml->ControlIdioma->obtenerVariable('agenda_fecha_inicio')); 
		$e->setVariable('valor',$objetos[0]['fecha_inicio_real']); 
	  	$e->addTemplate('lista_item_select_valor');    
		$e->setVariable('valor_titulo',$ControlHtml->ControlIdioma->obtenerVariable('agenda_fecha_termino')); 
		$e->setVariable('valor',$objetos[0]['fecha_termino_real']); 
	  	$e->addTemplate('lista_item_select_valor');    
		$e->setVariable('valor_titulo',$ControlHtml->ControlIdioma->obtenerVariable('agenda_lugar')); 
		$e->setVariable('valor',$objetos[0]['lugar']); 
		$aux = array('patrocina','organiza','consulta');
		foreach($aux as $key => $valor)
		{ 
			if(trim($objetos[0][$valor]) == '')
				continue;
		  	$e->addTemplate('lista_item_select_valor');    
			$e->setVariable('valor_titulo',$ControlHtml->ControlIdioma->obtenerVariable('agenda_'.$valor)); 
			$e->setVariable('valor',$objetos[0][$valor]); 
		}
	} 
	else
	{	 
		$e->addTemplate('lista_item'); 		
		$agno = date('Y');
		$e->setVariable('agno',$agno);
		$meses  = $ControlHtml->ControlIdioma->obtenerVariable('agenda_meses_lista');
		$j=1;
		foreach($meses as $key => $mesn)
		{
			$e->addTemplate('calendario_tabla_mes'); 
			$mest = $j; if($j < 10)	$mest = '0'.$j;
			$ListaDeObjetos	 	= $ControlAgenda->getLista(0,$agno.'-'.$mest); 				
			$total 				= 0;
			if(is_array($ListaDeObjetos))
			 	$total 				= count($ListaDeObjetos);
			$e->setVariable('mes',$mesn); 
			$e->setVariable('total',$total); 
			$e->setVariable('mes_num',$j); 
			$e->setVariable('lang',$ControlHtml->langSite);
			$j++;
		}

		/* TABLA DE CALENDARIO DE LA AGENDA */
		$e->addTemplate('calendario_tabla'); 
		$dias  = $ControlHtml->ControlIdioma->obtenerVariable('agenda_dias_lista');
			
		$e->addTemplate('dia_titulo_fila');
		foreach($dias as $key => $dia)
		{
			$e->addTemplate('dia_titulo_fila_columna');
			$e->setVariable('valor',$dia); 
		}

		$dia = 1;
		$mes = VarSystem::getVariable("mes",'GET');
		if(trim($mes) == '') $mes = date('m');
		$fecha_inicio 	= mktime(0, 0, 0, $mes, $dia , $agno);
		$dia_semana 	= date('N',$fecha_inicio);
		$e->addTemplate('dia_valor_fila');
		for($i = 1; $i < $dia_semana; $i++)
		{
			$e->addTemplate('dia_valor_fila_columna');
			$e->setVariable('valor',' ');
			$e->setVariable('clase','fondo_claro');
		}

		for($dia = 1; $dia < 32; $dia++)
		{
			$fecha_inicio 	= mktime(0, 0, 0, $mes, $dia , $agno);
			$dia_semana 	= date('N',$fecha_inicio);
			if($dia_semana == 1)
				$e->addTemplate('dia_valor_fila');
			$e->addTemplate('dia_valor_fila_columna');
			$e->setVariable('clase','fondo_oscuro');
			$e->setVariable('dia',$dia.'/'.$mes);	
			
			$mest = $mes; if($mes < 10)	$mest = '0'.$mes;
			$diat = $dia; if($dia < 10)	$diat = '0'.$dia;
			$ListaDeObjetos	 	= $ControlAgenda->getLista(0,$agno.'-'.$mest.'-'.$diat); 				
			$total 				= count($ListaDeObjetos);
			if(is_array($ListaDeObjetos) && $total > 0)
			{
				for($i=0; $i < $total; $i++)
				{ 
					$e->addTemplate('dia_valor_fila_columna_valor');
					$e->setVariable('valor',$ListaDeObjetos[$i]['titulo']);
					$aux = explode(' ',$ListaDeObjetos[$i]['fecha_inicio']);
					$e->setVariable('hora',substr($aux[1],0,5));
					$e->setVariable('id',$ListaDeObjetos[$i]['id_item']);
					$e->setVariable('lang',$ControlHtml->langSite);
				}	
			}
		} 
		$dia_semana++;
		for($i = $dia_semana; $i <=7; $i++)
		{
			$e->addTemplate('dia_valor_fila_columna');
			$e->setVariable('valor','');
			$e->setVariable('clase','fondo_claro');
		}
 
	}
	
	echo $e->toHtml();


?>
	