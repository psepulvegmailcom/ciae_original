<?xml version="1.0" encoding="ISO-8859-1"?>

<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">
	<channel>
		<title>Actualidad {sitio_nombre}</title> 
		<link>{url_site}</link> 
		<description></description>
		<language>es-mx</language>
		<copyright>{sitio_nombre}</copyright>
		<!-- START BLOCK : bloque_elemento -->
			<item>
				<title>{titulo}</title>
				<description>{bajada}</description>
				<pubDate>{fecha_html}</pubDate>
				<link>{url_site}/index.php?page=view_noticias&id={id_noticia}</link>
				<guid>{url_site}/index.php?page=view_noticias&id={id_noticia}</guid>
			</item> 
		<!-- END BLOCK : bloque_elemento --> 
		</channel>
</rss>



		<!-- START BLOCK : bloque_elemento -->
			<item>
				<title>{fecha_html} - {titulo}</title>
				<link>{url_site}index.php?page=view_noticias&id={id_noticia}</link>
				<pubDate>{fecha_update} GM</pubDate>
				<description>{bajada}&nbsp;&nbsp;</description>
				<content:encoded><![CDATA[<div>{bajada}&nbsp;&nbsp;</div>]]></content:encoded>
				<dc:creator>private</dc:creator>
				<category domain="{url_site}">{tipo}</category>
				<guid isPermaLink="true">{url_site}index.php?page=view_noticias&id={id_noticia}</guid> 
			</item> 
		<!-- END BLOCK : bloque_elemento --> 