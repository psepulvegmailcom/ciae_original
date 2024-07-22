<?
	require_once 'PHPLIB.php';
	require_once 'layersmenu-common.inc.php';
	require_once 'layersmenu.inc.php';
	require_once 'treemenu.inc.php';
	

	$file = '../libs/date.php';
	if(file_exists($file))
		require_once $file ;
	else
		require_once 'date.php';
  
	require_once 'AuthSession.inc';
	require_once 'AuthSessionIntranet.inc';
	require_once 'HtmlElement.inc';
	require_once 'FormControl.inc';
	require_once 'PersistentObject.inc';
	require_once 'pgsql.inc';
	require_once 'oracle.inc';
	require_once 'dblogic.inc';
	require_once 'Button.inc';
	require_once 'RadioButton.inc';
	require_once 'Frame.inc';
	require_once 'FloatingFrame.inc';
	require_once 'HtmlFile.inc';
	require_once 'InputText.inc';
	require_once 'MsgBox.inc';
	require_once 'PasswordText.inc';
	require_once 'Select.inc';
	require_once 'TextArea.inc';
	require_once 'Confirm.inc';
	require_once 'Hidden.inc';
	require_once 'Image.inc';
	require_once 'Link.inc';
	require_once 'Submit.inc';
	require_once 'Form.inc';
	require_once 'InputFile.inc';
	require_once 'Message.inc';
	require_once 'Page.inc';
	require_once 'Table.inc';
	require_once 'IFrame.inc';
	require_once 'SubmitSpecial.inc';
	require_once 'Scroll.inc';
	require_once 'OverLib.inc';
	require_once 'SelectMultipleDoble.inc';
	require_once 'ControladorDeObjetos.inc';
	require_once 'Calendar.inc';
	require_once 'CheckBox.inc';
	require_once 'HtmlText.inc';
	require_once 'JavaScript.inc';
	//require_once 'Writer.php'; 
	require_once 'Div.inc'; 
	require_once 'TextEditor.inc'; 
	require_once 'powerTemplate/class.TemplatePower.inc.php';

	/* clase para crear archivos PDF */
	require_once 'pdfClasses009e/class.pdf.php';
	require_once 'pdfClasses009e/class.ezpdf.php';
	require_once 'pdfFile.inc';

?>
