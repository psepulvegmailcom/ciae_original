<?php


class ControlSeleccionMultiple extends ControladorDeObjetos {

	var $obj1; 	
	var $obj2;
	var $nombre_campo; 
	var $ordenar = true;	 
	
	function ControlSeleccionMultiple() {			
		parent::ControladorDeObjetos();
		$this->obj1 			= new PersistentObject(); 	
		$this->obj2 			= new PersistentObject();
		$this->nombre_campo 	= ''; 	 
		$this->sourceTable 		= $this->obj1->sourceTable;
	}	 
	 
	function getListaOnlyOferente($id_oferente){
	
		$sql = "SELECT ofr.*  
				FROM   ".$this->obj2->sourceTable." as ofr
				WHERE ofr.id_oferente = ".$id_oferente."";
		return parent::getQuery($sql);
	}
	
	function getLista($id_oferente){
		
		$sql = "SELECT r.id_".$this->nombre_campo." as id_registro, r.".$this->nombre_campo." as registro ,'' as selected,'' as checked,r.oficial, r.orden
				FROM ".$this->sourceTable." as r WHERE r.oficial=1 UNION 
		SELECT r.id_".$this->nombre_campo." as id_registro, r.".$this->nombre_campo." as registro ,'selected' as selected,'checked' as checked,r.oficial, r.orden
				FROM ".$this->sourceTable." as r, ".$this->obj2->sourceTable." as ofr
				WHERE ofr.id_oferente = ".$id_oferente." AND ofr.id_".$this->nombre_campo." = r.id_".$this->nombre_campo."				
				UNION 
				SELECT table1.id_".$this->nombre_campo." as id_registro, table1.".$this->nombre_campo." as registro, '' as selected ,'' as checked, oficial,  table1.orden
				FROM ".$this->sourceTable." as table1 
					LEFT JOIN ".$this->obj2->sourceTable."  as table2 ON table1.id_".$this->nombre_campo." = table2.id_".$this->nombre_campo." 
				WHERE table1.oficial = 1 AND table2.id_".$this->nombre_campo." IS NULL";
				
		
			$sql .= " ORDER BY oficial DESC,orden ASC, id_registro ASC, selected ASC,checked ASC ";				
		if($this->ordenar)		
			$sql .= ",registro";
			 
		 
		$registros = parent::getQuery($sql);
		// echo "<br>".$sql."<br><br>"; print_r($registros);
			 
		for($i=0; $i < count($registros); $i++)
		{
			$aux = $i + 1;
			if(trim($registros[$i]['id_registro']) == trim($registros[$aux]['id_registro']))
			{
				unset($registros[$i]); 
				$registros = array_values($registros);
			} 
		}   
		$registros = array_values($registros); 
		return $registros;
		
	}
	
	function cleanRegistros(){
		$sql = " SELECT table1.id_".$this->nombre_campo."  as id_registro 
				FROM ".$this->sourceTable." as table1 
					LEFT JOIN ".$this->obj2->sourceTable."  as table2 ON table1.id_".$this->nombre_campo." = table2.id_".$this->nombre_campo."
				WHERE table1.oficial=0 AND table2.id_".$this->nombre_campo." IS NULL ";
				//echo $sql;
		 $registro = parent::getQuery($sql);
		 for($i=0; $i < count($registro); $i++)
		 {		 
			$where =  " id_".$this->nombre_campo."='".$registro[$i]['id_registro']."'";	
			$this->obj1->destroyObject($where);
		 }
	}
	
	function deleteRegistrosOferente($id_oferente){
		
		$where = "id_oferente='".$id_oferente."'";	
		$this->obj2->destroyObject($where);
	
	} 

	function addRegistroOferente($id_oferente,$id_registro){
	
		
		$sql = "INSERT INTO ".$this->obj2->sourceTable." (id_oferente,id_".$this->nombre_campo." ) VALUES ('".$id_oferente."','".$id_registro."');";
		
		return parent::getQuery($sql);	
	}	
	
	function addNewRegistro($registro){
		 
		$id_registro = Funciones::cleanChar($registro);  	 
		$sql = "INSERT INTO ".$this->obj1->sourceTable." (id_".$this->nombre_campo.",".$this->nombre_campo.",oficial ) VALUES ('".$id_registro."','".$registro."',0);";
		
		if(parent::getQuery($sql))
		{	
			$this->obj1->loadObject("id_".$this->nombre_campo."=".$id_registro);
			if(isset($this->obj1->oficial))
				return $id_registro;
			else
			{	
				$sql = "SELECT MAX(id_".$this->nombre_campo.") as max FROM ".$this->obj1->sourceTable."";
				$rs = parent::getQuery($sql);
				return $rs[0]['max'];
			}
		}
		else
			return false;
	}
}

?>