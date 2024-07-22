  
				<td  class="{color_fila}">
				<input type="checkbox"  class="inputcheckbox"   name="ate_oferta_programa[]" value="{bloque_ate_area_programa_id}" {bloque_ate_area_programa_selected}  onclick="javascript:agregarOferta({bloque_ate_area_area_id},{bloque_ate_area_programa_id},'{bloque_ate_area_rut}');"	>
				{bloque_ate_area_programa_nombre}  		
				
				  
				<div class="div_{estado_boton_oferta}"  id='boton_mas_oferta_{bloque_ate_area_programa_id}' style="vertical-align:bottom">
				 <button type="button"  onclick="javascript:agregarOferta({bloque_ate_area_area_id},{bloque_ate_area_programa_id},'{bloque_ate_area_rut}');"><span>Ingresar más  Ofertas</span></button>
				 </div> 
				 
				 </td> 
				<td   class="{color_fila}" align="center">			
					<center>	<input  type="radio"  class="inputcheckbox"   name="ate_oferta_programa_{bloque_ate_area_programa_id}" value="no"  checked="checked"  />	</center>	
					</td>
				<td  class="{color_fila}"   align="center" >	
				<center>	<input  type="radio"  class="inputcheckbox"   name="ate_oferta_programa_{bloque_ate_area_programa_id}" value="si" {bloque_ate_area_programa_selected_radio} onclick="javascript:registro_area_check_fila({bloque_ate_area_programa_id});agregarExperiencia({bloque_ate_area_area_id},{bloque_ate_area_programa_id},'{bloque_ate_area_rut}');" /> </center>	
				 
			 	<div class="div_{estado_boton_experiencia}" id='boton_mas_experiencia_{bloque_ate_area_programa_id}' style="text-align:center;vertical-align:bottom">
				 <button type="button"  onclick="javascript:agregarExperiencia({bloque_ate_area_area_id},{bloque_ate_area_programa_id},'{bloque_ate_area_rut}');">
				 <span><small  ><div style="font-size:9px;">Ingresar más</div></small></span></button>
				   </div> 
		</td> 