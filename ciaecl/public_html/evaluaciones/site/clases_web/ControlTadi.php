<?php 

class PedidosTadi extends Objetos
{
	var $sourceTable =  'site_tadi_pedido'; 
	
	function PedidosTadi()
	{  
		parent::Objetos();
		$this->dbKey 		= 'id_pedido'; 
	} 
} 


?>