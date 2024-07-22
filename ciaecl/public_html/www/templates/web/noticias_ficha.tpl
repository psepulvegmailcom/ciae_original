    	 
     
       <script type="text/javascript">
     /* $(function() {
        $('#noticia a').lightBox();
    }); */ 
	changeTitle('{titulo}');
		     
 
    </script> 


<div class="container">   
<div class="row">

        <div class="col-sm-8 single-new">


			<!-- START BLOCK : bloque_elemento_imagen -->
			
			<!-- INCLUDE BLOCK : www/templates/web/noticias_ficha_imagen.tpl -->
			<!-- END BLOCK : bloque_elemento_imagen -->


          <div class="grey-box-home">
          
            <h2 class="title-grey-box" >{titulo}</h2>
            <small>{fecha_html_full}</small><br>
           <!-- INCLUDE BLOCK : www/templates/web/noticias_compartir.tpl -->
 </p>  
			<!-- INCLUDE BLOCK : www/templates/web/noticias_traducir.tpl -->
			<!-- START BLOCK : bloque_elemento_bajada -->
            <div style="padding:0px 10px 20px 30px"><em  >{bajada}</em></div>
            <!-- END BLOCK : bloque_elemento_bajada -->
            
         
            <div class="post-new">
            
              {noticia} 
              

<br>


				<p><strong>Fuente:</strong> {autor}</p>
				
			<!-- START BLOCK : bloque_palabra_clave_general -->
            <strong>Palabras Clave:</strong>
            <!-- START BLOCK : bloque_palabra_clave -->
              <a href="index.php?langSite=es&page={page}&busqueda_flag={busca_flag}&busca_palabra={palabra}" >{palabra}</a> &nbsp;
              <!-- END BLOCK : bloque_palabra_clave -->
          
            <!-- END BLOCK : bloque_palabra_clave_general --> 
           
           
            </div><!-- /.post-new -->

            <!--div class="tag-zone">
              <a href="" class="tag">educaci&oacute;n</a> <a href="" class="tag">tag 2</a> <a href="" class="tag">tag 3</a>
            </div-->
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
            CONTACTO COMUNICACIONES | contacto@ciae.uchile.cl
          </div>


        </div><!-- /.blog-main -->
			 <!-- INCLUDE BLOCK : www/templates/web/noticias_menu_lateral.tpl --> 
        <!-- /.blog-sidebar -->

      </div>
     </div> 