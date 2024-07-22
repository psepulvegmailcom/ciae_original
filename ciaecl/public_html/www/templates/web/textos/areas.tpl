<div class="container">


      <div class="row">

        <div class="col-sm-8 single-new">
          <div class="grey-box-home">
            <h2 class="big-title">Areas de investigaci&oacute;n</h2>
            <div class="post-new row item-row">            
              <div class="col-md-12">
                <img src="www/images_new/areas.jpg" class="img-responsive">
                {texto_contenido}
                <ul>
                    <!-- START BLOCK : bloque_listado_areas -->
                    <li><a href="?langSite={langSite}&page=view_area_{clave}">{area}</a></li>  
                    <!-- END BLOCK : bloque_listado_areas -->
            	</ul>
                <br>
              </div>
              <div class="col-md-2">
                <div class="ico-quienes"><i class="fa fa-leanpub"></i></div>
              </div>
             
              




            </div><!-- /.post-new -->
            <input type="hidden" name="busca_Autor" id="busca_Autor" value="">
            <input type="hidden" name="busca_Anno" id="busca_Anno" value="">
            <input type="hidden" name="busca_Area" id="busca_Area" value="">
            <input type="hidden" name="busca_tipoDocumento" id="busca_tipoDocumento" value="">
            <input type="hidden" name="busca_palabra" id="busca_palabra" value="">  
   <!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->



          </div><!-- /.grey-box-home -->
          


        </div><!-- /.blog-main -->

        <!-- INCLUDE BLOCK : www/templates/web/proyectos_menu_lateral_otro.tpl -->
             
        <!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->