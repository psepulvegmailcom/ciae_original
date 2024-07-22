<div class="container">
      
 <div class="row">

     <div class="col-sm-8 single-new">
		  <div class="blue box-style box-buscador">
            <div class="row">
              <div class="col-md-12">
                <h2>Noticias</h2>
                BUSCAR NOTICIAS
              </div>
              <div class="col-sm-4">
                <div class="input-group">
                 
					<input type="text" class="form-control margin-form" name="busca_palabra" id="busca_palabra" placeholder="Buscar por Palabra" >
                  
                </div>
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form" name="busca_tipo" id="busca_tipo" placeholder="Tipo de Noticia">
                  <option value=0 >Tipo de Noticia</option>
                  <option value="noticia" >Noticia</option>
                  <option value="evento" >Eventos</option>
                  <option value="medios" >En los Medios</option>                 
                </select>
              </div>
              <div class="col-sm-2">
                <select class="form-control margin-form" name="busca_mes" id="busca_mes" placeholder="Mes">
                   <option value=00 >Mes</option>
                  <option value=01 >Enero</option>
                  <option value=02 >Febrero</option>
                  <option value=03 >Marzo</option>
                  <option value=04 >Abril</option>
                  <option value=05 >Mayo</option>
                  <option value=06 >Junio</option>
                  <option value=07 >Julio</option>
                  <option value=08 >Agosto</option>
                  <option value=09 >Septiembre</option>
                  <option value=10 >Octubre</option>
                  <option value=11 >Noviembre</option>
                  <option value=12 >Diciembre</option>          
                </select>
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control margin-form" name="busca_Anno" id="busca_Anno" placeholder="A&ntilde;o">
                <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="2">
              </div>
              <div class="col-sm-4">

              </div>
              <div class="col-sm-4">

              </div>
              <div class="col-sm-4">
                <a class="btn btn-primary btn-block" href="#" role="button" onClick="javascript:buscadorFormularioNoticias();"><i class="fa fa-search"></i> Buscar</a>
                                <a class="" href="#" onClick="javascript:resetFormulario();"><i class="fa fa-search"></i>
                <small>limpiar busqueda</small></a>
              </div>
            </div>
          </div>
          <div class="grey-box-home">           
        <!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->
		<!-- START BLOCK : bloque_elemento --> 
       		<div class="post-new row">
        	<div class="col-md-12">
            <ul>
 			 <li><small> <!--{fecha_html_full}--></small> <a href="index.php?page=view_noticias&id={id_noticia}&langSite={langSiteEspecial_seleccionado}">{titulo}</a>  </li>
            </ul>
        	</div> 
         	</div>      
		<!-- END BLOCK : bloque_elemento -->
        <!-- START BLOCK : bloque_elemento_prensa --> 
       		<div class="post-new row">
        	<div class="col-md-12">
            <ul>
 			 <li>
             <a href="{url}" target="_blank">{titulo}</a>&nbsp;<a href="{url}" target="_blank"   id="link_blank"><img src="www/images/iconos/32x32/Target_blank.png" class="open_target_blank"></a><p /> {bajada} <p />{medio}, <small>{fecha_html_full}</small><br>
             
             </li>
            </ul>
        	</div> 
         	</div>      
		<!-- END BLOCK : bloque_elemento_prensa -->  
		<!-- START BLOCK : bloque_no_elemento --> 
 			<center> {langSite_general_no_hay_elementos}</center>
		<!-- END BLOCK : bloque_no_elemento --> 
        
        <!-- START BLOCK : bloque_elemento_paginacion -->
        {enlacePie}	
        <!-- END BLOCK : bloque_elemento_paginacion -->
          
          <!-- START BLOCK : bloque_home_noticia_general -->                             
            <!-- START BLOCK : bloque_home_noticia -->            
            <div class="post-new row">
              <div class="col-md-3">  
              <img src="imageview.php?image=noticias/{imagen}" class="img-responsive"  style="width:155px; height:100px"  alt='Imagen noticia {imagen}' />          
              </div>
              <div class="col-md-8">
                <span class="titulo-noticia-home"><a href="index.php?page=view_noticias&langSite={langSiteEspecial_seleccionado}&amp;id={id_noticia}">{titulo}</a> </span>
                <p>{bajada}</p>
              </div>
              <div class="col-md-1">
                <a href="index.php?page=view_noticias&langSite={langSiteEspecial_seleccionado}&amp;id={id_noticia}"class="link-square pull-right">+</a>
              </div>
            </div><!-- /.post-new -->
            <!-- END BLOCK : bloque_home_noticia -->            
          		<!-- /.blog-post -->
			<!-- END BLOCK : bloque_home_noticia_general -->

            <!-- START BLOCK : bloque_home_prensa_der --> 
             <h3>Observatorio Formaci&oacute;n Docente en los Medios de comunicaci&oacute;n</h3>                        
			<!-- START BLOCK : bloque_home_prensa_der_detalle -->
           
            <div class="post-new row">	
            	<div class="col-md-12">			  
			<!-- INCLUDE BLOCK : www/templates/general/version_home_prensa.tpl --> 
            	</div>
            </div>
           <div  class="link_mas_noticias"><a href="index.php?page=view_prensa">Ver m&aacute;s noticias</a></d>					             <!-- END BLOCK : bloque_home_prensa_der_detalle -->
			<!-- END BLOCK : bloque_home_prensa_der -->
            <!-- /.grey-box-list -->

        <!-- /.blog-main -->

        <!-- /.blog-sidebar -->
         <!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->

      </div>
     </div>
     <!-- INCLUDE BLOCK : www/templates/web/noticias_menu_lateral.tpl --> 
        
      
   
   </div>
</div>   
    <script>
 
  function resetFormulario()
 { 
	document.getElementById("main").reset();		 
 }
 
 </script>