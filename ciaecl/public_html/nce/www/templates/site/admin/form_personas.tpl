		<input type="hidden" name="persona_eliminar_id" > 
	<input type="hidden" name="persona_eliminar_orden" >
	<input type="hidden" name="persona_eliminar_nombre" > 
	<script>
	function eliminarPersona(opcion, id_proyecto,id_persona,orden,nombre)
	{
		document.main.persona_eliminar_id.value = id_persona;
		document.main.persona_eliminar_orden.value = orden;
		document.main.persona_eliminar_nombre.value = nombre;
		enviar_accion_admin(opcion+'|modificar|eliminar_persona',id_proyecto);
	}
	</script>
	
	<div>
		<label>		Personas participantes   </label><br  /><br  />
        En el caso de agregar una persona fuera del sistema debe ingresarlo con el siguiente formato: "Apellidos, Nombre"
		<div>
		 <table style=" width:90% ">
		 <tr>
		 <td class="border_th">Persona</td>
		 <td class="border_th">Cargo</td>
		 <td class="border_th">Orden</td>  
		 <td class="border_th" style="widtd:10px ">Eliminar</td>  
		 </tr>
		 <!-- START BLOCK : bloque_form_persona_extra -->
		  <tr>
		 <td class="border_td">{nombre_publicacion}</td>
		 <td class="border_td">{cargo_proyecto}</td>
		 <td class="border_td">{orden_proyecto}</td> 
		 <td class="border_td"><a href="javascript:eliminarPersona('{opcion_modulo}',{id_proyecto},'{id_persona}',{orden_proyecto},'{nombre_publicacion}');">
		 	 <img src="www/images/iconos/delete.gif" ></a>	</td> 
		 </tr>
		 <!-- END BLOCK : bloque_form_persona_extra -->
		 <!-- START BLOCK : bloque_form_persona_extra_ingreso -->
		  <tr>
		 <td class="border_td"><select name="persona_extra_id[]">
		 <!-- START BLOCK : bloque_form_persona_extra_ingreso_nombre -->
		 <option value="{id_persona}"> {apellido_paterno} {apellido_materno}, {nombre}</option>
		 <!-- END BLOCK : bloque_form_persona_extra_ingreso_nombre -->
		 </select><br>
		 <input type="text" name="persona_extra_nombre[]" maxlengtd="255">
		 </td>
		 <td class="border_td"><input type="text" name="persona_extra_cargo[]" maxlengtd="250"></td>
		 <td class="border_td">
		 	<select  class="inputtext"   name='persona_extra_orden[]'>
		 <!-- START BLOCK : bloque_form_persona_extra_ingreso_orden -->
		 <option value="{orden}" {selected}>{orden}</option>
		  <!-- END BLOCK : bloque_form_persona_extra_ingreso_orden -->
		
		</select></td> 
		 <td class="border_td">&nbsp;</td> 
		 </tr>
		 <!-- END BLOCK : bloque_form_persona_extra_ingreso -->
		 
		 </table>
		 </div>
	</div>
	
