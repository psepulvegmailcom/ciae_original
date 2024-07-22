

	<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->		
		<fieldset id='formulario_admin'> 
   <div class="fieldset_campos">
	  <label>		ID CIAE </label>
	  <br  />
    <input  class="inputtext" type="text" {disabled_form}    name="form_id_libro"  id="form_id_libro"  value="{id_libro}" >
    <script>
		if(trim('{id_libro}') != '')
			{
				document.main.form_id_libro.disabled = true ;
			}
	   </script>
	</div> 
   <div class="fieldset_campos"  >
	  <label>		ID UChile </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_id_uchile"  id="form_id_uchile"  value="{id_uchile}" >
    <script>
		if(trim('{id_uchile}') != '')
			{
				document.main.form_id_uchile.disabled = true ;
			}
	   </script>
	</div>   	
   
     
         
    <div class="label_fieldset">
    <label>		Titulo </label> 
    <textarea  class="textarea_revision" {disabled_form}  type="text"   name="form_titulo"  id="form_titulo"   >{titulo} </textarea> 
    </div>
    <div class="label_fieldset">
    <label>		Autores </label> 
 
    <textarea  class="textarea_revision" {disabled_form}  type="text"   name="form_autores"  id="form_autores"    >{autores} </textarea> 
    </div>
    <div class="label_fieldset">
    <label>		Editorial </label> 
 
    <textarea  class="textarea_revision" {disabled_form}  type="text"   name="form_editorial"  id="form_editorial"    >{editorial} </textarea> 
    </div> 
    <div class="fieldset_campos">
    <label>		A&ntilde;o  </label><br  />
    <select name="form_agno_publicacion"  id="form_agno_publicacion"  {disabled_form}    > 
			<option value="0">---</option>
		 <!-- START BLOCK : bloque_form_agno -->
		 <option value="{agno}" {selected}>&nbsp;&nbsp;&nbsp;&nbsp;{agno}&nbsp;&nbsp;&nbsp;&nbsp;</option>
		 <!-- END BLOCK : bloque_form_agno-->
	</select>
    <script>
		if(trim('{agno_publicacion}') != '')
			{
				selectValue('form_agno_publicacion','{agno_publicacion}');
			}
	   </script>
    </div> 
    <div class="fieldset_campos">
	  <label>		ISBN </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_isbn"  id="form_isbn"  value="{isbn}"  maxlength="150" >
			</div>
    <div class="fieldset_campos">
	  <label>		DOI </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_doi"  id="form_doi"  value="{doi}"  maxlength="100" >
			</div>
			
    <div class="fieldset_campos">
	  <label>		Tipo </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_tipo_libro"  id="form_tipo_libro"  value="{tipo_libro}"  maxlength="255" >
			</div>
			
			      
			
			
    <div class="fieldset_campos">
	  <label>		Centro de costo </label>
	  <br  /> 
    
            <select name="form_centro_costo"  onChange="javascript:replicarDatos();" {disabled_form}   id="form_centro_costo">
         <option value=""></option>
         <!-- START BLOCK : bloque_proyectos_centros_pago -->
         <option value="{id_centro_costo}">{codigo} - {centro_costo} ({nombre} {apellido_paterno})</option>
         <!-- END BLOCK : bloque_proyectos_centros_pago -->          
         </select>
			</div>
			
    <script>
		selectChangeValueText('form_centro_costo','10000','Sin CC definido');
		if(trim('{centro_costo}') != '')
		{
			selectValue('form_centro_costo','{centro_costo}');
		}
		function replicarDatos()
		{
			var centro_costo = document.getElementById('form_centro_costo').value;
			/*var centro_costo = document.getElementById('form_proyecto').value;
			var centro_costo = document.getElementById('form_investigador_acargo').value;*/
			alert(centro_costo);
		}
	   </script>
	   
    <div class="fieldset_campos">
	  <label>		Proyecto </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_proyecto"  id="form_proyecto"  value="{proyecto}"  maxlength="255" >
			</div>
    <div class="fieldset_campos">
	  <label>		Investigador responsable </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_investigador_acargo"  id="form_investigador_acargo"  value="{investigador_acargo}" >
			</div>
			
    <div class="fieldset_campos">
	  <label>		Palabras claves  </label> (incluir tem&aacute;ticas, &aacute;reas, etc. Separar conceptos por comas)
	  <br  />
		<textarea  class="inputtext"  {disabled_form}    name="form_palabra_clave"  id="form_form_palabra_clave"  >{palabra_clave}</textarea>
			</div> 
    <div class="fieldset_campos">
    <label>		N&uacute;mero de copias </label><br  />
    <select name="form_numero_copias" {disabled_form}  id="form_numero_copias"    >
      
		<!-- <option value="1" >&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;</option> 
		 <option value="2" >&nbsp;&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;&nbsp;</option>
		 <option value="3" >&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;&nbsp;</option>
		 <option value="4" >&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;</option>
		 <option value="5" >&nbsp;&nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;&nbsp;</option>
		 <option value="6" >&nbsp;&nbsp;&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;&nbsp;</option>-->
	</select>
   
    <script>
		for(var i=1; i < 2000; i++)
			{
				var x = document.getElementById("form_numero_copias");
				var option = document.createElement("option");
				option.text = i;
				option.value = i;
				x.add(option);
			}
		if(trim('{numero_copias}') != '')
			{
				selectValue('form_numero_copias','{numero_copias}');
			}
	   </script>
    </div> 
			
    <div class="fieldset_campos">
	  <label>		Proveedor </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_proveedor"  id="form_proveedor"  value="{proveedor}"  maxlength="250" >
			</div>
			
    <div class="fieldset_campos">
	  <label>		Costo unitario (sin iva) </label>
	  <br  />
    <input  class="inputtext" type="text" {disabled_form}    name="form_precio_unitario"  id="form_precio_unitario"  value="{precio_unitario}"  maxlength="20" style="width: 150px" onChange="javascript:calculoPrecioIVA()" >
			</div>
    <div class="fieldset_campos">
	  <label>		Valor iva </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_precio_iva"  id="form_precio_iva"  value="{precio_iva}"  maxlength="20" style="width: 150px"  >
			</div>
    <div class="fieldset_campos">
	  <label>		Costo unitario con iva </label>
	  <br  />
    <input  class="inputtext" type="text" {disabled_form}    name="form_precio_total"  id="form_precio_total"  value="{precio_total}"  maxlength="20" style="width: 150px"  >
			</div>
    <div class="fieldset_campos">
	  <label>		Orden de compra </label>
	  <br  />
    <input  class="inputtext" type="text"  {disabled_form}   name="form_orden_compra"  id="form_orden_compra"  value="{orden_compra}"  maxlength="100" >
			</div>
    <div class="fieldset_campos">
	  <label>		N&uacute;mero de factura </label>
	  <br  />
    <input  class="inputtext" type="text"   {disabled_form}  name="form_factura"  id="form_factura"  value="{factura}"  maxlength="10" >
			</div> 
    <div class="fieldset_campos">
	  <label>		Fecha factura </label>
	  <br  />
	  		<input  class="inputtext" type="text" {disabled_form}   name="form_fecha_factura"  id="form_fecha_factura"  value="{fecha_factura_html}" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha_factura,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	  		<script>
				if(document.main.form_fecha_factura.value == '00-00-0000')
					{
						document.main.form_fecha_factura.value = '';
					}
		</script>
				</div> 		 	 	 	 	
			 	 
			 	 	 	 	
    <div class="fieldset_campos">
    <label>		Estado libro </label><br  />
    <select name="form_estado"  id="form_estado"  {disabled_form}   >  
		 <option value="activo" >&nbsp;&nbsp;&nbsp;&nbsp;Activo&nbsp;&nbsp;&nbsp;&nbsp;</option> 
		 <option value="dado_de_baja" >&nbsp;&nbsp;&nbsp;&nbsp;Dado de baja&nbsp;&nbsp;&nbsp;&nbsp;</option>
		 <option value="perdido" >&nbsp;&nbsp;&nbsp;&nbsp;Perdido&nbsp;&nbsp;&nbsp;&nbsp;</option>
		 <option value="prestado" >&nbsp;&nbsp;&nbsp;&nbsp;Prestado&nbsp;&nbsp;&nbsp;&nbsp;</option> 
		 <option value="donado" >&nbsp;&nbsp;&nbsp;&nbsp;Donado&nbsp;&nbsp;&nbsp;&nbsp;</option> 
		 <option value="solicitud_prestamo" >&nbsp;&nbsp;&nbsp;&nbsp;Solicitud de pr&eacute;stamo&nbsp;&nbsp;&nbsp;&nbsp;</option> 
	</select>
    <script>
		if(trim('{estado}') != '')
			{
				selectValue('form_estado','{estado}');
			}
	   </script>
    </div> 
			 	 	 	 		 	 	
			 	 	 	 		 	 		 	 		 	 	
			<div class="label_fieldset">
    <label>		Comentarios </label> 
    <textarea  class="textarea_revision"  type="text"   name="form_comentarios"  id="form_comentarios"   >{comentarios} </textarea> 
    </div>
    
    
		 
	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
	<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button>
	</fieldset>


