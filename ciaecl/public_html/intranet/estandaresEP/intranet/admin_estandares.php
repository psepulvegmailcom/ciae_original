<?php	

include ("header.php");  
GeneralImprimirHeader(); 

$e = new miniTemplate('templates/herramientas/traspaso.tpl');

if(isset($_POST['accion']) && trim($_POST['accion']) == 'traspaso')
{ 
	$TraspasoEstandares = new TraspasoEstandares();
	$TraspasoEstandares->NuevaVersion(); 
	$e->addTemplate('bloque_traspaso');
	$e->setVariable('version',$TraspasoEstandares->valores['version_fecha']);
}
else
{ 
	$e->addTemplate('bloque_hacer_traspaso');
	$e->setVariable('version_fecha',date("d-m-Y H:i:s"));
}
echo $e->toHtml();

GeneralImprimirFooter();

class TraspasoEstandares 
{
	var $valores ;
	var $tablas_externas ;
	var $tablas_locales ;
	function TraspasoEstandares()
	{
		$this->valores = array();
		global $DB_externa;
		$this->tablas_externas = array('version'=>'`'.$DB_externa.'`.rubrica_area',
		'dominio'=>'`'.$DB_externa.'`.rubrica_componente',
		'version_usuario' => '`'.$DB_externa.'`.rubrica_area_respuesta',
		'usuario' => '`'.$DB_externa.'`.auth_user_md5',
		'estandares'=> '`'.$DB_externa.'`.rubrica_elemento',
		'ejemplo'=> '`'.$DB_externa.'`.rubrica_ejemplo',
		'indicador'=> '`'.$DB_externa.'`.rubrica_indicador');
	}
	
	function NuevaVersion()
	{
		$this->valores['version_fecha'] = $_POST['version_fecha'];
		//print_r($this->valores);
		$datos = array('area' => $this->valores['version_fecha'],'orden'=>1); 
		$this->valores['version_id'] = GeneralSQLInsertar($this->tablas_externas['version'],$datos);
		
		$sql = "DELETE FROM ".$this->tablas_externas['version_usuario']." ";
		GeneralSQLQuery($sql,true,false);
		
		$sql = "INSERT INTO ".$this->tablas_externas['version_usuario']."  (usuario ,	id_area)
	       SELECT username as usuario, ".$this->valores['version_id']." as id_area
	       FROM ".$this->tablas_externas['usuario']." ";
	    GeneralSQLQuery($sql,true,false);
	 
	 	/** DOMINIO Y ESTANDARES */ 
		$rules = new rules(); 
		$qryBd = new qryBd();
		$dominios = $rules->EPDominiosArchivos(); 
		for($i=0; $i < count($dominios); $i++)
		{
			$orden = $i + 1;
			$datos = array('componente'=>$dominios[$i]['dominio'],'id_area'=>$this->valores['version_id'],'orden'=>$orden);  
			$id_dominio = GeneralSQLInsertar($this->tablas_externas['dominio'],$datos);
			
			$estandares = $qryBd->EPDominiosArchivosDetalle($dominios[$i]['dominio']); 
			
			for($j=0; $j < count($estandares); $j++)
			{				
				$orden = $j + 1;
				$datos = array('elemento'=>  $estandares[$j]['titulo']  ,'descripcion'=> $estandares[$j]['bajada'],'definicion'=> $estandares[$j]['definicion'] ,'id_componente'=> $id_dominio,'orden'=> $orden);  
				$id_estandar = GeneralSQLInsertar($this->tablas_externas['estandares'],$datos);
				
				$indicadores = $qryBd->EPIndicadores($estandares[$j]['id_archivo']);
				//echo "<pre>";print_r($estandares[$j]);echo $id_estandar.'<br>';print_r($indicadores);echo "</pre>";
				for($k=0;$k < count($indicadores);$k++)
				{
					$orden = $k + 1;
					$datos = array('indicador' =>$indicadores[$k]['indicador'],'id_elemento' =>$id_estandar,'orden' =>$orden);
					$id_indicador = GeneralSQLInsertar($this->tablas_externas['indicador'],$datos);
				}
				$ejemplos = $qryBd->EPEjemplos($estandares[$j]['id_archivo']);
				for($k=0;$k < count($ejemplos);$k++)
				{
					$orden = $k + 1;
					$datos = array('ejemplo' =>$indicadores[$k]['ejemplo'],'id_elemento' =>$id_estandar,'orden' =>$orden);
					$id_ejemplo = GeneralSQLInsertar($this->tablas_externas['ejemplo'],$datos);
				}
			}
		} 
	}
	
	
	 
}

?>