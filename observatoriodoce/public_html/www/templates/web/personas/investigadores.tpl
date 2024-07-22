

            <!--<h2 class="big-title">{tipo}</h2>-->
            <h2 class="big-title">{tipo}</h2>
            <p>{descripcion}</p>
           
            <div class="post-new row item-row">
             <!-- START BLOCK : bloque_contenido_investigadores_tr -->
            	<!-- START BLOCK : bloque_contenido_investigadores_tr_universidad -->
              <!--div class="col-md-12"><h3 class="tit-universidad">&nbsp;</h3></div-->
              	<!-- END BLOCK : bloque_contenido_investigadores_tr_universidad -->
               <!-- START BLOCK : bloque_contenido_investigadores_td -->
              <div class="col-md-3 col-force-4">
                <a  href="?page=view_personas_investigadores&case=ficha&id={id_persona}&langSite={langSiteEspecial_seleccionado}" >
                <img src="imageview.php?image=personas/{imagen}" style="width:150px; height:170px;" title=" {nombre} {apellido_paterno}  {apellido_materno}" class="img-responsive">
                  
                </a>
                <span class="nombre-investigador"><a  href="?page=view_personas_investigadores&case=ficha&id={id_persona}&langSite={langSiteEspecial_seleccionado}" >{nombre} {apellido_paterno}    </a></span>
                <span class="small"><p style="height:25px; width:150px;">{cargo}</p></span>
              </div>
              <!-- END BLOCK : bloque_contenido_investigadores_td -->
              <!-- END BLOCK : bloque_contenido_investigadores_tr -->
            </div><!-- /.post-new -->






