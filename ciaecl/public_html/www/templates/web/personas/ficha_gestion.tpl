<div class="container">
<div class="row">

        <div class="col-sm-8 single-new">
          <div class="grey-box-home">
            <h2 class="big-title">{nombre} {apellido_paterno} {apellido_materno}</h2>
            <div class="post-new row item-row">
              <div class="col-md-4">
                <img src="imageview.php?image=personas/{imagen}" style="width:150px;" title=" {nombre} {apellido_paterno}  {apellido_materno}" class="img-responsive">
                <h2 class="title-grey-box">contacto</h2>
                <a href="{url_html}" target="_blank">{url}</a>
                {email} 
               
              </div>
              <div class="col-md-8">
              <!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->
                <h4>{titulo} </h4><p>{grado}</p>
               <h4>Cargo </h4><p>{cargo}</p>
               
                <p>{perfil}</p> 
               
				<!-- INCLUDE BLOCK : www/templates/web/bloques/orden_bloque.tpl -->
                <br>                
              </div>
            </div><!-- /.post-new -->
          </div><!-- /.grey-box-home -->
        </div><!-- /.blog-main -->
		<div class="col-sm-4 sidebar">
          <!-- INCLUDE BLOCK : www/templates/web/personas/lista_tipo_persona_menu.tpl -->                  
        </div>
        <!-- /.blog-sidebar -->

      </div>
</div>