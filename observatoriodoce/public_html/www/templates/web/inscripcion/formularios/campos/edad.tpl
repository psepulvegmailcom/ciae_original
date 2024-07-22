 <tr>
    <td><strong>Edad   (*)</strong> </td>
    <td>
        <select name="form_edad">
        <option value=""></option>
        <script>
		for(var i=18;i < 90 ; i++)
		{
			if('{edad}' == i)
			{				
				document.write("<option selected value='"+i+"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+i+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>");
			}
			else
			{
				document.write("<option value='"+i+"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+i+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>");	
			}
		}
		</script>
        </select></td>
  </tr>