<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl -->

		 	<!-- START BLOCK : bloque_redondeado_areas -->  
				<div  id='listado_{caso}_id_{fila}'>
 				<!-- INCLUDE BLOCK : www/templates/web/bloques/formato_areas.tpl -->
				</div>
			<!-- END BLOCK : bloque_redondeado_areas --> 
		
			<table class="tabla_simple">
		 	<!-- START BLOCK : bloque_redondeado_personas --> 
		 	<!-- START BLOCK : bloque_redondeado_personas_oculto_iniciod -->
			<!-- INCLUDE BLOCK : www/templates/web/bloques/bloque_inicio.tpl -->
			<!-- END BLOCK : bloque_redondeado_personas_oculto_iniciod --> 
			
			<tr id='listadod_{caso}_id_{fila}' > 
 			<!-- INCLUDE BLOCK : www/templates/web/bloques/listado_personas.tpl -->
			</tr> 
		<!-- END BLOCK : bloque_redondeado_personas --> 
		 
		</table>

		 <!-- START BLOCK : bloque_redondeado_proyectos --> 
		 		<!-- START BLOCK : bloque_redondeado_proyectos_oculto_inicio -->
				<!-- INCLUDE BLOCK : www/templates/web/bloques/bloque_inicio.tpl -->
				<!-- END BLOCK : bloque_redondeado_proyectos_oculto_inicio -->
				<div  id='listado_{caso}_id_{fila}'>
 				<!-- INCLUDE BLOCK : www/templates/web/bloques/formato_proyecto.tpl -->
				</div>
		<!-- END BLOCK : bloque_redondeado_proyectos --> 
		
		 <!-- START BLOCK : bloque_redondeado_publicaciones --> 
		 		<!-- START BLOCK : bloque_redondeado_publicaciones_oculto_inicio -->
				<!-- INCLUDE BLOCK : www/templates/web/bloques/bloque_inicio.tpl -->
				<!-- END BLOCK : bloque_redondeado_publicaciones_oculto_inicio -->
				<div  id='listado_{caso}_id_{fila}'>
 				<!-- INCLUDE BLOCK : www/templates/web/bloques/formato_publicaciones.tpl --> 
				</div>
		<!-- END BLOCK : bloque_redondeado_publicaciones --> 
		

		
		
		<!-- START BLOCK : bloque_redondeado_publicaciones_oculto_cierre -->
		<!-- INCLUDE BLOCK : www/templates/web/bloques/bloque_cierre.tpl -->
		<!-- END BLOCK : bloque_redondeado_publicaciones_oculto_cierre -->
		<!-- START BLOCK : bloque_redondeado_personas_oculto_cierre -->
		<!-- INCLUDE BLOCK : www/templates/web/bloques/bloque_cierre.tpl -->
		<!-- END BLOCK : bloque_redondeado_personas_oculto_cierre -->
		<!-- START BLOCK : bloque_redondeado_proyectos_oculto_cierre -->
		<!-- INCLUDE BLOCK : www/templates/web/bloques/bloque_cierre.tpl -->
		<!-- END BLOCK : bloque_redondeado_proyectos_oculto_cierre -->
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 

