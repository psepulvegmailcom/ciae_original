{hidden_page}
<a name="top"></a> 
	<div id="wrapper">
		<div id='header'>
			<div id="hright">
			<div style="float:right; padding-right:5px">
			<a href="http://www.ciae.uchile.cl/" target="_blank"><img src="images/LOGO2011_B.jpg"  border="0"  /></a>
			</div>
				<div id="hrighttop">
					<p></p>
				</div>
				<div id="menu">
					<!-- informacion del usuario online -->
				</div>
			</div>
			<div id="title">  
				 <h3>{titulo_chico}</h3> 
			</div> 
		</div>
		<div id="bottomcontenttop">
			<div id="user_info">
				<!-- START BLOCK : user_info -->
				<b>{titulo_usuario}:</b>&nbsp;{nombre_usuario} ({login_usuario}) 	
				<!-- END BLOCK : user_info -->	
				<p>
					<span id="online_clock" style="font-size:9px" ></span > 
					<script>startTime();</script>
				</p>
			</div>
		</div>
		<div id="bottomcontent">
		<!-- START CONTENT-->
		
			 <!-- INCLUDE BLOCK : ../templates/general/version3_ventanas.tpl -->
			<div class="left" id="sidebar"  >
				<!--Menu lateral-->
						
						<!-- START BLOCK : show_lista_MENU -->
						<h2>Menu</h2>
						<div> 
							<!-- START BLOCK : menu_superior --> 
								<p>	<!--{menu_li_class}-->
								<a href="javascript:limpiarPaginamientoProcess('{menu_opcion}',0);" style='{menu_selected}'  accesskey="0" title="{menu_name}"  id='menu_{menu_opcion}'>{menu_name}</a></p>
							<!-- END BLOCK : menu_superior -->	
						</div>
						
						<!-- END BLOCK : show_lista_MENU -->
						 <!-- START BLOCK : show_menu_inferior -->
						<h2>Acciones</h2>
						<div>
							<p>
								<ul>
								<!-- START BLOCK : menu_inferior -->
								<li class="{menu_li_class}">
									<a href="javascript:limpiarPaginamientoProcess('{menu_opcion}',0);"   title="{menu_name}" class="{menu_a_class}" id='submenu_{menu_opcion}'>{menu_name} {menu_editar}</a>
								</li>
							<!-- END BLOCK : menu_inferior -->			
								</ul>
							</p>
						</div>
						<!-- END BLOCK : show_menu_inferior -->
						{form_login}
						
						 
						  
						
						
						
						 
						 
						 
						<!--<h2  id='numero_visitas_sup' >N&deg; de visitas :  &nbsp; </h2>-->
						
					 
						<!-- START BLOCK : show_lista_FAQ_old -->
						<h2>Preguntas&nbsp;Frecuentes</h2>
						<div>
								<p>
								<ul>
								<!-- START BLOCK : lista_FAQ_old -->		
								<li class="{class}">
								<a href="javascript:ate_view_faq({id_faq});" title="{faq}" class="faq">{faq_orden}.- {faq}</a></li>
								<!-- END BLOCK : lista_FAQ_old -->
								
								<li class="{class}">
								<a href="javascript:ate_view_faq();" title="Aspectos Generales" class="faq">Aspectos Generales</a></li>
								<li class="{class}">
								<a href="javascript:ate_view_faq();" title="Registro ATE" class="faq">Registro ATE</a></li>
								<li class="{class}">
								<a href="javascript:ate_view_faq();" title="Contratación de una ATE" class="faq">Contratación de una ATE</a></li>
								<li class="{class}">
								<a href="javascript:ate_view_faq();" title="Inscripción y encuesta de satisfacción de usuarios con servicios ATE" class="faq">Inscripción y encuesta de satisfacción de usuarios con servicios ATE</a></li>
								</ul>
								</p>
						</div>
						<!-- END BLOCK : show_lista_FAQ_old -->
								 
						<!-- START BLOCK : show_lista_LINK -->
								<h2>Links</h2>
						<div>
							<p>
							<ul>
							<!-- START BLOCK : lista_link -->		
							<li class="{class}">
							<a href="http://{url}" target='_blank' title="{name}">{name}</a>
							<br>{description}
							</li>
							<!-- END BLOCK : lista_link -->
							</ul>
							</p>
						</div>
						<!-- END BLOCK : show_lista_LINK -->
						<h2>Ayuda</h2>
						<div>
							<p>
							<ul>
							 	
							<li class="{class}">
							<a href="docs/guia_uso.pdf" target='_blank' title="Guía de Usuario">Guía de Usuario</a>
							 
							</li>
							
							
							<li class="{class}">
							<a href="docs/201107-EstandaresEducadorasParvulosConsultaNacional.pdf" target='_blank' title="Estándares de Educadoras de Párvulos para Consulta Nacional">Estándares de Educadoras de Párvulos para Consulta Nacional</a>
							 
							</li>
							 
							</ul>
							</p>
						</div>
			</div>
			<div class="right"  >	
				<div id="mainAreaInternal">
				 
			  



					{barra_navegacion} 
					 
					
					<!-- START BLOCK : bloque_home_sello -->
					<div style="float:right; margin-top:5px "><img src="images/sello.jpg" /></div>
					  
				 <!--<a href="javascript:process('avisos',0);"   accesskey="0" title="avisos" ><img src="images/noticia.gif" border="0"  style=" margin:10px 0 0 10px"/></a> --> 
					<!-- END BLOCK : bloque_home_sello -->
					
					<!-- START BLOCK : bloque_titulo_modulo --> 
					{bloque_titulo_modulo}	
					<!-- END BLOCK : bloque_titulo_modulo -->
					
					{mensaje_guardar_datos}
				

					<!-- inicio contenido -->
					<p class="thumbs"></p>
					{contenido_sitio}
					<!-- fin contenido -->
					<br /><br /><br /><br /><br /><br />
				</div>
				
			</div>
		<!-- END CONTENT-->
		</div>
		<div class="clear"></div>
		
</div>

 



{footer_page}
