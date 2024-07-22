<div class="col-sm-4 sidebar">

          <div class="blue-nav caluga-sidebar-nav">
              <h4>Buscar proyectos</h4>

              <h6>Por palabra</h6>
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
				

             <p></p>  
</br>
          </div> 
                <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="3">
          <!-- INCLUDE BLOCK : www/templates/general/palabras_claves.tpl -->
          
          
        </div>