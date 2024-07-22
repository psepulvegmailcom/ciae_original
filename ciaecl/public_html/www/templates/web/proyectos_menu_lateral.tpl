<div class="col-sm-4 sidebar">

          <div class="blue-nav caluga-sidebar-nav">
              <h4>Buscar proyectos</h4>
              
              <h6>Por area de investigaci&oacute;n</h6>
              <ul>
                  <!-- START BLOCK : bloque_proyectos_filtro_area_lateral -->                    
                  <li><a href="javascript:buscadorFormularioProAreaOtraDirec('{id_area}')">{area_show}</a></li>
                   <!-- END BLOCK : bloque_proyectos_filtro_area_lateral -->                 
              </ul>
              <h6>Por palabra clave</h6>
              <div class="sidebar-nav-content">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="input-group">
                        <input type="text" class="form-control" name="busca_palabra" id="busca_palabra" placeholder="Buscar por Palabra">
                        <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="3">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" onClick="javascript:buscadorFormularioProWordOtraDirec();">Buscar <i class="fa fa-search"></i></button>
                        </span>
                      </div><!-- /input-group -->
                  </div>
                </div>
              </div>
              <h6>Por a&ntilde;o</h6>
              <div class="sidebar-nav-content">
                <div class="row">     
                  <div class="col-lg-12">
                      <div class="input-group">
                        <input type="text" class="form-control" name="busca_Anno" id="busca_Anno" placeholder="A&ntilde;o">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" onClick="javascript:buscadorFormularioProYearOtraDirec(document.main.busca_Anno.value);">Buscar <i class="fa fa-search"></i></button>
                        </span>
                      </div><!-- /input-group -->
                  </div>
                </div>
              </div>

              <h6>Por apellido del investigador</h6>
              <p class="buscar-apellidos">
                <a href="javascript:buscardorPaginaProRangoOtraDirec('rango','1')">A-D</a>
                  <a href="javascript:buscardorPaginaProRangoOtraDirec('rango','2')">E-H</a>  
                  <a href="javascript:buscardorPaginaProRangoOtraDirec('rango','3')">I-L</a>  
                  <a href="javascript:buscardorPaginaProRangoOtraDirec('rango','4')">M-O</a>  
                  <a href="javascript:buscardorPaginaProRangoOtraDirec('rango','5')">P-S</a>  
                  <a href="javascript:buscardorPaginaProRangoOtraDirec('rango','6')">T-Z</a>    
              </p>
               

          </div> 
          <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="3"> 
          <!-- INCLUDE BLOCK : www/templates/general/palabras_claves.tpl -->
          
          
        </div>