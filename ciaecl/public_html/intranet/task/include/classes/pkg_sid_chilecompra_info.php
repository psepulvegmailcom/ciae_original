<?php 


function create_insert_chilecompra($url,$revisar)
{
	$r = new HTTPRequest( $url ); 
	
	$paginaChileCompra =  $r->DownloadToString(); 
	$resultado = getChileCompraInfo($paginaChileCompra);
	 
	// echo "<pre>";print_r($resultado);echo "</pre>";
	
	$query = "INSERT INTO v0_sid_chilecompra (id, institucion, propuesta, descripcion, link, numero,chileproveedores, presupuesto, fecha, revisar,fecha_creacion) VALUES (NULL,";
	$query .=  "'".strip_tags(trim($resultado["DemandanteRazonSocial"].' - '.$resultado["DemandanteOrgCNombre"]))."',";
	$query .=   "'".strip_tags(trim($resultado["NomAdquisicion"]))."',";
	$query .=   "'".strip_tags(trim(str_replace("-"," - ",$resultado["Descripcion"])))."',";
	$query .=  "'".$url."',";
	$query .=  "'".strip_tags(trim($resultado["NumAdquisicion"]))."',";
	$query .=   "'".strip_tags(trim($resultado["ChileProveedores"])).";',";
	$query .=   "'".strip_tags(trim($resultado["TipoAdquisicion"]))."',";
	
	$aux = split(' ',strip_tags(trim($resultado["CierreOfertas"])));
	$horaCierre = $aux[1].":00";
	$aux = split('-',$aux[0]);
	$resultado["CierreOfertas"] = $aux[2].'-'.$aux[1].'-'.$aux[0]." ".$horaCierre;
	$query .=  "'".trim($resultado["CierreOfertas"])."',";
	$query .=   $revisar.",'".date('Y-m-d')."');";

	$query = str_replace("&nbsp;"," ",$query);
	$query = str_replace("&nbsp"," ",$query);
	
	//echo $query;
	return $query;
}

function cleanStringChileCompraInfo($text)
{
	$text 	= trim(str_replace("\n\r",'',strip_tags($text)));
	$aux 	= explode(" ",$text); 
	$aux2 	= trim(end($aux)); 
	while(true)
	{
		if(trim($aux2) == '')
			break;
		$valor = $aux2." ".$valor;
		$aux2 = trim(prev($aux));	 
	}
	
	$valor = utf8_decode($valor);
	//$valor = htmlentities($valor);
	return $valor;
}

/*echo "<pre>";
print_r($resultado);
echo "</pre>";echo "<br/>Todos los campos:<br/><br/>";
$i=0;
foreach( $resultado["todosloscampos"] as $campo ){
	echo "Campos ".$i.": ".$campo."<br/>";
$i++;
}*/

