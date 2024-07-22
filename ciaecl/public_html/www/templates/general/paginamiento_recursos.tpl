			
	<nav class="mb-5">
          <ul class="pagination justify-content-center">
			 <!-- START BLOCK : bloque_paginamiento_anterior -->  
            <li class="page-item">
              <a class="page-link" href="javascript:buscarPaginamiento('{pagina_anterior}');">&laquo;</a>
            </li>
			 <!-- END BLOCK : bloque_paginamiento_anterior --> 
			 <!-- START BLOCK : bloque_paginamiento_numero -->
			   <!-- START BLOCK : bloque_paginamiento_numero_simple -->
            <li class="page-item"><a class="page-link" href="javascript:buscarPaginamiento('{pagina}');"> {pagina}
				  <!-- END BLOCK : bloque_paginamiento_numero_simple -->
				  <!-- START BLOCK : bloque_paginamiento_numero_seleccionada -->
				 <li class="page-item active" aria-current="page">
              <span class="page-link">{pagina}
				   <!-- END BLOCK : bloque_paginamiento_numero_seleccionada -->
				</a></li>
				 <!-- END BLOCK : bloque_paginamiento_numero -->
            <!--li class="page-item">
              <a class="page-link" href="#">&#187;</a>
            </li-->
          </ul>
        </nav>			
				