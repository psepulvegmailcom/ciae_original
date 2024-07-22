<?php
 
class ControlGeneralSitios extends ControlGeneral
{
	function ControlGeneralSitios($path_admin,$ControlHtml)
	{			
		parent::ControlGeneral($path_admin,$ControlHtml);
	} 
	
	function mostrarVideosRecursos($e,$id_tipo='video')
	{ 
		$ControlRecursosObjeto = new ControlRecursosObjetoView();
		$agno_actual = date("Y")-2;
		//$ControlRecursosObjeto->where = " destacado = 1 AND video NOT LIKE '' AND agno >= '".$agno_actual."' ";
		//$video = $ControlRecursosObjeto->obtenerRecursosTipoTexto($id_tipo,$this->site_id,'  RAND() LIMIT 5');
		
		$total = 1;

		if($this->site_id == 6)
		{
			$total = 3;
		}
		$ControlRecursosObjeto->where = " destacado = 1 AND video NOT LIKE ''  AND agno >= '".$agno_actual."'  ";
		$video = $ControlRecursosObjeto->obtenerRecursosTipoTexto($id_tipo,$this->site_id,'   RAND() LIMIT '.$total);

		/*
		if(count($video) > 0 && is_array($video))
		{
			$e->addTemplate('bloque_banner_video_youtube');
			$e->setVariable('id_video',$video['0']['video']);
			$e->setVariable('titulo',$video['0']['titulo']);
			$e->setVariable('bajada',$video['0']['bajada']);
		}
		*/

		for($i = 0; $i < count($video); $i++)
		{
			$e->addTemplate('bloque_banner_video_youtube');
			$e->setVariable('id_video',$video[$i]['video']);
			$e->setVariable('titulo',$video[$i]['titulo']);
			$e->setVariable('bajada',$video[$i]['bajada']);
		}
		return $e;
	}
	
	function mostrarGifInformativoCIAE($e)
	{
		$id = round(rand(1,3));
		$e->addTemplate('bloque_banner_presentacion_gif');
		$e->setVariable('id',$id ); 
		return $e;
	}
	
	function mostrarNoticiasRecientes($e)
	{
		$ControlNoticias = new  ControlNoticias();
		$elementos = $ControlNoticias->obtenerNoticiasRecientes();
		if(is_array($elementos) && count($elementos)>0)
		{
			$e->addTemplate('bloque_noticia_reciente');   
			
			$max_noticias = count($elementos);
			for($i=0; $i <  $max_noticias;$i++)
			{
				$e->addTemplate('bloque_noticia');
				if(trim($elementos[$i]['imagen']) == '')
				{
					$elementos[$i]['imagen'] = 'blanco.jpg';
				}
				$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
				$e->showDataSimple($elementos[$i]);
			}
		}		
		return $e;
	}
	
	function mostrarNoticiasDestacadasHome($e)
	{ 
		//echo "descatadas";
		$ControlNoticias = new ControlNoticias();
		$elementos = $ControlNoticias->obtenerNoticiasHome() ;
		//shuffle ($elementos);
		Funciones::mostrarArreglo($elementos,false,'noticias destacadas');         
		if(is_array($elementos) && count($elementos)>0)
		{
			$e->addTemplate('bloque_noticia_reciente');   				
			$max_noticias = count($elementos);
			//$max_noticias = 1;
			for($i=0; $i <  $max_noticias;$i++)
			{
				$e->addTemplate('bloque_noticia');
				if(trim($elementos[$i]['imagen']) == '')
				{
					$elementos[$i]['imagen'] = 'blanco.jpg';
				}
				$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
				$e->showDataSimple($elementos[$i]);
			}
		} 
		return $e;
	}
	
	function mostrarDatosNubePalabraClaves($e,$id_sitio,$tipo,$busca_flag,$page,$total=8)
	{
		$ControlNube = new ControlNube();   	
		$palabras = $ControlNube->obtenerListadoPalabras($id_sitio,$tipo,$total);
		$total = count($palabras);
		if(is_array($palabras) && $total > 0)
		{
			$e->addTemplate('bloque_palabra_clave_global');
			for($i=0; $i < $total; $i++)
			{ 
				$e->addTemplate('bloque_palabra_clave_global_palabra');
				if($i%2 == 0)
					$e->setVariable('tamano_letra',rand(13,19));
				else
					$e->setVariable('tamano_letra',rand(20,26));
				
				$e->setVariable('page',$page);
				$e->setVariable('busca_flag',$busca_flag); 
				$e->setVariable('palabra_clave',$palabras[$i]['palabra_clave']); 
			}
		} 	
		return $e;
	}
}
?>