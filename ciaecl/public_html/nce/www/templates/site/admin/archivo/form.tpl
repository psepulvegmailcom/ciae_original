 <input type="hidden" name="id_envio" value="{id_envio}">

<input type="hidden" name="tipo_revision"  value="definitivo" /> 
 
   
  
  
<div class="fieldset_title">Proposal Files</div>

 <table width="100%" border="0" cellpadding="5"  cellspacing="3"   > 
   <tr>
    <td   class="fondo_oscuro"  style=" width:30%"><strong>Title</strong></td>
    <td   class="fondo_oscuro" style="width:70%"> 
        {titulo}  </td>
  </tr> 
  <tr>
    <td style=" width:20%"><strong>ID </strong></td>
    <td style="width:70%"> 
        {id_envio}    </td>
  </tr>
 
  <tr>
    <td   class="fondo_oscuro" style=" width:20%"><strong>Status</strong></td>
    <td   class="fondo_oscuro" style="width:70%;text-transform:capitalize"  > 
        {estado}    </td>
  </tr>

  <tr>
    <td style=" width:20%"><strong>Type</strong></td>
    <td style="width:70%;text-transform:capitalize"> 
        {tipo}  
		<input type="hidden" name="tipo_propuesta"  value="{tipo}" /> 
		  </td>
  </tr>
  <tr>
    <td  class="fondo_oscuro" style=" width:20%"><strong>Available   to present it in a poster session</strong></td>
    <td  class="fondo_oscuro" style="width:70%;text-transform:capitalize"> 
        {tipo_no_paper}    </td>
  </tr>
  
  
  <tr>
    <td  style=" width:20%"><strong> Conference sub-themes</strong></td>
    <td   style="width:70%"> 
        {subtema}    </td>
  </tr>
  <tr>
    <td class="fondo_oscuro" style=" width:20%"><strong> Other conference sub-themes</strong></td>
    <td class="fondo_oscuro"  style="width:70%"> 
        {subtema_otro}    </td>
  </tr>
  <tr>
    <td style=" width:20%"><strong>Abstract  </strong></td>
    <td style="width:70%;"> 
	<div style="height:150px;overflow:scroll; width:100% ">{abstract}</div>
            </td>
  </tr>
  <tr>
    <td class="fondo_oscuro"  style=" width:20%"><strong>Proposal</strong></td>
    <td  class="fondo_oscuro" style="width:70%"> 
        <div style="height:250px;overflow:scroll; width:100% ">{propuesta}  </div>  </td>
  </tr>
  <tr>
    <td style=" width:20%"><strong>Reference</strong></td>
    <td style="width:70%"> 
       <div style="height:150px;overflow:scroll; width:100% "> {referencias}  </div>  </td>
  </tr>
    <tr>
    <td class="fondo_oscuro" style=" width:20%"><strong>Submit Date 
 </strong></td>
    <td class="fondo_oscuro" style="width:70%"> 
         {fecha}    </td>
  </tr>
  
  <!-- START BLOCK : item_lista_no_evaluador -->
   <tr>
    <td   style=" width:20%"><strong>Contact Person Name 
</strong></td>
    <td  class="fondo_oscuro" style="width:70%"> 
         {contacto_nombre}     </td>
  </tr>
  <tr>
    <td class="fondo_oscuro" style=" width:20%"><strong>Contact Person Email </strong></td>
    <td class="fondo_oscuro" style="width:70%"> 
         {contacto_email}    </td>
  </tr> 
  <tr><td colspan="2"><strong> </strong></td></tr>
  <tr><td colspan="2"><strong> </strong></td></tr>
  <tr><td colspan="2"><strong><u>Authors</u></strong></td></tr>
  
  <!-- START BLOCK : item_lista_no_evaluador_autor -->
  <tr>
    <td class="{fondo}" style=" width:20%"><strong>Author {numero} </strong></td>
    <td class="{fondo}" style="width:70%"> 
       <strong>Name</strong> 	{nombre} {apellido}<br>
	   <strong>Email</strong> 	{email}<br> 
<strong>Organization Affiliation</strong> {afiliacion}<br>
<strong>  Presenter </strong>	{presentador}<br> 
<strong>Country of residence</strong> <span style="text-transform:capitalize ">{pais}</span><br>
<br><strong>Only for Symposium</strong> <br> 
<strong style="padding-left:20px ">Role</strong> {simposioroles} <br> 
<strong style="padding-left:20px ">Paper/Presentation Title</strong> {simposiotitulo}<br> 
   </td>
  </tr>   
  <!-- END BLOCK : item_lista_no_evaluador_autor -->
  
	  <!-- END BLOCK : item_lista_no_evaluador -->
    
    
</table>

   
  
  <!-- START BLOCK : bloque_formulario_revisores --> 
