
 <div style="padding-left:20px; padding-right:20px">
	{tag_volver}
<div class="fieldset_title">Solicitud de cometido funcionario/comisi&oacute;n de servicio </div>
	
{mensaje_guardar}
		<fieldset id='formulario_admin'> 
        

        
        	<div class="fieldset_campos">
		<table style="width:99%">
        
        <tr>
        <td style="text-align:left"><strong>Pertenece Universidad de Chile</strong></td>
        </tr>
        <tr>
        <td>  Honorarios CIAE</td>
          </tr>
         
        
         
        </table>
	</div>
	<div class="fieldset_campos">
		<label>		Fecha </label> 
		  22-04-2016 10:25:30 
	</div> 
     
    
	  <div class="fieldset_campos">
		<label>		Email </label> Roberto.araya.schulz@gmail.com 
		 
	</div>
	  <div class="fieldset_campos">
		<label>		Nombre  </label> Roberto Araya 
	</div>
	 
    
	  <div class="fieldset_campos">
		<label>		Rut   </label> 10.256.358-2
		 <img src="www/images/iconos/edit.gif" >
	</div>
	   
	  <div class="fieldset_campos">
		<label>		Pasaporte  </label> SDF44545
		<img src="www/images/iconos/edit.gif" >
	</div>
	  
    
    
	  <div class="fieldset_campos">
		<label>		Cargo </label> 
		Investigador Asociado
	</div>
    
    
	  <div class="fieldset_campos">
		<label>		CV </label> 
		<img src="www/images/iconos/edit.gif" >
	</div>
    
    
	  <div class="fieldset_campos">
		<label>	 Observaci&oacute;n (por ejemplo: financiamiento compartido, tramos, etc) </label> 
		 Financia proyecto Basal
	</div>
    </fieldset>
    <fieldset id='formulario_admin_1'> 
    <div class="fieldset_campos"> <label>Datos de tramo 1</label></div>
    
	  <div class="fieldset_campos">
		<label>		Objetivo </label> 
		<br>Seminario 2016 
	</div>
	  <div class="fieldset_campos">
		<label>		Fecha Inicio </label> 
		<br>25-05-2016
	</div>
    
	  <div class="fieldset_campos">
		<label>		Fecha T&eacute;rmino</label> 
		<br>02-06-2016
	</div>
    
	  <div class="fieldset_campos">
		<label>		Origen </label> 
		<br>Santiago, Chile
	</div>
	  <div class="fieldset_campos">
		<label>		Destino </label> 
		<br>Montreal, Canada
	</div>
    
    
    
	  <div class="fieldset_campos">
		<label>		Solicita Vi&aacute;tico? (indicar qui&eacute;n paga?) </label> 
		<div> Si, paga CIAE</div>
       
	</div> 
    
	  <div class="fieldset_campos">
		<label>		Solicita Pago de Pasajes? </label> 
		<div> Si, paga CIAE</div>
	</div> 
    	  <div class="fieldset_campos">
		<label>	 Solicita reembolso de pago de inscripci&oacute;n a seminario?</label> 
		<BR>No
	</div> 
    <div class="fieldset_campos">
		<label>		Carta de invitaci&oacute;n </label> 
		 <img src="www/images/iconos/edit.gif" >
	</div>
    
    
    
        	  <div class="fieldset_campos">
		<label>		Motivo de viaje</label>  Participaci&oacute;n en evento 
    </div>
        	  <div class="fieldset_campos">
		<label>		Tipo de actividad</label>   Congreso Internacional 
        </div>
        	  <div class="fieldset_campos">
		<label>		P&uacute;blico Objetivo</label>  Investigadores 
	</div>
    
    <div class="fieldset_campos">
		<label>		Ingresar Cotizaci&oacute;n de pasajes </label> 
		<input  class="inputtext"  type="file"  name="archivo_pasaporte"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
    
    </fieldset>
    
    
     
    
    
    </fieldset>
    
    
    
    
    
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	


 



<input type="hidden" name="form_time_ingreso" value="{fecha_ingreso}" />
<input type="hidden" name="form_usuario" value="{usuario}" />

<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">
 
function editElement()
{     
	if(isEmpty(document.getElementById('form_titulo').value) || isEmpty(document.getElementById('form_noticia').value) || isEmpty(document.getElementById('form_fecha').value) || isEmpty(document.getElementById('form_autor').value))
	{
		alert('Debe los campos basicos del formulario (titulo, noticia, fecha y autor)'); 
		return false;
	}    
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}
</div>