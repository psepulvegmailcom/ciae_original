<div class="col-sm-4 sidebar">
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Personas</h4>
              <p class="buscar-apellidos"><a href="index.php?langSite=es&page=view_personas_investigadores">INVESTIGADORES</a></p>
            <h6>Buscar por Apellido</h6>
              <p class="buscar-apellidos">
              <a href="javascript:buscardorPaginaRango('1','view_personas_investigadores')">A-D</a>  <a href="javascript:buscardorPaginaRango('2','view_personas_investigadores')">E-H</a>  <a href="javascript:buscardorPaginaRango('3','view_personas_investigadores')">I-L</a>  <a href="javascript:buscardorPaginaRango('4','view_personas_investigadores')">M-O</a>  <a href="javascript:buscardorPaginaRango('5','view_personas_investigadores')">P-S</a>  <a href="javascript:buscardorPaginaRango('6','view_personas_investigadores')">T-Z</a>    
              </p>
          </div>
</div>
        
        <script>
       function buscardorPaginaRango(rango, page)
		 {
			location.href="index.php?langSite=es&page="+page+"&busca_rango="+rango+"";
		 }
		</script>
        