<div class="fieldset_title">Proposal Review</div>
  <table>
  
  
  
  <tr>
  <td colspan="2" style="text-align:center"><strong>Evaluation Criteria</strong></td>
  </tr>
  <tr>
  <td colspan="2" > 
  <table cellspacing="0" style="width:100%;  " cellpadding="0">
    
    <tr >
      <td >&nbsp;</td>
      <td align="right" ><div align="center"><strong>1</strong></div></td>
      <td align="right" ><div align="center"><strong>2</strong></div></td>
      <td align="right" ><div align="center"><strong>3</strong></div></td>
      <td align="right" ><div align="center"><strong>4</strong></div></td>
      <td align="right" ><div align="center"><strong>5</strong></div></td>
    </tr>
    <tr>
      <td  style=" border-bottom:1px solid #333333;"style="width:40%" >   </td>
      <td style=" border-bottom:1px solid #333333;"><div align="center"><strong>Not evident                                      </strong></div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td style=" border-bottom:1px solid #333333;"><div align="center"><strong>Strongly Evident    </strong></div></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;">1. Clear statement of the objectives or purposes of the presentation</td>
      <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_1" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_1"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_1" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_1" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_1" value="5" /></center></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;"> 2. Perspective(s) or theoretical framework</td>
      <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_2" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_2"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_2" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_2" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_2" value="5" /></center></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;"> 3. Approach and methods of inquiry and analysis</td>
         <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_3" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_3"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_3" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_3" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_3" value="5" /></center></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;">4. Data sources or evidence</td>

      <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_4" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_4"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_4" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_4" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_4" value="5" /></center></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;">  5. Results and/or conclusions/points of view</td>
     
      <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_5" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_5"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_5" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_5" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_5" value="5" /></center></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;">6.  Educational importance for research and/or practice</td>

      <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_6" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_6"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_6" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_6" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_6" value="5" /></center></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;">  7.	Connection to Congress subthemes 
(Look at the proposal classification)</td>

      <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_7" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_7"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_7" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_7" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_7" value="5" /></center></td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #333333;">  8.	<strong>SYMPOSIUM ONLY.</strong>  Symposium organization and activities, including opportunities for interaction with audience and exchange of presenters</td> 
      <td style="border-bottom:1px solid #333333;"><center>
	  
	  <input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_8" value="1" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_8"  value="2" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_8" value="3"  /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_8" value="4" /></center></td>
       <td style="border-bottom:1px solid #333333;"><center><input type="radio"  {formulario_evaluador_disabled} onClick="javascript:calculoPromedioPuntuacion();"   name="criterio_8" value="5" /></center></td>
    </tr>
     
  </table>
  <br>
  <br><strong>Average criteria</strong> <span id='promedio_nota_html'>0</span>
 </td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td style=" width:20%"><strong>Reviewer Comments

</strong> </td>
    <td style="width:70%">
  (Required. Please be specific about any concerns/weakness.  These comments will be shared with the proposers, though the identities of the reviewers will remain anonymous):</td></tr>
  <tr><td></td>
    <td style="width:70%"> 
        <textarea name="comentario"  {formulario_evaluador_disabled} style="width:100%; height:50px;"></textarea>   </td>
  </tr>
  
    <tr>
    <td style=" width:20%"><strong> Recommendation

</strong></td>
    <td style="width:70%"> 
    
		<input type="radio"  name="decision" value="Definitely accept">Definitely accept<br>
		<input type="radio"  name="decision" value="Possibly accept">Possibly accept (papers not selected may be invited to present posters if requested by authors depending on their evaluation scores and ranking)<br>
		<input type="radio"  name="decision" value="Reject">Reject<br>
		   </td>
  </tr>
  
  <script>
  var casoCoordinador = false;
  </script>
  
   <tr>
    <td   style="text-align:center" colspan="2">&nbsp;</td>
  </tr> 
     <tr>
    <td>&nbsp;</td>
    <td>  <input   type="button" class="buttontype" onclick="javascript:enviarRevision();"  title="Guardar" value="Send" /> </td>
  </tr>
  
  <tr>
    <td style=" width:20%"> </td>
    <td style="width:70%">    </td>
  </tr>
  </table>
  
  <!-- END BLOCK : bloque_formulario_revisores -->
  
    <!-- START BLOCK : bloque_formulario_admin --> 
<div class="fieldset_title">Proposal Status</div>
  <table  style="width:100%">
  <tr>
    <td style="width:30%" ><strong>Status</strong></td><td>
  <select name="estado"  > 
	  <option value="active"  {selected_active}>Active</option>
	  <option value="repeated" {selected_repeated}>Repeated</option> 
	  <option value="damaged" {selected_damaged}>Damaged</option>
	  <option value="discuss" {selected_discuss}>Discuss</option>
  </select>
  
  </td></tr>
  <tr>
    <td style="width:30%" ><strong>Reviewers Assigned</strong></td>
	<td>
	<select name="reviews[]" multiple size="10">
	<!-- START BLOCK : bloque_formulario_admin_reviewer -->
	<option value="{username}" {selected}>{username}</option>
	<!-- START BLOCK : bloque_formulario_admin_reviewer -->
	</select>
	</td>
	</tr>
  
  
    <tr>
    <td  ><strong>Comment</strong></td>
    <td  > 
        <textarea name="comentario" style="width:100%; height:100px;">{comentario_interno}</textarea>   </td>
  </tr> 
   <tr>
    <td>&nbsp;</td>
    <td>  <input   type="button" class="buttontype"   onclick="javascript:guardarEstado();"   title="Guardar" value="Save" /> </td>
  </tr>
  </table>
  <!-- END BLOCK : bloque_formulario_admin -->
  
