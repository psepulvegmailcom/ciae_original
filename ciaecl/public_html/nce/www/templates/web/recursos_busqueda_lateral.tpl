 
  
 <div class="col-sm-4 sidebar">
   <div class="blue-nav caluga-sidebar-nav">
    <h4>Por Tipo</h4>
       <ul>
		<!-- START BLOCK : bloque_menu_lateral_tipo_estructura_listado -->	
		<li><a href="index.php?page=langSite=es&page={tipo_estructura_opcion_site}"  >{tipo_estructura}</a>
                 <ul style=" padding-left:1px;">
                 	<!-- START BLOCK : bloque_menu_lateral_tipo_estructura_listado_detalle -->
                 	<li><a  href="index.php?page={tipo_estructura_opcion_site}&langSite=es&id_tipo={id_tipo}">{tipo}</a></li>
                 	<!-- END BLOCK : bloque_menu_lateral_tipo_estructura_listado_detalle -->
				</ul>
		   </li>
		<!-- END BLOCK : bloque_menu_lateral_tipo_estructura_listado -->
       </ul> 
    </div>
    <div class="blue-nav caluga-sidebar-nav">
        <h4>Buscar  </h4>
           <h6>Por palabra</h6>
              <div class="sidebar-nav-content">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="input-group">
              <input type="text" class="form-control" name="busca_palabra" id="busca_palabra" placeholder="Buscar por Palabra">
              <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="5">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" onClick="javascript:buscadorFormularioProWordOtraDirec();">Buscar <i class="fa fa-search"></i></button>
                        </span>
                      </div><!-- /input-group -->
                  </div>
                </div>
              </div>

				

             <p></p>  
				</br>
  </div>         
          <input type="hidden" name="busqueda_flag" value="1">
          <!-- INCLUDE BLOCK : www/templates/general/palabras_claves.tpl -->
          
          
</div>