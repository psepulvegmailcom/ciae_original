<!-- TPL MENU -->  
<ul>
    <div id="menu_col"  >  
        <div id="navigation">  
			<ul>  
				<!-- START BLOCK : bloque_menu_principal -->
				 <li id="{destacado_menu}"   onMouseOver="javascript:mostrarSubmenu('{menu_id}');">
				  <a href="?langSite={menu_lang}&page={menu_option}"  id="{destacado_menu_a}" {destacado_menu_a_extra}>  {menu_name}  </a>
					<!-- START BLOCK : bloque_menu_principal_sub -->
					<ul id='hijo_{menu_id_padre}'>  
						<!-- START BLOCK : bloque_menu_principal_sub_item -->
							<li><a href="?langSite={menu_lang}&page={menu_option}"  >   {menu_name} </a></li>
						<!-- END BLOCK : bloque_menu_principal_sub_item --> 
					</ul>
					<!-- END BLOCK : bloque_menu_principal_sub -->
				  </li>
				 <!-- END BLOCK : bloque_menu_principal -->
			 </ul> 
		  </div>         
      </div> 
    </ul>
<!-- TPL MENU -->
