<form action="admin.php" method="post" enctype="multipart/form-data">
<table class="table_actions" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td class="td_headline" colspan="5"><?php echo $this->lang['editfolder'] ?></td>
</tr>
<tr valign="top">
  <td rowspan="5" class="td_files" width="170" align="center">
    <a href="<?php echo $this->indexfile ?>?list=<?php echo $_REQUEST['editfolder'] ?>" target="_blank">
      <img src="<?php echo $thumb ?>" width="<?php echo $thumb_width ?>" height="<?php echo $thumb_height ?>" alt="<?php echo $this->lang['viewfolder'] ?>" title="<?php echo $this->lang['viewfolder'] ?>" <?php echo $class ?> border="0" /><br />
    </a>
<?php
if ($result[0][7] != "" && $_REQUEST['editfolder'] != "1"){
?>
<?php echo $this->lang['deletethumb'] ?>
<input type="checkbox" name="deletethumb" value="1" />

<?
}
?>
  </td>
  <td class="td_actions_noborder" width="100"><?php echo $this->lang['foldername'] ?></td>
  <td class="td_actions_noborder">
<?php if ($_REQUEST['editfolder'] != "1") { ?>
    <input type="text" name="name" value="<?php echo $folder ?>" size="40" class="admintext" />
<?php }else echo $this->lang['root']; ?>
  </td>
  <td rowspan="4" class="td_actions_noborder" width="100"><?php echo $this->lang['sortby'] ?></td>
  <td rowspan="4" class="td_actions_noborder">
    <select size="7" name="sortby" class="admindropdown">
      <option value="1" <?php if($result[0][3] == "1") echo "selected" ?>><?php echo $this->lang['filename'] ?></option>
      <option value="3" <?php if($result[0][3] == "3") echo "selected" ?>><?php echo $this->lang['description'] ?></option>
      <option value="5" <?php if($result[0][3] == "5") echo "selected" ?>><?php echo $this->lang['filesize'] ?></option>
      <option value="6" <?php if($result[0][3] == "6") echo "selected" ?>><?php echo $this->lang['width'] ?></option>
      <option value="7" <?php if($result[0][3] == "7") echo "selected" ?>><?php echo $this->lang['height'] ?></option>
      <option value="10" <?php if($result[0][3] == "10") echo "selected" ?>><?php echo $this->lang['date'] ?></option>
    </select>
  </td>
</tr>
<tr>
  <td class="td_actions_noborder" width="100"><?php echo $this->lang['newpassword'] ?></td>
  <td class="td_actions_noborder">
    <input type="password" name="password" value="" size="40" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_actions_noborder" width="100"><?php echo $this->lang['deletepassword'] ?></td>
  <td class="td_actions_noborder">
    <input type="checkbox" name="deletepassword" value="1" />
  </td>
</tr>
<tr>
<?php if ($_REQUEST['editfolder'] != "1") { ?>
  <td class="td_actions_noborder" width="100"><?php echo $this->lang['moveto'] ?></td>
<? }else echo "<td class=\"td_actions_noborder\" width=\"100\">&nbsp;</td>"; ?>
  <td class="td_actions_noborder">
<?php if ($_REQUEST['editfolder'] != "1") { ?>
    <select size="1" name="moveto" class="admindropdown">
<?php
  for ($i=0; $i < count($this->sortedfolders); $i++){
    if ($this->sortedfolders[$i][1] != $_REQUEST['editfolder']) {
?>
      <option value="<?php echo $this->sortedfolders[$i][1];?>"<?php if ($this->sortedfolders[$i][1] == $this->parentid) {echo " selected";} ?> ><?php echo $this->sortedfolders[$i][0] ?></option>
<?php
    }
  }
?>
    </select>
<?php   } else echo "&nbsp;"; ?>
  </td>
</tr>
<tr>
  <td class="td_actions" width="100"><?php echo $this->lang['introtext'] ?></td>
  <td class="td_actions"><table class="table_wysiwyg_folder"><tr><td>
    <textarea id="editor" cols="60" rows="10" name="introtext" class="admindropdown"><?php echo $introtext ?></textarea>
  </td></tr></table></td>
  <td class="td_actions" width="100"><?php echo $this->lang['direction'] ?></td>
  <td class="td_actions">
    <select size="2" name="direction" class="admindropdown">
    <option value="0" <?php if($result[0][4] == "0") echo "selected" ?>><?php echo $this->lang['ascending'] ?></option>
    <option value="1" <?php if($result[0][4] == "1") echo "selected" ?>><?php echo $this->lang['descending'] ?></option>
    </select>
  </td>
</tr>
<tr>
  <td colspan="5" align="center" class="td_actions">
    <a href="admin.php" target="_self"><img src="skins/admin/images/cancel.gif" width="24" height="24" alt="<?php echo $this->lang['cancel'] ?>" title="<?php echo $this->lang['cancel'] ?>" border="0" class="adminpicbutton"  /></a>
    <input type="image" src="skins/admin/images/ok.gif" class="adminpicbutton" alt="<?php echo $this->lang['ok'] ?>" title="<?php echo $this->lang['ok'] ?>" />
    <input type="hidden" name="list" value="<?php echo $_REQUEST['editfolder'] ?>" />
    <input type="hidden" name="action" value="updatefolder" />
  </td>
</tr>
</table>
</form>

