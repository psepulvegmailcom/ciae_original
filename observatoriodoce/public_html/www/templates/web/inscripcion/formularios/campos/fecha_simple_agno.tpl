		 <option value='' >A&ntilde;o  </option>
		 <script>
		var d = new Date();
		var n = d.getFullYear() + 10 ; 
		for(var i=n;i > 1930 ; i--)
		{
			document.write("<option value='"+i+"'>"+i+"</option>");
		}
		</script>