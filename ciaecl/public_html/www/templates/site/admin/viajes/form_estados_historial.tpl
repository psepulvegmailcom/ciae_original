<div class="fieldset_campos">
            <p><label>		Historial de estados y observaciones internos </label> </p> 
             <table style="width:100%">
             <tr>
             <td><strong>Fecha inicio</strong></td><td><strong>Fecha cierre</strong></td><td><strong>Responsable</strong></td><td><strong>Estado</strong></td><td><strong>Comentario</strong></td></tr>
             
             <!-- START BLOCK : bloque_estado_estados_historial -->
             <tr>
             <td style="vertical-align:top"> {fecha} </td>
             <td style="vertical-align:top"> {fecha_cierre} </td>
             <td style="vertical-align:top">{id_usuario_responsable}</td><td style="vertical-align:top">{tipo_estado}</td><td style="vertical-align:top"> {comentarios}
             
             <!-- START BLOCK : bloque_estado_estados_historial_archivos -->
             <br>
             <a   class="open_view" id="popup_interno_pdf_interno_archivos_{archivo}" data-type="download.php?file=solicitudes_gestion/archivos/{archivo}" > 
             <img  border=0 src="www/images/iconos/download_act.png"> {nombre}</a> 
             <!-- END BLOCK : bloque_estado_estados_historial_archivos -->
             
               </td></tr>
             <!-- END BLOCK : bloque_estado_estados_historial -->
             </table>
     </div>
</fieldset></td></tr>