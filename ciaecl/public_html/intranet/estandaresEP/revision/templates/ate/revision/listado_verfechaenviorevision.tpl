 /*document.getElementById('info_fecha_oferente_{id_oferente}').innerHTML = '<div style="font-size:10px;"><strong style="font-size:10px;">fecha envio:</strong> <font class="{clase_atencion}">{fecha_envio}</font> '+'<strong style="font-size:10px;">fecha estado:</strong><br>' + document.getElementById('info_fecha_oferente_{id_oferente}').innerHTML+'<br>
<strong style="font-size:10px;">quedan</strong>&nbsp;<font class="{clase_atencion}">{dia_diff}</font>&nbsp;<strong style="font-size:10px;">d&iacute;as</strong></div>
'; */ 

document.getElementById('info_fecha_oferente_{id_oferente}').innerHTML = '<div style="font-size:10px;"><strong style="font-size:10px;">fecha envio:</strong> <font class="{clase_atencion}">{fecha_envio}</font><br><strong style="font-size:10px;">fecha estado:</strong><br>{fecha_estado_actual}<br><strong style="font-size:10px;">han&nbsp;pasado&nbsp;{dia_diff_envio}&nbsp;d&iacute;as</strong><strong style="font-size:10px;">quedan&nbsp;<font   class="{clase_atencion}">{dia_diff}</font>&nbsp;d&iacute;as</strong></div>
';
