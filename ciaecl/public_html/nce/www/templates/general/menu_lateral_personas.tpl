<div class="col-sm-4 sidebar">
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Personas</h4>
           
              <h6>Buscar por Apellido</h6>
              <p class="buscar-apellidos">
              <a href="javascript:buscardorPaginaRango('1','{page}')">A-D</a>  <a href="javascript:buscardorPaginaRango('2','{page}')">E-H</a>  <a href="javascript:buscardorPaginaRango('3','{page}')">I-L</a>  <a href="javascript:buscardorPaginaRango('4','{page}')">M-O</a>  <a href="javascript:buscardorPaginaRango('5','{page}')">P-S</a>  <a href="javascript:buscardorPaginaRango('6','{page}')">T-Z</a>    
              </p>
          </div> 
           
           

        </div>
        
        <script>
       function buscardorPaginaRango(rango, page)
		 {
			location.href="index.php?langSite=es&page="+page+"&busca_rango="+rango+"";
		 }
		</script>
        