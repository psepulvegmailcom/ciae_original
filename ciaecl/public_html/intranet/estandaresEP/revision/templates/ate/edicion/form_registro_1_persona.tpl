 
document.main.ate_persona_rut.disabled = true;
document.main.ate_persona_dv.disabled = true;
document.main.ate_persona_nombre.disabled = true;
document.main.ate_persona_apellido_paterno.disabled = true;
document.main.ate_persona_apellido_materno.disabled = true;
 
  

<!-- INCLUDE BLOCK : ../templates/ate/edicion/form_edicion_generico.tpl -->

changeTextIdEdicion('mensaje_persona_edicion','Los datos de identificación como: rut, nombres y apellidos son inmodificables. Sin embargo, en caso de ser justificablemente necesario, podrá solicitar a la Mesa de Ayuda el cambio de estos datos.'); 


</script>
<input type="hidden" name="ate_persona_telefono_codigo_extra" value="">
<input type="hidden" name="ate_persona_celular_codigo_extra" value="">
<script>

if(!isEmpty(document.getElementById('ate_persona_telefono_estado').innerHTML))
{	
	document.main.ate_persona_telefono_codigo_extra.value = document.main.ate_persona_telefono_codigo.value;
	document.main.ate_persona_telefono_codigo.disabled = true;
}
if(!isEmpty(document.getElementById('ate_persona_celular_estado').innerHTML))
{	
	document.main.ate_persona_celular_codigo_extra.value = document.main.ate_persona_celular_codigo.value;
	document.main.ate_persona_celular_codigo.disabled = true;
}



