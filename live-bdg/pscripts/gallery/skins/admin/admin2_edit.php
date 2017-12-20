<table class="table_actions" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td class="td_headline" colspan="5"><?php echo $mg2->lang['editimage'] ?></td>
</tr>
<tr valign="top">
  <td rowspan="4" class="td_files" width="170" align="center">
    <a href="<?php echo $mg2->indexfile ?>?id=<?php echo $_REQUEST['editID'] ?>" target="_blank">
      <img src="pictures/<?php echo $mg2->thumb($result[0][1]) ?><?php echo "?" . rand(0,10000) ?>" width="<?php echo $result[0][8] ?>" height="<?php echo $result[0][9] ?>" alt="<?php echo $mg2->lang['viewimage'] ?>" title="<?php echo $mg2->lang['viewimage'] ?>" class="thumb" />
    </a><br />
    <a href="admin.php?rotate=<?php echo $_REQUEST['editID'] ?>&amp;direction=left" target="_self"><img src="skins/admin/images/rotateleft.gif" width="24" height="24" alt="<?php echo $mg2->lang['cancel'] ?>" title="<?php echo $mg2->lang['rotateleft'] ?>" border="0" class="adminpicbutton"  /></a>
    <a href="admin.php?rotate=<?php echo $_REQUEST['editID'] ?>&amp;direction=right" target="_self"><img src="skins/admin/images/rotateright.gif" width="24" height="24" alt="<?php echo $mg2->lang['cancel'] ?>" title="<?php echo $mg2->lang['rotateright'] ?>" border="0" class="adminpicbutton"  /></a>
  </td>
  <td class="td_actions_noborder" width="150"><?php echo $mg2->lang['filename'] ?></td>
  <td class="td_actions_noborder">
    <form action="admin.php" method="post" enctype="multipart/form-data">
    <input type="text" name="filename" value="<?php echo $result[0][1] ?>" size="80" class="admintext" />
  </td>
</tr>
<tr>
  <td><?php echo $mg2->lang['title'] ?></td>
  <td class="td_actions_noborder">
	<textarea  cols="78" rows="10" name="title"><?php echo $result[0][3] ?></textarea>
    <!--<input type="text" name="title"  value="<?php echo $result[0][3] ?>" size="256" />-->
  </td>
</tr>
<tr>
  <td class="td_actions_noborder"><?php echo $mg2->lang['description'] ?></td>
  <td class="td_actions_noborder"><table><tr><td>
    <textarea id="editor" cols="78" rows="10" name="description"><?php echo $description ?></textarea>
</td></tr></table></td>
</tr>

<tr>
  <td class="td_actions"><?php echo $mg2->lang['setasthumb'] ?></td>
  
  <td class="td_actions">
    <select size="1" name="setthumb" class="admindropdown">
<?php
  for ($i=0; $i < count($mg2->sortedfolders); $i++){
?>
      <option value="<?php echo $mg2->sortedfolders[$i][1] ?>"><?php echo $mg2->sortedfolders[$i][0] ?></option>
<?php
}
?>
	</select>
  </td>
</tr>

<tr>
  <td colspan="4" align="center" class="td_actions">
    <input type="hidden" name="id" value="<?php echo $result[0][0] ?>" />
    <input type="hidden" name="action" value="editID" />
    <input type="hidden" name="next" value="<?php echo $_REQUEST['next'] ?>" />
    <input type="hidden" name="list" value="<?php echo $_REQUEST['list'] ?>" />
    <a href="admin.php?list=<?php echo $_REQUEST['list'] ?>" target="_self"><img src="skins/admin/images/cancel.gif" width="24" height="24" alt="<?php echo $mg2->lang['cancel'] ?>" title="<?php echo $mg2->lang['cancel'] ?>" border="0" class="adminpicbutton"  /></a>
    <input type="image" src="skins/admin/images/ok.gif" class="adminpicbutton" alt="<?php echo $mg2->lang['ok'] ?>" title="<?php echo $mg2->lang['ok'] ?>" />
    </form>
  </td>
</tr>
<TR><td></td><td></td><TD><h5>*Note:  URL's do not need the base domain; Subfolders only. Start with a forward slash (/).</h5></TD></TR>
</table>