<div class="fieldset_title">Reviews</div>
  <table>
  <!-- START BLOCK : bloque_revisiones --> 
    <tr> 
    <td  colspan="2" style="border-bottom:1px solid #333333;"> 
<strong>User   </strong>{username}<br />
<strong>      Date</strong> {fecha_html}<br />
	   <strong>Comment</strong> {comentario}<br />
	   <strong>Recommendation</strong> <font style="text-transform:capitalize" >{decision}</font>  <br />
	  <!--  <strong>Tipo Decisi&Oacute;n :</strong> <font style="text-transform:capitalize" >{tipo_revision} </font><br /> -->
	  
	   <ol>
	   <li>  Clear statement of the objectives or purposes of the presentation <strong>{criterio_1}</strong></li>
<li> 	Perspective(s) or theoretical framework<strong>{criterio_2}</strong></li>
<li> 	Approach and methods of inquiry and analysis <strong>{criterio_3}</strong></li>
<li> 	Data sources or evidence<strong>{criterio_4}</strong></li>
<li> 	Results and/or conclusions/points of view<strong> {criterio_5}</strong></li>
<li> 	Educational importance for research and/or practice<strong> {criterio_6}</strong></li>
<li> 	Connection to Congress subthemes 
(Look at the proposal classification)
 <strong>{criterio_7}</strong></li>
<li> 	<strong>SYMPOSIUM ONLY. </strong> Symposium organization and activities, including opportunities for interaction with audience and exchange of presenters <strong>{criterio_8}</strong></li>
	   </ol>
	   <strong>Average </strong> {promedio_nota}
      </td>
  </tr>
  
  <!-- END BLOCK : bloque_revisiones --> 
     
  <tr>
  <td colspan="2">{no_hay_comentarioscc}</td></tr>
  </table>


<input type="hidden" value="mant_envios"  name="opcion" /> 
  
<input type="hidden" value="0" name="promedio_nota">
<script>  

 

function guardarEstado()
{
	if(confirm('Are you  sure to make these changes in this proposal?'))
	{
		process('guardar_estado',2);
	}
}
function enviarRevision()
{  

	var  tiene = false;
	 
	 if(!casoCoordinador)
	 {
  <!-- START BLOCK : bloque_chequeos_criterios -->
  	tiene = false;
    for (var i=0;i<document.main.criterio_{criterio}.length;i++)
	{
       if (document.main.criterio_{criterio}[i].checked)
       {
	     tiene = true;
		}
    } 
	if(!tiene)
	{
		alert('You should evaluate the criterion {criterio}');
		return false;
	}
  <!-- END BLOCK : bloque_chequeos_criterios -->
  
  	if(document.main.tipo_propuesta.value == 'symposium')
	{
		tiene = false;
		for (var i=0;i<document.main.criterio_8.length;i++)
		{
		   if (document.main.criterio_8[i].checked)
		   {
			 tiene = true;
			}
		} 
		if(!tiene)
		{
			alert('You should evaluate the criterion 8');
			return false;
		}
	}
  }
  
  	tiene = false;
	for (var i=0;i<document.main.decision.length;i++)
	{
	   if (document.main.decision[i].checked)
	   {
		 tiene = true;
		}
	} 
	if(!tiene)
	{
		alert('You must select the decision for this proposal');
		return false;
	}
	if(document.main.comentario.value == '')
	{
		alert('You must comment for this proposal');
		return false;
	} 
	 process('guardar',2); 
}

function calculoPromedioPuntuacion()
{
	var total_valores = 7;
	var suma_nota = 0;
	var promedio = 0; 
	var valor_8 = 0;
  	<!-- START BLOCK : bloque_chequeos_criterios_calculo -->
	   
		
	for (var i=0;i<document.main.criterio_{criterio}.length;i++)
	{		
		if (document.main.criterio_{criterio}[i].checked)
		{
			suma_nota = suma_nota + parseInt(document.main.criterio_{criterio}[i].value);
			if({criterio} == 8)
			{
				valor_8 = parseInt(document.main.criterio_{criterio}[i].value);
			}
		}
	} 
	  
  	<!-- END BLOCK : bloque_chequeos_criterios_calculo -->
	
	
	
  	if(document.main.tipo_propuesta.value == 'symposium')
	{
		total_valores = 8;
	}
	else
	{
		suma_nota = suma_nota - valor_8;
	}
	promedio = suma_nota / total_valores;
	promedio = Math.round(promedio*100)/100; 
	document.main.promedio_nota.value = promedio;
	cambiarTexto('promedio_nota_html',promedio); 
}
</script>