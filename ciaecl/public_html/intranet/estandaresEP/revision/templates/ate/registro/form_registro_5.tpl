 <div  class="fieldset_title" >Personas <span>{ayuda_persona_general}</span></div>
 <br />
 
 <!-- START BLOCK : ate_personas_bloque_msn_universidad -->
 <!--<div>
	 <img src="images/Info.ico" border="0">
	 <strong>En el caso de no  contar con los certificados de t&iacute;tulos, post&iacute;tulos y/o postgrados debidamente  legalizados ante notario, se pueden ingresar <u>copias simples</u>. <br />
	   De ser validada su  oferta, la instituci&oacute;n tendr&aacute; la <u>obligaci&oacute;n</u> de enviar toda la documentaci&oacute;n  debidamente legalizada a m&aacute;s tardar el 30 de abril 2008.</strong>
 </div>-->
 <!-- START BLOCK : ate_personas_bloque_msn_universidad -->
 
 <br />
 
 Para ingresar la información de la persona haga click en <img src="images/Search.ico" border="0" /><br /> <br />
			<table id="tabla_noborder">
				<tr> 
					<th  width="20%"  align="center">  <strong>Rut</strong></th>
					<th  width="25%"   align="center"> <strong>Nombre</strong></th>
					<th  width="25%"  align="center">  <strong>Apellido Paterno</strong></th>
					<th  width="25%"  align="center">  <strong>Apellido Materno</strong></th>
					<th  width="3%"  align="center" ></th>
					<th  width="3%"  align="center" ></th>
				</tr>
				<!-- START BLOCK : ate_personas_bloque_con -->
				<tr id='fila_ficha_{numero_fila}' > 
					<td class="{fondo_color}" style="text-align:right; padding-right:10px;">&nbsp;&nbsp;<strong>{rut}-{dv}</strong> <br><font id='ate_capital_{rut_numero}_estado' style="text-align:left" class="edicion_enrevision"> </font>
					</td>
					<td class="{fondo_color}">&nbsp;&nbsp;<strong>{nombre}</strong></td>
					<td class="{fondo_color}">&nbsp;&nbsp;<strong>{apellido_paterno}</strong></td>
					<td class="{fondo_color}">&nbsp;&nbsp;<strong>{apellido_materno}</strong></td>
					<td class="{fondo_color}"><a onclick="javascript:verFichaRecurso('{numero_fila}','{rut_numero}','{dv}');" id='boton_editar_capital_humano_{rut_numero}'><img src="images/Search.ico" border="0"  title="Ver ficha"/></a></td> 
					<td class="{fondo_color}" ><a  title="Eliminar Ficha" id='boton_borrar_capital_humano_{rut_numero}' onclick="javascript:eliminarFichaRecurso('{numero_fila}','{rut_numero}');"><img src="images/delete.ico" border="0" /></a></td>
				</tr>
				 
				<!-- END BLOCK : ate_personas_bloque_con -->
				<!-- START BLOCK : ate_personas_bloque -->
				<tr id='fila_ficha_{numero_fila}'> 
				<td  class="{fondo_color}"  align="left" id="ate_capital_{numero_fila}_rut_col"><input type="text" name="ate_capital_{numero_fila}_rut"  title="Sin punto" onchange="javascript:verFicha('{numero_fila}');" maxlength="10" style="width:75px"  />-<input type="text" name="ate_capital_{numero_fila}_dv"  style="width:18px" maxlength="1" onchange="javascript:verFicha('{numero_fila}');" /> </td>
					<td class="{fondo_color}"  id="ate_capital_{numero_fila}_nombre_col"><input type="text" name="ate_capital_{numero_fila}_nombre"  onchange="javascript:verFicha('{numero_fila}');"   /></td>
					<td class="{fondo_color}"  id="ate_capital_{numero_fila}_apellido_paterno_col"><input type="text" name="ate_capital_{numero_fila}_apellido_paterno" onchange="javascript:verFicha('{numero_fila}');"     /></td>
					<td class="{fondo_color}" id="ate_capital_{numero_fila}_apellido_materno_col"><input type="text" name="ate_capital_{numero_fila}_apellido_materno" onchange="javascript:verFicha('{numero_fila}');" /></td>
					
					<td class="{fondo_color}"  id="ate_capital_{numero_fila}_ver_col"><a href="javascript:verFicha('{numero_fila}');"><img src="images/Search.ico" border="0" /></a></td>
					<td class="{fondo_color}"  id="ate_capital_{numero_fila}_del_col"></td>
				</tr>
				<!-- END BLOCK : ate_personas_bloque -->				
			</table>		
		 <br />
 <input type="hidden" value="{total_recurso}" name="total_recurso">
