	
 <!--<script type="text/javascript" src="www/libjs/md5.js?version=1453226691"></script>--> 
	<!-- INICIO HIDDEN INTERNO  -->
	{hidden_page} 
	<!-- INICIO PAGINA INTERNA -->
	
<!-- INCLUDE BLOCK : www/templates/general/cabeceras/site_comun.tpl -->

<table  class="tabla_contenedor" style="width:100%; "   cellspacing="0" border="0" > 
 			 <tr> 
				 <td colspan="2" id='bloque_tabla_menu' style=" text-align: right" > 
				  <!-- INCLUDE BLOCK : www/templates/general/cabeceras/user_info.tpl -->
				 </td>
			 </tr> 
			 <!-- FIN BARRA -->
			 
<div id='bloque_extra_general'></div>
<div id='bloque_extra_general_texto'></div>
			 
			 						
							 
			 
<tr> <td  colspan="2" style="vertical-align: top ">

<table style=" width:100% ;  " border="0">
<tr><td id='bloque_menu_admin_lateral' style="vertical-align:top; padding-top:20px; text-align:left; width:200px">
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl --> 
 {template_menu_contenido} <ul style="padding:10px 10px 10px -30px; margin-left:-20px">  
				<!-- START BLOCK : bloque_menu_principal --> 
				 <li      style=" padding-top: 0px; padding-bottom:0px; padding-right:5px; " >
				 
				   <!-- START BLOCK : bloque_menu_principal_menu -->                
                          <a href="?langSite={menu_lang}&amp;page={menu_option}"  id="{destacado_menu_a}" {destacado_menu_a_extra}>    {menu_name}  </a>    
                        <!-- END BLOCK : bloque_menu_principal_menu -->
				  
					<!-- START BLOCK : bloque_menu_principal_sub -->
					 
					<ul  style="padding:0px 0px 0px -30px" >  
						<!-- START BLOCK : bloque_menu_principal_sub_item -->
							<li style=" padding-top: 0px; padding-bottom:0px; margin-left:-25px; padding-left:-20px">
                            
                           
                             <!-- START BLOCK : bloque_menu_principal_sub_item_menu -->                
                             <a href="?langSite={menu_lang}&amp;page={menu_option}"  {destacado_menu_a_extra}  >   {menu_name} </a>
                        <!-- END BLOCK : bloque_menu_principal_sub_item_menu -->
                            
                            </li>
                            
						<!-- END BLOCK : bloque_menu_principal_sub_item --> 
					</ul>
					<!-- END BLOCK : bloque_menu_principal_sub -->
				  </li>
				 <!-- END BLOCK : bloque_menu_principal -->
				 
				 <!-- START BLOCK : bloque_logout_user -->
				<!--  <li      style=" padding-top: 0px; padding-bottom:0px; " > <a href="?langSite={menu_lang}&amp;page=logout"     >    Cerrar Sesi&oacute;n  </a>	  </li> -->
				  <!-- START BLOCK : bloque_logout_user -->
			 </ul> 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
</td>

<td style="vertical-align:top;"> 
<!-- START BLOCK : bloque_contenido_modulo -->

<div class="contenido_titulo_separador" style=" margin-top:0px;">{titulo_sitio}</div>

<div id="contentido"  style="  margin-left: 20px;  	" >  
				 <p>  {contenido_sitio} </p> 
				</div>
				<!-- END BLOCK : bloque_contenido_modulo -->
<!-- START BLOCK : bloque_login_user -->
 &nbsp;
 <!-- INCLUDE BLOCK : www/templates/admin/login.tpl -->	
<!-- END BLOCK : bloque_login_user -->
</td></tr>
</table>
	<p style="padding: 50px 0px 0px 5px; text-align: right"><small>En caso de cualquier duda o problema con el sistema, favor escr&iacute;bir a <a href="mailto:webmaster@ciae.uchile.cl?subject=[INTRANET] Consultas intranet CIAE">webmaster@ciae.uchile.cl</a></small></p>
</td></tr>		 



	
 </table>
 <!-- INCLUDE BLOCK : www/templates/general/index_comun_footer.tpl -->	
	 
		{footer_page} 