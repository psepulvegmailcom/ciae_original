<?

	global $ControlHtml;
	$laPagina	= $ControlHtml->laPagina;
	
	global $publicarEstado;
	$maxOrden = 40;

	$frame = new Frame(1,3);
	$frame->setTitle("Mantenedor de Link");
	$frame->setBorder(0);
	$frame->setWidth("80%");
	$frame->setCellHeight(1,2,"150");
	$frame->setCellHeight(1,3,"40");
	$frame->setCellHeight(1,1,"40");
	$frame->setCellVAlign(1,1,"center");
	$frame->setCellVAlign(1,3,"center");
	$frame->setCellAlign(1,1,"center"); 

	$frameInterior 	= new Frame(2,1);
	$frameBotones 	= new Frame(3,1);
	$elFormulario	= new Form(2,7);
	 
	// obtener la lista de objetos
	$elControladorDeObjetos = new ControladorLink();

	$elObjeto = new LinkObjeto();
	if ($laPagina->lastAction("eliminar",1)){
	
		if ($laPagina->lastAction("eliminar",2)){		
			
			// eliminar el objeto			
			$elObjeto->loadObject('id='.$Id);			
			$exito = true;
			
			if($elObjeto->destroyLink())
				$msg = "Datos Eliminados";
			else{
				$msg = "Error en el proceso de eliminación";
				$exito = false;
			}			
				
			$elMensaje = new Message($msg);
			$laPagina->add($elMensaje);
			
			if($exito)
				$Id=-1;				
		 
		} 
		elseif ($laPagina->lastAction("cancel",2)){
		
			$elMensaje = new Message("<br>Proceso Cancelado<br><br>");
			$elMensaje->setWidth("30%");
			$frame->setCellVAlign(1,2,"CENTER");
			$laPagina->add($elMensaje);			
			$laPagina->setlastAction("consultar",1);
		} 
		else{
		
			$elMensaje = new Confirm("eliminar",2,"<br>¿Esta seguro de eliminar link seleccionado?<br><br>");
			$laPagina->add($elMensaje);
		}		
	}

	if ($laPagina->lastAction("modificar",1) || $laPagina->lastAction("ingresar",1)){
	
		$noHayError = true;
		$msg = "";
		if(trim($link)=='' || trim($url)==''){
		
			$msg = "Debe ingresar información mínima (nombre del link y url)";
			$noHayError = false;
		}	
		
		if(!$noHayError){
			$elMensaje = new MsgBox($msg);
			$laPagina->add($elMensaje);
		}
		else{
			$url = str_replace("http://","",$url);

			$arregloMsg = array();
			if ($laPagina->lastAction("modificar",1)){
				$elObjeto->loadObject('id='.$Id);
				$arregloMsg['exito'] = "<br>Datos Modificados correctamente<br><br>Para visualizar los cambios deberá actualizar la página<br><br>";
				$arregloMsg['error'] = "<br>No se modificó la información por problemas en el proceso<br><br>";
			}
			else{
				/*caso ingresar*/				
				$arregloMsg['exito'] = "<br>Datos ingresados sin problemas. <br><br>";
				$arregloMsg['error'] = "<br>No se ingresó la información por problemas en el proceso<br><br>";		
			}
			$elObjeto->link = $link;
			$elObjeto->url = $url;
		   	$elObjeto->descripcion = 	$descripcion;
			$elObjeto->publicar = $publicar;
			if($orden == 0)
				$orden = $maxOrden; 
			$elObjeto->orden = $orden;			
			
			if($elObjeto->saveObject()){
				$msg = $arregloMsg['exito'];
				if ($laPagina->lastAction("ingresar",1)) {
					$elObjeto->setLastID();
					$elObjeto->id = $elObjeto->Id;
				}
			}
			else
				$msg = $arregloMsg['error'];
					

			$elMensaje = new Message($msg);
			$laPagina->add($elMensaje);
			
			$laPagina->setlastAction("consultar",1);			
			$Id       	 	= $elObjeto->id;		
		}
	}
	 

	if ($laPagina->lastAction("consultar",1)){
		// cargar el objeto	
		$elObjeto->loadObject('id='.$Id);

		$Id       	 	= $elObjeto->id;
		$link       	= $elObjeto->link;
		$descripcion    = $elObjeto->descripcion;
		$url   			= $elObjeto->url;
		$publicar    	= $elObjeto->publicar;
		$orden      	= $elObjeto->orden;
		
		if($orden == $maxOrden)
			$orden = 0; 	
	}

	if (!($laPagina->lastAction("ingresar",1)) && $Id==-1) {
		// limpiar las varibles
		$Id       	 = '';	
		$link       	= '';
		$descripcion    = '';
		$url   			= '';
		$publicar    	= 0;
		$orden      	= 0;
	}


	$ListaDeObjetos = $elControladorDeObjetos->getArray();

	$filaF=1;
	$elFormulario->add(1,$filaF,"Link");
	$elFormulario->add(2,$filaF,new Select("Id",$ListaDeObjetos,"id","link",0,$Id,"<-- Nuevo Elemento ->",-1,"process('consultar',1)"));
	$filaF++;
	$elFormulario->add(1,$filaF,"&nbsp;");
	$elFormulario->add(2,$filaF,"&nbsp;");
	$filaF++;
	$elFormulario->add(1,$filaF,"Nombre Link");
	$elFormulario->add(2,$filaF,new InputText("link",$link,"Ingrese nombre link",20),true);
	$filaF++;
	$elFormulario->add(1,$filaF,"Url ");
	$elFormulario->add(2,$filaF,new InputText("url",$url ,"Ingrese url",20),true);
	$filaF++;
	$elFormulario->add(1,$filaF,"Descripción");
	$elFormulario->add(2,$filaF,new InputText("descripcion",$descripcion,"Ingrese descripción",20),true);
	$filaF++;
	$elFormulario->add(1,$filaF,"Orden Relativo");
	$ordenArreglo= array();
	for($i=0; $i < 35; $i++){
		$iaux = $i+1;
		$ordenArreglo[$i]['id']=$iaux;
		$ordenArreglo[$i]['orden']=$iaux;
	}
	$elFormulario->add(2,$filaF,new Select("orden",$ordenArreglo,"id","orden",0,$orden,"<-- Seleccione lugar ->"));
	$filaF++;
	$elFormulario->add(1,$filaF,"Publicar");
	$elFormulario->add(2,$filaF,new Select("publicar",$publicarEstado,"id","tipo",0,$publicar));
	$filaF++;


	$laPagina->add(new Hidden("opcion_num",'0'));

	if (!isset($Id) || $Id==-1 || trim($Id)=='') {

		$frameBotones->add(1,1,new Submit("Ingresar","ingresar",1));
		$frameBotones->add(3,1,new Submit("            Cancelar                  ","",0));
		$frameBotones->setCellWidth(1,1,"50%");
	} else { 
		$frameBotones->add(1,1,new Submit("Modificar","modificar",1));
		$frameBotones->add(2,1,new Submit("  Eliminar ","eliminar",1));
		$frameBotones->add(3,1,new Submit("           Cancelar              ","",0));
		$frameBotones->setCellWidth(1,1,"40%");
		$frameBotones->setCellWidth(2,1,"35%");
	}
	$frameBotones->setAlign("center");	 
	$elFormulario->setCellWidth(1,1,"30%");
	$frameInterior->add(1,1,$elFormulario);
	$frameInterior->setCellWidth(1,1,"100%");
	$frameInterior->setCellWidth(2,1,"20%");
	$frame->add(1,1,$frameBotones);
	$frame->add(1,2,$frameInterior);
	$frame->add(1,3,$frameBotones);
	
	echo $frame->toHtml(); 
?>
