// JavaScript Document

function showHideId(id)
{
	if(document.getElementById(id).style.height == 'auto')
	{
		hiddenId(id)
	}
	else
	{
		showId(id);
	}
}

function showId(id)
{	
	if(document.getElementById(id))
	{
	    document.getElementById(id).style.visibility 	= "visible"; 
		document.getElementById(id).style.display		= 'block';
		document.getElementById(id).style.height 		= 'auto';
	}
}

function hiddenId(id)
{	
	if(document.getElementById(id))
	{
		if (document.all)		
	    {
			document.getElementById(id).style.display 		= 'none';	
		}
		else
	    {
			document.getElementById(id).style.visibility 	= "hidden";	
		}
		document.getElementById(id).style.height 			= '0px';
	}
}