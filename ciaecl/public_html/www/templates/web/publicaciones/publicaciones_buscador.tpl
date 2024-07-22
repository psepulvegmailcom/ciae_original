 <div class="blue box-style box-buscador">
            <div class="row">
              <div class="col-md-12">
                <h2>{lang_publicaciones_menu_titulo}</h2>
               <font style="text-transform:uppercase">{lang_buscador_buscar} {lang_publicaciones_menu_titulo}</font>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" name="busca_Autor" id="busca_Autor" placeholder="{lang_buscador_autor}">
              </div>
                <div class="col-sm-4">
                <select class="form-control margin-form" name="busca_Anno" id="busca_Anno" >
                   <option value="0">{lang_publicaciones_agno}</option>
                   <!-- START BLOCK : bloque_publicaciones_filtro_agno -->        
                   <option value="{agno}">{agno}</option>
                  <!-- END BLOCK : bloque_publicaciones_filtro_agno -->
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form" name="busca_Area" id="busca_Area" placeholder="{lang_proyectos_area}">
                  <option value="0">{lang_proyectos_area}</option>
                  
                   <!-- START BLOCK : bloque_publicaciones_filtro_area --> 
                  <option value="{id_area}" >{area_show}</option>                  
                   <!-- END BLOCK : bloque_publicaciones_filtro_area --> 
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form" name="busca_tipoDocumento" id="busca_tipoDocumento"  placeholder="{lang_publicaciones_tipo}" >
                  <option value="0">{lang_publicaciones_tipo}</option>
                  
                   <!-- START BLOCK : bloque_publicaciones_filtro_tipo --> 
                  <option value="{id_tipo}">{tipo}</option>                  
                   <!-- END BLOCK : bloque_publicaciones_filtro_tipo -->
                                
                </select>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" name="busca_palabra" id="busca_palabra" placeholder="{lang_buscador_palabra_clave}">
                 <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="1">
              </div>
             
              <div class="col-sm-4">
                <a class="btn btn-primary btn-block" href="#" role="button" onClick="javascript:buscadorFormulario();"><i class="fa fa-search"></i>{lang_buscador_buscar}
                </a>
              </div>
               <div class="col-sm-4">
                <a class="" href="#" onClick="javascript:resetFormulario();"><i class="fa fa-search"></i>
                <small>limpiar busqueda</small></a>
              </div>
            </div>
          </div>