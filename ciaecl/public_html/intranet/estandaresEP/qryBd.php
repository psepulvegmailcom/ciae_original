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
$qryLista = "select ar.*,ar.id_archivo, ar.id_tipoarchivo,  det.id_tema, ar.id_autor , tem.id_autor as autor_tema, ar.titulo, ar.bajada, ar.pais, ar.fec_publicacion, ar.nom_archivo, ar.estado, ar.autor_orig, ar.comentarios, usu.firstname, usu.lastname, tip.tipo_archivo, sub.id_subtema, sub.subtema ,tem.tema from archivos as ar
inner join archivos_temas as det on(ar.id_archivo=det.id_archivo) 
inner join tema as tem on(tem.id_tema=det.id_tema)
inner join usuarios as usu on(ar.id_autor=usu.id_usuario)  
inner join tipos_archivos as tip on(tip.id_tipoarchivo=ar.id_tipoarchivo)  
inner join subtema as sub on(sub.id_subtema = ar.id_subtema)  
$condicion order by dominio,titulo,usu.lastname, ar.autor_orig, ar.id_subtema,ar.fec_publicacion DESC ";
// GeneralPrint($qryLista);  
$resultLista = mysql_query($qryLista, $conn);
return $resultLista;
}

function getDetalleArchivo($conn, $archivo){
$qryLista = "select ar.*,ar.cita_apa, ar.id_archivo,  det.id_tema, ar.id_autor,  ar.titulo, ar.bajada, ar.pais, ar.fec_publicacion, ar.nom_archivo, ar.nom_archivo_2, ar.estado, ar.id_tipoarchivo, ar.comentarios, usu.firstname, usu.lastname, tem.tema, ar.autor_orig, ar.ano_re, ar.comentarios,ar.nom_archivo_3   from archivos_temas as det inner join  archivos as ar on(ar.id_archivo=det.id_archivo) inner join tema as tem on(tem.id_tema=det.id_tema)  inner join usuarios as usu on(ar.id_autor=usu.id_usuario) where(det.id_archivo=$archivo)"; 
	// echo $qryLista;
	$resultLista = mysql_query($qryLista, $conn);
	$row = mysql_fetch_array($resultLista);
	return $row;
}

function getlistadoComentarios($conn, $condicion)
{
	$qryLista = "SELECT * 
	FROM view_archivos_comentarios ".$condicion." 
	ORDER BY tema ,	documento,fecha_comentario";  
	$resultLista = mysql_query($qryLista, $conn); 
	return $resultLista;
}

function listarTablaGeneral($conn, $tabla)
{
	$qryLista = "SELECT * 
	FROM ".$tabla." ";  
	$resultLista = mysql_query($qryLista, $conn); 
	return $resultLista;
} 

function listarConsulta($conn,$qryLista)
{ 
	$resultLista = mysql_query($qryLista, $conn); 
	return $resultLista;
}

function getlistadoUsuarios($conn)
{
	$qryLista = "SELECT * 
	FROM usuarios  
	WHERE estado_usu = 1
	ORDER BY lastname,firstname";  
	$resultLista = mysql_query($qryLista, $conn); 
	return $resultLista;
}

function getListadoUsuariosResponsable($conn,$id_archivo='')
{
	if(trim($id_archivo) != '')
	{
		$where = 'AND o.id_archivo = '.$id_archivo;
	}
	else
	{
		$where = 'AND o.id_archivo IS NULL';
	}
	$qryLista = "SELECT g.id_usuario, g.firstname, g.lastname, o.id_archivo
	FROM usuarios AS g
	LEFT OUTER JOIN archivos_usuarios AS o ON g.id_usuario = o.id_usuario
	".$where."
	WHERE g.estado_usu = 1
	ORDER BY g.lastname, g.firstname";   
	 //GeneralPrint($qryLista);
	$resultLista = mysql_query($qryLista, $conn); 
	return $resultLista;
}

