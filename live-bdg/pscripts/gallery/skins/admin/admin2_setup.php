<form action="admin.php" method="post" enctype="multipart/form-data">
<table class="table_actions" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td class="td_headline" colspan="2"><?php echo $this->lang['setup'] ?></td>
</tr>
<tr valign="top">
  <td class="td_setup" width="300"><?php echo $this->lang['gallerytitle'] ?></td>
  <td class="td_setup">
    <input type="text" name="gallerytitle" value="<?php echo $this->gallerytitle ?>" size="80" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['adminemail'] ?></td>
  <td class="td_setup">
    <input type="text" name="adminemail" value="<?php echo $this->adminemail ?>" size="80" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['language'] ?></td>
  <td class="td_setup">
    <select size="1" name="defaultlang" class="admindropdown">
<?php
  for ($i=0; $i < count($lang); $i++){
?>
      <option value="<?php echo $lang[$i] ?>" <?php if($lang[$i] == "$this->defaultlang") echo "selected=\"selected\"" ?>><?php echo ucfirst(substr($lang[$i],0,strlen($lang[$i])-4)) ?></option>
<?php
}
?>
    </select>
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['skin'] ?></td>
  <td class="td_setup">
    <select size="1" name="activeskin" class="admindropdown">
<?php
  for ($i=0; $i < count($skins); $i++){
?>
      <option value="<?php echo $skins[$i] ?>" <?php if($skins[$i] == "$this->activeskin") echo "selected=\"selected\"" ?>><?php echo ucfirst($skins[$i]) ?></option>
<?php
}
?>
    </select>
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['dateformat'] ?></td>
  <td class="td_setup">
    <select size="1" name="dateformat" class="admindropdown">
      <option value="j M Y" <?php if($this->dateformat == "j M Y") echo "selected=\"selected\"" ?>><?php echo $this->lang['DDMMYY'] ?></option>
      <option value="M j, Y" <?php if($this->dateformat == "M j, Y") echo "selected=\"selected\"" ?>><?php echo $this->lang['MMDDYY'] ?></option>
      <option value="j.m.y" <?php if($this->dateformat == "j.m.y") echo "selected=\"selected\"" ?>><?php echo $this->lang['DD.MM.YY'] ?></option>
      <option value="m.j.y" <?php if($this->dateformat == "m.j.y") echo "selected=\"selected\"" ?>><?php echo $this->lang['MM.DD.YY'] ?></option>
      <option value="Ymd" <?php if($this->dateformat == "Ymd") echo "selected=\"selected\"" ?>><?php echo $this->lang['YYYYMMDD'] ?></option>
    </select>
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['marknew'] ?></td>
  <td class="td_setup">
    <input type="text" name="marknew" value="<?php echo $this->marknew ?>" size="5" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['sendmail'] ?></td>
  <td class="td_setup">
    <input type="checkbox" name="sendmail" <?php if($this->sendmail == "1") echo "checked=\"checked\"" ?> value="1" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['foldericons'] ?></td>
  <td class="td_setup">
    <input type="checkbox" name="foldericons" <?php if($this->foldericons == "1") echo "checked=\"checked\"" ?> value="1" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['showexif'] ?></td>
  <td class="td_setup">
    <input type="checkbox" name="showexif" <?php if($this->showexif == "1") echo "checked=\"checked\"" ?> value="1" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['allowcomments'] ?></td>
  <td class="td_setup">
    <input type="checkbox" name="showcomments" <?php if($this->showcomments == "1") echo "checked=\"checked\"" ?> value="1" />
  </td>
</tr>
<tr>
  <td class="td_setup_bottom" width="300"><?php echo $this->lang['copyright'] ?><br /><br /></td>
  <td class="td_setup_bottom">
    <input type="text" name="copyright" value="<?php echo $this->copyright ?>" size="80" class="admintext" /><br /><br />
  </td>
</tr>
<tr valign="top">
  <td class="td_headline" colspan="2"><?php echo $this->lang['passwordchange'] ?></td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['oldpasswordsetup'] ?></td>
  <td class="td_setup">
    <input type="password" name="oldpassword" value="" size="20" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['newpasswordsetup'] ?></td>
  <td class="td_setup">
    <input type="password" name="password" value="" size="20" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup_bottom" width="300"><?php echo $this->lang['newpasswordsetupconfirm'] ?></td>
  <td class="td_setup_bottom">
    <input type="password" name="passwordconfirm" value="" size="20" class="admintext" />
  </td>
</tr>
<tr>
  <td colspan="2" align="center" class="td_actions">
    <input type="hidden" name="action" value="writesetup" />
    <div align="center">
    <a href="admin.php" target="_self"><img src="skins/admin/images/cancel.gif" width="24" height="24" alt="<?php echo $this->lang['cancel'] ?>" title="<?php echo $this->lang['cancel'] ?>" border="0" class="adminpicbutton"  /></a>
    <input type="image" src="skins/admin/images/ok.gif" class="adminpicbutton" alt="<?php echo $this->lang['ok'] ?>" title="<?php echo $this->lang['ok'] ?>" />
    </div>
  </td>
</tr>
<tr valign="top">
  <td class="td_headline" colspan="2"><?php echo $this->lang['advanced'] ?></td>
</tr>
<tr valign="top">
  <td class="td_setup" width="300"><?php echo $this->lang['allowedextensions'] ?></td>
  <td class="td_setup">
    <input type="text" name="extensions" value="<?php echo $this->extensions ?>" size="80" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['imgwidth'] ?></td>
  <td class="td_setup">
    <input type="text" name="mediumimage" value="<?php echo $this->mediumimage ?>" size="20" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['indexfile'] ?></td>
  <td class="td_setup">
    <input type="text" name="indexfile" value="<?php echo $this->indexfile ?>" size="20" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['thumbquality'] ?></td>
  <td class="td_setup">
    <input type="text" name="thumbquality" value="<?php echo $this->thumbquality ?>" size="10" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['imagecolumns'] ?></td>
  <td class="td_setup">
    <input type="text" name="imagecolumns" value="<?php echo $this->imagecolumns ?>" size="5" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['imagerows'] ?></td>
  <td class="td_setup">
    <input type="text" name="imagerows" value="<?php echo $this->imagerows ?>" size="5" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup" width="300"><?php echo $this->lang['slideshowdelay'] ?></td>
  <td class="td_setup">
    <input type="text" name="slideshowdelay" value="<?php echo $this->slideshowdelay ?>" size="5" class="admintext" />
  </td>
</tr>
<tr>
  <td class="td_setup_bottom" width="300"><?php echo $this->lang['websitelink'] ?></td>
  <td class="td_setup_bottom">
    <input type="text" name="websitelink" value="<?php echo $this->websitelink ?>" size="30" class="admintext" />
  </td>
</tr>
<tr valign="top">
  <td class="td_headline" colspan="2"><?php echo $this->lang['actions'] ?></td>
</tr>
<tr>
  <td class="td_setup_bottom" colspan="2">
    - <a href="admin.php?action=dbbackup" target="_self"><?php echo $this->lang['backuplink'] ?></a><br />
    - <a href="mg2_log.txt" target="_blank"><?php echo $this->lang['viewlogfile'] ?></a> (<?php if (is_file("mg2_log.txt")) echo round(filesize("mg2_log.txt") / 1000,1); ?> KB)
  </td>
</tr>
</table>
</form>
