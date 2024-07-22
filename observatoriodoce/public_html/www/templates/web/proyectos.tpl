<div class="container">
<div class="row">

        <div class="col-sm-8 single-new">
          <div class="grey-box-home">
            <h2 class="big-title" id='titulo_opcion'>L&iacute;neas de trabajo y proyectos</h2>
            <div class="post-new row item-row">
                           <div class="col-md-12"> 
             
                <p>{descripcion}</p>
              
				<!-- INCLUDE BLOCK : www/templates/web/proyectos_portada_me.tpl -->
               
                
                <!-- START BLOCK : bloque_proyectos_por_ficha -->

 				<!-- INCLUDE BLOCK : www/templates/web/proyectos_ficha.tpl -->

				<!-- END BLOCK : bloque_proyectos_por_ficha -->
                
                <!-- START BLOCK : bloque_listado_proyectos_busqueda -->
                <script>
				document.getElementById('titulo_opcion').innerHTML = 'Proyectos';
				</script>
                
                
                {titulo}
 				<!-- INCLUDE BLOCK : www/templates/web/bloques/formato_proyecto.tpl -->
                 					
				<!-- END BLOCK : bloque_listado_proyectos_busqueda -->
                
                    <!-- START BLOCK : bloque_elemento_paginacion -->
                 
                    {enlacePie}	
                   
                    <!-- END BLOCK : bloque_elemento_paginacion -->  
       </div>
            </div><!-- /.post-new -->



          </div><!-- /.grey-box-home -->
          


        </div><!-- /.blog-main -->
			
            <!-- INCLUDE BLOCK : www/templates/web/proyectos_menu_lateral.tpl -->
        <!-- /.blog-sidebar -->

      </div>
      </div>
          <!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->