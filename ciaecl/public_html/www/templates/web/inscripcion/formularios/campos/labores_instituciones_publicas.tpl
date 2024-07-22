<a name='formlabores_{orden}_completo_{orden}' ></a>
<tr   id='formlabores_{orden}_completo_{orden}' >
      
      <td colspan="2">
  <table  border="0" style="width:100%">
          <tr><td  colspan="2"><strong style=" text-decoration:underline">Nombramiento {orden}</strong><br> <a  onClick="javascript:eliminarLabor('{orden}');"  href="#formlabores_{orden}_completo_{orden}">(-) Eliminar elemento</a>
          
          
          
          </td></tr>
    <tr>
    <td  ><strong>Instituci&oacute;n  p&uacute;blica  (*)   </strong></td>
    <td style="width:70%">
        <input type="text"  style="width:100%" name="formlabores_{orden}_institucion" id="formlabores_{orden}_institucion" value="{institucion}"  maxlength="255"> </td>
  </tr> 
  
    <tr>
    <td><strong>Tipo de contrato (*)</strong> </td>
    <td>
        <select name="formlabores_{orden}_tipo_contrato" id="formlabores_{orden}_tipo_contrato" style="width:100px"> 
        <option></option>
        <option  value="Planta">Planta</option>    
        <option  value="Contrata">Contrata</option>     
        <option  value="Honorario">Honorario</option>     
        </select>
        
         <script>
		 if('{tipo_contrato}' != '')
		 {
				selectValue('formlabores_{orden}_tipo_contrato','{tipo_contrato}'); 
		 }
		 </script>
        </td>
  </tr>
          <tr>
    <td><strong>Labor que desempe&ntilde;a (*) </strong></td>
    <td>
        <input  style="width:100%" type="text"  name="formlabores_{orden}_cargo" id="formlabores_{orden}_cargo" value="{cargo}"    maxlength="255"> </td>
  </tr>  
   <tr>
    <td><strong>Monto de renta bruta mensual (*) </strong></td>
    <td>
        <input  style="width:100%" type="text" name="formlabores_{orden}_monto" id="formlabores_{orden}_monto" value="{monto}"  maxlength="100"> </td>
  </tr> 
      
   <tr>
    <td><strong>Per&iacute;odo   (indicar mes y a&ntilde;o de inicio y t&eacute;rmino) (*) </strong></td>
    <td>
    <table style="width:100%">
    <tr><td><strong>Inicio</strong> </td>
    <td><strong>T&eacute;rmino </strong> </td>
    </tr>
    <tr><td>  
    <select name="formlabores_{orden}_periodo_inicio_mes" id="formlabores_{orden}_periodo_inicio_mes" class="cajatxt" style="width:150px"  >
          
         <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_mes.tpl -->
        </select>
          <script>
		 if('{periodo_inicio_mes}' != '')
		 {
				selectValue('formlabores_{orden}_periodo_inicio_mes','{periodo_inicio_mes}'); 
		 }
		 </script>
        </td>
       <td>
       <select name="formlabores_{orden}_periodo_termino_mes" id="formlabores_{orden}_periodo_termino_mes" class="cajatxt" style="width:150px"  >
          
         <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_mes.tpl -->
                 <option value="00">--INDEFINIDO--</option>
        </select>
        
        
          <script>
		 if('{periodo_termino_mes}' != '')
		 {
				selectValue('formlabores_{orden}_periodo_termino_mes','{periodo_termino_mes}'); 
		 }
		 </script>
        </td></tr>
        
        <tr><td>
        <select name="formlabores_{orden}_periodo_inicio_agno"  id="formlabores_{orden}_periodo_inicio_agno" class="cajatxt"  style="width:150px" >
        
        <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_agno.tpl -->
        </select>
        
        
          <script>
		 if('{periodo_inicio_agno}' != '')
		 {
				selectValue('formlabores_{orden}_periodo_inicio_agno','{periodo_inicio_agno}'); 
		 }
		 </script>
        </td><td> 
        <select name="formlabores_{orden}_periodo_termino_agno" id="formlabores_{orden}_periodo_termino_agno"   class="cajatxt"  style="width:150px" >
        
        <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_simple_agno.tpl -->
        <option value="0">--INDEFINIDO--</option>
        </select>
        
        
          <script>
		 if('{periodo_termino_agno}' != '')
		 {
				selectValue('formlabores_{orden}_periodo_termino_agno','{periodo_termino_agno}'); 
		 }
		 </script>
        </td></tr>
    </table>
    
       
       
       
       </td>
  </tr> 
   <tr>
    <td style="border-bottom:1px solid #DBD4D4" colspan="2">&nbsp; 
       </td>
  </tr>
  </table>
  
  </td></tr>
  
    
  <script>
  hidetr('formlabores_{orden}_completo_{orden}'); 
  <!-- START BLOCK : bloque_mostrar_fila --> 
  showtr('formlabores_{orden}_completo_{orden}');
  <!-- END BLOCK : bloque_mostrar_fila --> 
  </script>