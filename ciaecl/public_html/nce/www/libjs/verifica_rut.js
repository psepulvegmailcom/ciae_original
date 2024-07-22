function rutOK()
{
	if (document.main.rut.value == '')
	{
		alert ("Debe ingresar rut");
		document.main.rut.focus();
		return false;
	}
	if (document.main.digito_rut.value == '')
	{
		alert ("Debe ingresar el digito verificador");
		document.main.digito_rut.focus();
		return false;
	}
	return true;
}
function esDigito(c)
{
	var test= "" + c;
	if (test == "0" || test == "1" || test == "2" || test == "3" || test == "4" || test == "5" || test == "6" || test == "7" || test == "8" || test == "9")
	{
		return true;
	}
	return false;
}
function esDigitoVerificadorValido(c)
{
	var test= "" + c;
	if (test == "0" || test == "1" || test == "2" || test == "3" || test == "4" || test == "5" || test == "6" || test == "7" || test == "8" || test == "9" || test == "k" || test == "K")
	{
		return true;
	}
	alert ("Dígito verificador inválido");
	return false;
}
function esRutValido(s)
{
	var test = "" + s;
	for (var k=0;k < test.length; k++)
	{
		var c=test.substring(k,k+1);
		if (esDigito(c)==false)
		{
			alert ("Rut inválido");
			return false;
		}
	}
	return true;
}
function calculaDigitoVerificador(rut)
{
	var test = "" + rut;
	var total=0;
	var i=2;
	for (var k=test.length;k > 0; k--)
	{
		var c=test.substring(k-1,k);
		if (i==8)
		{
			i=2;
		}
		total+=parseInt(c)*i
		i++;
	}
	if ((11-(total-(Math.floor(total/11)*11)))==11){
		return 0;
	}
	else{
		return (11-(total-(Math.floor(total/11)*11)));
	}
}
function revisaRut()
{
	if (rutOK()==false)
		return false;
	
	if (esRutValido(document.main.rut.value)==false)
		return false;
	if (esDigitoVerificadorValido(document.main.digito_rut.value)==false)
		return false;
	if (calculaDigitoVerificador(document.main.rut.value)==10)
	{
		var test=""+document.main.digito_rut.value;
		if ((test != "K")&&(test != "k"))
		{
			alert ("Rut inválido");
			return false;
		}
	}
	else 
	{
		if (calculaDigitoVerificador(document.main.rut.value)!=document.main.digito_rut.value)
		{
			alert ("Rut inválido");
			return false;
		}
	}
	
	/*si pasa las pruebas anteriores*/
	return true;
	
	
}



