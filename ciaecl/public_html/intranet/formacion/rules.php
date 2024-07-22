<?php
session_start();
include ("qryBd.php");

/*--------------FUNCIONES--------------------------------------------*/
function SureRemoveDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }

    closedir($dh);
    if ($DeleteMe){
        @rmdir($dir);
    }
}

function Formatofecha($cadena){
   $dia=substr($cadena,-2);
   $mes=substr($cadena,5,2);
   $agno=substr($cadena,0,4);
   //echo $dia."-".$mes."-".$agno;
   //setlocale(LC_ALL,"es_CL");
   //$loc = setlocale(LC_TIME, NULL);
   //$fecha=strftime("%A, %d de %B del %Y",mktime(0,0,0,$mes,$dia,$agno));
  //$fecha=strftime("%d/%m/%Y",$time);   
   //return $fecha;
   return $dia."/".$mes."/".$agno;
}

/*--------------------------CLASES-------------------------------------------*/
class rules{
			
function ListarTemas($conn,$perfil,$autor, $tipo){
   $funcionLista = new qryBd();
   if($tipo == "0") $con="tip.id_tipotema=tip.id_tipotema";
   else $con="tip.id_tipotema=$tipo";

   if($perfil == "0")
        $sqlVal = $funcionLista->getListaTemas($conn," where(estado=1)and($con)");
   else		
    if($perfil == "1")
        $sqlVal = $funcionLista->getListaTemas($conn,"where ($con) ");
    else		
      if($perfil == "2")
        $sqlVal = $funcionLista->getListaTemas($conn," where(estado<>0)or( (estado=0)and(tem.id_autor = $autor))and($con) ");
      
		
		
   return $sqlVal;
}

function ListarDiarios($conn,$perfil,$autor, $tipo){
   $funcionLista = new qryBd();
   if($tipo == "0") $con="tip.id_tipotema=tip.id_tipotema";
   else $con="tip.id_tipotema=$tipo";

   if($perfil == "0")
        $sqlVal = $funcionLista->getListaDiario($conn," where(estado=1)and($con)");
   else		
    if($perfil == "1")
        $sqlVal = $funcionLista->getListaDiario($conn,"where ($con) ");
    else		
      if($perfil == "2")
        $sqlVal = $funcionLista->getListaDiario($conn," where((estado<>0)or( (estado=0)and(tem.id_autor = $autor)))and($con) ");
      
		
		
   return $sqlVal;
}

function BuscaDetalleTema($conn, $id_tema){
   $funcionBusca = new qryBd();
   $sqlVal = $funcionBusca->getListaTemas($conn, "where (id_tema=$id_tema)");
    
   $row = @mysql_fetch_array($sqlVal);
   return $row;
}



function ListarArchivos($conn, $tema, $perfil, $usuario, $tipo,$subtema=0){
   $funcionLista = new qryBd();
   if($tipo=="0") $con="ar.id_tipoarchivo=ar.id_tipoarchivo"; else $con="ar.id_tipoarchivo=$tipo"; 
   
   if($subtema > 0){
   		if(trim($con) != '')
			$con .= " AND ";
    	$con .= " ar.id_subtema 	 = ".$subtema." "; 
	} 
    
   if($perfil=="0")  $sqlVal = $funcionLista->getListaArchivos($conn, $tema, "where((ar.estado=1)and(det.id_tema=$tema))and($con)");
   else if($perfil=="1")  $sqlVal = $funcionLista->getListaArchivos($conn, $tema, "where(det.id_tema=$tema)and($con)");  
   else if($perfil=="2")  $sqlVal = $funcionLista->getListaArchivos($conn, $tema, "where((ar.estado<>0)or( (ar.estado=0)and(ar.id_autor = $usuario)))and(det.id_tema=$tema)and($con)");   
  
   return $sqlVal;
}

/* funciones de subtemas */
function obtenerSubtema($conn,$id_tema,$subtema=0)
{
	$funcionLista = new qryBd();
	$sqlVal = $funcionLista->obtenerSubtema($conn,$id_tema,$subtema);
//	print_r($sqlVal);
	 return $sqlVal;
	
}

function ListarArchivosBusq($conn, $buscado, $usuario, $opcion, $perfil, $tipo){
   $funcionLista = new qryBd();

   if($tipo=="0") $con="ar.id_tipoarchivo=ar.id_tipoarchivo"; else $con="ar.id_tipoarchivo=$tipo"; 
   
   if($opcion=="titulo") $donde="(MATCH (titulo) AGAINST ( '%$buscado%'  IN BOOLEAN MODE))or(titulo like '%$buscado%')";
   else if($opcion=="autor") $donde="(MATCH (firstname, lastname) AGAINST ( '%$buscado%'  IN BOOLEAN MODE))or((firstname like '%$buscado%')or(lastname like '%$buscado%'))";
   else if($opcion=="pais") $donde="(MATCH (pais) AGAINST ( '%$buscado%'  IN BOOLEAN MODE))or(pais like '%$buscado%')";
   else if($opcion=="descripcion") $donde="(MATCH (bajada) AGAINST ( '%$buscado%'  IN BOOLEAN MODE))or(bajada like '%$buscado%')";

   if($perfil=="0")  $sqlVal = $funcionLista->getListaArchivos($conn, $tema, "WHERE ($donde)and((ar.estado=1)and($con)) group by ar.id_archivo ");
   else if($perfil=="1")  $sqlVal = $funcionLista->getListaArchivos($conn, $tema, "WHERE ($donde)and($con)  group by ar.id_archivo ");  
   else if($perfil=="2")  $sqlVal = $funcionLista->getListaArchivos($conn, $tema, "WHERE ($donde)and((ar.estado<>0)or( (ar.estado=0)and(ar.id_autor=$usuario)))and($con) group by ar.id_archivo ");   

   return $sqlVal;
}

function DetalleArchivo($conn, $archivo){
   $funcionLista = new qryBd();
   $sqlVal = $funcionLista->getDetalleArchivo($conn, $archivo);
   return $sqlVal;
}

function ComentariosArchivo($conn, $archivo, $perfil, $usuario){
   $funcionLista = new qryBd();
   if($perfil=="1") $condicion = "where (com.id_archivo=$archivo)";
   else if($perfil=="2") $condicion = "where ((com.estado<>0)or( (com.estado=0)and(ar.id_autor = $usuario)))and(com.id_archivo=$archivo)";
   else $condicion = "where (com.estado<>0)and(com.id_archivo=$archivo)";
      
   $sqlVal = $funcionLista->getComentariosArchivo($conn, $archivo, $condicion);
   return $sqlVal;
}

function ComentariosTema($conn, $tema, $perfil, $usuario){
   $funcionLista = new qryBd();
   if($perfil=="1") $condicion = "where (com.id_tema=$tema)";
   else if($perfil=="2") $condicion = "where ((com.estado<>0)or( (com.estado=0)and(tem.id_autor = $usuario)))and(com.id_tema=$tema)";
   else $condicion = "where (com.estado<>0)and(com.id_tema=$tema)";
      
   $sqlVal = $funcionLista->getComentariosTemas($conn, $tema, $condicion);
   return $sqlVal;
}

function DescripcionTema($conn, $tema){
   $funcionLista = new qryBd();
   $condicion = "where (tema.id_tema=$tema)";   
   $sqlVal = $funcionLista->getDescripcionTema($conn, $tema, $condicion);
   return $sqlVal;
}

/*------------------------------------*/


function BuscarUsuario($conn, $usu, $pass){
   $funcionLista = new qryBd();
   $funcionActualiza = new qryBd();
   $sql = $funcionLista->getUsuario($conn, $usu, $pass);
   if($sql=="0"){
     $Val="index.php?error=1";
   }else{ 
	 $_SESSION["id_usuario"]=$sql[0];
     $_SESSION["per_usuario"]=$sql[3];
     $_SESSION["nom_usuario"]=$sql[1]." ".$sql[2];
     $funcionAgrega = new rules();
	 $resp= $funcionActualiza->setEditaUsuario($conn,$sql[0], "firstname","lastname","email","id_tipousuario","estado_usu","username","passwd", "'".date("Y-m-d")."'", "perfil_pro","curriculo","publicaciones");
	 $Val="intranet/intranet.php?login=login";
   }   
   return $Val;
}

function TraeUsuario($conn, $id_usuario){
$funcionTrae = new qryBd();
   $sql = $funcionTrae->getDatoUsuario($conn,$id_usuario);
   return $sql;
}


function ListarUsuarios($conn, $condicion){
   $funcionLista = new qryBd();
   $sqlVal = $funcionLista->getListarUsuarios($conn, $condicion);
   return $sqlVal;
}

function ActualizaTema($conn,$id_tema, $tipo_tema, $area,$estado,$descripcion,$descripcion2,$descripcion3, $id_autor, $img1, $img2, $img3, $comentario){
   $funcionActualiza = new qryBd();
   $sqlVal = $funcionActualiza->postActualizaTema($conn,$id_tema, $area,$estado,$descripcion, $descripcion2,$descripcion3, $id_autor, $tipo_tema, $img1, $img2, $img3, $comentario);
   if($sqlVal)
    return $sqlVal;
   else
    return 1;	
}

function setActivacion($conn, $estado, $id_tema){
   $funcionLista = new qryBd();
   $sql = $funcionLista->setEstado($conn, $estado, $id_tema);
   return $sql;
}

function setActivacionFile($conn, $estado, $id_archivo){
   $funcionLista = new qryBd();
   $sql = $funcionLista->setEstadoFile($conn, $estado, $id_archivo);
   return $sql;
}

function setActivacionComentario($conn, $estado, $id_comentario){
   $funcionLista = new qryBd();
   $sql = $funcionLista->setEstadoComentario($conn, $estado, $id_comentario);
   return $sql;
}

function setActivacionComentarioTema($conn, $estado, $id_comentario){
   $funcionLista = new qryBd();
   $sql = $funcionLista->setEstadoComentarioTema($conn, $estado, $id_comentario);
   return $sql;
}

function setDeleteTemaArchivos($conn, $id_tema, $ruta, $rutaImg){
   $funcionActualiza = new qryBd();
   //$sql = $funcionActualiza->setDeleteTemaArchivos($conn, $id_tema);
   $dir = "$rutaImg/dir$id_tema";
   SureRemoveDir($dir, true);
   $txt="";
   $sql = $funcionActualiza->getDetalleArchivos($conn, $id_tema); //selecciono los archivos del tema
   while($row = mysql_fetch_array($sql) ){
     if(($funcionActualiza->getArchivoOtros($conn, $row["id_archivo"], $id_tema))<=0 ){ //si el archivo no esta asociado con otro tema, lo borro
         $row = $funcionActualiza->getDetalleArchivo($conn, $row["id_archivo"]);
		 $file = "$ruta/".$row["nom_archivo"];
         unlink($file);
	     $funcionActualiza->setDeleteArchivo($conn, $row["id_archivo"]);
     }
   
   }
   $sql = $funcionActualiza->setDeleteDetalleTema($conn, $id_tema);
   $sql = $funcionActualiza->setDeleteTema($conn, $id_tema);
   return $sql;
}

function DeleteFile($conn, $id_archivo, $ruta, $idtema, $archivo){
   $funcionActualiza = new qryBd();
   if(($funcionActualiza->getArchivoOtros($conn, $id_archivo, $idtema))<=0 ){ //si el archivo no esta asociado con otro tema, lo borro
     $file = "../"."$ruta/$archivo";
     unlink($file);
     $sql = $funcionActualiza->setDeleteArchivo($conn, $id_archivo);
   }
     $sql = $funcionActualiza->setDeleteDetalleArchivo($conn, $id_archivo, $idtema);
   return $sql;
}

function DeleteComentario($conn, $id_comentario){
   $funcionActualiza = new qryBd();
   $sql = $funcionActualiza->setDeleteComentario($conn, $id_comentario);
   return $sql;
}

function DeleteComentarioTema($conn, $id_comentario){
   $funcionActualiza = new qryBd();
   $sql = $funcionActualiza->setDeleteComentarioTema($conn, $id_comentario);
   return $sql;
}

function DeleteUsuario($conn, $id_usuario){
   $funcionActualiza = new qryBd();
   $sql = $funcionActualiza->setDeleteUsuario($conn, $id_usuario);
   return $sql;
}

function AgregaTema($conn,$area,$estado,$descripcion,$descripcion2,$descripcion3,$tipo_tema,$usuario, $ruta, $rutaImg, $img1, $img2, $img3, $comentario, $fecha){
   $funcionActualiza = new qryBd();
   $sqlVal = $funcionActualiza->setAgregaTema($conn,$area,$estado,$descripcion,$descripcion2,$descripcion3,$usuario,$tipo_tema, $img1, $img2, $img3, $comentario, $fecha);
   if($sqlVal)
    return $sqlVal;
   else{
     $idTem = $funcionActualiza->getBuscaIdTema($conn,$area,$estado,$descripcion,$usuario);
	 mkdir("../"."$rutaImg/dir$idTem", 0755, true);
	 $fp = fopen("../"."$rutaImg/dir$idTem/index.php", "w");
     fwrite($fp, "<h2> No se puede acceder directamente a éste directorio </h2>");
     fclose($fp);

	 $fp = fopen("../"."$ruta/index.php", "w");
     fwrite($fp, "<h2> No se puede acceder directamente a éste directorio </h2>");
     fclose($fp);
     return $idTem;	
   }	
}


function BuscaAutortema($conn, $tema){
  $funcionActualiza = new qryBd();
  $idAu = $funcionActualiza->getBuscaAutorTema($conn,$tema);
  return $idAu;
}

function AgregaComentario($conn,$titulo,$autor,$correo,$fecha,$comentario,$archivo){
   $funcionActualiza = new qryBd();
   $sqlVal = $funcionActualiza->setAgregaComentario($conn,$titulo,$autor,$correo,$fecha,$comentario,$archivo);
   if($sqlVal)
     return $sqlVal;
   else
     return 1;	
}

function AgregaComentarioTema($conn,$titulo,$autor,$correo,$fecha,$comentario,$tema){
   $funcionActualiza = new qryBd();
   $sqlVal = $funcionActualiza->setAgregaComentarioTema($conn,$titulo,$autor,$correo,$fecha,$comentario,$tema);
   if($sqlVal)
     return $sqlVal;
   else
     return 1;	
}


function AgregaUsuario($conn,$nombre,$apellido,$correo,$tipo,$estado,$usuario,$pass){
   $funcionActualiza = new qryBd();
   $sqlVal = $funcionActualiza->setAgregaUsuario($conn,$nombre,$apellido,$correo,$tipo,$estado,$usuario,$pass);
   if($sqlVal)
     return $sqlVal;
   else
     return 1;	

}

function EditaUsuario($conn,$id_usuario, $nombre,$apellido,$correo,$tipo,$estado,$usuario,$pass, $acceso, $perfil, $curriculo, $publicaciones){
   $funcionActualiza = new qryBd();

   if(isset($tipo)&& isset($estado)){
      $sqlVal = $funcionActualiza->setEditaUsuario($conn,$id_usuario, "'".$nombre."'","'".$apellido."'","'".$correo."'", $tipo, $estado, "'".$usuario."'","'".$pass."'", $acceso, "'".$perfil."'", "'".$curriculo."'", "'".$publicaciones."'");
	}  
   else{
      $sqlVal = $funcionActualiza->setEditaUsuario($conn,$id_usuario, "'".$nombre."'","'".$apellido."'","'".$correo."'","id_tipousuario","estado_usu","'".$usuario."'","'".$pass."'", $acceso, "'".$perfil."'", "'".$curriculo."'", "'".$publicaciones."'");
   }
   if($sqlVal)
     return $sqlVal;
   else
     return 1;	

}

function EditaComentario($conn,$id_comentario, $titulo,$autor,$correo, $comentario){
   $funcionActualiza = new qryBd();
   $sqlVal = $funcionActualiza->setEditaComentario($conn,$id_comentario,$titulo,$autor,$correo, $comentario);
   if($sqlVal)
     return $sqlVal;
   else
     return 1;	
}

function EditaComentarioTema($conn,$id_comentario, $titulo,$autor,$correo, $comentario){
   $funcionActualiza = new qryBd();
   $sqlVal = $funcionActualiza->setEditaComentarioTema($conn,$id_comentario,$titulo,$autor,$correo, $comentario);
   if($sqlVal)
     return $sqlVal;
   else
     return 1;	
}

function AgregaArchivo($conn,$titulo,$tipo_archivo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$ids_temas,$dir,$autor_orig,$ano_re){
       $funcionActualiza = new qryBd();
	   $txt="";
	   $val = $funcionActualiza->setAgregaArchivo($conn,$titulo,$tipo_archivo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$dir,$autor_orig,$ano_re);
	   $txt = $txt.$val;
       $id_archivo = $funcionActualiza->getBuscaArchivo($conn,$titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo);
	   //foreach($ids_temas as $elemento){
	         //$id_tema=$elemento;
			 $id_tema=$ids_temas;
		     $val = $funcionActualiza->setAsociaArchivoTema($conn,$id_archivo, $id_tema);
			 $txt = $txt.$val;
	   //}		 
       if($txt)
          return $txt;
       else
          return "Se ha agregado el archivo satisfactoriamente";
}

function Editarchivo($conn,$id_archivo,$tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$ids_temas,$dir,$autor_orig, $ano_re){
       $funcionActualiza = new qryBd();
       $val = $funcionActualiza->setEditaArchivo($conn,$id_archivo, $tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$dir,$autor_orig,$ano_re);
	  /* $val = $funcionActualiza->setBorraDetalleArchivo($conn,$id_archivo);
	   foreach($ids_temas as $elemento){
	         $id_tema=$elemento;
		     $val = $funcionActualiza->setAsociaArchivoTema($conn,$id_archivo, $id_tema);
	   }	*/	 

       if($Val)
          return $Val;
       else
          return "Se ha editado el archivo satisfactoriamente";
}



}//FIN CLASS BUSQUEDA



?>
