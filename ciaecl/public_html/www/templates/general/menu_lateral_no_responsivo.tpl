 
   
        <div class="col-sm-12">
          <!-- Static navbar -->
          <div class="navbar navbar-ciae" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="navbar-collapse collapse">
			 

              <!-- Left nav -->
              <ul class="nav navbar-nav">
              <!-- START BLOCK : bloque_menu_principal --> 
              <!-- primer nivel menu -->
                <li>                
                        <!-- START BLOCK : bloque_menu_principal_menu -->                
                            <a href="?langSite={menu_lang}&amp;page={menu_option}" >{menu_name}{menu_despliegue}</a>    
                        <!-- END BLOCK : bloque_menu_principal_menu -->
                        
                        <!-- START BLOCK : bloque_menu_principal_menu_simple -->                
                            <a href="#" >{menu_name}{menu_despliegue}</a>    
                        <!-- END BLOCK : bloque_menu_principal_menu_simple -->
                
              	  <!-- START BLOCK : bloque_menu_principal_sub -->  
                   <!-- segundo nivel menu -->            
                  <ul   class="dropdown-menu">
                   <!-- START BLOCK : bloque_menu_principal_sub_item -->
                   <li>
                      
                      	<!-- START BLOCK : bloque_menu_principal_sub_item_menu -->                
                        <a href="?langSite={menu_lang}&amp;page={menu_option}" >{menu_name}{menu_despliegue}</a>    
                        <!-- END BLOCK : bloque_menu_principal_sub_item_menu -->
                        
                        <!-- START BLOCK : bloque_menu_principal_sub_item_menu_simple -->
                         <a href="#" >{menu_name}{menu_despliegue}</a>    
                        <!-- END BLOCK : bloque_menu_principal_sub_item_menu_simple -->
                    
                                        
                     <!-- START BLOCK : bloque_menu_principal_sub_item_sub -->  
                      <!-- tercer nivel menu -->            
                      <ul   class="dropdown-menu">
                        <!-- START BLOCK : bloque_menu_principal_sub_item_sub_item -->
                        <li>
                        
                        
                            <!-- START BLOCK : bloque_menu_principal_sub_item_sub_item_menu -->
                            <a href="?langSite={menu_lang}&amp;page={menu_option}">{menu_name}</a>
                            <!-- END BLOCK : bloque_menu_principal_sub_item_sub_item_menu -->                            
                            <!-- START BLOCK : bloque_menu_principal_sub_item_sub_item_menu_simple -->
                            <a href="#">{menu_name}</a>
                            <!-- END BLOCK : bloque_menu_principal_sub_item_sub_item_menu_simple -->
                        
                        
                        </li> 
                        <!-- END BLOCK : bloque_menu_principal_sub_item_sub_item --> 
                      </ul>
                      <!-- END BLOCK : bloque_menu_principal_sub_item_sub -->
                     </li> 
                    <!-- END BLOCK : bloque_menu_principal_sub_item --> 
                  </ul>
	    		  <!-- END BLOCK : bloque_menu_principal_sub -->
                 </li>
				<!-- END BLOCK : bloque_menu_principal -->                  
              </ul> 
                
              
			<!-- INCLUDE BLOCK : www/templates/general/menu_lateral_redes_sociales.tpl --> 

            </div><!--/.nav-collapse -->
          </div>
        </div> 
  
      