<div class="container"> 
      <div class="row"> 
      <div class="col-sm-12 single-new">  
      <div class="grey-box-home">
      

               
<!-- START BLOCK : bloque_recursos_view_recursos_nce -->
<p></p>
</br>
 <h2 class="big-title">Recursos  </h2>
<!-- INCLUDE BLOCK : www/templates/web/lista_item_recurso.tpl --> 
<!-- END BLOCK : bloque_recursos_view_recursos_nce -->

<!-- START BLOCK : bloque_recursos_view_publicaciones --->
<p></p>
 <h2 class="big-title">Publicaciones </h2>
<!-- INCLUDE BLOCK : www/templates/web/lista_item_recurso_pub.tpl -->
<!-- END BLOCK : bloque_recursos_view_publicaciones ---> 




<!-- START BLOCK : bloque_home_recursos_link -->
</br>
 <h2 class="big-title">Links</h2>
<!-- INCLUDE BLOCK : www/templates/web/lista_item_recurso_link.tpl --> 
<!-- END BLOCK : bloque_home_recursos_link -->



<!-- START BLOCK : bloque_recursos_view_academicas -->
</br>
 <h2 class="big-title">Publicaciones  acad&eacute;micas</h2>
<!-- INCLUDE BLOCK : www/templates/web/lista_item_recurso_video.tpl --> 
<!-- END BLOCK : bloque_recursos_view_academicas -->


	<!-- START BLOCK : bloque_elemento_enc -->
       <ul><h2 class="big-title">Preguntas de inter&eacute;s general</h2></ul>
        <!--ul><h2 class="big-title">{encabeza}</h2></ul-->
  	<!-- END BLOCK : bloque_elemento_enc -->  
    
                 
		<!-- START BLOCK : bloque_elemento --> 
            <div class="post-new row" style=" padding-top:2px; padding-bottom:2px; margin-left:30px; margin-right:10px;">
              <!--div class="col-md-3">  
              <img src="imageview.php?image=recursos/{imagen}" class="img-responsive"  style="width:155px; height:100px"  alt='Imagen noticia {imagen}' />          
              </div-->                           
                <ul><li><a href="index.php?page={pagina_actual}&langSite={langSiteEspecial_seleccionado}&amp;id={id_recurso}">  {titulo}  </a><small style="color:#8E8E8E; text-transform:lowercase">[{tipo}]</small> </li></ul>           
             </div> 
                                               
		<!-- END BLOCK : bloque_elemento --> 
        
        
        	<!-- START BLOCK : bloque_elemento_link -->                                  
                <ul><li><a href="http://{link}" target="new">{link} </a>  <p>{texto}</p> </li></ul>
			<!-- END BLOCK : bloque_elemento_link -->     
                
                
        	<!-- START BLOCK : bloque_no_elemento --> 
 			 {langSite_general_no_hay_elementos}
			<!-- END BLOCK : bloque_no_elemento --> 
        
        
        <!-- START BLOCK : bloque_elemento_paginacion -->
         <div class="post-new row">
        	<div class="col-md-3">         
        {enlacePie}	        
        	</div>
        </div>
        <!-- END BLOCK : bloque_elemento_paginacion -->
        
        
        </div>
        </div>
        <!-- INCLUDE BLOCK : www/templates/web/recursos_busqueda_lateral_01.tpl -->
 	</div>
 </div>   
 		<!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->    