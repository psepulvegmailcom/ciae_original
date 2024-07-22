<table style=" margin-left:30px;width:96% " border="0">
<tr>
<td    colspan="2" style="  border-top:1px solid #999999; " ><strong>Author {numero_autor}</strong></td>
 
    
  </tr>
<tr>
<td   style="width:30% " ><strong>First Name</strong></td>
 
    <td  > 
        <input type="text" name="form_autor_nombre_{numero_autor}"   style="width:100% " maxlength="255"   >    </td>
  </tr>
  <tr>
<td><strong>Last Name</strong></td>
 
    <td > 
        <input type="text" name="form_autor_apellido_{numero_autor}" style="width:100% "  maxlength="255"  >    </td>
  </tr>
    <tr>
<td><strong>Organization Affiliation(s)</strong></td>
 
    <td > 
        <input type="text" name="form_autor_afiliacion_{numero_autor}" style="width:100% "  maxlength="255"  >    </td>
  </tr>
  <tr>
<td><strong>Presentation role: Presenter</strong>  </td>
 
    <td > 
         <input type="radio" name="form_autor_presentador_{numero_autor}"  value="si"> Yes <br>
		 <input type="radio" name="form_autor_presentador_{numero_autor}"  value="no" checked> No    </td>
  </tr>
 
<tr>
<td><strong>Email</strong>  </td>
 
    <td > 
         <input type="text" name="form_autor_email_{numero_autor}" style="width:100% " maxlength="255">   </td>
  </tr>
  <tr>
<td><strong>Country of residence</strong>  </td>
 
    <td > 
          <select  name="form_autor_pais_{numero_autor}" >
		  <option value=""  selected='selected'  >	---------  </option>
		  <!-- START BLOCK : bloque_inscripcion_pais --> 
<option value="{valor}"   >	{texto}   </option>
<!-- END BLOCK : bloque_inscripcion_pais -->  
		  
		  </select>  </td>
  </tr>
  
  <tr>
<td    colspan="2" >&nbsp;</td>
 
    
  </tr>
  
  <tr>
 
 
    <td colspan="2"    > 
        <div  >   <input type="button" name="nuevo_autor" value="New author"  id='boton_nuevo_autor_{numero_autor}' onClick="javascript:showtr('bloque_autores_{numero_autor_siguiente}');showId('boton_eliminar_autor_{numero_autor}');hiddenId('boton_eliminar_autor_1');hiddenId('boton_nuevo_autor_{numero_autor}');"> 
		   &nbsp; <input type="button" name="nuevo_autor" value="Delete author {numero_autor}"  id='boton_eliminar_autor_{numero_autor}' onClick="javascript:hidetr('bloque_autores_{numero_autor}');showId('boton_nuevo_autor_{numero_autor}');showId('boton_eliminar_autor_{numero_autor_siguiente}');showId('boton_nuevo_autor_1');hiddenId('boton_eliminar_autor_{numero_autor}');"> 
		   
		   </div></td>
  </tr>

</table>