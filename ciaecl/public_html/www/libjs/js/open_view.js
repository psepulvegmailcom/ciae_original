$(document).ready(function() {
	
	$('.open_view').click(function() 
	{  
		
		pdf = $(this).attr('data-type');   
		var id = $(this).attr('id');
		var caso_especial = id.split("_"); 
		var caso_id = caso_especial[2] + '_' + caso_especial[3];
		var caso_base = caso_especial[0] + '_' + caso_especial[1];
		/* formato esperado id='popup_interno_url_interno_persona' primera dos palabras deben ser popup_interno las 2 y 3 deben ser el caso particular, los posteriores pueden ser cualquier cosa*/
		
		var caso = 'url'; 
		if(caso_base == 'popup_interno')
		{			
			switch(caso_id)
			{
				case 'url_interno':
					caso = 'url_interno'; 
				break;
				case 'url_externo':
					caso = 'url'; 
				break;
				case 'pdf_interno':
					caso = 'doc';
					pdf  = 'http://www.ciae.uchile.cl/'+pdf;
					
      				var res = pdf.split(".");
					var extension = res.pop();
					if(extension == 'jpg' || extension == 'png' || extension == 'gif' || extension == 'jpeg')
					{
						pdf = pdf + '&tipo=doc';
						pdf = pdf.replace("download","imageview");
						caso = 'img';
					}
				break;
				case 'img_interno':
					caso = 'img';
					pdf  = 'http://www.ciae.uchile.cl/'+pdf;
				break;
			}
		}
		/*alert(pdf + " | " +  caso +  " | " + caso_id);*/
		type = 'zoomout2';
		var w = 750;
		var h = 580;
		$('.overlay-container').fadeIn(function() 
		{  
			gotoHref('top');
			if(caso == 'url')
				texto =  '  <a href="'+pdf+'" target="_blank">Ver link</a> <br><br>  ';
			else
			{
				if(caso != 'url_externo')
				{
					texto =  ' <a href="'+pdf+'" target="_blank">Descargar archivo</a>  <br><br>';
				}
			}
				
			if(caso == 'img')
			{
				 texto = texto + ' <img src="'+pdf+'" width="'+w+'"  > '; 
			}
			else
			{		
				if(caso == 'doc')
				{
					texto = texto + '   <iframe style="border:none" src="http://docs.google.com/viewer?url='+pdf+'&embedded=true" width="'+w+'" height="850"></iframe> '; 
				}
				else
				{
					texto = texto + '   <iframe style="border:none"  style="" src="'+pdf+'" width="'+w+'" height="'+h+'"></iframe> '; 
				} 
			}
			$('.window-container.'+type).html(texto);
			
			window.setTimeout(function(){
				$('.window-container.'+type).addClass('window-container-visible');
			}, 100);
			
		});
	});
	
	$('.close_open_view').click(function() {
		$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
	});
	
});