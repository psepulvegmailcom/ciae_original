<h1 class="title--despliegue text-center">{titulo} / {tipo}</h1>
<div class="row mb-5 justify-content-center box--info-despliegue">
	<div class="col-12 col-md-5 col-lg-3 mb-4 mb-md-0 img-libro">
		<figure>
			<img src="imageview.php?image=recursos/{imagen}" />
		</figure>
	</div>
	<div class="col-12 col-md-7 col-lg-6">
		<div class="container--info-despliegue">
			<p><strong>Autor:</strong> {autor}</p>
			<p>{editorial}</p>
			<p>{paginas}</p>
			<p>{isbn}</p>
			<p><em>{bajada}</em></p>
			<p><strong>Resumen:</strong> {descripcion}</p>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-3 mt-4 mt-lg-0 text-center">
		<a href="download.php?file=recursos/{archivo}" class="btn btn-warning d-block text-uppercase mb-2" target="_blank">Descargar Boletín</a>
	</div>
</div>