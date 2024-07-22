<?php

class generarCertificado
{	  
    public function __CONSTRUCT()
	{
        $this->con = new ConexionBaseDatos('DB_LOCAL');
        $this->pdo = $this->con->connect();		
		$this->funciones = new FuncionesGenerales(); 
    }  
	
	function generarCertificadoPDF($nombre,$correo,$caso,$evento,$fecha,$url_salida)
	{ 
		$url_salida = $url_salida.$caso."-".$correo.".pdf";
		//echo $url_salida;
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->Image('templates/imagenes/cabecera_certificado.jpg',20,15);
		$pdf->SetFont('Arial','B',16);
		$pdf->SetMargins(25, 0, 25);
		//$pdf->Cell(140,110,'¡Hola, Mundo!'.$rut." ".$folio." ".$nombre." ".$carrera); 
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->Cell(140,110,utf8_decode("                          CERTIFICADO ASISTENCIA"),0,'C'); 


		$pdf->Image('templates/imagenes/firma_certificado.jpg',70,160);

		$pdf->SetFont('Arial','',12); 
		//$pdf->MultiCell(0,90,utf8_decode("FOLIO ".$folio),0,'R');  



		//$pdf->Image('fondo_constancia.jpg',130,120,200,200);

		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L'); 
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L'); 
		$pdf->MultiCell(0,10,utf8_decode("Carmen Sotomayor, directora del Instituto de Estudios Avanzados en Educación de la Universidad de Chile, certifica que ".$nombre." participó como asistente del ".'"'.$evento.'"'." realizado ".$fecha."."),0,'L');


  
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L'); 
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L'); 
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,10,utf8_decode("Carmen Sotomayor"),0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,10,utf8_decode("Directora"),0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,10,utf8_decode("Instituto de Estudios Avanzados en Educación"),0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,10,utf8_decode("Universidad de Chile"),0,'C'); 
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L');
		$pdf->MultiCell(0,10,utf8_decode(" "),0,'L'); 
		$pdf->SetFont('Arial','I',10); 
		$pdf->MultiCell(0,10,utf8_decode("Santiago, ".date("d/m/Y")),0,'L');

		$pdf->Output("f",$url_salida,TRUE);
		return $url_salida;
	}

	 
}
?>