<input type="hidden" name="id_libro" value="{id_libro}" /> 
<input  class="inputtext" type="hidden" name="id_item" value="{id_libro}" id="id_item" />


<script type="text/javascript">
 
function editElement()
{     
	document.main.form_id_uchile.disabled = false; 
	document.main.form_id_libro.disabled = false;
	if(!validacionCampoTextoSimple('form_titulo') || !validacionCampoTextoSimple('form_autores') || !validacionCampoTextoSimple('form_editorial') || !validacionCampoTextoSimple('form_proyecto') || !validacionCampoTextoSimple('form_investigador_acargo') || !validacionCampoTextoSimple('form_id_libro')  || !validacionCampoTextoSimple('form_tipo_libro'))
	{
		if(trim('{id_libro}') != '')
		{
			document.main.form_id_libro.disabled = true ;
		}	

		if(trim('{id_uchile}') != '')
		{
			document.main.form_id_uchile.disabled = true ;
		}		
		return false;
	} 	
  		 
	process('{opcion_modulo}|guardar',0);	 
}
function calculoPrecioIVA()
{ 
	var str = trim(document.main.form_precio_unitario.value);
	str = str.replace(".", "");
	str = str.replace(".", "");
	str = str.replace(".", "");
	document.main.form_precio_unitario.value = str;
	var sin_iva = parseInt(document.main.form_precio_unitario.value);
	var iva 	= sin_iva * 0.19;
	var iva_fix = iva.toFixed(2);
	var total 	= Number(sin_iva) + Number(iva_fix);
	document.main.form_precio_iva.value = iva_fix;
	document.main.form_precio_total.value = total;
}
</script>
{tag_volver}