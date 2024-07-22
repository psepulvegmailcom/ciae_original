---[find]---
    	</table>
    	<p class="ctr">
---[replace]---
<!-- begin Time Clock addition -->
     	  <tr>
    	    <th><?php echo $GLOBALS['langForm']['time']; ?>:</th>
			<td<?php echo (@constant('FRK_CONTEXT_ENABLE'))?' colspan="3"':''; ?>>
				<input type="radio" id="time1" name="time[]" value="time_change"> <?php echo $GLOBALS['langForm']['time_change']; ?>&nbsp;&nbsp;
				<input type="text" size=3 id="t_days" name="t_days" value="0" onSelect="gE('time1').checked=true;"> <?php echo $GLOBALS['langDateMore']['days']; ?>&nbsp;
				<select id="t_hours" name="t_hours" onChange="gE('time1').checked=true;">
					<?php 
						// hour options
						for ($b=0; $b<24; $b++) {
						 	if ($b<10) {
								$c = "0". (string) $b;
							} else { $c = $b; }
							print("<option value='".$b."'>".$c."</option>");
						}
					?>
				</select> :
				<select id="t_mins" name="t_mins" onChange="gE('time1').checked=true;">
					<?php 
						// minute options
						for ($b=0; $b<60; $b++) {
						 	if ($b<10) {
								$c = "0". (string) $b;
							} else { $c = $b; }
							print("<option value='".$b."'>".$c."</option>");
						}
					?>
				</select> :
				<select id="t_secs" name="t_secs" onChange="gE('time1').checked=true;">
					<?php 
						// seconds options
						for ($b=0; $b<60; $b++) {
						 	if ($b<10) {
								$c = "0". (string) $b;
							} else { $c = $b; }
							print("<option value='".$b."'>".$c."</option>");
						}
					?>
				</select>
    	    </td>
    	  </tr>
      	  <tr>
    	    <th></th>
			<td<?php echo (@constant('FRK_CONTEXT_ENABLE'))?' colspan="3"':''; ?>>
				<input type="radio" id="time2" name="time[]" value="time_delete"> <?php echo $GLOBALS['langForm']['time_delete']; ?>
    	    </td>
    	  </tr>
<!-- end Time Clock addition --> 
    	</table>
    	<p class="ctr">