//**************************** fin ****************************/
//Funciones y objectos
function getChileCompraInfo($phrase)
{
	
	/* +\.[^.]
	# - the regex delimiter (goes either side)
	\[ - match an open square bracket
	(.+?) - followed by at least one character (this is non-greedy, meaning it will stop matching as soon as it can)
	=\"? - followed by an equals and quote (but the quote is optional)
	(.+?) - same again, at least one character, non-greedy
	\"? - optional quote again
	\] - followed by closed square bracket
	# - regex delimiter
	i - make the regex case-insensitive*/
//GralSubtitulos

	
	//Descripcion
	if( preg_match_all ("/<tr class=\"formFilas\">([^`]*?)<\/tr>/", $phrase, $matches) ){
		$todoslostextos =  $matches[0];		
	}
	//echo "<pre>";print_r($todoslostextos);echo "</pre>";
	if(preg_match("/<span id=\"crtlFichaAdq_lblNombreLC2\">([^`]*?)<\/span>/", $phrase, $matches) ){
		$GralSubtitulos =  $matches[0];
	}
	//DemandanteRazonSocial
	$DemandanteRazonSocial =  cleanStringChileCompraInfo($todoslostextos[0]);
	
	//DemandanteOrgCNombre 
	$DemandanteOrgCNombre =  cleanStringChileCompraInfo($todoslostextos[1]);
	//DemandanteRut 
	$DemandanteRut =  cleanStringChileCompraInfo($todoslostextos[2]); 
	
	//crtlFichaAdq_lblDemandanteDireccion 
	$DemandanteDireccion  =  cleanStringChileCompraInfo($todoslostextos[3]);

	//DemandanteComuna
	$DemandanteComuna  =  cleanStringChileCompraInfo($todoslostextos[4]);
	//DemandanteComuna
	$RegionNombre  =  cleanStringChileCompraInfo($todoslostextos[4]);
 
	$CierreOfertas  =  cleanStringChileCompraInfo($todoslostextos[23]);
	 		
	$Descripcion  =  cleanStringChileCompraInfo($todoslostextos[13]);
	 
	$NumAdquisicion  =  cleanStringChileCompraInfo($todoslostextos[11]); 
	
	$TipoAdquisicion  =  cleanStringChileCompraInfo($todoslostextos[14]);
	$NomAdquisicion  =  cleanStringChileCompraInfo($todoslostextos[12]);
	
	 		
	
	$ChileProveedores =  cleanStringChileCompraInfo($todoslostextos[35]);
	//esto es ok
	
	if( preg_match_all ("/<span class=\"formCampos\">([^`]*?)<\/span>/", $phrase, $matches) ){
		$todosloscampos =  $matches[0];
	}


	
		
	$rs = array( "GralSubtitulos"=>$GralSubtitulos, 
				 "DemandanteRazonSocial"=>$DemandanteRazonSocial,
				 "DemandanteOrgCNombre"=>$DemandanteOrgCNombre,	
				 "DemandanteRut"=>$DemandanteRut, 
				 "DemandanteDireccion"=>$DemandanteDireccion,
				 "DemandanteComuna"=>$DemandanteComuna,
				 "RegionNombre"=>$RegionNombre,
				 "CierreOfertas"=>$CierreOfertas,
				 "Descripcion"=>$Descripcion,
				 'NumAdquisicion' => $NumAdquisicion,
				 "todosloscampos"=>$todosloscampos,
				 'ChileProveedores' => $ChileProveedores,
				 'NomAdquisicion' => $NomAdquisicion,
				 'TipoAdquisicion' => $TipoAdquisicion,
				 "todoslostextos"=>$todoslostextos
				);
				
	return $rs;
}


//clase request
class HTTPRequest
{
    var $_fp;        // HTTP socket
    var $_url;        // full URL
    var $_host;        // HTTP host
    var $_protocol;    // protocol (HTTP/HTTPS)
    var $_uri;        // request URI
    var $_port;        // port
   
    // scan url
    function _scan_url()
    {
        $req = $this->_url;
       
        $pos = strpos($req, '://');
        $this->_protocol = strtolower(substr($req, 0, $pos));
       
        $req = substr($req, $pos+3);
        $pos = strpos($req, '/');
        if($pos === false)
            $pos = strlen($req);
        $host = substr($req, 0, $pos);
       
        if(strpos($host, ':') !== false)
        {
            list($this->_host, $this->_port) = explode(':', $host);
        }
        else
        {
            $this->_host = $host;
            $this->_port = ($this->_protocol == 'https') ? 443 : 80;
        }
       
        $this->_uri = substr($req, $pos);
        if($this->_uri == '')
            $this->_uri = '/';
    }
   
    // constructor
    function HTTPRequest($url)
    {
        $this->_url = $url;
        $this->_scan_url();
    }
   
    // download URL to string
    function DownloadToString()
    {
        $crlf = "\r\n";
       
        // generate request
        $req = 'GET ' . $this->_uri . ' HTTP/1.0' . $crlf
            .    'Host: ' . $this->_host . $crlf
            .    $crlf;
       
        // fetch
        $this->_fp = fsockopen(($this->_protocol == 'https' ? 'ssl://' : '') . $this->_host, $this->_port);
        fwrite($this->_fp, $req);
        while(is_resource($this->_fp) && $this->_fp && !feof($this->_fp))
            $response .= fread($this->_fp, 1024);
        fclose($this->_fp);
       
        // split header and body
        $pos = strpos($response, $crlf . $crlf);
        if($pos === false)
            return($response);
        $header = substr($response, 0, $pos);
        $body = substr($response, $pos + 2 * strlen($crlf));
       
        // parse headers
        $headers = array();
        $lines = explode($crlf, $header);
        foreach($lines as $line)
            if(($pos = strpos($line, ':')) !== false)
                $headers[strtolower(trim(substr($line, 0, $pos)))] = trim(substr($line, $pos+1));
       
        // redirection?
        if(isset($headers['location']))
        {
            $http = new HTTPRequest($headers['location']);
            return($http->DownloadToString($http));
        }
        else
        {
            return($body);
        }
    }
}
?>
