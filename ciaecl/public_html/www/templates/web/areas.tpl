 <div class="container">
 <div class="row">

        <div class="col-sm-8 single-new">
          <div class="grey-box-home">
            <h2 class="big-title">{area} / {area_en}</h2>
            <div class="post-new row item-row">            
              <div class="col-md-12" align="justify">
                <img src="www/images_new/area_{clave}.jpg" class="img-responsive"><br>
                {descripcion}
                <!--h3>Proyectos:</h3-->
                <!-- START BLOCK : bloque_listado_proyectos_area -->            
                <!--ul>
                <li>{financiamiento} {codigo} <a href="index.php?page=view_proyectos&case=ficha&id={id_proyecto}&langSite=es">{proyecto}</a></li>
               </ul-->                    
                <!-- END BLOCK : bloque_listado_proyectos_area -->
 				<!-- INCLUDE BLOCK : www/templates/web/bloques/orden_bloque.tpl -->
                <br>
              </div>
               
              
              




            </div><!-- /.post-new -->





          </div><!-- /.grey-box-home -->
          


        </div><!-- /.blog-main -->

 
        <!-- INCLUDE BLOCK : www/templates/web/proyectos_menu_lateral.tpl -->
        
        
        <!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->
            <input type="hidden" name="busca_Autor" id="busca_Autor" value="">
            <input type="hidden" name="busca_Autor_id" id="busca_Autor_id" value="">
            <input type="hidden" name="busca_Anno" id="busca_Anno" value="">
            <input type="hidden" name="busca_Area" id="busca_Area" value="">
            <input type="hidden" name="busca_tipoDocumento" id="busca_tipoDocumento" value="">
            <input type="hidden" name="busca_palabra" id="busca_palabra" value="">  
       <!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->