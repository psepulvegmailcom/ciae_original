<?php

class HTTPRequest
{
    var $_fp;         // HTTP socket
    var $_url;        // full URL
    var $_host;       // HTTP host
    var $_protocol;   // protocol (HTTP/HTTPS)
    var $_uri;        // request URI
    var $_port;       // port
   
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
        $body 	= substr($response, $pos + 2 * strlen($crlf));
       
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
 

		
	function getHtmlData()
	{ 
		$html = $this->DownloadToString(); 
		preg_match_all('/<tr>\s*<td[^>]*>((?:<td.+?<\/td|.)*?)<\/td>/si', $html, $matches);
			
		return $matches; 
	}	
	
	function getHTMLPlain()
	{
		$html = $this->DownloadToString();  
		$html = html_entity_decode($html); 
		return $html;
	}
	
	function getHTMLClean(){
	 
		$html = $this->DownloadToString(); 
		$html = str_replace(">",">\n",$html);
		$html = strip_tags($html);
		$html = html_entity_decode($html); 
		return $html;
	}
}

/* otra version,  solucion para https con post */
class HTTPCallRequest
{
	var $variable;
	var $url;
	var $method;
	var $output;
	
	function HTTPCallRequest($url,$data=array())
	{
		if(is_array($data))
			$data = http_build_query($data);
		$this->variable = $data;
		$this->method = $method;
		$this->url = $url;
		$this->output = 'ERROR';
	}
	
	private function isSSL()
	{
		$aux = explode('https',$this->url);
		if(count($aux) > 2)
			return true;
		else
			return false;
	}
		
	function httpResponse($method)
	{
		$ch = curl_init();
		if($this->isSSL())
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
		switch($method)
		{
			case 'get':				
				$res = curl_setopt ($ch, CURLOPT_URL,$this->url.'?'.$this->variable);
			break;
			case 'post':
				$res= curl_setopt ($ch, CURLOPT_URL,$this->url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $this->variable);
			break;				
		}		
		ob_start();
		curl_exec($ch);	
		$this->output = ob_get_contents();	
		ob_end_clean();
		curl_close($ch);  
		return $this->output;
	}
}


?>