<script>

<!-- START BLOCK : ate_personas_show_ficha_nuevo -->
verFichaRecurso({nuevo_fila},{nuevo_rut},'{nuevo_dv}');
<!-- END BLOCK : ate_personas_show_ficha_nuevo -->


function revisarFilaRecurso(ficha_persona,conmensage)
{
	var nombre_input_rut = searchElement('ate_capital_'+ficha_persona+'_rut'); 	
	if(nombre_input_rut.value.length < 5 || nombre_input_rut.value > 30000000)
	{ 
		showAlert('Debe ingresar el rut de la persona. El rut debe ser númerico, mayor de 6 dígitos, sin puntos y menor a 30.000.000');
		nombre_input_rut.focus();
		nombre_input_rut.value =''; 
		return false;
	}
	if(isEmpty(nombre_input_rut.value))
	{
		if(conmensage)
			showAlert('Debe ingresar el rut de la persona. El rut debe ser númerico, mayor de 6 dígitos y sin puntos');
		nombre_input_rut.focus();
		return false;
	}	 
	else
	{
		var nombre_input_dv  = searchElement('ate_capital_'+ficha_persona+'_dv');
		if(isEmpty(nombre_input_dv.value))
		{
			if(conmensage)
				showAlert('Debe ingresar el dígito verificador del rut de la persona');
			nombre_input_dv.focus();
			return false;
		}
		else
		{ 
			if(!revisaRut(nombre_input_rut.value,nombre_input_dv.value))
			{			
				showAlert('El dígito verificador del rut no coincide. El rut debe ser númerico, mayor de 6 dígitos y sin puntos');
				nombre_input_dv.value = '';
				nombre_input_dv.focus();
				return false;
			}
		}	
	}
	
	var nombre_input = searchElement('ate_capital_'+ficha_persona+'_nombre');
 
	if(nombre_input.value == '')
	{
		if(conmensage)
			showAlert('Debe ingresar el nombre de la persona');
		nombre_input.focus();
		return false;
	}
	nombre_input = searchElement('ate_capital_'+ficha_persona+'_apellido_paterno');
	if(nombre_input.value == '')
	{
		if(conmensage)
			showAlert('Debe ingresar el apellido paterno de la persona');
		nombre_input.focus();
		return false;
	}	
	nombre_input = searchElement('ate_capital_'+ficha_persona+'_apellido_materno');
	if(nombre_input.value == '')
	{
		if(conmensage)
			showAlert('Debe ingresar el apellido materno de la persona');
		nombre_input.focus();
		return false;
	}	
	
	return true;
}

function eliminarFichaRecurso(fila,rut)
{
	if(document.main.caso_revision.value == 'edicion')
	{
		showAlert('Para que su postulación siga siendo válida no podrá eliminar a todo su capital humano.');
		if(document.main.total_recurso.value == 1)
		{			
			showAlert('[ATENCIÓN] el capital humano no puede ser eliminado de su postulación para mantener validada');
			return false;
		}
	}

	if(confirm('¿Esta seguro de eliminar este Capital Humano de su institución? Esta acción eliminará toda la información previamente ingresada para esa persona en relación a su postulación (Información personal y Experiencias)'))
	{		
		registro_fichapersona_eliminar(fila,rut);
	}
}

function verFicha(ficha_persona)
{
	var nombre_input_rut = searchElement('ate_capital_'+ficha_persona+'_rut');
	var nombre_input_dv  = searchElement('ate_capital_'+ficha_persona+'_dv');
	if(revisarFilaRecurso(ficha_persona,false))
	{
		/*
		registro_fichapersona_agregar(ficha_persona);
		verFichaRecurso(ficha_persona,nombre_input_rut.value,nombre_input_dv.value);
		*/
			/* chequeoTipoDatos(document.main.caso_revision.value+'|5',0); */
			chequeoTipoDatos(document.main.lastAction.value,0);
	} 
} 

function verFichaRecurso(fila,rut,dv)
{   
	var opcion = 'ficha_persona&id_fila='+fila+'&dv='+dv+'&rut='+rut;
	verFormularioPopup(opcion,'ventana_extra_recurso');
}
	
function chequeoTipoDatos(action,level)
{
	 
			desbloquearFormularioDevuelto();
		chequeoTipoDatosCompleto(action,level); 
			bloquearFormularioDevuelto();				
}
function chequeoTipoDatosCompleto(action,level)
{
	var chequeo = true;  

	if(chequeo)
	{
		process(action,level);
	}
}
</script>