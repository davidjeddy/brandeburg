<tr valign="top">
  <td class="td_div" width="30" align="center"><input type="checkbox" name="selectfile<?php echo $i ?>" value="<?php echo $result[$i][1] ?>" /></td>
  <td class="td_files" width="50" align="center"><a href="admin.php?editID=<?php echo $result[$i][0] ?>" target="_self"><img src="pictures/<?php echo $mg2->thumb($result[$i][1]) ?>" width="<?php echo $result[$i][8] / 5 ?>" height="<?php echo $result[$i][9] / 5 ?>" alt="" title="" class="thumb" /></a></td>
  <td class="td_files" colspan="2"><?php echo $result[$i][1] ?></td>
  <td class="td_files" width="130"><?php echo $filesize ?></td>
  <td class="td_files" width="130" align="left"><?php echo date($mg2->dateformat,$result[$i][10]) ?></td>
  <td class="td_div" width="40" align="center"><a href="admin.php?rebuildID=<?php echo $result[$i][0] ?>" target="_self"><img src="skins/admin/images/rebuild.gif" width="24" height="24" alt="<?php echo $mg2->lang['rebuildimages'] ?>" title="<?php echo $mg2->lang['rebuildimages'] ?>" border="0" /></a></td>
  <td class="td_div" width="40" align="center"><a href="admin.php?editID=<?php echo $result[$i][0] ?>" target="_self">
  <?php if ($result[$i][3] != "" || $result[$i][4] != "" || is_file($result[$i][1] . ".comment")) { ?>
    <img src="skins/admin/images/edit.gif" width="24" height="24" alt="<?php echo $mg2->lang['edit'] ?>" title="<?php echo $mg2->lang['edit'] ?>" border="0" />
  <?php }else { ?>
    <img src="skins/admin/images/edit_dimmed.gif" width="24" height="24" alt="<?php echo $mg2->lang['edit'] ?>" title="<?php echo $mg2->lang['edit'] ?>" border="0" />
  <?php } ?>
  </a></td>
  <td class="td_div" width="40" align="center"><a href="admin.php?deleteID=<?php echo $result[$i][0] . "&amp;list=" . $_REQUEST['list'] ?>" target="_self"><img src="skins/admin/images/delete.gif" width="24" height="24" alt="<?php echo $mg2->lang['delete'] ?>" title="<?php echo $mg2->lang['delete'] ?>" border="0" /></a></td>
</tr>
