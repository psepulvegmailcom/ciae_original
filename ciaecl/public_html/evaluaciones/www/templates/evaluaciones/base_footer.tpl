</div>
<!-- SUB FOOTER -->
<script>
function guardarFormulario()
{	
		if(true)
	{		
		process('{opcion_modulo}|guardar|guardar',0);
	}
	//if(guardarDetalleFormulario()) en vez del if(true)
} 

function irOpcionFormulario(caso)
{
	process('{opcion_modulo}|'+caso,0);
}

function cancelarFormulario()
{
	process('{opcion_modulo}',0);
}


function actualizarFechaInicio_1()
{
	process('mant_adminGeneral|guardarI1',0);
}
function actualizarFechaCierre_1()
{
	process('mant_adminGeneral|guardarC1',0);
}

function actualizarFechaInicio_2()
{
	process('mant_adminGeneral|guardarI2',0);
}
function actualizarFechaCierre_2()
{
	process('mant_adminGeneral|guardarC2',0);
}

function actualizarFechaInicio_3()
{
	process('mant_adminGeneral|guardarI3',0);
}
function actualizarFechaCierre_3()
{
	process('mant_adminGeneral|guardarC3',0);
}
</script>
 
 