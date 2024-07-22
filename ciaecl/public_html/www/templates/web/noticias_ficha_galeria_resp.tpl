    <script type="text/javascript">
    $(function() {
        $('#galeria_noticia a').lightBox();
    });
    </script>


<!-- START BLOCK : bloque_elemento_galeria -->
<div id='galeria_noticia' style="width:100% ">
	<table class="tabla_simple" style="padding-top:15px;width:100%   " border="0">
		<!-- START BLOCK : bloque_elemento_galeria_tr -->
		<tr style="  ">
			<!-- START BLOCK : bloque_elemento_galeria_td -->
			<td style="text-align:center; " > 
			<a href="imageview.php?image=noticias/{id}/{imagen}" alt="{imagen}"  title="{imagen}"  style=" border-bottom:none;" >
                <img src="imageview.php?image=noticias/{id}/{imagen}"   alt='Imagen {imagen}' title="{imagen}"  width="170px" border="0"   class="noticias_imagen_galeria"   />
            </a>
			</td>
			<!-- END BLOCK : bloque_elemento_galeria_td -->
		</tr>
		<!-- END BLOCK : bloque_elemento_galeria_tr -->
	</table>
</div>
<!-- END BLOCK : bloque_elemento_galeria -->

