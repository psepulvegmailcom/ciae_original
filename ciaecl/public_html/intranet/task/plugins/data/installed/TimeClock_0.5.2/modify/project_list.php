---[find]---
				<th width="50%"><?php echo $langProject['project']; ?></th>
                <th width="12%" class="act"><?php echo $langProject['position']; ?></th>
				<th width="8%" class="act"><?php echo $langProject['members']; ?></th>
				<th width="12%" class="act"><?php echo $langProject['status']; ?></th>
				<th width="8%" class="act"><?php echo $langForm['tasks']; ?></th>
				<th width="10%" class="act"><?php
---[replace]---
				<th width="50%"><?php echo $langProject['project']; ?></th>
<!-- begin Time Clock edit --> 
                <th width="8%" class="act"><?php echo $langProject['position']; ?></th>
				<th width="8%" class="act"><?php echo $langProject['members']; ?></th>
				<th width="8%" class="act"><?php echo $langForm['time']; ?></th>
				<th width="8%" class="act"><?php echo $langProject['status']; ?></th>
				<th width="8%" class="act"><?php echo $langForm['tasks']; ?></th>
<!-- end Time Clock edit -->
				<th width="10%" class="act"><?php
---[find]---
				<td align="center"><?php $objItem->p('memberCount'); ?></td>
---[replace]---
				<td align="center"><?php $objItem->p('memberCount'); ?></td>
<!-- begin Time Clock addition -->			
				<td align="center"><?php $objItem->pGetTime($objItem->id); ?></td>
<!-- end Time Clock addition -->
---[find]---
                <td colspan="6">
                    <p>&nbsp;</p>
                    <p align="center">- <?php echo $langMessage['no_project_found']; ?> -</p>
---[replace]---
<!-- begin Time Clock edit -->
                <td colspan="7">
<!-- end Time Clock edit -->                
                    <p>&nbsp;</p>
                    <p align="center">- <?php echo $langMessage['no_project_found']; ?> -</p>