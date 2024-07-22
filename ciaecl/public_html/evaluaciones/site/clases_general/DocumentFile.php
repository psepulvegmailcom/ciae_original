<?php
 

class DocumentFile 
{	
	var $originalName;
	var $contentType;
	var $fileTmp;
	var $fileName;
	var $size;
	var $extension;	
	var $errorUpload;
	var $errorSave;
	var $folder_deep = 4;
	var $extension_allow;
	var $extension_error ;
	
	function DocumentFile($path_file) 
	{
		$this->path  			= $path_file;
		$this->extension_allow 	= array();
		$this->change_name 		= true;	
	}
	
	function checkPath()
	{
		if(!is_dir($this->path))
		{
			//mkdir($this->path);
		}
	} 
	
	function setExtensionAllow($extension)
	{
	
		if(is_array($extension))
			$this->extension_allow = $extension;
		else
			$this->extension_allow[] = $extension;
	}
	
	function isErrorExtension()
	{
		return $this->extension_error;
	}
	
	function setFileArray($dataFile) 
	{
		$this->setValues($dataFile);
	}
	
	function setFile($dataFile) 
	{
		$this->fileName      = $dataFile;	
	}
	
	private function setValues($dataFile) 
	{	
		$this->setFileName($dataFile['name']);
		$this->extension_error = false;
		if(count($this->extension_allow) > 0)
		{ 
			if (!in_array($this->extension, $this->extension_allow))
			{
				$this->extension_error = true;
			}	
		}		 
		$this->contentType   = $dataFile['type'];
		$this->size          = $dataFile['size'];
		$this->fileTmp       = $dataFile['tmp_name'];
		$this->new_name      = $dataFile['new_name'];
		$this->errorUpload   = $dataFile['error'];	
		$this->errorSave     = false;
		$this->fileName      = '';	
	}
	
	private function setFileName($name) 
	{			
		$this->extension         = strtolower(trim(array_pop(explode('.',$name))));
		$excluidos               = array('ñ','Ñ','á','é','í','ó','ú',' ',"'",'"');
		$reemplazo               = array('_n','_N','a','e','i','o','u','_',"",'');
		$this->originalName      = str_replace($excluidos,$reemplazo,$name);		
		$this->originalName      = str_replace(".".$this->extension,"",$this->originalName);
		$this->new_name			 = str_replace($excluidos,$reemplazo,$this->new_name);	
		return $name;
	}
	
	function setNewName($name)
	{
		$this->new_name = $name;
	}

	function notChangeName($name)
	{
		$this->change_name = false;
	}	
		
	private function prepareFile() 
	{	
		$md5_doc            = md5(file_get_contents($this->fileTmp)."_".time());		
		$path_md5           = str_split($md5_doc);
		$folders            = '';
		for($i=0; $i < $this->folder_deep;$i++)
		{			
			$folders .= $path_md5[$i]."/";
			if(!file_exists($this->path.$folders) && !mkdir($this->path.$folders,0777)) /*si no existe la carpeta*/
			{
				return false;
			}	
		}	
		$this->folderName	= $folders;
		$this->fileName		= $folders.substr($md5_doc,$this->folder_deep).'.'.$this->extension;	
	}
		
	private function prepareFileSimple() 
	{	
		$this->folderName	= '';
		if(trim($this->new_name) == '')
		{
			$this->new_name  = md5(file_get_contents($this->fileTmp)."_".time());	;
		}
		if($this->change_name)
			$this->fileName		= $this->new_name.'-'.time().'.'.$this->extension;	
		else
			$this->fileName		= $this->new_name.'.'.$this->extension;
	}
	
	function saveFile($md5=true) 
	{			
		if(!$this->extension_error)
		{			
			if($md5)
			{
				$this->prepareFile();
			}
			else
			{
				$this->prepareFileSimple();
			}
			Funciones::mostrarArreglo($this);
			if(!(bool)$this->errorUpload)
			{			
				if(!file_exists($this->path.$this->fileName))
				{
					if(copy( $this->fileTmp,$this->path.$this->fileName))
					{	 
						$this->errorSave     = true;
					}
				}
			}
		}
		return $this->errorSave;	
	}	
	
	function getOriginalName() {
		return $this->originalName;
	}
	
	function getFileName() {
		return $this->fileName;	
	}
	
	function getFileExtension() {
		return $this->extension;
	}
	
	function getContentType() {
		return $this->contentType;	
	}
	
	function getSize() {
		return $this->size;	
	}

	function deleteFile() {		 
		//echo $this->path.$this->fileName;
		if(file_exists($this->path.$this->fileName) && @unlink($this->path.$this->fileName))
			return true;
		return false;
	}
} 
?>
