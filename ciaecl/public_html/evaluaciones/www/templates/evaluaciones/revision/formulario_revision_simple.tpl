 <script> 
 
 	document.main.username_revisado.value = '{username_revisado}';
 </script>
    <table class="tabla_noborder_admin"      >
    	<tr><th colspan="{maximo_nota_revision_html}"><big>Retroalimentaci&oacute;n</big></th></tr>
        
        <!-- START BLOCK : bloque_lista_envio_pregunta -->
        
        
        <!-- START BLOCK : bloque_lista_envio_pregunta_fila_nota -->
        <tr>
        <td><strong>Evalue la respuesta de la<br /> pregunta <u>{fila_pregunta}</u> con nota<br /> de 1 a {maximo_nota_revision}</strong><br><small>(1 es <em>Muy Mal</em> y {maximo_nota_revision} es <em>Muy Bien</em>)</small></td>
        <!-- START BLOCK : bloque_lista_envio_pregunta_nota -->
        <td><input type="radio" name="revision_nota_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}"  value="{valor_nota}"/>  {valor_nota} </td>
        <!-- END BLOCK : bloque_lista_envio_pregunta_nota -->
        </tr> 
        <!-- END BLOCK : bloque_lista_envio_pregunta_fila_nota -->
        
                
        <tr><td style="padding:15px 0 15px 0"  colspan="{maximo_nota_revision_html}"> 
        <strong>{fila_pregunta}.- {pregunta}</strong> <br /><small>{ayuda}</small></td></tr>

        <!-- START BLOCK : bloque_lista_envio_pregunta_texto -->
        <tr><td colspan="{maximo_nota_revision_html}">
            <textarea  style="height:150px; width: 100%; font-size:11px" name="revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}"  id="revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}" onChange="javascript:revisionTexto('revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}',70);"></textarea> 
		
        <br>
        <small><span id='info_revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}'></span>&nbsp;&nbsp;
            <span class="maximo_palabras_error" id='error_revision_texto_{id_evaluacion}_{id_etapa}_{id_envio}_{id_pregunta}'></span>
        </span></small>
		 
		
		    </td></tr>

            <tr><td colspan="{maximo_nota_revision_html}" style=" border-bottom:1px dotted #666666">&nbsp;</td></tr>

            
        <!-- END BLOCK : bloque_lista_envio_pregunta_texto -->
        
         
        <!-- END BLOCK : bloque_lista_envio_pregunta -->
        
        <!-- START BLOCK : bloque_lista_envio_bloque_nota -->
        
        <!-- START BLOCK : bloque_lista_envio_bloque_nota -->        
        
        
        
        
        
        
    </table>