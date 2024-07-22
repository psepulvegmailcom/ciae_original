	{hidden_page} 
  
		<div id="box">
		<div style="float:left; position:relative;  "><img src="cea/images/site/logo_texto.png"></div>

		<div id="head"> 
		<p style="" align="right">	 </p>	
	</div>
	</div>
	<div id="menu">
	<p>
	 <a href="?langSite=es&page=equipamiento"><img src="cea/images/site/menu_equipamiento.png" style="margin:0; border:0;"></a>	  <a href="?langSite=es&page=escena"><img src="cea/images/site/menu_escena.png">	</a> <a href="?langSite=es&page=sobrebd"> <img src="cea/images/site/menu_sobreBD.png"></a>
	</p>
	</div>
	
	
	
	
	
	
	<div></div>
		<a name="top"></a> 
		<!-- START MENU TOP -->
		<div id='menu_top'>
			
		</div>
		<!-- END MENU TOP -->
	 	
		
		<div id="wrapper" >
			
			
		<div id='header' style="padding-left:0px;">	 
				<div id='banner_header'>
					  
				</div>
				<div id="title"> 
					 <!--<h3>{titulo_chico}</h3> -->
				</div> 
			</div>		
			
			
	 
			<div id="bottomcontent">
				
			<!-- START CONTENT-->
				<div class="left" id="sidebar"  >
					<!--Menu lateral-->						 
					<div class='nav3' > 
						<ul>
						<!-- START BLOCK : bloque_menu_principal -->
						<li class="group" > <a href="?langSite={menu_lang}&page={menu_option}">   {menu_name} </a> </li> 
							<!-- START BLOCK : bloque_menu_principal_sub -->
							<li  class="subgroup"   >   <a  href="?langSite={menu_lang}&page={menu_option}"><img src="cea/images/site/menu_sub.gif" /> {menu_name} </a> </li>
							<!-- END BLOCK : bloque_menu_principal_sub --> 
						<!-- END BLOCK : bloque_menu_principal -->	 
						</ul>
					<div style="padding-top:10px;   text-align:center"> 
					 
					</div> 
					</div> 
						
	
				</div>
				 
				<div class="right"  >	
					<div id="mainAreaInternal">  
						<!-- START BLOCK : bloque_titulo_modulo --> 
							{titulo_modulo}	 
						<!-- END BLOCK : bloque_titulo_modulo --> 
						{mensaje_guardar_datos} 
						<!-- inicio contenido -->
						<p class="thumbs"></p>
						<!-- START BLOCK : bloque_contenido_modulo -->
						{contenido_sitio}
						<!-- START BLOCK : bloque_contenido_modulo -->
						<!-- START BLOCK : bloque_contenido_modulo_home -->
						<div style="float:left ; ">
						
								 <!--index.php?langSite=en&page=researchers-->
							<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="210px" height="230px"  >
							 <param name="movie" value="cea/images/site/fot.swf?linkURL=http://www.icdb.uchile.cl/researchers.html" />
							 <param name="quality" value="high"   />
							 <embed  src="cea/images/site/fot.swf?linkURL=http://www.icdb.uchile.cl/researchers.html" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"    style=" text-align:center">
							 </embed>
						   </object>
									   </div>
					   {contenido_sitio}
					   <div class="bloque_eventos_publicaciones_fila"></div>
					   <div  class="bloque_eventos_publicaciones" style="float:left;"    >
							<h3><a href="?langSite={bloque_lang}&page=news">{titulo_noticias}</a></h3>
							<table style=" width:100%"  >
						   <!-- START BLOCK : bloque_eventos_publicaciones_noticias -->
							
						 <tr  class="bloque_eventos_publicaciones_fila" >
						 <td  class="bloque_eventos_publicaciones_fila"  style="width:60px" valign="top">				 
							<img class="img_photo"    src="imageview.php?image=news/{datos_img}&case=img_news" width="55px" /></td>
						 <td  class="bloque_eventos_publicaciones_fila"  style="width:150px"  > 
						  <div class="bloque_eventos_publicaciones_titulo">{datos_title} </div> 
						  <small>	{datos_resumen}   </small> <br />
								<a    style="color: #D62439; font-weight:bold;" href='?langSite={datos_lang_languaje}&page=news&id_elemento={datos_id}'    > +{datos_lang_more} </a>
						 </td>
						 </tr>
						 
						   <!-- END BLOCK : bloque_eventos_publicaciones_noticias -->
							 </table>
					   </div>
					   
					   <div  class="bloque_eventos_publicaciones" style="float:left;width:250px;">
					   <div >
					   <h3><a href="?langSite={bloque_lang}&page=view_agenda">{titulo_eventos}</a></h3>
	 <table style=" width:90%">
					   <!-- START BLOCK : bloque_eventos_publicaciones_eventos -->
						
					 <tr  class="bloque_eventos_publicaciones_fila" >
					  
					 <td   class="bloque_eventos_publicaciones_fila"     > 
					 <strong><small>	 {datos_date}  </small></strong>
					  <div class="bloque_eventos_publicaciones_titulo">{datos_title} </div>  
							<a    style="color: #D62439; font-weight:bold;" href='?page=view_agenda&id_elemento={datos_id}&langSite={datos_lang_languaje}'    > +{datos_lang_more} </a>
					 </td>
					 </tr>
					 
					   <!-- END BLOCK : bloque_eventos_publicaciones_eventos -->
						 </table>				   
					   </div>
					   <div >
					   <h3><a href="?langSite={bloque_lang}&page=publications">{titulo_publicaciones}</a></h3>
					   <ul>
					   
					   <!-- START BLOCK : bloque_eventos_publicaciones_publicaciones -->
					   <li   class="bloque_eventos_publicaciones_fila" >  {datos_title}<br /><a    style="color: #D62439; font-weight:bold;" href='?option=eventos&id_evento={datos_id}&langSite={datos_lang_languaje}'    > +{datos_lang_more} </a></li>
					   <!-- END BLOCK : bloque_eventos_publicaciones_publicaciones -->
					   </ul>
					   </div>
					   </div>
						<!-- START BLOCK : bloque_contenido_modulo_home -->
						<!-- fin contenido -->  
					</div>
					
					
			
				</div>
			<!-- END CONTENT-->
	
			</div>   
			
	</div>
	  
		{footer_page} 