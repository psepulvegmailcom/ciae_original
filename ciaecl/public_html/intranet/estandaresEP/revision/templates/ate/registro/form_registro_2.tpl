 

<div class="fieldset_title">&iquest;Est&aacute; Usted Inscrito en otro registro?</div>
	 
<fieldset>
	<div> Se&ntilde;ale si la organizaci&oacute;n est&aacute; inscrita en uno de los registros que propone la lista. Si est&aacute; inscrito en un registro que no aparece, marque opci&oacute;n &ldquo;otro&rdquo; y escriba el nombre de &eacute;l</div>
	<div>		 
		<label></label> 
		<input type="radio"  class="inputcheckbox" name="ate_legal_otro_registro" value="si" {checked_si}/>Si  &nbsp;&nbsp;&nbsp;
		<input type="radio"  class="inputcheckbox" name="ate_legal_otro_registro" value="no" onclick="otroRegistroNo();" {checked_no} />No
		<span>(*)</span>
	</div>
	<div>
	
		<label>&iquest;Cu&aacute;l?</label><span>{ayuda_seleccion_registro}</span><br  />  
		<img src="images/Info.ico" border='0'   />	Para seleccionar m&aacute;s de un registro mantenga presionada la tecla CTRL + click en el elemento a seleccionar. Para deseleccionar un registro mantenga presionada la tecla CTRL + click en el elemento a deseleccionar <br />
			<select  name="ate_legal_otro_registros[]"  multiple="multiple" size="6" style="height:auto"  onchange="javascript:chequeo2otroregistro();" >
			 
			<!-- START BLOCK : bloque_ate_legal_otro -->
			<option value="{ate_legal_otro_id}" {ate_legal_otro_selected}  >{ate_legal_otro_registro}</option>
			<!-- END BLOCK : bloque_ate_legal_otro -->
			<option value="otro" {ate_legal_otro_registro_selected} >OTRO REGISTRO</option>
			</select>
		<span>(*)</span> 
		<br />
		<label>Otro</label><br  />

		<input name="ate_legal_otro_registros_otro" value="{otro_registros_otro}"  maxlength="70" disabled="disabled"/>
		<script>
			<!-- START BLOCK : bloque_ate_legal_otro_nodisable -->
			otroRegistroSi();
			document.main.ate_legal_otro_registros_otro.disabled 	= false;
			var aux = searchElement('ate_legal_otro_registros[]');
			aux.options[{numero_selected}].selected= true;
			<!-- END BLOCK : bloque_ate_legal_otro_nodisable -->
			
			function chequeo2otroregistro()
			{
				var name = 'ate_legal_otro_registros[]'; 
					
				var x = searchElement(name);
				   
				for (var i=0 ; i < x.length ; i++)
				{			    
					if(x[i].selected )
					{
						otroRegistroSi();
						if(x[i].value == 'otro')						
						{
							otroRegistro();
						} 
					} 
				}  
			}
			
			function otroRegistro(){
				document.main.ate_legal_otro_registros_otro.disabled 	= false;
				document.main.ate_legal_otro_registros_otro.focus();
				otroRegistroSi();
			}
			function otroRegistroSi(){
				document.main.ate_legal_otro_registro[0].checked 		= true;
			}
			function desabilitarOtro(){
				document.main.ate_legal_otro_registros_otro.value 		= '';
				document.main.ate_legal_otro_registros_otro.disabled 	= true;			
			} 
			function otroRegistroNo(){
				desabilitarOtro(); 
				unselectInputAll('ate_legal_otro_registros');
				 
				document.main.ate_legal_otro_registro[1].checked 		= true;
				
			}
		</script>
	</div>
</fieldset>

<div class="fieldset_title">Documentos Legales</div>
	  
{tpl_ayuda_file} 

{tpl_documentos_tipo_oferente}
 
 

<script>	
function chequeoTipoDatos(action,level)
{
	if(document.main.caso_revision.value == 'registro')
		desbloquearFormularioDevuelto();
	chequeoTipoDatosCompleto(action,level);
	if(document.main.caso_revision.value == 'registro')
		bloquearFormularioDevuelto();			
}
function chequeoTipoDatosCompleto(action,level)
{
	var chequeo = true; 
	/*for (i=0;i<document.main.ate_legal_otro_registro.length;i++) {
		if (document.main.ate_legal_otro_registro[i].checked) {
			valor = document.main.ate_legal_otro_registro[i].value;
			break;
		}
	}
	var arreglo = searchElement('ate_legal_otro_registros[]');
	var arreglo_sel = false;
	for(i=0; i < arreglo.length; i++)
	{		
		if(valor == 'no')
			arreglo[i].selected = false;
		else
		{
			if(valor == 'si' && arreglo[i].selected == true)
				arreglo_sel = true;
		}	
	}
	if(!arreglo_sel && valor == 'si' && document.main.ate_legal_otro_registros_otro.value == '')
	{
			showAlert('Debe seleccionar al menos un registro o ingresar un nuevo registro');
			arreglo.focus();
			chequeo = false;
	} 	*/
	
	
	 /*   REVISION DE OTRO REGISTRO */ 
	var envioRegistro 	= false; 	 
	var x 				= document.main.elements;	 
	if(document.main.ate_legal_otro_registro[0].checked)
	{
		for (var i=0 ; i < x.length ; i++)
		{	 
			if(x[i].name == 'ate_legal_otro_registros[]' )
			{
				for(var j=0; j < x[i].length ; j++)
				{ 									
					if(x[i][j].selected)
					{
						envioRegistro = true;
						if(x[i][j].value == 'otro' && isEmpty(document.main.ate_legal_otro_registros_otro.value))
						{											
							 envioRegistro = false;
						}							 
					} 
				} 
			} 			 			 									
		 }	 
	}
	else
		envioRegistro = true;
	
	 if(!envioRegistro)
	 {	 	
		showAlert('Debe seleccionar al menos un registro o ingresar un nuevo registro'); 
		document.main.ate_legal_otro_registros_otro.focus();
		chequeo = false; 
	 }	
	
	
	

	if(chequeo)
	{
		process(action,level);
	}
}
</script>