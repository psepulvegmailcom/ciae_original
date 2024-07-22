
<input type="hidden" name="email" value="{email}">

<div class="fieldset_title">Ficha Inscrito</div>
<table width="95%" border="0" cellpadding="3" style="font-size:">  

  <tr>
    <td  ><strong>Nombre</strong></td>
    <td  > 
        {nombre} {apellidos}   </td>
  </tr>
  <tr>
    <td style=" width:30%"><strong>Email </strong></td>
    <td style="width:70%"> 
        {email}    </td>
  </tr>
  <tr>
    <td   ><strong>Fecha Inscripción</strong></td>
    <td  > 
        {fecha_html}    </td>
  </tr> 
  
 <tr>
    <td   ><strong>Clave Inscripción</strong></td>
    <td  > {clave}    </td>
  </tr> 
  
 <tr>
    <td   ><strong>Institución</strong></td>
    <td  > {institucion}    </td>
  </tr> 
  
 <tr>
    <td   ><strong>Rol</strong></td>
    <td  > {rol}    </td>
  </tr> 
 <tr>
    <td   ><strong>Teléfono</strong></td>
    <td  > {telefono}    </td>
  </tr> 
  
 <tr>
    <td   ><strong>Dirección</strong></td>
    <td  > {direccion}    </td>
  </tr> 
  
 <tr>
    <td   ><strong>Ciudad</strong></td>
    <td  > {ciudad}    </td>
  </tr> 
  
 <tr>
    <td   ><strong>País</strong></td>
    <td  > {pais_nombre}    </td>
  </tr> 
  
  
 <tr>
    <td   style="vertical-align:top"><strong>Disciplinas</strong></td>
    <td  style="vertical-align:top" >  
	<ul>
	 <!-- START BLOCK : bloque_disciplinas -->
	 <li>{disciplina}</li>
	 <!-- END BLOCK : bloque_disciplinas -->
	</ul> 
	    </td>
  </tr> 
  
 <tr>
    <td   style="vertical-align:top"><strong>Área</strong></td>
    <td  style="vertical-align:top">  
	<ul>
	 <!-- START BLOCK : bloque_area -->
	 <li>{area}</li>
	 <!-- END BLOCK : bloque_area -->
	</ul> 
	    </td>
  </tr> 
  
 <tr>
    <td   ><strong>Comentario Inscripción</strong></td>
    <td  > {comentario}    </td>
  </tr> 
  

   
  </table> 