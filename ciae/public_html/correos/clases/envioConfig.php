<?php

class envioConfig
{	  
    public function __CONSTRUCT()
	{
        $this->con = new ConexionBaseDatos('DB_LOCAL');
        $this->pdo = $this->con->connect();		
		$this->funciones = new FuncionesGenerales(); 
    } 
	
	public function obtenerEnviosAntiguos()
	{		
		$sql = "SELECT caso_envio, asunto
    	 FROM envio_email_detalle ORDER BY estado ASC, caso_envio DESC	, fecha_actualizacion DESC		  "; 
		$salida = $this->con->obtenerDatos($sql);  
		return $salida;
	} 
 
	public function copiarEnvio($valores)
	{
		print_r($valores);
		
		
		$nuevo_asunto = trim($valores['nuevo_asunto']);
		if($nuevo_asunto == '')
		{
			$nuevo_asunto = "  asunto ";
		}
		else
		{
			$nuevo_asunto = "'".$valores['nuevo_asunto']."' as  asunto ";
		}
		$nuevo_contenido = trim($valores['nuevo_contenido']);
		if($nuevo_contenido == '')
		{
			$nuevo_contenido = "  contenido ";
		}
		else
		{
			$nuevo_contenido = "'".$valores['nuevo_contenido']."' as  contenido ";
		}
		
		$sql = "INSERT INTO envio_email_detalle (caso_envio, tipo, estado, asunto, tipo_remitente, reply,cc_1, cc_2, bcc_1, bcc_2, contenido)
SELECT  '".$valores['nuevo_caso_envio']."' as caso_envio,   'manual' as tipo, 'activoE' as estado,   ".$nuevo_asunto.", tipo_remitente, reply,cc_1, cc_2, bcc_1, bcc_2, ".$nuevo_contenido."
 FROM envio_email_detalle
WHERE caso_envio = '".$valores['caso_envio']."';"; 
		echo $sql."<br>";
		$this->con->ejecutarQuery($sql); 
		
		
		$sql = "INSERT INTO envio_email_destino (caso_envio,   email, estado,    nombre, apellidos ) VALUES ('".$valores['nuevo_caso_envio']."',   'psepulve@gmail.com', 'no_enviado',     'Paulina', 'Sepúlveda' );"; 
		echo $sql."<br>";
		$this->con->ejecutarQuery($sql); 
		 
		if(isset($valores['opcion']) && $valores['opcion'] == 'email')
		{			
			$sql = "INSERT IGNORE INTO envio_email_destino (caso_envio,  estado,email, nombre, apellidos)
	SELECT  '".$valores['nuevo_caso_envio']."' as caso_envio,  'pendiente' as estado, email, nombre, apellidos
	 FROM envio_email_destino
	WHERE caso_envio = '".$valores['caso_envio']."' AND estado != 'rebote' ;"; 
			echo $sql."<br>";
			$this->con->ejecutarQuery($sql); 	 
		}
	}
}
?>