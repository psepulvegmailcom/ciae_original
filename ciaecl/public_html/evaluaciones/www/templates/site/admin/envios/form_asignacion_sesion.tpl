<tr>
    <td   style="text-align:center" colspan="2"><strong>Asignación de Sesión de Trabajo</strong>  </td>
  </tr> 
   <tr>
    <td   style="text-align:left" colspan="2">Recuerde que los cupos por sesión son limitados. Si desea reemplazar/eliminar algún trabajo deberá indicar cual desea eliminar</td>
  </tr> 
  <!-- START BLOCK : bloque_formulario_coordinadores_sesion --> 
   <tr>
    <td   style="text-align:left" colspan="2"><input  type="radio" name="sesion" value="{id_sesion}" disabled="disabled" /><strong> Sesión {orden_sesion} :</strong> {tipo_sesion} (Cupos disponibles: {cupo} | Cupos utilizados: {total_inscritos})<br />
	<ul style="padding-left:70px; ">
	<!-- START BLOCK : bloque_formulario_coordinadores_sesion_trabajo -->
	<li style="padding-top:6px"> <strong>ID {id_envio}: {titulo}</strong>, {nombre} {apellidos}<br /> <small>
	(¿Desea quitar este trabajo de esta sesión? 
	No <input disabled="disabled"  type="radio" value="no" name="eliminar[{id_sesion}][{id_envio}]"  checked="checked"  />  
	Si <input disabled="disabled"  type="radio" value="si" name="eliminar[{id_sesion}][{id_envio}]"     />)</small></li>  
	<!-- END BLOCK : bloque_formulario_coordinadores_sesion_trabajo -->
	</ul>
	
	</td>
	
  </tr> 
  <!-- END BLOCK : bloque_formulario_coordinadores_sesion -->