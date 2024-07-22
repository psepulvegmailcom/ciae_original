---[find]---
	.'task_update_status,task_update_full,task_delete,'
---[replace]---
	.'task_update_status,task_update_full,task_delete,'
	.'task_file_delete,task_file_upload,task_file_download,'
---[find]---
                            case 2:
                                echo '<img src="skins/'.FRK_SKIN_FOLDER.'/images/priv2.png" width="12" height="16" align="absmiddle" border="0" alt="" />';
                                break;
                        }
---[replace]---
                            case 2:
                                echo '<img src="skins/'.FRK_SKIN_FOLDER.'/images/priv2.png" width="12" height="16" align="absmiddle" border="0" alt="" />';
                                break;
                        }
												// Check files and show icon
												?>
												<a href="javascript:freak_view(<?php echo $objItem->id; ?>,'file');"><img id="fileIcon<?php echo $objItem->id; ?>" src="<?php echo PLG_FILE_DIR; ?>/images/files.png" width="12" height="11" alt="files" border="0" align="absmiddle" style="display:none" /></a>
												<?php
												$objFileList = new ItemFile();
												$objFileList->addWhere('itemId='.$objItem->id);
												$objFileList->loadList();
												if ($objFileList->rMore()) { 
													echo '<script type="text/javascript">sE(gE(\'fileIcon'.$objItem->id.'\')); gE(\'fileIcon'.$objItem->id.'\').title=\''.$objFileList->rTotal().' file(s)\'</script>';
												}
---[find]---
					<td><div style="float:right" id="ecomm<?php echo $objItem->id; ?>"><?php echo $objItem->p('itemCommentCount','0'); ?></div><a href="javascript:freak_view(<?php echo $objItem->id; ?>,'comm');"><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_disc.png" width="14" height="16" alt="commentaires" border="0" /></a></td>
---[replace]---
					<?php
					// get real number, don't mix it with files ;)
					$objCommentList = new ItemComment();
					$objCommentList->addWhere('itemId='.$objItem->id);
					$objCommentList->loadList();
					?>
					<td><div style="float:right" id="ecomm<?php echo $objItem->id; ?>"><?php echo $objCommentList->rTotal(); ?></div><a href="javascript:freak_view(<?php echo $objItem->id; ?>,'comm');"><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_disc.png" width="14" height="16" alt="commentaires" border="0" /></a></td>