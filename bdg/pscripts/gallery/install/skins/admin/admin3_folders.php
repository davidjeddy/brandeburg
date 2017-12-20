<tr valign="top">
  <td class="td_div">&nbsp;</td>
  <td class="td_files" width="50" align="center"><a href="admin.php?editfolder=<?php echo $folders[$i][0] ?>" target="_self"><?php if ($folders[$i][5] != ""){ ?> <img src="skins/admin/images/folder_small_locked.gif" width="30" height="20" alt="" title="" border="0" /><?php } else if ($folders[$i][7] != ""){ ?> <img src="skins/admin/images/folder_small_thumb.gif" width="30" height="20" alt="" title="" border="0" /></a></td><?php } else { ?> <img src="skins/admin/images/folder_small.gif" width="30" height="20" alt="" title="" border="0" /></a></td><?php } ?>

  <td class="td_files" colspan="2"><a href="admin.php?list=<?php echo $folders[$i][0] ?>" target="_self"><?php echo $folders[$i][2] ?></a></td>
  <td class="td_files" width="130"><?php echo ucfirst($mg2->lang['folder']) ?></td>
  <td class="td_files" width="130"><?php echo date($mg2->dateformat,$folders[$i][6]) ?></td>
  <td class="td_div" width="40" align="center">&nbsp;</td>
  <td class="td_div" width="40" align="center"><a href="admin.php?editfolder=<?php echo $folders[$i][0] ?>" target="_self"><img src="skins/admin/images/edit.gif" width="24" height="24" alt="<?php echo $mg2->lang['edit'] ?>" title="<?php echo $mg2->lang['edit'] ?>" border="0" /></a></td>
  <td class="td_div" width="40" align="center"><a href="admin.php?deletefolder=<?php echo $folders[$i][0] ?>&amp;list=<?php echo $_REQUEST['list'] ?>" target="_self"><img src="skins/admin/images/delete.gif" width="24" height="24" alt="<?php echo $mg2->lang['delete'] ?>" title="<?php echo $mg2->lang['delete'] ?>" border="0" /></a></td>
</tr>
