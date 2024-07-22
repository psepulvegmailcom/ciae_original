<?php

class pdfFile extends Cezpdf 
{
	function pdfFile($p='letter',$o='portrait')
	{
		$this->Cezpdf($p,$o);
		if(class_exists(VarSystem))
			$this->selectFont(VarSystem::getPathVariables('path_libs_pdf').'fonts/Times-Roman.afm');
		$this->ezSetCmMargins(6,0,3,3);
	}

	function seguridad($password='')
	{
		$this->setEncryption($password,$password,array('print'));
	}

	function savePdfFile($filename='',$dir='')
	{ 
		$pdfcode 	= $this->output(); 
		if(trim($dir) == '')
		{
			if(class_exists(VarSystem))
				$dir 		= VarSystem::getPathVariables('dir_repositorio_tmp');
		}
		else
			$dir = $dir."/";
		 
		$fname 	= tempnam($dir,'PDF_');
		$fp 	= fopen($fname,'w');
		fwrite($fp,$pdfcode);
		if(fclose($fp))
		{ 
			copy($fname, $fname.".pdf"); 
			unlink($fname);
			$filename = str_replace($dir,'',$fname).".pdf";  
			return $filename;
		}
		else
			return '';
	}
}

?>