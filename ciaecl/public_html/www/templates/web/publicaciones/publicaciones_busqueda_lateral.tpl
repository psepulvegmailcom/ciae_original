
<div class="col-sm-4 sidebar">
          <!--<div class="blue-nav caluga-sidebar-nav">
            <h4>{lang_publicaciones_menu_lateral}</h4>
              <ul>
                <li><a href="">Noticias</a></li>
                <li><a href="">En Foco</a></li>
              </ul>
          </div>-->  
          <div class="blue-nav caluga-sidebar-nav">
            <h4>&Aacute;reas de Investigaci&oacute;n</h4>
              <ul>
              
                   <!-- START BLOCK : bloque_publicaciones_filtro_area_lateral -->                    
                  <li><a href="javascript:buscadorFormularioPublArea('{id_area}')">{area_show}</a></li>                  
                   <!-- END BLOCK : bloque_publicaciones_filtro_area_lateral --> 
              
               
              </ul>
          </div>
          <div class="blue-nav caluga-sidebar-nav">
            <h4>Apellidos Autores</h4>
            <p class="buscar-apellidos">
            
              <a href="javascript:buscardorPaginaRango('rango','1')">A-D</a>            
               <a href="javascript:buscardorPaginaRango('rango','2')">E-H</a>  
               <a href="javascript:buscardorPaginaRango('rango','3')">I-L</a> 
                <a href="javascript:buscardorPaginaRango('rango','4')">M-O</a>  
                <a href="javascript:buscardorPaginaRango('rango','5')">P-S</a>  
                <a href="javascript:buscardorPaginaRango('rango','6')">T-Z</a>  
               
            </p>
          </div>
          <div class="blue-nav caluga-sidebar-nav">
            <h4>Tipo de Publicaci&oacute;n</h4>
              <div class="sidebar-nav-content">
                <select class="form-control margin-form" name="tipoDoc" id="tipoDoc">
                 <option value="0">{lang_publicaciones_tipo}</option>
                   <!-- START BLOCK : bloque_publicaciones_filtro_tipo_lateral --> 
                  <option value="{id_tipo}" onClick="javascript:buscadorPubTipo('{id_tipo}');">{tipo}</option>                  
                   <!-- END BLOCK : bloque_publicaciones_filtro_tipo_lateral -->
                </select> 
              </div>
          </div>
         
          <input type="hidden" name="busqueda_flag" value="1">
          <!-- INCLUDE BLOCK : www/templates/general/palabras_claves.tpl -->
          
          
        </div>