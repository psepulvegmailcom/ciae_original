
<!-- FIN CONTENIDO MODULO -->   
   
<div class="clear"></div>     
</div>
<!--   fin de div textos-->
</div>
<!--   fin de div content-->

</div><!--   fin de div todo-->
<script type="text/javascript" charset="utf-8">
		window.addEvent('load', function () {
			myTabs = new SlidingTabs('buttons', 'panes');
			
			// this sets up the previous/next buttons, if you want them
			$('previous').addEvent('click', myTabs.previous.bind(myTabs));
			$('next').addEvent('click', myTabs.next.bind(myTabs));
			
			// this sets it up to work even if it's width isn't a set amount of pixels
			window.addEvent('resize', myTabs.recalcWidths.bind(myTabs));
		});
	</script>
</body>
</html>
