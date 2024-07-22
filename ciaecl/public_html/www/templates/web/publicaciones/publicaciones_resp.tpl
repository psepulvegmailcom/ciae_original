
<div class="container"> 

      <div class="row">

        <div class="col-sm-8 single-new">
 <!-- START BLOCK : bloque_buscador -->
          <div class="blue box-style box-buscador">
            <div class="row">
              <div class="col-md-12">
                <h2>{lang_publicaciones_menu_titulo}</h2>
               <font style="text-transform:uppercase">{lang_buscador_buscar} {lang_publicaciones_menu_titulo}</font>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" name="busca_Autor" id="busca_Autor" placeholder="{lang_buscador_autor}">
              </div>
                <div class="col-sm-4">
                <select class="form-control margin-form" name="busca_Anno" id="busca_Anno" >
                   <option value="0">{lang_publicaciones_agno}</option>
                   <!-- START BLOCK : bloque_publicaciones_filtro_agno -->        
                   <option value="{agno}">{agno}</option>
                  <!-- END BLOCK : bloque_publicaciones_filtro_agno -->
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form" name="busca_Area" id="busca_Area" placeholder="{lang_proyectos_area}">
                  <option value="0">{lang_proyectos_area}</option>
                  
                   <!-- START BLOCK : bloque_publicaciones_filtro_area --> 
                  <option value="{id_area}" >{area_show}</option>                  
                   <!-- END BLOCK : bloque_publicaciones_filtro_area --> 
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control margin-form" name="busca_tipoDocumento" id="busca_tipoDocumento"  placeholder="{lang_publicaciones_tipo}" >
                  <option value="0">{lang_publicaciones_tipo}</option>
                  
                   <!-- START BLOCK : bloque_publicaciones_filtro_tipo --> 
                  <option value="{id_tipo}">{tipo}</option>                  
                   <!-- END BLOCK : bloque_publicaciones_filtro_tipo -->
                                
                </select>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control margin-form" name="busca_palabra" id="busca_palabra" placeholder="{lang_buscador_palabra_clave}">
                 <input type="hidden" class="form-control margin-form" name="busqueda_flag" id="busqueda_flag" value="1">
              </div>
             
              <div class="col-sm-4">
                <a class="btn btn-primary btn-block" href="#" role="button" onClick="javascript:buscadorFormulario();"><i class="fa fa-search"></i>{lang_buscador_buscar}
                </a>
              </div>
               <div class="col-sm-4">
                <a class="" href="#" onClick="javascript:resetFormulario();"><i class="fa fa-search"></i>
                <small>limpiar busqueda</small></a>
              </div>
            </div>
          </div>
<!-- END BLOCK : bloque_buscador -->
          <input type="hidden" value="view_publicaciones"  name="opcion" /> 
<input type="hidden" name="page" value="">  
<input type="hidden" name="buscar" value="buscar">
<input type="hidden" name="buscador_pagina" value="{buscador_pagina}">

