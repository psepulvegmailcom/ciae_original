<div class="container"> 
      <div class="row"> 
		<div class="col-sm-12 single-new">
        <div class="grey-box-home">
		<div class="col-sm-12 single-new" align="center">

        <!-- START BLOCK : bloque_elemento_img -->
        <img src="imagenewview.php?image=recursos/{imagen}" width="50%" height="50%">
        <p></p>
        <!-- END BLOCK : bloque_elemento_img -->
       <!-- START BLOCK : bloque_elemento_video -->
        <iframe class="youtube-player" type="text/html" width="100%" height="349px"  src="https://www.youtube.com/embed/{video}" frameborder="0"></iframe>
        <p></p>
        <!-- END BLOCK : bloque_elemento_video -->
        </div>
          <div class="grey-box-home">
            <h2 class="title-grey-box">{titulo} {codigo} <br></h2>
            <div class="post-new">
              <!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->

<!-- START BLOCK : bloque_elemento_bajada -->
{lang_proyectos_tipo_proyecto} <p  style="color: #706F6F; padding: 0 10px 5px 10px"><i>{bajada}</i></p>
<!-- END BLOCK : bloque_elemento_bajada -->
<!-- START BLOCK : bloque_elemento_descripcion -->
{lang_proyectos_tipo_proyecto} <p>{descripcion}</p>
<!-- END BLOCK : bloque_elemento_descripcion -->
<!-- START BLOCK : bloque_proyectos_por_ficha_campos_url -->
{lang_proyectos_proyectos_web}
<p><a href="{url}" target="_blank">{url}</a></p>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_url -->
<!-- START BLOCK : bloque_elementos_descripcion -->
{lang_campo}
<p>{descripcion}</p>
<!-- END BLOCK : bloque_elementos_descripcion --> 
<!-- START BLOCK : bloque_elemento_archivo -->
<p style="padding:10px 0 10px 0;"><a href="download.php?file=recursos/{archivo}" target="_blank"><img src="www/images/iconos/32x32/Download.png" border="0" style="width:32px " title="{langSite_publicaciones_descarga}"></a>&nbsp;<a href="download.php?file=recursos/{archivo}" target="_blank"   id="link_blank" >Descargar archivo</a></p>
<!-- END BLOCK : bloque_elemento_archivo -->

			<!-- START BLOCK : bloque_palabra_clave_general -->
            <strong>Palabras Clave: </strong>&nbsp;
            <!-- START BLOCK : bloque_palabra_clave -->
              <a href="index.php?langSite=es&page={page}&busqueda_flag={busca_flag}&busca_palabra={palabra}"  style="text-transform:lowercase">{palabra}</a> &nbsp;
              <!-- END BLOCK : bloque_palabra_clave -->
          
            <!-- END BLOCK : bloque_palabra_clave_general -->




            </div><!-- /.post-new -->
            <div class="tag-zone">
    </div>
          </div><!-- /.grey-box-home -->


       <!-- /.blog-main -->

        <!-- /.blog-sidebar -->
   </div> 
   </div>    
        
 </div>
 </div> 
<!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->   