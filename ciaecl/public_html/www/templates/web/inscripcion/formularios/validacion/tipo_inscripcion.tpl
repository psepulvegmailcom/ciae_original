 	 
 	if(trim(document.main.form_tipo_inscripcion.value) == ''  )
	{
		alert('Debe seleccionar la forma de participacion'); 
		return false;
	} 
    else
    {
        if(document.main.form_tipo_inscripcion.type == 'radio')
        {
            if(!document.main.form_tipo_inscripcion.checked)
            {
                alert('Debe seleccionar la forma de participacion'); 
                return false;
            }
        }
    }
    