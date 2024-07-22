<div class="container-fluid header-ciae">
	<div class="row">
		<div class="col-md-9">
			<a href="index.php?langSite=es&page=home" class="logo-ciae" style="float: left">
				<img src="www/images_new/observatorioDocente.png" class="img-responsive" height="150px" style="height: 90px; margin-right: 50px;">
			</a>
			<a href="https://ciae.uchile.cl">
				<img src="www/images_new/logo.png" class="img-responsive" style="height: 90px;">
			</a>
		</div>
		<div class="col-md-3">
			<div class="input-group" style="margin-top: 20px;">
				<!-- SiteSearch Google -->
				<form method="get" target="_blank" action="https://www.google.cl/search" name="search">
					<input type="hidden" name="ie" value="UTF-8">
					<input type="hidden" name="oe" value="UTF-8">
					<input type="hidden" name="domains" value="www.observatoriodocente.cl/">
					<input type="hidden" name="sitesearch" value="www.observatoriodocente.cl/">
					<input type="hidden" name="site" value="www.observatoriodocente.cl/">
					<div class="input-group" id="buscador_google">
						<input type="text" name="q" maxlength="255" value="" placeholder="Buscar" aria-describedby="basic-addon2" class="form-control form-control-search">
						<span class="input-group-addon input-group-addon-search" id="basic-addon2">
                		<i class="fa fa-search"></i></span>
					</div>
				</form>
				<script type="text/javascript">
					function enviarBusqueda() {
						document.search.submit();
						document.search.q.value = '';
					}
				</script>
			</div>
		</div>
	</div>
</div>