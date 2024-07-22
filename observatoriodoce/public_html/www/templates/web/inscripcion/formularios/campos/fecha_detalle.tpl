  <tr>
    <td style=" width:30%"><strong>Fecha {nombre_titulo_formulario}  (*)  </strong></td>
    <td style="width:70%"> 
		<input type="hidden" name="{variable_fecha}_formfecha" value="{valor_fecha}">
         <select name="{variable_fecha}_dia"  id="{variable_fecha}_dia" onChange="javascript:fecha_detalle_{variable_fecha}();"> 
          
		<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_dia.tpl -->
	</select> / <select name="{variable_fecha}_mes" id="{variable_fecha}_mes" class="cajatxt" onChange="javascript:fecha_detalle_{variable_fecha}();">
         <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_mes.tpl -->
        </select> /  
        
       <select name="{variable_fecha}_agno" id="{variable_fecha}_agno"  onChange="javascript:fecha_detalle_{variable_fecha}();"  style="width:100px">
     
        <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_agno.tpl -->
        
        </select>
        </td>
  </tr>
  <script>
  function fecha_detalle_{variable_fecha}()
  {
	document.main.{variable_fecha}_formfecha.value = document.main.{variable_fecha}_agno.value+'-'+document.main.{variable_fecha}_mes.value+'-'+document.main.{variable_fecha}_dia.value; 
  }
  
  fecha_seleccion('{variable_fecha}_formfecha','{variable_fecha}');
  </script>