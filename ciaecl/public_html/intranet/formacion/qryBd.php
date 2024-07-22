<?php

class qryBd{

function getListaTemas($conn, $condicion){
$qryLista = "select * from tema as tem inner join usuarios as usu on(tem.id_autor=usu.id_usuario) inner join tipos_temas as tip on(tem.id_tipotema=tip.id_tipotema) $condicion order by id_tema DESC, tema";
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;
}

function getListaDiario($conn, $condicion){
$qryLista = "select * from tema as tem inner join usuarios as usu on(tem.id_autor=usu.id_usuario) inner join tipos_temas as tip on(tem.id_tipotema=tip.id_tipotema) $condicion  and tem.id_tipotema = 1 order by id_tema DESC, tema";
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;
}

function getListaArchivos($conn, $tema, $condicion){
$qryLista = "select ar.id_archivo, ar.id_tipoarchivo,  det.id_tema, ar.id_autor , tem.id_autor as autor_tema, ar.titulo, ar.bajada, ar.pais, ar.fec_publicacion, ar.nom_archivo, ar.estado, ar.autor_orig, ar.comentarios, usu.firstname, usu.lastname, tip.tipo_archivo, sub.id_subtema, sub.subtema  from archivos as ar
inner join archivos_temas as det on(ar.id_archivo=det.id_archivo) 
inner join tema as tem on(tem.id_tema=det.id_tema)
inner join usuarios as usu on(ar.id_autor=usu.id_usuario)  
inner join tipos_archivos as tip on(tip.id_tipoarchivo=ar.id_tipoarchivo)  
inner join subtema as sub on(sub.id_subtema = ar.id_subtema)  
$condicion order by ar.id_subtema,ar.fec_publicacion DESC, titulo ";
//echo $qryLista;
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;
}

function getDetalleArchivo($conn, $archivo){
$qryLista = "select ar.cita_apa, ar.id_archivo,  det.id_tema, ar.id_autor,  ar.titulo, ar.bajada, ar.pais, ar.fec_publicacion, ar.nom_archivo, ar.estado, ar.id_tipoarchivo, ar.comentarios, usu.firstname, usu.lastname, tem.tema, ar.autor_orig, ar.ano_re  from archivos_temas as det inner join  archivos as ar on(ar.id_archivo=det.id_archivo) inner join tema as tem on(tem.id_tema=det.id_tema)  inner join usuarios as usu on(ar.id_autor=usu.id_usuario) where(det.id_archivo=$archivo)";
$resultLista = mysql_query($qryLista, $conn);
$row = mysql_fetch_array($resultLista);
return $row;
}

function getComentariosArchivo($conn, $archivo, $condicion){
$qryLista = "select com.id_comentario, com.id_archivo, com.titulo_comentario, com.autor_comentario, com.correo, com.fec_comentario, com.estado, com.comentario from comentarios as com inner join archivos as ar on(com.id_archivo=ar.id_archivo) $condicion";
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;

}

function getComentariosTemas($conn, $tema, $condicion){
$qryLista = "select com.id_comentario, com.id_tema, com.titulo_comentario, com.autor_comentario, com.correo, com.fec_comentario, com.estado, com.comentario from comentarios_temas as com inner join tema as tem on(com.id_tema=tem.id_tema) $condicion";
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;

}

function getDescripcionTema($conn, $tema, $condicion){
$qryLista = "select tema.descripcion, tema.descripcion2, tema.descripcion3 from tema $condicion";
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;

}

function getUsuario($conn, $usu, $pass){
$qryResultado = "select usu.id_usuario as id_usuario, firstname, lastname, perfil, estado_usu from usuarios as usu inner join tipo_usuario as tip on(usu.id_tipousuario=tip.id_tipousuario) where(username='$usu')and(passwd='$pass')and(estado_usu=1)";
//echo $qryResultado;
$resultLista = mysql_query($qryResultado, $conn);
if($resultLista){
$row = mysql_fetch_row($resultLista);
return $row;
}else 
  return "0";
}

function getDatoUsuario($conn, $id_usuario){
$qryResultado = "select id_usuario, firstname, lastname, estado_usu, email, username, passwd, perfil_pro, curriculo, publicaciones from usuarios as usu  where(id_usuario='$id_usuario')";
$resultLista = mysql_query($qryResultado, $conn);
return $resultLista;
}


function getListarUsuarios($conn, $condicion){
 $qryResultado = "select usu.id_usuario as id_usuario, usu.id_tipousuario,  firstname, lastname, perfil, estado_usu, tipo_usuario, username, passwd, email, ifnull(last_login,'--------------') as last_login  from usuarios as usu inner join tipo_usuario as tip on(usu.id_tipousuario=tip.id_tipousuario) $condicion";
$resultLista = mysql_query($qryResultado, $conn);
return $resultLista;
}

function postActualizaTema($conn,$id_tema, $area,$estado,$descripcion,$descripcion2,$descripcion3, $id_autor, $tipo_tema, $img1, $img2, $img3, $comentario){
$qryLista = "update tema set tema='$area',descripcion='$descripcion', descripcion2='$descripcion2', descripcion3='$descripcion3', estado='$estado',id_autor=$id_autor, id_tipotema=$tipo_tema,  img1= $img1, img2= $img2, img3= $img3, comentarios='$comentario' where(id_tema=$id_tema)";
echo $qryLista;
exit;
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}	

function setEstado($conn,$estado, $id_tema){
$qryLista = "update tema set estado='$estado' where(id_tema=$id_tema)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}	

function setEstadoFile($conn,$estado, $id_archivo){
$qryLista = "update archivos set estado='$estado' where(id_archivo=$id_archivo)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}	

function setEstadoComentario($conn,$estado, $id_comentario){
$qryLista = "update comentarios set estado='$estado' where(id_comentario=$id_comentario)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}	

function setEstadoComentarioTema($conn,$estado, $id_comentario){
$qryLista = "update comentarios_temas set estado='$estado' where(id_comentario=$id_comentario)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}	

function getDetalleArchivos($conn, $id_tema){
$qryLista = "select * from archivos_temas where(id_tema=$id_tema)";
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;
}

function getArchivoOtros($conn, $id_archivo, $id_tema){
 $qryLista = "select * from archivos_temas where((id_archivo=$id_archivo)and(id_tema<>$id_tema))";
 $resultLista = mysql_query($qryLista, $conn);
 return mysql_affected_rows();
}

function setDeleteDetalleTema($conn, $id_tema){
 $qryLista = "delete from archivos_temas where(id_tema=$id_tema)";
 $resultLista = mysql_query($qryLista, $conn);
 $num_result1 = mysql_error($conn);
 return $num_result1;
}

function setDeleteDetalleArchivo($conn, $id_archivo, $id_tema){
 $qryLista = "delete from archivos_temas where(id_archivo=$id_archivo)and(id_tema=$id_tema)";
 $resultLista = mysql_query($qryLista, $conn);
 $num_result1 = mysql_error($conn);
 return $num_result1;
}

function setDeleteTema($conn, $id_tema){
 $qryLista = "delete from tema where(id_tema=$id_tema)";
 $resultLista = mysql_query($qryLista, $conn);
 $num_result1 = mysql_error($conn);
 return $num_result1;
}

function setDeleteArchivo($conn, $id_archivo){
 $qryLista = "delete from archivos where(id_archivo=$id_archivo)";
 $resultLista = mysql_query($qryLista, $conn);
 $num_result2 = mysql_error($conn);
 return $num_result2;
}

function setDeleteComentario($conn, $id_comentario){
 $qryLista = "delete from comentarios where(id_comentario=$id_comentario)";
 $resultLista = mysql_query($qryLista, $conn);
 $num_result2 = mysql_error($conn);
 return $num_result2;
}

function setDeleteComentarioTema($conn, $id_comentario){
 $qryLista = "delete from comentarios_temas where(id_comentario=$id_comentario)";
 $resultLista = mysql_query($qryLista, $conn);
 $num_result2 = mysql_error($conn);
 return $num_result2;
}

function setDeleteUsuario($conn, $id_usuario){
 $qryLista = "delete from usuarios where(id_usuario=$id_usuario)";
 $resultLista = mysql_query($qryLista, $conn);
 $num_result2 = mysql_error($conn);
 return $num_result2;
}

function setAgregaTema($conn,$area,$estado,$descripcion,$descripcion2,$descripcion3,$usuario, $tipo_tema, $img1, $img2, $img3, $comentario, $fecha){
$qryLista = "insert into tema set tema='$area', descripcion='$descripcion', descripcion2='$descripcion2', descripcion3='$descripcion3', estado='$estado', id_autor=$usuario , id_tipotema=$tipo_tema , img1= '$img1', img2= '$img2', img3= '$img3', comentarios='$comentario', fec_creacion='$fecha' ";
echo $qryLista;
exit;
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function setAgregaUsuario($conn,$nombre,$apellido,$correo,$tipo,$estado,$usuario,$pass){
$qryLista = "insert into usuarios set id_tipousuario=$tipo,firstname='$nombre',lastname='$apellido',username='$usuario',passwd='$pass',email='$correo',estado_usu=$estado";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function setEditaUsuario($conn,$id_usuario, $nombre,$apellido,$correo,$tipo,$estado,$usuario,$pass, $acceso, $perfil_pro, $curriculo, $publicaciones){
$qryLista = "update usuarios set id_tipousuario=$tipo,firstname=$nombre,lastname=$apellido,username=$usuario,passwd=$pass,email=$correo,estado_usu=$estado, last_login=$acceso, perfil_pro=$perfil_pro, curriculo=$curriculo, publicaciones=$publicaciones where(id_usuario=$id_usuario)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function setAgregaComentario($conn,$titulo,$autor,$correo,$fecha,$comentario, $archivo){
$qryLista = "insert into comentarios set id_archivo=$archivo,titulo_comentario='$titulo',autor_comentario='$autor',fec_comentario='$fecha',correo='$correo',comentario='$comentario',estado='1'";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function setAgregaComentarioTema($conn,$titulo,$autor,$correo,$fecha,$comentario, $tema){
$qryLista = "insert into comentarios_temas set id_tema=$tema,titulo_comentario='$titulo',autor_comentario='$autor',fec_comentario='$fecha',correo='$correo',comentario='$comentario',estado='1'";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function setEditaComentario($conn,$id_comentario,$titulo,$autor,$correo,$comentario){
$qryLista = "update comentarios set titulo_comentario='$titulo',autor_comentario='$autor',correo='$correo',comentario='$comentario' where(id_comentario=$id_comentario)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;

}

function setEditaComentarioTema($conn,$id_comentario,$titulo,$autor,$correo,$comentario){
$qryLista = "update comentarios_temas set titulo_comentario='$titulo',autor_comentario='$autor',correo='$correo',comentario='$comentario' where(id_comentario=$id_comentario)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;

}

function setAgregaArchivo($conn,$titulo,$tipo_archivo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$dir,$autor_orig,$ano_re){
$qryLista = "insert into archivos set id_autor=$autor, titulo='$titulo',bajada='$bajada',pais='$pais',fec_publicacion='$fecha',nom_archivo='$archivo',estado='$estado',comentarios='$comentario', id_tipoarchivo=$tipo_archivo, autor_orig='$autor_orig', ano_re='$ano_re'";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function getBuscaArchivo($conn,$titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo){
 $qryLista = "select id_archivo from archivos where((id_autor=$autor)and( titulo='$titulo')and(bajada='$bajada')and(pais='$pais')and(fec_publicacion='$fecha')and(nom_archivo='$archivo')and(estado='$estado')and(comentarios='$comentario'))";
 $resultLista = mysql_query($qryLista, $conn);
 if($resultLista) {
    $row = mysql_fetch_row($resultLista);
    return $row[0];
 }else return "no paso";
}

function setAsociaArchivoTema($conn,$id_archivo, $id_tema){
$qryLista = "insert into archivos_temas set id_archivo=$id_archivo,id_tema=$id_tema";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;

}

function setEditaArchivo($conn,$id_archivo, $tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$dir,$autor_orig,$ano_re){
$qryLista = "update archivos set id_autor=$autor ,titulo='$titulo',bajada='$bajada',pais='$pais', nom_archivo='$archivo',estado='$estado',comentarios='$comentario', id_tipoarchivo=$tipo_archivo, autor_orig='$autor_orig', ano_re='$ano_re' where(id_archivo=$id_archivo)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function setBorraDetalleArchivo($conn,$id_archivo){
$qryLista = "delete from archivos_temas where(id_archivo=$id_archivo)";
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;

}

function getBuscaIdTema($conn,$area,$estado,$descripcion,$usuario){
$qryLista = "select id_tema from tema where(tema='$area')and(descripcion='$descripcion')and(estado='$estado')and(id_autor=$usuario)";
$resultLista = mysql_query($qryLista, $conn);
if($resultLista) {
$row = mysql_fetch_row($resultLista);
return $row[0];
}else return "no paso";
}

function getBuscaAutorTema($conn,$tema){
$qryLista = "select id_autor, firstname, lastname, fec_creacion from tema inner join usuarios on tema.id_autor=usuarios.id_usuario where(id_tema='$tema')";
$resultLista = mysql_query($qryLista, $conn);
if($resultLista) {
$row = mysql_fetch_row($resultLista);
return $row;
}else return "no paso";
}

/* funciones de subtemas */
function obtenerSubtema($conn,$id_tema,$subtema=0)
{
	$con = '';
	if($subtema > 0)
		$con = " AND s.id_subtema = ".$subtema;
	$sql = "SELECT s.id_subtema ,	s.subtema, t.tema FROM subtema as s, tema as t WHERE s.id_tema = t.id_tema AND s.id_tema = ".$id_tema.' '.$con; //echo $sql;
	$resultLista = mysql_query($sql, $conn);
	 return $resultLista; 
}

}//FIN CLASS qryBd
?>
