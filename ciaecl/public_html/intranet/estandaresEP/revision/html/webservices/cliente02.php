<table>
<tr>
<td  style="vertical-align:top; width:450px;">

<form method="post" name='main'>
RBD <input name="rbd"  type="text" value="" > (25540)<br>
DV RBD <input name="rdbDv"  type="text" value=""> (8)<br>
RUT ATE <input name="rut"  type="text" value=""> (71635600-0)<br>
Fecha Cobro <input name="fecha"  type="text" value=""> (20032009) (ddmmaaaa)<br>
Código <input name="codigo"  type="text" value=""> (003693-000163)<br> 
<input type="submit">
<br><br>
  
<?php
if(is_array($_POST) && count($_POST) > 0)
{ 
	?>
	<script>
	document.main.rbd.value = '<?php echo $_POST['rbd']; ?>';
	document.main.rdbDv.value = '<?php echo $_POST['rdbDv']; ?>';
	document.main.rut.value = '<?php echo $_POST['rut']; ?>';
	document.main.fecha.value = '<?php echo $_POST['fecha']; ?>';
	document.main.codigo.value = '<?php echo $_POST['codigo']; ?>';
	</script>
	<?php
	require_once('../../libs/nusoaplib/nusoap.php');					
	$aux = str_replace('cliente02.php','percepcionATETEST.php?wsdl',$_SERVER['HTTP_REFERER']);
	$aux = str_replace('www.registroate.cl','localhost/ate',$aux);
	//echo $aux.'<br>';
	//$aux = 'http://localhost/ate/webservices/percepcionATETest.php?wsdl';
	$oSoapClient = new nusoap_client( $aux, true);  

	//$oSoapClient = new nusoap_client( 'http://localhost/desarrollo/ate/html/webservices/percepcionATE.php?wsdl', true); 
	 
	if ($sError = $oSoapClient->getError()) 
	{ 	
		echo "No se pudo realizar la operación [" . $sError . "]"; 
		die(); 
	}
	 
		    
	$aParametros = array('rbd' => $_POST['rbd'],'rdbDv' => $_POST['rdbDv'],'rut' => $_POST['rut'],'fecha' => $_POST['fecha'],'codigo' => $_POST['codigo']);
	//$aParametros = array('rbd' => '1','rdbDv' => '9','rut' => '76005635-9','fecha' => '15012007','codigo' => '000083-000147');
  
	$aRespuesta = $oSoapClient->call("consultarPercepcion", $aParametros ); // Existe alguna falla en el servicio? 
	
	if ($oSoapClient->fault) 
	{ // Si 
		echo "No se pudo completar la operaci&oacute;n"; 
		die(); 
	} 
	else 
	{ // No 
		$sError = $oSoapClient->getError();  
		if ($sError) 
		{ // Si 
			echo "Error:" . $sError; 
			die(); 
		} 
	}  
	
	//echo "<pre style='max-width:400px;'>";
	echo  nl2br(str_replace(array("\t","&gt;"),array("&nbsp;&nbsp;&nbsp;&nbsp;","&gt;\n"),htmlentities($aRespuesta)));
	//echo "</pre>";
}
?>
</td>

<td  style="vertical-align:top;  ">
 
 </td>
</tr></table></form>
 