	    <div class="container">
      <div class="row">                   
    <!-- Wrapper for slides -->
   <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <div class="slider-home">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->                                
                  <div class="carousel-inner" role="listbox"> 
                  <!--  BLOQUE BANNER -->
                  <!-- START BLOCK : bloque_banner_home -->                               
                     <div class="item {active}">                      
               		 <img src="imageview.php?image=banner/{imagen}" alt="Banner {titulo}" title="{titulo}" />
                      <!--div class="carousel-caption">
                        <h3 > {titulo} </h3> 
                        <p >{bajada}<br><a href="{link}" title="Ver Mas"  >  Ver m&aacute;s</p></a>
                      </div-->
                    </div>
                   <!-- END BLOCK : bloque_banner_home -->       
                 <!--  BLOQUE BANNER -->                                                   <!-- Controls -->           
                  <!--a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a-->
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
               
                </div>

            </div>    
           </div>
            <div class="agenda-home">
            <h4>Noticias</h4>
              <!-- START BLOCK : bloque_home_noticia_general -->
             <!-- START BLOCK : bloque_home_noticia --> 
                <div class="evento row">  
                <div class="col-md-4 col-xs-6">              
                <img src="imageview.php?image=noticias/{imagen}"  height="62px" width="90px">
				</div>
                <div class="col-md-8 col-xs-6 info-agenda-home">    		
     			 <a href="index.php?page=view_noticias&langSite={langSiteEspecial_seleccionado}&amp;id={id_noticia}" >{titulo}</a>     
               </div>
                  </div> 
            <!-- END BLOCK : bloque_home_noticia -->                    
			 <!--a href="index.php?page=view_recursos_nce&langSite={langSiteEspecial_seleccionado}"class="pull-right">VER M&Aacute;S +</a--> 
             <!-- END BLOCK : bloque_home_noticia_general -->            
            </div>
                
                
                 
      </div>     
    </div>
     
 <div class="row">

        <div class="col-sm-8 blog-main">
                 <!-- START BLOCK : bloque_home_version_extra_presentacion --> 
        	 <div class="grey-box-home"> 
        	  <div class="post-new row">
        	 	<div class="col-md-12">
					<h2 class="title-grey-box">Presentaci&oacute;n</h2>                
                	<p>{texto_presentacion}</p>
				</div>
			</div>
		     </div>
		  <!-- END BLOCK : bloque_home_version_extra_presentacion --> 
 
        
        <div class="banner-home">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->                                
                  <div class="carousel-inner" role="listbox"> 
                  
                  <!--  BLOQUE BANNER PIE-->
                  <!-- START BLOCK : bloque_banner_home_pie -->                                 
                    <div class="item {active}">                      
               		 <a href="{link}" target="_blank"><img src="imageview.php?image=banner/{imagen}" alt="Banner {titulo}" title="{titulo}" /></a>
                    </div>
                  <!-- END BLOCK : bloque_banner_home_pie -->                                     
                 <!--  BLOQUE BANNER PIE -->
                                                                                    
                </div>
            </div>
        </div> <!-- /.banner-home -->
        </div><!-- /.blog-main -->


    <div class="col-sm-4 sidebar">
     
          
          <div class="col-sm-4 sidebar">
           
          <!-- START BLOCK : bloque_banner_video_youtube -->  
          
			<!-- INCLUDE BLOCK : www/templates/web/bloque_video_youtube.tpl -->            
          
          <!-- END BLOCK : bloque_banner_video_youtube --> 
          </div>  
         
                                                                
                            


              <!--span class="hora">10:20 - 14:40</span-->              
                                                           
                         
          <!-- class="blue caluga-sidebar">
            <h4>Proyectos</h4>
            <!-- START BLOCK : bloque_home_proyectos -->
            <!--a href="" class="img-proyecto-link"><img src="www/images_new/proyecto_{i_fila}.png" class="img-responsive"></a>
            <a href="index.php?page=view_proyectos&case=ficha&id={id_proyecto}&langSite=es" class="titulo-proyecto"><small>{proyecto}</small></a>
            <!-- END BLOCK : bloque_home_proyectos -->

          <!--/div-->
        <!--div class="col-sm-4 sidebar">
                <div> 
                	</br>  
                      </br>                         
                    	<div> 
                    <!-- START BLOCK : bloque_banner_home_lateral -->                        
               		 <!--a href="{link}" target="_blank"><img src="imageview.php?image=banner/{imagen}" alt="Banner {titulo}" title="{titulo}" /></a-->
                     <!-- END BLOCK : bloque_banner_home_lateral --> 
                    <!--/div>
                    </br>                               
                   </br>                                                               
                </div>            
        </div-->
        </div><!-- /.blog-sidebar -->
        
        <!-- /.blog-sidebar -->

      </div><!-- /.row -->

</div>
</div>