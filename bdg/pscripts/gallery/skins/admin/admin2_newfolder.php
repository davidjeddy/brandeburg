<form action="admin.php" method="post" enctype="multipart/form-data">
<table class="table_actions" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td class="td_actions" width="100"><?php echo $mg2->lang['newfolder'] ?><br /><br /><?php echo $mg2->lang['password'] ?></td>
  <td class="td_actions">
    <input type="text" name="name" value="<?php echo $folder ?>" size="30" class="admintext" />
    <br />
    <input type="password" name="password" value="" size="30" class="admintext" />
    <input type="hidden" name="list" value="<?php echo $_REQUEST['list'] ?>" />
    <input type="hidden" name="action" value="makefolder" />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
  </td>
  <td class="td_actions" width="100"><?php echo $mg2->lang['sortby'] ?><br /><br /><br /><br /><br /><br /><br /><br /><br /><?php echo $mg2->lang['direction'] ?></td>
  <td class="td_actions">
    <select size="7" name="sortby" class="admindropdown">
      <option value="1" selected="selected"><?php echo $mg2->lang['filename'] ?></option>
      <option value="3"><?php echo $mg2->lang['description'] ?></option>
      <option value="5"><?php echo $mg2->lang['filesize'] ?></option>
      <option value="6"><?php echo $mg2->lang['width'] ?></option>
      <option value="7"><?php echo $mg2->lang['height'] ?></option>
      <option value="10"><?php echo $mg2->lang['date'] ?></option>
    </select>
    <br />
    <br />
    <select size="2" name="direction" class="admindropdown">
      <option value="0" selected="selected"><?php echo $mg2->lang['ascending'] ?></option>
      <option value="1"><?php echo $mg2->lang['descending'] ?></option>
    </select><br />
  </td>
</tr>
<tr>
  <td colspan="4" align="center" class="td_actions">
    <a href="admin.php" target="_self"><img src="skins/admin/images/cancel.gif" width="24" height="24" alt="<?php echo $mg2->lang['cancel'] ?>" title="<?php echo $mg2->lang['cancel'] ?>" border="0" class="adminpicbutton"  /></a>
    <input type="image" src="skins/admin/images/ok.gif" class="adminpicbutton" alt="<?php echo $mg2->lang['ok'] ?>" title="<?php echo $mg2->lang['ok'] ?>" />
  </td>
</tr>
</table>
</form>
