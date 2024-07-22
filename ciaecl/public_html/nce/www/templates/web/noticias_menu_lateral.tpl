
<div class="col-sm-4 sidebar">
           <div class="blue caluga-sidebar">
              <h4>Agenda</h4>
              <!-- START BLOCK : bloque_home_eventos -->
              <div class="evento row">
                <div class="col-md-4 col-xs-6">
                  <div class="month">{mes}</div>
                  <div class="day">{dia}</div>
                </div>
                <div class="col-md-8 col-xs-6 info-agenda-home">
                  <p><a href="index.php?page=view_noticias&amp;id={id_noticia}&langSite={langSiteEspecial_seleccionado}" >{titulo}</a></p>
                </div>
              </div>
    		<!-- END BLOCK : bloque_home_eventos -->  
          </div>
			<!-- START BLOCK : bloque_elemento_galeria -->

				<!-- INCLUDE BLOCK : www/templates/web/noticias_ficha_galeria.tpl --> 

			<!-- END BLOCK : bloque_elemento_galeria --> 
          
           <!-- START BLOCK : bloque_noticia_boletin --> 
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Boletines Institucionales </h4>
                
				<ul>
				
                <a   href="download.php?file=boletin/{archivo}">
                <img src="imagenewview.php?image=boletin/boletin_miniatura.jpg" width="70px"></a>
                &nbsp;&nbsp;<a href="download.php?file=boletin/{archivo}">
                {mes_html} {agno} N&deg; {id_boletin} </a>                
                <br><br>
                <a href="index.php?langSite=es&page=view_boletin">Lee sobre nuestros Boletines</a><br>
			        </ul>       
          </div> 
          
           <!-- END BLOCK : bloque_noticia_boletin --> 
          
          

          
          <!-- INCLUDE BLOCK : www/templates/general/palabras_claves_01.tpl -->
          
          
        </div>
