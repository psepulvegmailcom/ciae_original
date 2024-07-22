<?
	$path_local = VarConfig::path_site.'libs/';
	require_once $path_local.'PHPLIB.php';
	require_once $path_local.'layersmenu-common.inc.php';
	require_once $path_local.'layersmenu.inc.php';
	require_once $path_local.'treemenu.inc.php';
	 
	$file = VarConfig::path_site.'libs/date.php';  
	if(file_exists($file))
	{ 
		require_once $file ;  
	}
	else
	{
		require_once 'date.php';  
	}
  
	require_once $path_local.'AuthSession.inc';
	require_once $path_local.'AuthSessionIntranet.inc';
	require_once $path_local.'HtmlElement.inc';
	require_once $path_local.'FormControl.inc';
	require_once $path_local.'PersistentObject.inc';
	require_once $path_local.'pgsql.inc';
	require_once $path_local.'oracle.inc';
	require_once $path_local."mysql.inc"; 
	require_once $path_local.'dblogic.inc';
	require_once $path_local.'Button.inc';
	require_once $path_local.'RadioButton.inc';
	require_once $path_local.'Frame.inc';
	require_once $path_local.'FloatingFrame.inc';
	require_once $path_local.'HtmlFile.inc';
	require_once $path_local.'InputText.inc';
	require_once $path_local.'MsgBox.inc';
	require_once $path_local.'PasswordText.inc';
	require_once $path_local.'Select.inc';
	require_once $path_local.'Form.inc';
	require_once $path_local.'InputFile.inc';
	require_once $path_local.'Message.inc';
	require_once $path_local.'TextArea.inc';
	require_once $path_local.'Confirm.inc';
	require_once $path_local.'Hidden.inc';
	require_once $path_local.'Image.inc';
	require_once $path_local.'Link.inc';
	require_once $path_local.'Submit.inc';
	require_once $path_local.'Table.inc';
	require_once $path_local.'IFrame.inc';
	require_once $path_local.'Table.inc';
	require_once $path_local.'IFrame.inc';
	require_once $path_local.'SubmitSpecial.inc';
	require_once $path_local.'Scroll.inc';
	require_once $path_local.'Calendar.inc';
	require_once $path_local.'CheckBox.inc';
	require_once $path_local.'Div.inc'; 
	//require_once $path_local.'Writer.php'; 
	require_once $path_local.'TextEditor.inc'; 
	require_once $path_local.'SelectMultipleDoble.inc';
	require_once $path_local.'Page.inc';
	require_once $path_local.'OverLib.inc';
	require_once $path_local.'HtmlText.inc';
	require_once $path_local.'ControladorDeObjetos.inc';
	require_once $path_local.'JavaScript.inc';
	require_once $path_local.'powerTemplate/class.TemplatePower.inc.php'; 
	require_once $path_local.'ControllerTemplate.php'; 

	/** CLASE PARA CREAR ARCHIVOS PDF */
	require_once $path_local.'pdfClasses009e/class.pdf.php';
	require_once $path_local.'pdfClasses009e/class.ezpdf.php';
	require_once $path_local.'pdfFile.inc';

	/** ADMINISTRACION DATOS XML */
	require_once $path_local."xmldb.inc";
	require_once $path_local.'PersistentObjectXML.inc';

?>
