  <tr>
    <td style=" width:30%"><strong>Fecha de nacimiento  (*)  </strong></td>
    <td style="width:70%"> 
		<input type="hidden" name="form_fecha_nacimiento" id="form_fecha_nacimiento" value="{fecha_nacimiento}">
        
         <select name="dia_fn" id="dia_fn"  onChange="javascript:fecha_nacimiento();"> 
          
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_dia.tpl -->
	</select> / <select name="mes_fn"  id="mes_fn" class="cajatxt" onChange="javascript:fecha_nacimiento();">
         

		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_mes.tpl -->
        </select> /  
        <select name="agno_fn" id="agno_fn" onChange="javascript:fecha_nacimiento();"   class="cajatxt">
        
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_agno.tpl -->
        
        
        </select>
        
        
        </td>
  </tr>
  <script>
  function fecha_nacimiento()
  {
	document.main.form_fecha_nacimiento.value = document.main.agno_fn.value+'-'+document.main.mes_fn.value+'-'+document.main.dia_fn.value; 
  }
  
  
  fecha_seleccion('form_fecha_nacimiento','fn');
  </script>