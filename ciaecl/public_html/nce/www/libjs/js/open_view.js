$(document).ready(function() {
	
	$('.open_view').click(function() {
		
		pdf = $(this).attr('data-type'); 
		var res = pdf.split(".");
		var extension = res.pop(); 
		extension = extension.toLowerCase();
		/*alert(extension);*/
		type = 'zoomout2';
		
		$('.overlay-container').fadeIn(function() 
		{  
			gotoHref('top');
			texto =  ' <br><a href="'+pdf+'">Descargar archivo</a> <br><br><br> ';
			if(extension == 'jpg' || extension == 'png'  || extension == 'gif')
			{
				 texto = texto + ' <img src="'+pdf+'" width="600"  > '; 
			}
			else
			{				
				texto = texto + '   <iframe style="" src="http://docs.google.com/viewer?url=http://www.ciae.uchile.cl/'+pdf+'&embedded=true" width="600" height="580"></iframe> '; 
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