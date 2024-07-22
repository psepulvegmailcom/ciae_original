<?php

   
	class CertificadoDetalle extends Objetos
	{	
		var $sourceTable = "site_certificado_detalle";
		
		function CertificadoDetalle()
		{
			parent::Objetos();
		}
		
		function buscarCertificado($certificado,$email)
		{
			parent::loadObject('email = "'.$email.'" AND id_certificado = "'.$certificado.'"');
		}
	}
	
	
	class ControlCreadorCertificado extends ControladorDeObjetos 
	{
		function ControlCreadorCertificado()
		{
			parent::ControladorDeObjetos();  	
		} 
	
		function crearCertificado($nombrePersona,$id_certificado,$texto_extra='',$email='')
		{ 
			$path_certificado = VarSystem::getPathVariables('dir_template_web').'certificados/pdf/'.$id_certificado.'/';
			
			$certificado_base = false;
			if(!file_exists($path_certificado.'texto.tpl'))
			{
				$certificado_base = true;
				$path_certificado = VarSystem::getPathVariables('dir_template_web').'certificados/pdf/certificado_base/';
			}
			$EventosInforme = new EventosInforme();
			$EventosInforme->obtenerIDInscripcion($id_certificado);
			Funciones::mostrarArreglo($EventosInforme,false,'EventosInfoosInfoosInfoosInforme'); 
			
			$e 	= new miniTemplate($path_certificado.'texto.tpl'); 	
			$e->setVariable('nombre',$nombrePersona); 
			$e->setVariable('texto_extra',$texto_extra);
			$e->setVariable('titulo',$EventosInforme->nombre); 
			$e->setVariable('fecha',$EventosInforme->certificado_fec);
			$e->setVariable('horas',$EventosInforme->certificado_horas); 
			$e->setVariable('ubicacion',$EventosInforme->certificado_ubicacion); 
			$e->setVariable('organizador',$EventosInforme->certificado_organizadores); 
			$texto = $e->toHtml();
			$e 	= new miniTemplate($path_certificado.'firma.tpl'); 
			$firma = $e->toHtml();	
			$e 	= new miniTemplate($path_certificado.'titulo.tpl'); 
			$titulo = $e->toHtml();	
			$e 	= new miniTemplate($path_certificado.'fecha.tpl'); 
			$e->setVariable('fecha',$EventosInforme->certificado_encabezado_fech);
			$fecha = $e->toHtml();	
			 
			$texto_salto = explode("\n",$texto); 
			$total_texto_salto = count($texto_salto)/2;
			
				
			$pdf = new pdfFile();
			//$pdf->seguridad();	 
		 
		 	$y_firma = 235; 
			$largo_organizadores =  strlen(trim($EventosInforme->certificado_organizadores));
			if($largo_organizadores <= 100 && $certificado_base)
			{
				$y_firma = $y_firma + 30;
			} 	 	
		 	if($total_texto_salto <= 2)
		 	{
				$y_firma = $y_firma + 40;
			} 
			else	 	 
		 	{
				$y_firma = $y_firma - (10*$total_texto_salto);
			} 
		 	
			$pdf->addJpegFromFile($path_certificado.'cabecera.jpg',20,670,560); 
			$pdf->addJpegFromFile($path_certificado.'firma.jpg',20,$y_firma,560);  
			$pdf->addJpegFromFile($path_certificado.'pie.jpg',35,15,550);
	 
			$pdf->ezText("\n",12,array('justification'=>'right'));
			
			$pdf->ezText($fecha."\n\n",12,array('justification'=>'right'));
			$pdf->ezText($titulo,14,array('justification'=>'center')); 
			$pdf->ezText("\n\n",12,array('justification'=>'right')); 
			$pdf->ezText(html_entity_decode($texto),12,array('justification'=>'full'));	
			$pdf->ezText("\n\n\n\n\n\n\n\n",12,array('justification'=>'right')); 
			 
			$pdf->ezText($firma,12,array('justification'=>'left'));  
			
		 	$certificado_archivo = $pdf->savePdfFile(md5(time().$email.'_'.$id_certificado));  
		  
		  	//Funciones::mostrarArreglo($certificado_archivo,false,'certificado--');
			return end($certificado_archivo);
		} 
	}  
?>