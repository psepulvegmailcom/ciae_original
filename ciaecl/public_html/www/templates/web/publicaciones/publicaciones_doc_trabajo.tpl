
<div class="contenido_titulo_separador" style=" "><!-- {tipo} --> {numero_html} {mes} {agno} : "{titulo}" </div>
<!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->
 <input type="hidden" name="id_publicaciones" value="{id_publicaciones}">
<p><strong>{langSite_publicaciones_titulo} : </strong> <em>"{titulo}"</em></p> 
<p id='publicaciones_numero'><strong>{langSite_publicaciones_numero} : </strong> {numero}</p>

<p id='publicaciones_mes'><strong>{langSite_publicaciones_mes} : </strong> {mes}</p>
<p><strong>{langSite_publicaciones_agno} : </strong> {agno}</p>
<script>
	if(trim('{numero}') == '')
		{
			hiddenId('publicaciones_numero');
		}
	if(trim('{mes}') == '')
		{
			hiddenId('publicaciones_mes');
		}
</script>
<p><strong>{langSite_publicaciones_autores} : </strong>
{autores_html}
 </p>
 <!-- START BLOCK : bloque_elemento_documento_link -->
 <p><strong>link : </strong> <a href="{link}" target="_blank" style="border:0px "> {link}</a>  </p>
<!-- END BLOCK : bloque_elemento_documento_link --> 
 <!-- START BLOCK : bloque_elemento_link_doi -->
 <p><strong>doi : </strong> <a href="https://doi.org/{doi}" target="_blank" style="border:0px ">https://doi.org/{doi}</a>  </p>
<!-- END BLOCK : bloque_elemento_link_doi --> 
<p id='publicaciones_resumen'><strong>{langSite_publicaciones_resumen} : </strong> {resumen}</p><br>
<script>
	if(trim('{resumen}') == '')
		{
			hiddenId('publicaciones_resumen');
		} 
</script>
<!-- START BLOCK : bloque_elemento_documento -->
<p><a href="download.php?file=publicaciones/{documento}" target="_blank" style="border:0px "><img src="www/images/filetypes/pdf.png" border="0" style="width:32px " title="{langSite_publicaciones_descarga}"> {langSite_publicaciones_descarga}</a>  </p>
<!-- END BLOCK : bloque_elemento_documento --> 
<p>&nbsp;</p><p>&nbsp;</p>

 

 
