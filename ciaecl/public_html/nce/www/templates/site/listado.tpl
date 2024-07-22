   
 <script>
 changeTextId('topnavpre','Proposal List'); 
 hiddenId('titulo_inter');  
 document.getElementById('navegador').style.width = '0px'; 
 </script> 
 	 <div style="text-align:center; padding:10px; ">
	  <a href="download.php?file=tmp/{archivo_tmp}" target="_blank">Download Proposal List</a><br><br>
	  “Note that you can order the information clicking on columns titles”  <br>
	 </div>
	 
 

 
 <table width="800px" border="0" cellpadding="3">
 <tr>
 <td class="fieldset_title"><a href="?page=view_proposal&order=id">ID</a></td>
  <td class="fieldset_title"><a href="?page=view_proposal&order=title">Title</a></td>
  <td class="fieldset_title"><a href="?page=view_proposal&order=type">Type</a></td>
  <td class="fieldset_title"><a href="?page=view_proposal&order=subtheme">Subtheme</a></td>
  <td class="fieldset_title">Authors</td>
  <td class="fieldset_title"><a href="?page=view_proposal&order=date">Date</a></td>
  <td class="fieldset_title">Hour</td>
  <td class="fieldset_title"><a href="?page=view_proposal&order=room">Room</a></td>
  <td class="fieldset_title"><a href="?page=view_proposal&order=file">File</a></td>
 
 </tr>
 <!-- START BLOCK : item_lista_elemento -->
<tr>  
<td class="tabla_listado_{tipo_fila}">{id_envio}</td>
<td class="tabla_listado_{tipo_fila}"><em>{titulo}</em></td>
<td class="tabla_listado_{tipo_fila}">{titulo_tabla}</td>
<td class="tabla_listado_{tipo_fila}">{subtema}</td>
<td class="tabla_listado_{tipo_fila}">{autores}</td> 
<td class="tabla_listado_{tipo_fila}">{fecha}</td>
<td class="tabla_listado_{tipo_fila}">{hora}</td>
<td class="tabla_listado_{tipo_fila}">{sala}</td>
<td class="tabla_listado_{tipo_fila}"> 
 <!-- START BLOCK : item_lista_elemento_archivo -->
 <a href="download.php?file=envios/{archivo}">Download&nbsp;File</a> 
 <!-- END BLOCK : item_lista_elemento_archivo -->
 </td> 
 
</tr>
<!-- END BLOCK : item_lista_elemento -->

 
 </table>
		
		 	 <div style="text-align:left; padding:10px; ">
	  <a href="#top"  ><small>Go Top</small></a>
	 </div>