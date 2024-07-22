

function mostrarSubmenu(ubicacion)
{   
	if (document.all) /* funciona solo para IE*/
	{ 
		var id = 'hijo_'+ ubicacion;
		for(var i=0;i < 10;i++)
		{
			id = 'hijo_'+i;
			hiddenId(id);
		}
		id = 'hijo_'+ ubicacion;
		showId(id);  
		var mas = 35; 
		if(ubicacion == 1)
		{
			mas = -30;
		}
		document.all[id].style.left =  (ubicacion*100)+mas;
		document.all[id].style.top =  135;
	}
}


function ocultarSubmenu(padre)
{   
	if (document.all)/* funciona solo para IE*/
	{
		setTimeout("ocultarSiSubmenu('"+padre+"')",2000);
	}
}

function ocultarSiSubmenu(padre)
{  
	if (document.all)/* funciona solo para IE*/
	{
		 var id = 'hijo_'+padre;
		 hiddenId(id);
	}
}

 