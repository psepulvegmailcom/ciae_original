<?xml version="1.0" encoding="ISO-8859-1"?>

<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">
	<channel>
		<title>{sitio_nombre}</title> 
		<link>{url_site}</link> 
		<description>Noticias y Agenda {sitio_nombre}</description>
		<language>es-mx</language>
		<copyright>{sitio_nombre}</copyright>
		<!-- START BLOCK : bloque_elemento -->
			<item>
				<title><![CDATA[{titulo}]]></title>
				<link><![CDATA[{url_site}index.php?page=view_noticias&id={id_noticia}&externo=rss]]></link>
				<pubDate>{fecha_update}</pubDate>
				<description><![CDATA[{bajada}]]></description>
				<content:encoded><![CDATA[{bajada}]]></content:encoded>
				<dc:creator>{sitio_nombre}</dc:creator>
				<category domain="{url_site}">{tipo}</category>
				<guid isPermaLink="true"><![CDATA[{url_site}index.php?page=view_noticias&id={id_noticia}&externo=rss]]></guid> 
			</item> 
		<!-- END BLOCK : bloque_elemento --> 
		
		
		
		 
		
		
		
		
	</channel>
</rss>