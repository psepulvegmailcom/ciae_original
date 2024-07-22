
<A NAME="ancla">
		<div class="col-sm-12 single-new">
        <!-- START BLOCK : bloque_proyectos_por_ficha_imagen -->
        <img src="imagenewview.php?image=proyectos/{id}/{imagen}" width="680px" height="430px">
        <p></p>
        <!-- END BLOCK : bloque_proyectos_por_ficha_imagen -->
        </div>
          <div class="grey-box-home">
            <h2 class="title-grey-box">{proyecto}. {tipo} {codigo}</h2>
            <div class="post-new">
              <!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->

 
<!-- START BLOCK : bloque_proyectos_por_ficha_campos_tipo -->
<p><strong>{lang_proyectos_tipo_proyecto}</strong></p> <p>{tipo_proyecto}</p>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_tipo -->
<!-- START BLOCK : bloque_proyectos_por_ficha_campos_url -->
{lang_proyectos_proyectos_web}
<p><a href="{url}" target="_blank">{url}</a></p>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_url -->
<!-- START BLOCK : bloque_proyectos_por_ficha_campos_previo -->
<p><strong>{lang_campo}</strong></p>
<p>{valor_campo}</p>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_previo --> 
 

<!-- START BLOCK : bloque_proyectos_por_ficha_campos_posterior -->
<p><strong>{lang_campo}</strong></p> <p>{valor_campo}</p>
<!-- END BLOCK : bloque_proyectos_por_ficha_campos_posterior --> 



                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th><p><strong>Periodo de ejecuci&oacute;n</strong></p></th>
                        <td>{periodo}</td>
                      </tr>
                      <tr>
                        <th>Recursos</th>
                        <td>{recursos}</td>
                      </tr>
                      <tr>
                        <th>Equipo</th>
                        <td><ul>{listado_personas}</ul></td>
                      </tr>
                      <tr>
                        <th>Fuente de financiamiento</th>
                        <td>{financiamiento}</td>
                      </tr>
                    </tbody>
                  </table>
			<!-- START BLOCK : bloque_palabra_clave_general -->
            <strong>Palabras Clave:</strong>
            <!-- START BLOCK : bloque_palabra_clave -->
              <a href="index.php?langSite=es&page={page}&busqueda_flag={busca_flag}&busca_palabra={palabra}" >{palabra}</a> &nbsp;
              <!-- END BLOCK : bloque_palabra_clave -->
          
            <!-- END BLOCK : bloque_palabra_clave_general -->

            </div><!-- /.post-new -->
            <div class="tag-zone">
    </div>
          </div><!-- /.grey-box-home -->


       <!-- /.blog-main -->

        <!-- /.blog-sidebar -->

