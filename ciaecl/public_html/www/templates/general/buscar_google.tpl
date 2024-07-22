					<!-- SiteSearch Google -->
					 
					<form  method="get"  target="_blank" action="https://www.google.cl/search" name="search" >
					<input type='hidden' name='ie' value='UTF-8' />
					<input type='hidden' name='oe' value='UTF-8' />
					<input type='hidden' name='domains' value="www.ciae.uchile.cl" />  
					<input type='hidden' name='sitesearch' value="www.ciae.uchile.cl"   />
					<input type="hidden" name="site" value="www.ciae.uchile.cl" />
					 
					<!-- SiteSearch Google -->
				 
					 
                <div class="input-group" id='buscador_google'>           
                <input type="text" name='q' maxlength='255' value="" placeholder="Buscar" aria-describedby="basic-addon2" class="form-control form-control-search">
                <span class="input-group-addon input-group-addon-search" id="basic-addon2">
                <i class="fa fa-search" ></i></span>
                <!-- SiteSearch Google -->
                </div> 
					
					</form>
					<script type="text/javascript">
					function enviarBusqueda()
					{
						/*document.search.q.value = document.search.q.value+" site:www.ciae.uchile.cl";*/
						document.search.submit();
						document.search.q.value = '';
					}
					</script>