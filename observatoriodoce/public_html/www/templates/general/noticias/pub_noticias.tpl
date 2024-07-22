<div style="text-align: right">
	<br /> <a href="javascript:process('',1);">{back_link}</a>
	</div> 
<table width="100%">
<tr>
	<td colspan="2"><small><em>{noticia_epigrafe}</em></small></td>
</tr>

 <input type="hidden" name="id_noticia"  value="{noticia_id_noticia}"/>
<tr>
	<td colspan="2" style=" text-align:justify;font-weight:bold; line-height:24px; padding-bottom:10px; font-size:150%; " >
	  {noticia_titulo} </td>
 
</tr>
<tr> 
 <td  colspan="2"  style="padding-bottom:10px; text-align:justify" ><br />
 
  <ul><li><em>{noticia_bajada_noticia}</em></li></ul>
  
  </td>
 </tr>
 <tr>
 <td   colspan="2"  style="text-align:justify"> 

<!-- START BLOCK : noticia_bloque_img -->
<div style=" float:{noticia_imagen_noticia_lado}; width:335px;">
<img src="imageview_intranet.php?image={noticia_imagen_noticia}&case=img_news" width="300"  class="content1_img" style=" padding:2px; margin: 1px 12px 2px 12px; ">  <br />
<div  style=" padding:2px; margin: 1px 25px 2px 12px; line-height:14px; ">
<small> {noticia_imagen_noticia_descripcion} </small></div>
</div>
<!-- END BLOCK : noticia_bloque_img -->

 {noticia_noticia}</td>
</tr>

<tr><td>&nbsp;</td></tr>




	<!-- START BLOCK : noticia_tag_bloque -->
	<tr>
<td colspan="2">
		 <strong><small> {noticia_tag_idioma} :</small></strong> <small> {noticia_tag}</small>
	</td>
</tr>
	<!-- END BLOCK : noticia_tag_bloque -->
 
</table> 

	<!-- START BLOCK : noticia_tag_galeria_bloque -->
	<center>
		<input type='button'  class='button' name=back value='   {texto}    ' onclick='javascript:location.href="?parent=actualidad&option=galImagDet&lang={lang}&tema={tema}"'>
	</center>
	<!-- END BLOCK : noticia_tag_galeria_bloque -->

	<div style="text-align: right">
	<br /> <a href="javascript:process('',1);">{back_link}</a>
	</div>
	 
