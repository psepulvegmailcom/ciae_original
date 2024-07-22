<?php

global $laPagina;
?>

<script>
function saveEditedMenu() {
	var t=(window.get_xhtml) ? get_xhtml(oW.document.body) : oW.document.body.innerHTML;
	o(idTa).value=tidyH(t)	;
	document.main.new_menuContent.value = document.main.menuContent.value;
	process("saveMenu",4); 
}
</script>

<?php


// obtener la lista de objetos
$elObjeto = new Menu();

$contentFrame = new Frame(1,4);
$contentFrame->setWidth("100%");
$contentFrame->setBorder("0");
$contentFrame->setCellHeight(1,1,"45");
$contentFrame->setCellHeight(1,3,"45");

$contentFrame->setCellAlign(1,2,"center");

$contentFrame->setCellAlign(1,1,"center");
$contentFrame->setCellAlign(1,3,"center");
$contentFrame->setCellVAlign(1,1,"center");
$contentFrame->setCellVAlign(1,3,"center");

if (!$laPagina->lastAction("saveMenu",3)) {

	if($elObjeto->loadObject("id=".$id_menu_editar)) {
		if(trim($elObjeto->archivo) == '') {
			$frameBotones = new Frame(3,1);
			
			$laPagina->add(new Hidden("id_menu_editar",$id_menu_editar));
			$laPagina->add(new Hidden("new_menuContent",""));

			$frameBotones->add(1,1,new Button("Guardar Contenido","saveMenu","saveEditedMenu()"));
			$frameBotones->add(2,1,new Button("Cancelar Cambios","cancelarMenu","document.main.reset();"));
			
			if($elObjeto->menu_padre == 0 )
				$frameBotones->add(3,1,new Button("Ir Menu","cancelar","document.main.id_menu.value=".$elObjeto->id.";document.main.id_submenu.value=0;process('".$elObjeto->opcion."',0);"));
			else
				$frameBotones->add(3,1,new Button("Ir Menu","cancelar","document.main.id_menu.value=".$elObjeto->menu_padre.";document.main.id_submenu.value=".$elObjeto->id.";process('".$elObjeto->opcion."',0);"));
				
			$contentFrame->add(1,1,$frameBotones);
			$contentFrame->add(1,3,$frameBotones);
	
			$elEditor = new TextEditor('menuContent',stripslashes($elObjeto->body),120,30,"modifique el texto");
			$elEditor->setStyle("height: 300px;");

			$contentFrame->add(1,2,$elEditor,true);	
		} else {
			echo "<H1>ERROR:</H1> Este menu no puede ser editado, pues corresponde a un modulo interno ";
		}
	}
} else {
	if($elObjeto->loadObject("id=".$id_menu_editar)) {
		if(trim($elObjeto->archivo) == '') {
			$elObjeto->body = $new_menuContent;

			if ($elObjeto->saveObject()) {
				$msg = new Message("Contenido guardado exitosamente");	
				$laPagina->add($msg);
			} else {
				$msg = new Message("Problemas al guardar el contenido del menu");	
				$laPagina->add($msg);
			}
			$contentFrame->add(1,1,$new_menuContent);
		}
	} else {
		$contentFrame->add(1,2,"<center>No se ha definido menu para guardar</center>");
	}
}
echo $contentFrame->toHtml(); 

?>