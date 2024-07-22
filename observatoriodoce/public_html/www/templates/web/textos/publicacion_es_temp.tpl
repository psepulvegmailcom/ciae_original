<div class="container">
<div class="row">

        <div class="col-sm-8 single-new">
          <div class="blue box-style box-buscador">
            <div class="row">
              <div class="col-md-12">
                <h2>Publicaciones</h2>
                BUSCAR PUBLICACIONES
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" id="" placeholder="Autor">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" id="" placeholder="A&ntilde;o">
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form">
                  <option>Area</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form">
                  <option>Tipo de documento</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" id="" placeholder="Palabra clave">
              </div>
              <div class="col-sm-4">
                <a class="btn btn-primary btn-block" href="#" role="button"><i class="fa fa-search"></i> Buscar</a>
              </div>
            </div>
          </div>
          <div class="grey-box-home">
            <h2 class="title-grey-box">Publicaciones</h2>
            <div class="grey-box-list">
              <h3></h3>
              {texto_contenido}
              <!-- START BLOCK : bloque_listado_publicacion -->
              <ul>
                <li><a href="?page={opcion}&langSite={langSiteEspecial_seleccionado}">{titulo_es}</a></li>
              </ul>
              <!-- END BLOCK : bloque_listado_publicacion -->
            </div><!-- /.grey-box-list -->
            <!-- /.grey-box-list -->
          </div><!-- /.grey-box-home -->
          


        </div><!-- /.blog-main -->

        <div class="col-sm-4 sidebar">
          <div class="blue-nav caluga-sidebar-nav">
            <h4>Lee sobre nuestras publicaciones</h4>
              <ul>
                <li><a href="">Noticias</a></li>
                <li><a href="">En Foco</a></li>
              </ul>
          </div>  
          <div class="blue-nav caluga-sidebar-nav">
            <h4>Areas de investigaci&oacute;n</h4>
              <ul>
                <li><a href="">Pol&Iacute;ticas Educacionales</a></li>
                <li><a href="">Docentes, Ense&ntilde;anza y aprendizaje</a></li>
                <li><a href="">Neurociencia y Cognici&oacute;n</a></li>
                <li><a href="">Educaci&oacute;n y Tecnolog&Iacute;a de la Informaci&oacute;n</a></li>
              </ul>
          </div>
          <div class="blue-nav caluga-sidebar-nav">
            <h4>Apellidos Autores</h4>
            <p class="buscar-apellidos">
              <a href="#">A-D</a>  <a href="#">E-H</a>  <a href="#">I-L</a>  <a href="#">M-O</a>  <a href="#">P-S</a>  <a href="#">T-Z</a>    
            </p>
          </div>
          <div class="blue-nav caluga-sidebar-nav">
            <h4>Tipo de publicaci&oacute;n</h4>
              <div class="sidebar-nav-content">
                <select class="form-control margin-form">
                  <option>Tipo</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select> 
              </div>
          </div>
         <!-- INCLUDE BLOCK : www/templates/general/palabras_claves.tpl -->
        </div><!-- /.blog-sidebar -->

      </div>
       </div>