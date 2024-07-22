 
<script> 
	$(document).ready(function() {
	$('.galeria_noticia').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title') + '';
			}
		}
	});
}); 
</script>

<!--
<script type="text/javascript">
    $(function() {
        $('#galeria_noticia_mew a').lightBox();
    });
    </script>-->
           
           
            <div class="orange caluga-sidebar">
            <h4>Galeria de fotos</h4> 
                             
       
                               
            <div id='galeria_noticia'  class='galeria_noticia' style="width: 100%; text-align: center" > 
            <!-- START BLOCK : bloque_elemento_galeria_td --> 
                   <a href="imageview.php?image=noticias/{id}/{imagen}" title="{imagen}">
                   <img src="imageview.php?image=noticias/{id}/{imagen}"   class="imagen_vista_galeria" ></a>  
         <!-- END BLOCK : bloque_elemento_galeria_td -->               
              </div>   

                                      
 
          </div> 
