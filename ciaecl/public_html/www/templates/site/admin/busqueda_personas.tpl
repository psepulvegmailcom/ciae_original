 
  <div  id='detalle_persona'>
  
 <fieldset id='formulario_admin'> 
         
        <legend>Buscar persona  </legend>
     <!-- START BLOCK : bloque_autocomplete_email_personas_script -->
      <script>
  $( function() {
    var availableTags = [
		<!-- START BLOCK : bloque_autocomplete_email_personas -->
		{key: "{id_persona}", email: "{email}",value:html_entity_decode(trim("{nombre} {apellido_paterno} {apellido_materno}"))+", {email} "+reemplazaComaPunto("{rut_html}{rut_dv}")},
		<!-- END BLOCK : bloque_autocomplete_email_personas -->
        ""
    ];
    $( "#form_email_busqueda" ).autocomplete({
      source: availableTags,
      focus: function( event, ui ) {
        $( "#form_email_busqueda" ).val( ui.item.value );
        return false;
      },
      select: function( event, ui ) {
        $( "#form_email_busqueda" ).val( ui.item.value );
        $( "#form_email" ).val( ui.item.email );
        $( "#form_id_persona" ).val( ui.item.key ); 
        return false;
      }
		  
    });
  } );
  </script>
    <!-- END BLOCK : bloque_autocomplete_email_personas_script --> 
    <input  type="hidden" name="form_id_persona" id='form_id_persona'>
    <input type="hidden" name="form_email" id='form_email'>
	  <div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		 </label> 
		<input  class="inputtext" type="text"  autocomplete="off" name="form_email_busqueda"  {disable_input}    id="form_email_busqueda"  value="{email}" maxlength="255"     >
		<br>
		  <span>Si la persona a quien desea buscar no aparece en la b&uacute;squeda, ingrese <a onClick="javascript:consultarEmail();" >AQU&Iacute;</a>
	</div>
  <div class="fieldset_campos">
  <center> <button onclick="javascript:consultarEmail();" type="button"> <span>Buscar</span> </button> </center>   
	
	 </div>
	  </fieldset></div>
	  
<script>
	function consultarEmail()
	{
		process('{opcion_modulo}|consultar_email',0);
	}
	function reemplazaComaPunto(texto)
	{
		var aux = texto.replace(",",".");
		return aux.replace(",",".");
	}
</script>