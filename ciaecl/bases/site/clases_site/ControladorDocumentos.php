<?php



/**************************************************************************
							DOCUMENTOS
**************************************************************************/
class ControlDocumentos
{
	function ControlDocumentos($maximo='')
	{
		$this->maximo = $maximo;
	}
	
	function filtrarListado($e,$html)
	{		
		$aux = split('<div class="caja">',$html); 
		$aux = split('<p>&nbsp;</p>',$aux[1]);
		$html = $aux[0];
		$html = str_replace(array("\n",'<a href="/prontus_cea','N&ordm;','&nbsp;' ),array('', 'http://www.webmanager.cl/prontus_cea','','' ),$html);
		$html = str_replace('>',">\n",$html);
		  //echo $html.'-----------------------------'; 
		$html = strip_tags($html);  
		$html = str_replace('">',"\n",$html); 
		$html = split("\n",$html); 
		$html[] = '-1';
		$total = count($html);
		 if(trim($this->maximo) != '')
		 	$total = $this->maximo*60;
	 	$texto = '';
	 	$link  = '';
	 	
		for($j=0; $j < $total; $j++)
		{ 
			if(trim($html[$j]) == '')
			{
				continue;
			}	 
			if(is_numeric($html[$j]))
			{
				$aux = trim($html[$j])%2+1;		
				if((int)trim($html[$j]) == -1)
					continue;
				$e->addTemplate('bloque_documentos');
				$e->setVariable('numero',trim($html[$j])); 
				$e->setVariable('intercalado',$aux);
				$texto = '';	
	 			$link  = '';			
			}
			else
			{
				if(trim($link)== '')
				{ 
					$link = $this->convercionPDF(trim($html[$j]));
					$e->setVariable('link',$link);
				}
				else
				{
					$texto .= trim($html[$j]).'<br>';		
					$e->setVariable('texto',$texto);
				}
			}	
		 	//echo $j.' '.($html[$j]).'<br>'."\n";
		}
		return $e;
	}
	
	function obtenerListadoDocumentos($e,$opcion='')
	{
		$agno_actual = date('Y');
		$e->setVariable('agno_actual',$agno_actual);
		 if(trim($opcion) == 'view_publicaciones_anteriores')
		 {
		 	for($i=1996; $i < 	$agno_actual; $i++ )
		 	{
		 		$agnos[] = $i;
		 	}
		 }
		 else
		 {
		 	$agnos = array(	$agno_actual);
		 }
			 
	 	$agnos = array_reverse($agnos);
		/** LISTADO DOCUMENTOS POR AGNO */
		for($i=0; $i < count($agnos); $i++)
		{
			$url = "http://www.webmanager.cl/prontus_cea/cea_".$agnos[$i]."/site/port/portada.html"; 
			$data = array('agno'=>$agno);
			$data = http_build_query($data); 
		
			$HTTPCallRequest = new HTTPCallRequest($url,$data);
		 	$html = $HTTPCallRequest->httpResponse('get');
			// echo $html;
			$e = $this->filtrarListado($e,$html);			
		}  
		return $e;
	}
	
	function buscarDocumentosPost($data)
	{
		$url 	= "http://search-2.altavoz.net/cgi-local/search_02.pl";
		$data 	= http_build_query($data);	

		$HTTPCallRequest 	= new HTTPCallRequest($url,$data);
	 	$html 				= $HTTPCallRequest->httpResponse('post');
		  //echo $html; 		
	}
	

	function buscarDocumentosGet($e,$valores)
	{
		$i=1;		
	 	$this->fila = 1;
		while(true)
		{
			//echo $i.'-------------------------------------<br>';
			$url 	= "http://search-2.altavoz.net/cgi-bin/search_03.cgi?search_id=webmanagercea&mode=0&search=".$valores['search']."&p=".$i; 
			$data = array();
			$data 	= http_build_query($data);	
			
			$HTTPCallRequest 	= new HTTPCallRequest($url,$data);
			$html 				= $HTTPCallRequest->httpResponse('get'); 
			$aux = split('class="TABLEresult"',$html);
			//echo 'largo: '.count($aux).' ';
			if(count($aux) < 2)
			{
				break;
			} 
			if($i == 2000)
			{
				break;
			}			
			$this->filtrarBusqueda($e,$html); 
			$i++;
		 }	
		 return $e;
	}	 


	function filtrarBusqueda($e,$html)
	{		
		$aux = split('<span class="TITresult">',$html);  
		$aux = split('<hr align="center" size="1" class="HRsep">',$aux[1]);
		$html = $aux[0];
		$html = str_replace(array("\n",'<a href="','N&ordm;','&nbsp;','class="TEXTlink' ),array('', '','','','' ),$html);
		$html = str_replace('>',">\n",$html);
		  //echo $html.'-----------------------------'; 
		$html = strip_tags($html);  
		$html = str_replace('">',"\n",$html); 
		$html = str_replace('"',"",$html); 
		$html = split("\n",$html); 
		$html[] = '-1';
		$total = count($html); 
	 	$texto = '';
	 	$link  = '';
		for($j=10; $j < $total; $j++)
		{ 
			if(trim($html[$j]) == '')
			{
				continue;
			}	 
			if(is_numeric($html[$j]))
			{
				//echo $j.' '.$html[$j].'--------------<br>';
				$aux = $this->fila%2+1;	 	
				if((int)trim($html[$j]) == -1)
					continue;
				$e->addTemplate('bloque_documentos');  
				$e->setVariable('intercalado',$aux);
				$e->setVariable('fila',$this->fila);
				$this->fila++;
				
				$j= $j+7; 	
				$e->setVariable('link',$this->convercionPDF(trim($html[$j])));	
				$j= $j+2; 	
				$e->setVariable('texto',$html[$j]);		 		
			} 
			//	echo $j.' '.$html[$j].'<br>';
		}  
 		$e;
	}
	
	function convercionPDF($link)
	{ 
		$link = str_replace('http://www.webmanager.cl/prontus_cea/cea_2009/site/pags/','http://www.webmanager.cl/prontus_cea/cea_2009/site/asocfile/ASOCFILE1',$link); 
		$link = str_replace('.html','.pdf',$link); 
		return $link;
	}
		
}
?>