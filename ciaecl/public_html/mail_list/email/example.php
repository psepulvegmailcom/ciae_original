<?
	// Klasse Einbinden
	include("../../clases/pictureclass.php");

	// Neue Instanz der bildmail() Klasse erstellen
	$bildmail = new bildmail();

	// Absender angeben
	$bildmail->from("Name","psepulve@gmail.com");
	$bildmail->subject('Invitaci�n 3� conferencia "Relatos de Acci�n" - Ciclo Relatos para la Educaci�n en el Bicentenario | CIAE - CEPPE');
	// Empf�nger Adresse angeben
	$bildmail->to("psepulve@gmail.com");
	$bildmail->bcc("contact@sidwod.com");

	// EmailBodyText setzen				Bild in Text einf�gen
	// Die Funktion setbild muss im Text festgelegt werden
	$bildmail->settext('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Invitaci�n 3� conferencia "Relatos de Acci�n" de ciclo Relatos para la Educaci�n en el Bicentenario | CIAE - CEPPE</title>
</head>

<body>
<a
 href="http://eventioz.com/events/relatos-para-la-educacion-en-el-bicentenario/registrations/new?iframe">
  '.$bildmail->setbild("imagenes/relatos_3.jpg").' </a>
<br /><br />
Si no puede visualizar este email haga click <a href="http://www.ciae.uchile.cl/intranet/email/1.html">aqu� </a>

</body>
</html>');

	// Email versenden
	$bildmail->send();
?>