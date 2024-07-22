 	 <div  id='detalle_persona'>
        
        <!-- START BLOCK : bloque_datos_enviadas_boleta -->
        <fieldset id='formulario_admin_honorarios' style="height: 500px; overflow: auto"> 
        
        <legend>Boletas enviadas </legend>
        <!-- START BLOCK : bloque_datos_enviadas_boleta_detalle -->
        Para: {nombre} {apellido_paterno}  {email} <br>
        {salida_correo}
        <hr><br>
        <!-- END BLOCK : bloque_datos_enviadas_boleta_detalle -->
        </fieldset>
        <!-- END BLOCK : bloque_datos_enviadas_boleta -->
			
       
        <fieldset id='formulario_admin_honorarios2' style="height: 500px; overflow: auto">
        <legend>Enviar boletas </legend>
        
        <table id="tabla_noborder_admin" cellspacing="0" cellpadding="0">
          
          <tr>
            <th  >Tipo correo</th>
            <th >Rut</th>
            <th  >Nombre</th> 
            <th  >Convenio</th>  
            <th >Decreto</th> 
            <th  >Monto</th>
            <th  >Mes/A&ntilde;o pago</th> 
            <th  >Proyecto</th> 
            <th  >Investigador<br>Responsable</th> 
            <th  >Investigador<br>Supervisor</th> 
            <th  >Enviar boleta</th>
          </tr>
          <!-- START BLOCK : bloque_datos_boleta -->
          <tr>
			<td>Correo inicial</td>
			<td align="right">{rut_html}-{rut_dv}</td> 
			<td align="right">{nombre} {apellido_paterno}</td>
			<td align="right">{numero_convenio}</td> 
			<td align="right">{numero_decreto}</td>
            <td>$&nbsp;{monto_comprometido_html}</td> 
            <td>-</td>  
            <td>{proyecto_corto}</td>
            <td>{investigador_responsable}</td>
            <td>{investigador_supervisor}</td>
            <td style="text-align: center"><input type="checkbox" name="enviar_boletas[]"  value="{id_honorario}" ><input type="hidden" name="caso_boleta[{id_honorario}]" value="global"></td>
          </tr>
          <!-- END BLOCK : bloque_datos_boleta -->
          <!-- START BLOCK : bloque_datos_boleta_mensual -->
          <tr>
			<td>Mensual</td>
			<td align="right">{rut_html}-{rut_dv}</td> 
			<td align="right">{nombre} {apellido_paterno}</td>
			<td align="right">{numero_convenio}</td> 
			<td align="right">{numero_decreto}</td>
            <td>$&nbsp;{monto_cuota_html}</td> 
            <td>{numero_mes}/{numero_agno}</td>  
            <td>{proyecto_corto}</td>
            <td>{investigador_responsable}</td>
            <td>{investigador_supervisor}</td>
            <td style="text-align: center">
            <input type="checkbox" name="enviar_boletas[]"  value="{id_honorario}-{numero_cuota}" ><input type="hidden" name="caso_boleta[{id_honorario}-{numero_cuota}]" value="mensual"></td>
          </tr>
          <!-- END BLOCK : bloque_datos_boleta_mensual -->
          
        </table>
        </fieldset> 
<button onclick="javascript:enviar_accion_admin('{opcion_modulo}|envio_boletas','');" type="button"  ><span id='texto_boton_nuevo'>Enviar boletas</span></button>  
	 </div>
