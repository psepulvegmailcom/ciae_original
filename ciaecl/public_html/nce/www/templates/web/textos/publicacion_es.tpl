<div class="col-sm-8 single-new">
          <div class="blue box-style box-buscador">
            <div class="row">
              <div class="col-md-12">
                <h2>Publicaciones</h2>
                BUSCAR PUBLICACIONES
              </div>
              <form id="bP" name="bP" method="post" action="resultados_busqueda_publicaciones.php" target="new">
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" id="Autor" placeholder="Autor">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" id="Anno" placeholder="A&ntilde;o">
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form">
                  <option>Area</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form">
                  <option>Tipo de documento</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" id="Palabra" placeholder="Palabra clave">
              </div>
              <div class="col-sm-4">
              <input type="submit" id="bpublica" value="Buscar" class="btn btn-primary btn-block" />
                <!--a class="btn btn-primary btn-block" href="#" role="button"><i class="fa fa-search"></i> Buscar</a-->
              </div>
              </form>
            </div>
          </div>
          <div class="grey-box-home">
            <h2 class="title-grey-box">Publicaciones</h2>
            <div class="grey-box-list">
              <h3></h3>
              
              <!-- START BLOCK : bloque_listado_publicacion -->
              <ul>
                <li><a href="">{titulo_es}</a></li>
              </ul>
              <!-- END BLOCK : bloque_listado_publicacion -->
            </div><!-- /.grey-box-list -->
            <!-- /.grey-box-list -->
          </div><!-- /.grey-box-home -->
          


        </div>
