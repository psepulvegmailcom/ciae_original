<table style="width: 650px;" align="left" border="0" cellpadding="0" cellspacing="0">
            <tbody>
			<tr bgcolor="#e9e9e9"> 
              <th scope="row"  width="30%" style="padding:8px; text-align:center;"> <a href="?page=view_seminarios&agno=old"><strong>AÑOS ANTERIORES</strong></a> </th>
              <th scope="row" width="30%" style="padding:8px; text-align:center;"> <a href="?page=view_seminarios&agno={agno_anterior_anterior}"><strong>AÑO {agno_anterior_anterior}</strong></a> </th>
              <th scope="row" width="30%" style="padding:8px; text-align:center;"> <a href="?page=view_seminarios&agno={agno_anterior}"><strong>AÑO {agno_anterior}</strong></a>  </th>
            </tr>
          </tbody>
		  <tr> 
              <td   valign="top" colspan="3"> &nbsp;
			    </td>
            </tr>
		  <!-- START BLOCK : bloque_seminario -->
		  <tr> 
              <td class="intercalado{intercalado}" valign="top" colspan="3"><strong>{dia}</strong> 
			   <!-- START BLOCK : bloque_seminario_archivo -->
			   <div style="float:right"><a href="../../doc/seminarios/{archivo}">
			   <IMG             height=31             src="cea/images/iconos/download_act.png" width=28             border=0></a></div>
			   <!-- END BLOCK : bloque_seminario_archivo -->
			    <br /><br />
			  <div align="justify"><em>"{texto}"</em><br />{autor}</div><br /></td>
            </tr>

		  <!-- END BLOCK : bloque_seminario -->
		  </table>