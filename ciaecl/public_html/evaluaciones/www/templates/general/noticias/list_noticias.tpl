
 <input type="hidden" name="id_noticia" value="" />
 <script>
function gonews(id)
{
	document.main.id_noticia.value = id;
	process('home|ver',0);
}
</script>
 
<ul>
 
 <!-- START BLOCK : bloque_elemento_lista -->
<li>
	 	<a href="javascript:gonews({id_noticia});"> {titulo}</a> </div>
				 <em>{resumen}</em><br />({fecha})  
		 
	</li>
 <!-- END BLOCK : bloque_elemento_lista --> 
 </ul>
 
 
 <!-- START BLOCK : elemento_lista_nohay -->
 <div style="text-align:center">No hay noticias disponibles</div>
 <!-- END BLOCK : elemento_lista_nohay -->