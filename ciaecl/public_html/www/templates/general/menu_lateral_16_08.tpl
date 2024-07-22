     
<nav>	
  		<div class="container demo-2">	
			<!-- Codrops top bar -->
			<!--/ Codrops top bar -->
			
			<div class="main clearfix">
                <div class="column">
		           <div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Menu</button>
						<ul class="dl-menu">
						 <!-- START BLOCK : bloque_menu_principal --> 
						 <!-- primer nivel menu -->
							<li>
                        <!-- START BLOCK : bloque_menu_principal_menu -->                
                             <a href="?langSite={menu_lang}&amp;page={menu_option}">--{menu_name}{menu_despliegue}</a>   
                        <!-- END BLOCK : bloque_menu_principal_menu -->
                        
                        <!-- START BLOCK : bloque_menu_principal_menu_simple -->                
                            <a href="#" >{menu_name}{menu_despliegue}</a>    
                        <!-- END BLOCK : bloque_menu_principal_menu_simple -->
                
              	   <!-- START BLOCK : bloque_menu_principal_sub -->  
                   <!-- segundo nivel menu --> 
								<ul class="dl-submenu">
                   <!-- START BLOCK : bloque_menu_principal_sub_item -->
                   <li>
                      
                      	<!-- START BLOCK : bloque_menu_principal_sub_item_menu -->                
                        <a href="?langSite={menu_lang}&amp;page={menu_option}" >**{menu_name}{menu_despliegue}</a>    
                        <!-- END BLOCK : bloque_menu_principal_sub_item_menu -->
                        
                        <!-- START BLOCK : bloque_menu_principal_sub_item_menu_simple -->                
                         <a href="#" >{menu_name}{menu_despliegue}</a>    
                        <!-- END BLOCK : bloque_menu_principal_sub_item_menu_simple -->
                    
                                        
                     <!-- START BLOCK : bloque_menu_principal_sub_item_sub -->  
                      <!-- tercer nivel menu -->  
										<ul class="dl-submenu">
                        <!-- START BLOCK : bloque_menu_principal_sub_item_sub_item -->
                        <li>
                        
                        
                            <!-- START BLOCK : bloque_menu_principal_sub_item_sub_item_menu -->
                            <a href="?langSite={menu_lang}&amp;page={menu_option}">++{menu_name}</a>
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
						 
					</div><!-- /dl-menuwrapper -->
				</div>
			</div>
	</nav> 
		<script>
			$(function() {
				$( '#dl-menu' ).dlmenu({
					animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
				});
			});
		</script>

  
  
  
   
        
  
      