<!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpls -->
<div class="grey-box-home">
            <h2 class="big-title">Publicaciones </h2>
            <div class="grey-box-list"  style="padding: 0 10px 0 20px">
            <!-- START BLOCK : bloque_texto_elemento -->
            <p>{texto}</p>
            <!-- END BLOCK : bloque_texto_elemento -->
            <!-- START BLOCK : bloque_texto_documentos -->
            <p>{texto_presentacion}</p>
            <!-- END BLOCK : bloque_texto_documentos -->

              <ul>
                    <!-- START BLOCK : bloque_elemento --> 
                         <li>  {autores} ({agno}) <i><a href="https://doi.org/{doi}" target="_blank">{titulo}."</a></i> {texto}.  
                        <!-- INCLUDE BLOCK : www/templates/web/publicaciones/publicaciones_links_externos.tpl --> 				         </li>
                    <!-- END BLOCK : bloque_elemento --> 
                            
                            
                            
                            <!-- START BLOCK : bloque_elemento_documentos --> 
                                 <li>
   <!-- INCLUDE BLOCK : www/templates/web/publicaciones/publicaciones_doc_trabajo_formato.tpl --> 
                                 </li>
                            <!-- END BLOCK : bloque_elemento_documentos --> 		

                            
                            
                            <!-- START BLOCK : bloque_elemento_documentos_biblioteca --> 
                                 <li>
        <!-- INCLUDE BLOCK : www/templates/web/publicaciones/publicaciones_biblioteca_formato.tpl -->
                             <!-- START BLOCK : bloque_elemento_documentos_bloque_elemento_ver_detalle --> 
              <!-- INCLUDE BLOCK : www/templates/web/publicaciones/publicaciones_link_detalle.tpl -->
                             <!-- END BLOCK : bloque_elemento_documentos_bloque_elemento_ver_detalle -->
                                 </li>
                            <!-- END BLOCK : bloque_elemento_documentos_biblioteca --> 
                           
                            <!-- START BLOCK : bloque_elemento_paginacion -->
                            
                           <br>
                           <br>
                            {enlacePie}	
                            <!-- END BLOCK : bloque_elemento_paginacion -->
                            
                    </ul>
         
                    
             <!-- START BLOCK : bloque_publicaciones_detalle_no_existe --> 
				<center>{langSite_general_404_no_found}</center>
             <!-- END BLOCK : bloque_publicaciones_detalle_no_existe -->
             
    	 <!-- START BLOCK : bloque_publicaciones_detalle --> 
                   
            <input type="hidden" name="busca_Autor" id="busca_Autor" value="">
            <input type="hidden" name="busca_Anno" id="busca_Anno" value="">
            <input type="hidden" name="busca_Area" id="busca_Area" value="">
            <input type="hidden" name="busca_tipoDocumento" id="busca_tipoDocumento" value="">
            <input type="hidden" name="busca_palabra" id="busca_palabra" value="">   
                    
   			<!-- INCLUDE BLOCK : www/templates/web/publicaciones/publicaciones_doc_trabajo.tpl --> 
              <!-- START BLOCK : bloque_palabra_clave_general -->
            <strong>Palabras Clave:</strong>
            <!-- START BLOCK : bloque_palabra_clave -->
              <a href="index.php?langSite=es&page={page}&busqueda_flag={busca_flag}&busca_palabra={palabra}" >{palabra}</a> &nbsp;
              <!-- END BLOCK : bloque_palabra_clave -->
          
       <!-- END BLOCK : bloque_palabra_clave_general -->   
        
                               
       <!-- END BLOCK : bloque_publicaciones_detalle -->        
                    
            </div><!-- /.grey-box-list -->
             
          </div><!-- /.grey-box-home -->
          


   </div><!-- /.blog-main -->

        <!-- /.blog-sidebar -->

     
      <!-- INCLUDE BLOCK : www/templates/web/publicaciones/publicaciones_busqueda_lateral.tpl -->
   </div>

  </div>
  
 <!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->
 <script>
 function limpiezaFormularioPublicaciones()
 {	 
	document.main.pagina.value = ""; 
	document.main.busca_rangoNombre.value = '';
	document.main.busca_Autor.value = ''; 
	selectValue('busca_Area','0');
	selectValue('busca_Anno','0');
	selectValue('busca_tipoDocumento','0'); 
	document.main.busca_palabra.value = ''; 
 }
 
 function buscadorPubTipo(tipo)
 { 
	limpiezaFormularioPublicaciones();
	document.main.tipo_formulario.value = 'formulario'; 
	document.main.busca_tipoDocumento.value = tipo; 
	enviarFormulario();
		 
 }
 
  function resetFormulario()
 { 
	document.getElementById("main").reset();		 
 }
 
 function cambiar_color_over(celda){ 
   celda.style.backgroundColor="#66ff33" 
} 
 </script>