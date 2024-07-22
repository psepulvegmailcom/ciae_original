<?php

class pdfFile extends Cezpdf 
{
	function pdfFile($p='letter',$o='portrait')
	{
		$this->Cezpdf($p,$o);
		$this->selectFont(VarSystem::getPathVariables('path_libs_pdf').'fonts/Times-Roman.afm');
		$this->ezSetCmMargins(6,3,3,3);
	}

	function seguridad($password='')
	{
		$this->setEncryption($password,$password,array('print'));
	}

	function savePdfFile($filename='')
	{ 
		$pdfcode 		= $this->output();
		$dir 			= VarSystem::getPathVariables('dir_repositorio_tmp')."certificados/";
		$filename_ext 	= $filename;
		$fname 			= tempnam($dir.'/','PDF_');
		$fp 			= fopen($fname,'w');
		fwrite($fp,$pdfcode);
		if(fclose($fp))
		{
			//rename($fname, str_replace('.tmp',".pdf",$fname));
			rename($fname,$fname.".pdf");
			$fname = $fname.".pdf";
			 
			$filename = explode('\\',$fname); 
			if(!is_array($filename) || count($filename)==1)
			{
				$filename = explode('/',$fname); 
			} 
			//$filename = str_replace('.tmp',".pdf",end($filename)); 
			$aux = $dir.end($filename); 
			chmod($aux, 0755);  
			if(trim($filename_ext) != '')
			{
				copy($dir.end($filename),$dir.$filename_ext.'.pdf'); 
				$aux = array($filename_ext.'.pdf');  
				return $aux;
			}
			else
			{
				return $filename;
			}
		}
		else
			return '';
	}
}

?>