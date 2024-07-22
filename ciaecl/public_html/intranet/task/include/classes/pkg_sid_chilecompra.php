<?
/*psepulve*/
class ChileCompra extends TznDb
{
	
	function ChileCompra() 
	{
		parent::TznDb('sid_chilecompra');
		$this->addProperties(array(
			'id'				=> 'UID',
			'institucion'		=> 'STR',  	
			'propuesta'			=> 'STR', 	
			'descripcion'		=> 'STR',
			'link'				=> 'STR', 	
			'chileproveedores'	=> 'STR', 	
			'numero'			=> 'STR',
			'presupuesto'		=> 'STR',
			'fecha'				=> 'DTM',
			'revisar'			=> 'NUM'			
		));
	}
		
		
	function getPropuestas($revisar = true,$visible=true) 
	{
		if($revisar)
			$revisar = 0;
		else
			$revisar =1;
		$sql = "SELECT * 
			FROM ".$this->gTable('sid_chilecompra')."
			WHERE revisar =".$revisar." AND fecha >= NOW() ";
		if($visible)
		{	$sql .= " AND publicar=1 "; }
		$sql .= " ORDER BY fecha ASC";
			//echo $sql."<br>";
		$this->getConnection();
		if ($result = $this->query($sql)) 
		{
			$arrIds = array();
			while($objItem = $result->rNext()) 
			{
				$arrIds[] = get_object_vars($objItem);
			} 
		}
		return $arrIds;
	}
	
	function insertPropuesta($sql)
	{
		$this->getConnection();
		$this->query($sql);
	}

	function ocultarPropuesta($id)
	{
		$this->getConnection();
		$sql = "UPDATE ".$this->gTable('sid_chilecompra')." SET publicar = 0 WHERE id =".$id." LIMIT 1 ;";
		$this->query($sql);
	}	
	function publicarPropuesta($id)
	{
		$this->getConnection();
		$sql = "UPDATE ".$this->gTable('sid_chilecompra')." SET publicar = 1 WHERE id =".$id." LIMIT 1 ;";
		$this->query($sql);
	}	
}

?>