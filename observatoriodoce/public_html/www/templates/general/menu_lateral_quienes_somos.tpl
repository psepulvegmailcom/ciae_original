<!--div class="col-sm-4 sidebar">
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Personas</h4>
            <h6>Buscar por Apellido</h6>
              <p class="buscar-apellidos">
              <a href="javascript:buscardorPaginaRango('1','view_personas_investigadores')">A-D</a>  <a href="javascript:buscardorPaginaRango('2','view_personas_investigadores')">E-H</a>  <a href="javascript:buscardorPaginaRango('3','view_personas_investigadores')">I-L</a>  <a href="javascript:buscardorPaginaRango('4','view_personas_investigadores')">M-O</a>  <a href="javascript:buscardorPaginaRango('5','view_personas_investigadores')">P-S</a>  <a href="javascript:buscardorPaginaRango('6','view_personas_investigadores')">T-Z</a>    
              </p>
          </div>
</div-->
         <div class="col-sm-4 sidebar"  >
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
		 </div>
        <script>
       function buscardorPaginaRango(rango, page)
		 {
			location.href="index.php?langSite=es&page="+page+"&busca_rango="+rango+"";
		 }
		</script>
        