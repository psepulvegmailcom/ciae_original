    <script type="text/javascript">
    /*$(function() {
        $('#noticia a').lightBox();
    }); */
	//changeTitle('{titulo}');
    </script>

<style>

.grey-box-home a,.grey-box-home a:hover, .grey-box-home a:focus  {
	font-weight:bold;
	
}
</style>
<div class="container">   
<div class="row">

        <div class="col-sm-12 single-new">


			<!-- START BLOCK : bloque_elemento_imagen -->
			<!-- INCLUDE BLOCK : www/templates/web/noticias_ficha_imagen.tpl -->
			<!-- END BLOCK : bloque_elemento_imagen -->


          <div class="grey-box-home">
          
            <h2 class="title-grey-box">{titulo}</h2>
            <small>{fecha_html_full}</small><br>
           <!-- INCLUDE BLOCK : www/templates/web/noticias_compartir.tpl -->
 </p>  
			<!-- INCLUDE BLOCK : www/templates/web/noticias_traducir.tpl -->
			<!-- START BLOCK : bloque_elemento_bajada -->
            <div style="padding:0px 10px 20px 30px"><em>{bajada}</em></div>
            <!-- END BLOCK : bloque_elemento_bajada -->
            
         
            <div class="post-new">
            
              {noticia} 
              

<br>


<p><strong>Fuente: </strong>{autor}</p>
            </div><!-- /.post-new -->
			<!-- START BLOCK : bloque_palabra_clave_general -->
            <strong>Palabras Clave:</strong>
            <!-- START BLOCK : bloque_palabra_clave -->
              <a href="index.php?langSite=es&page={page}&busqueda_flag={busca_flag}&busca_palabra={palabra}" >{palabra}</a> &nbsp;
              <!-- END BLOCK : bloque_palabra_clave -->
          
            <!-- END BLOCK : bloque_palabra_clave_general -->
          </div><!-- /.grey-box-home -->
          <!-- START BLOCK : bloque_elemento_principal -->
          <div class="blue box-style">
            <span>Recursos relacionados:</span>
             <!-- START BLOCK : bloque_elemento_url -->
			<ul>            
            <li><a href="{link}" target="_blank">{texto}</a>&nbsp;<a href="{link}" target="_blank"   id="link_blank" ></a></li>
           
            </ul>
			  <!-- END BLOCK : bloque_elemento_url -->
            <!-- START BLOCK : bloque_elemento_doc -->
<ul><li><a href="download.php?file=noticias/{link}" target="_blank">{texto}</a>&nbsp;<a href="download.php?file=noticias/{link}" target="_blank"   id="link_blank" ></a></li></ul>
			<!-- END BLOCK : bloque_elemento_doc -->
          </div>
          <!-- END BLOCK : bloque_elemento_principal -->
          <div class="orange box-style">
            CONTACTO  | mejoramientoescolar@ciae.uchile.cl
          </div>


        </div><!-- /.blog-main -->
			 <!-- : www/templates/web/noticias_menu_lateral.tpl --> 
        <!-- /.blog-sidebar -->

      </div>
     </div> 