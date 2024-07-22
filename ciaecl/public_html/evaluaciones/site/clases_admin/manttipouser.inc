<?

	global $ControlHtml;
	$laPagina		= $ControlHtml->laPagina; 
global $publicarEstado;

$frame = new Frame(1,3);
$frame->setTitle("Mantenedor de Tipo de Usuarios");
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
$elFormulario 	= new Form(2,4);
 
// obtener la lista de objetos
$elControladorDeObjetos = new ControladorDeUsuarios();
$elObjeto = new Permiso();

if ($laPagina->lastAction("eliminar",1))
{	
	
		if($elObjeto->destroyObject('id_permiso='.$Id))
			$msg="Datos eliminados exitosamente";
		else
			$msg="No se modificó la información por problemas en el proceso";
		
		$elMensaje = new Message("<br><br>".$msg."<br><br><br>");
		$laPagina->add($elMensaje);	


		$Id       		= '';
		$descripcion   	= '';
		$alias			= '';		
	
}

if ($laPagina->lastAction("modificar",1) || $laPagina->lastAction("ingresar",1))
{
	$noHayError = true;
	$msg = "";
	if(trim($descripcion)=='' || trim($alias)=='')
	{
		$msg = "Debe ingresar descripción y alias del tipo de usuario";
		$noHayError = false;
	}		
	
	if(!$noHayError)
	{
		$elMensaje = new MsgBox($msg);
		$laPagina->add($elMensaje);
	}
	else
	{
		if ($laPagina->lastAction("modificar",1))
		{
			$elObjeto->loadObject('id_permiso='.$Id);
			$elObjeto->newObject = false;			
		}
		else
			$elObjeto->newObject = true;

		$elObjeto->alias = $alias;
		$elObjeto->descripcion = $descripcion;
		if ($laPagina->lastAction("modificar",1))
			$result = $elObjeto->saveObject('id_permiso='.$Id);		
		else
			$result = $elObjeto->saveObject();	
			
		if($result)
			$msg="Datos Modificados exitosamente";
		else
			$msg="No se modificó la información por problemas en el proceso";
		
		$elMensaje = new Message("<br><br>".$msg."<br><br><br>");
		$laPagina->add($elMensaje);
				
		if ($laPagina->lastAction("modificar",1))		
			$Id  = $elObjeto->id_permiso;	
		else
			$Id = $elObjeto->getLastId('id_permiso');
		
		$laPagina->setlastAction("consultar",1);	
	
	}
}
 

if ($laPagina->lastAction("consultar",1))  
{
	// cargar el objeto	
	$elObjeto->loadObject('id_permiso='.$Id);
	$Id       	 	= $elObjeto->id_permiso;
	$descripcion    = $elObjeto->descripcion;
	$alias       	= $elObjeto->alias;
}

if (!($laPagina->lastAction("ingresar",1)) && $Id==-1) {
	// limpiar las varibles
	$Id       	 = '';
	$descripcion       	= '';
	$alias       	= '';

}


$ListaDeObjetos = $elControladorDeObjetos->getArrayPermisos() ;

$filaF=1;
$elFormulario->add(1,$filaF,"Tipo Usuario");
$elFormulario->add(2,$filaF,new Select("Id",$ListaDeObjetos,"id_permiso","descripcion",0,$Id,"<-- Nuevo Tipo Usuario ->",-1,"process('consultar',1)"));
$filaF++;
$elFormulario->add(1,$filaF,"&nbsp;");
$elFormulario->add(2,$filaF,"&nbsp;");
$filaF++;
$elFormulario->add(1,$filaF,"Alias Tipo");
$elFormulario->add(2,$filaF,new InputText("alias",$alias,"Ingrese alias tipo",20),true);
$filaF++;
$elFormulario->add(1,$filaF,"Descripción Tipo");
$elFormulario->add(2,$filaF,new InputText("descripcion",$descripcion,"Ingrese descripición tipo",20),true);
$filaF++;


if (!isset($Id) || $Id==-1 || trim($Id)=='') {

	$frameBotones->add(1,1,new Submit("Ingresar","ingresar",1));
	$frameBotones->setCellWidth(1,1,"50%");
} else { 
	$frameBotones->add(1,1,new Submit("Modificar","modificar",1));
	$frameBotones->add(2,1,new Submit("  Eliminar ","eliminar",1));
	$frameBotones->setCellWidth(1,1,"40%");
	$frameBotones->setCellWidth(2,1,"35%");
}
$frameBotones->add(3,1,new Submit("Cancelar","",0));
$frameBotones->setAlign("center");
 
$frameInterior->add(1,1,$elFormulario);
$frameInterior->setCellWidth(1,1,"100%");
$frameInterior->setCellWidth(2,1,"20%");
$frame->add(1,1,$frameBotones);
$frame->add(1,2,$frameInterior);
$frame->add(1,3,$frameBotones);

 echo $frame->toHtml(); ?>