function getComentariosArchivo($conn, $archivo, $condicion){
$qryLista = "select com.id_comentario, com.id_archivo, com.titulo_comentario, com.autor_comentario, com.correo, com.fec_comentario, com.estado, com.comentario, com.* from comentarios as com inner join archivos as ar on(com.id_archivo=ar.id_archivo) $condicion
ORDER by com.fec_comentario DESC ";
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
if($resultLista)
{ 
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
//echo $qryLista;
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

function setEstadoComentarioTema($conn,$estado, $id_comentario)
{
	$qryLista 		= "update comentarios_temas set estado='$estado' where(id_comentario=$id_comentario)";
	$resultLista 	= mysql_query($qryLista, $conn);
	$num_result 	= mysql_error($conn);
	return $num_result;
}	

function getDetalleArchivos($conn, $id_tema)
{
	$qryLista = "select * from archivos_temas where(id_tema=$id_tema)";
	$resultLista = mysql_query($qryLista, $conn);
	return $resultLista;
} 

function getTemaArchivo($conn, $id_archivo)
{
	$qryLista = "select * from archivos_temas where (id_archivo=$id_archivo)";
	//echo $qryLista;
	$resultLista = mysql_query($qryLista, $conn); 
	return $resultLista;
}

function getArchivoOtros($conn, $id_archivo, $id_tema)
{
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
//echo $qryLista;
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

function setAgregaComentario($conn,$titulo,$autor,$correo,$fecha,$comentario, $archivo,$tipo=''){
$qryLista = "insert into comentarios set id_archivo=$archivo,titulo_comentario='$titulo',autor_comentario='$autor',fec_comentario='$fecha',correo='$correo',comentario='$comentario',estado='1', tipo_comentario = '$tipo'"; echo $qryLista;
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

function deleteUsuariosResponsables($conn,$id_archivo)
{
	$qryLista = "DELETE FROM  archivos_usuarios WHERE id_archivo =".$id_archivo;
	//echo $qryLista.'<br>';
	$resultLista = mysql_query($qryLista, $conn);
}

function setUsuariosResponsables($conn,$id_archivo,$id_usuario)
{
	$qryLista = "INSERT INTO  archivos_usuarios (id_archivo ,id_usuario) VALUES ('$id_archivo', '$id_usuario');"; 
	//echo $qryLista.'<br>';
	$resultLista = mysql_query($qryLista, $conn);
}

function setAgregaArchivo($conn,$titulo,$tipo_archivo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$dir,$autor_orig,$ano_re,$dominio='',$id_subtema=''){
$qryLista = "insert into archivos set id_autor=$autor, titulo='$titulo',bajada='$bajada',pais='$pais',fec_publicacion='$fecha',fecha_actualizacion='$fecha',nom_archivo='$archivo',estado='$estado',comentarios='$comentario', id_tipoarchivo='$tipo_archivo', autor_orig='$autor_orig', ano_re='$ano_re' , id_subtema = '$id_subtema', dominio = '".$dominio."'";
GeneralPrint($qryLista);
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;
}

function obtenerArchivoIngresado($conn)
{ 
	 $select 	= ' SELECT max( id_archivo ) AS id FROM archivos ';
	 $query 	= mysql_query($select,$conn);
	 $obj 		= mysql_fetch_object($query);
	 $id 		= $obj->id;
	 return $id; 
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
GeneralPrint($qryLista);
$resultLista = mysql_query($qryLista, $conn);
$num_result = mysql_error($conn);
return $num_result;

}

function setEditaArchivo($conn,$id_archivo, $tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$dir,$autor_orig,$ano_re,$otros=array())
{
	$fecha = date('Y-m-d');
$qryLista = "UPDATE archivos set id_autor='$autor' ,fecha_actualizacion='$fecha',titulo='$titulo',bajada='$bajada',pais='$pais', nom_archivo='$archivo',estado='$estado',comentarios='$comentario' , id_tipoarchivo='$tipo_archivo', autor_orig='$autor_orig', ano_re='$ano_re' ";

	if(is_array($otros) && count($otros)>0)
	{
		foreach($otros as $var => $val)
		{
			$qryLista .= ", ".$var."='".$val."' ";
		}
	} 

	$this->insertarHistorial($id_archivo,$titulo,'documento_titulo');
	$this->insertarHistorial($id_archivo,$bajada,'documento_descripcion');
	$this->insertarHistorial($id_archivo,$otros['dominio'],'documento_dominio');
	

$qryLista .= " WHERE (id_archivo=$id_archivo)";
GeneralPrint($qryLista);
//echo $qryLista;
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

function getBuscaAutorTema($conn,$tema)
{
	$qryLista = "select id_autor, firstname, lastname, fec_creacion from tema inner join usuarios on tema.id_autor=usuarios.id_usuario where(id_tema='$tema')";
	$resultLista = mysql_query($qryLista, $conn);
	if($resultLista)
	{
		$row = mysql_fetch_row($resultLista);
		return $row;
	}
	else
	{
		 return "no paso";
	}
}

/* funciones de subtemas */
function obtenerSubtema($conn,$id_tema,$subtema=0)
{
	$con = '';
	if($subtema > 0)
	{
		$con = " AND s.id_subtema = ".$subtema;
	}
	$sql = "SELECT s.id_subtema ,	s.subtema, t.tema FROM subtema as s, tema as t WHERE s.id_tema = t.id_tema AND s.id_tema = ".$id_tema.' '.$con; //echo $sql;
	$resultLista = mysql_query($sql, $conn);
	 return $resultLista; 
}

/* FUNCIONES NUEVAS*/
function obtenerTemas($id_tema=0,$subtema=0)
{
	$con = '';
	if(is_numeric($subtema) && $subtema > 0)
	{
		$con = " AND s.id_subtema = ".$subtema;
	}
	$sql = "SELECT s.id_subtema ,t.id_tema,	s.subtema, t.tema 
			FROM subtema as s, tema as t 
			WHERE s.id_tema = t.id_tema";
	if(is_numeric($id_tema) && $id_tema>0)
	{
	  $sql .= " AND s.id_tema = ".$id_tema;
 	}
 	$sql .= ' '.$con.' ORDER BY t.orden,t.id_tema'; // echo $sql;
	$output = GeneralSQLQuery($sql);
	 return $output; 
}

function EPversion($estado)
{
	$sql = "SELECT * FROM ep_version WHERE estado = '".$estado."'";
	$output = GeneralSQLQuery($sql);
	return $output; 
}

function EPDominios($id_version)
{
	$sql = "SELECT * FROM ep_dominio WHERE id_version = '".$id_version."'";
	//echo $sql;
	$output = GeneralSQLQuery($sql);
	return $output; 
}

function EPDominiosArchivos()
{ 
	$sql = "SELECT DISTINCT e.dominio
	FROM archivos_temas as r, archivos as e
	WHERE r.id_archivo = e.id_Archivo AND r.id_tema = 35 
	ORDER BY e.dominio"; 
	$output = GeneralSQLQuery($sql);
	return $output; 
}  

function EPDominiosArchivosDetalle($dominio)
{ 
	$sql = "SELECT DISTINCT e.*
	FROM archivos_temas as r, archivos as e
	WHERE r.id_archivo = e.id_Archivo AND r.id_tema = 35 AND dominio = '".$dominio."'
	ORDER BY e.dominio,e.titulo,e.bajada"; 
	$output = GeneralSQLQuery($sql);
	return $output; 
} 

function EPIndicadores($id_estandar)
{
	$sql = "SELECT * FROM ep_estandar_indicador WHERE id_estandar = '".$id_estandar."'"; 
	$output = GeneralSQLQuery($sql);
	return $output; 
}

function EPEjemplos($id_estandar)
{
	$sql = "SELECT * FROM ep_estandar_ejemplo WHERE id_estandar = '".$id_estandar."'";
	$output = GeneralSQLQuery($sql);
	return $output; 
}

function EPIndicadoresID($id_indicador)
{
	$sql = "SELECT * FROM ep_estandar_indicador WHERE id_indicador = '".$id_indicador."'"; 
	$output = GeneralSQLQuery($sql);
	return $output; 
}
function EPEjemplosID($id_ejemplo)
{
	$sql = "SELECT * FROM ep_estandar_ejemplo WHERE id_ejemplo = '".$id_ejemplo."'";
	$output = GeneralSQLQuery($sql);
	return $output; 
}

function insertarIndicador($id_estandar,$indicador)
{
	$sql = "INSERT INTO ep_estandar_indicador (`id_estandar` ,`indicador`) VALUES ('".$id_estandar."', '".$indicador."')";
	GeneralSQLQuery($sql,false);
} 

function actualizarIndicador($indicador,$id_indicador)
{
	$sql = "UPDATE  ep_estandar_indicador SET indicador = '".$indicador."' WHERE  id_indicador =".$id_indicador." LIMIT 1 ;";
 	$this->insertarHistorial($id_indicador,$indicador,'indicador');
	GeneralSQLQuery($sql,false);
} 


function eliminarIndicador($id_indicador)
{
	$sql = "DELETE FROM ep_estandar_indicador   WHERE  id_indicador =".$id_indicador." LIMIT 1 ;"; 
	//echo $sql.'<br>';
	GeneralSQLQuery($sql,false);
} 

function actualizarEjemplo($ejemplo,$id_ejemplo)
{
	$sql = "UPDATE  ep_estandar_ejemplo SET ejemplo = '".$ejemplo."' WHERE  id_ejemplo =".$id_ejemplo." LIMIT 1 ;";  
 	$this->insertarHistorial($id_ejemplo,$ejemplo,'ejemplo');
	GeneralSQLQuery($sql,false);
} 

function eliminarEjemplo($id_ejemplo)
{
	$sql = "DELETE FROM ep_estandar_ejemplo   WHERE  id_ejemplo =".$id_ejemplo." LIMIT 1 ;"; 
	//echo $sql.'<br>';
	GeneralSQLQuery($sql,false);
} 

function insertarEjemplo($id_estandar,$ejemplo)
{
	$sql = "INSERT INTO ep_estandar_ejemplo (`id_estandar` ,`ejemplo`) VALUES ('".$id_estandar."', '".$ejemplo."')";
	GeneralSQLQuery($sql,false);
}

function insertarHistorial($id,$modificacion,$tipo)
{
	global $datousua; 
	$usuario = $datousua['firstname'].' '.$datousua['lastname']; 
	switch($tipo)
	{
		case 'indicador':
			$datos = $this->EPIndicadoresID($id);
			$texto_original = $datos[0]['indicador'];
		break;
		case 'ejemplo':
			$datos = $this->EPEjemplosID($id);	
			$texto_original = $datos[0]['ejemplo'];	
		break; 
		default:
			global $conn;
			$datos = $this->getDetalleArchivo($conn, $id);
			//GeneralPrint($datos); 
			switch($tipo)
			{
				case 'documento_titulo':
					$texto_original = $datos['titulo'];
				break; 
				case 'documento_descripcion':
					$texto_original = $datos['bajada'];
				break;
				case 'documento_dominio':
					$texto_original = $datos['dominio'];
				break;
			}
			if($datos['id_tema'] == 35)
			{
				$tipo = str_replace('documento','estandar',$tipo);
			}
		break;
	}
	if(trim($modificacion) != trim($texto_original))
	{
		$sql = "INSERT INTO historial (	fecha  ,tipo_elemento,	 usuario,  id_tipo,  texto_original, texto_modificado) VALUES ('".date('Y-m-d H:i:s')."'  ,	'".$tipo."'  ,	'".$usuario."',  '".$id."',  '".$texto_original."',  '".$modificacion."')";
		GeneralSQLQuery($sql,false);
	} 
}


}//FIN CLASS qryBd
?>
