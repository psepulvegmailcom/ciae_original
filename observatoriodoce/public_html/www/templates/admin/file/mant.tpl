<fieldset>
<div>
<label> {titulo_form}</label><br /> 
<input type="file" name="archivo" />

</div> 
<button  type="button" onclick="javascript:process('guardar',1);"  class="buttontype"  ><span>Guardar</span></button> 
</fieldset>

	<table id="tabla_noborder_admin"  >
 
<tr> 
<th    style="text-align:left"> Archivo </th> 
<th   >Link </th>   
</tr>
 <!-- START BLOCK : lista_item_img -->
 <tr > 
 	<td  valign="top" align='center' class="{class_color}"> 
		
<img src='imageview.php?image=others/{imagen_file}'   width="70" height="70">
	</td> 
	<td class="{class_color}">imageview.php?image=others/{imagen_file}</td>
	</tr>
	
 <!-- END BLOCK : lista_item_img -->
 <!-- START BLOCK : lista_item_file -->
 <tr > 
 	<td  valign="top"  align='center'  class="{class_color}"> 
		
<a href='download.php?file={file}'><img src='cea/images/filetypes/{extension}.gif'   width="20" height="20" border=0></a>
	</td> 
	<td class="{class_color}">download.php?file={file}</td>
	</tr>
	
 <!-- END BLOCK : lista_item_file -->
  
 </table>

