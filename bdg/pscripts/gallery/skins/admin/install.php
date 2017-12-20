<?php if ($_REQUEST['step'] == "") { ?>
<table class="table_menu" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td align="center" colspan="2">
    <p><strong>Welcome to MG2 installation <?php echo $step ?> / 3</strong></p>
    <p>This script will help you configure MG2 in 3 easy steps.</p>
  </td>
</tr>
<tr valign="bottom">
  <td align="left" class="install_td" width="300">
  <br />
    Gallery folder writable:
  </td>
  <td align="left">
    <?php echo $test1 ?>
  </td>
</tr>
<tr valign="top">
  <td align="left" class="install_td" width="300">
    'pictures' subfolder writable:
  </td>
  <td align="left">
    <?php echo $test2 ?>
  </td>
</tr>
<tr valign="top">
  <td align="left" class="install_td" width="300">
    Main gallery files exists:
  </td>
  <td align="left">
    <?php echo $test3 ?>
  </td>
</tr>
<tr valign="top">
  <td align="left" class="install_td" width="300">
    GD image library version 2.x or newer:
  </td>
  <td align="left">
    <?php echo $test4 ?>
  </td>
</tr>
<?php if ($todo != "") { ?>
<tr valign="bottom" height="30">
  <td align="left" class="install_td" colspan="2">
    You must complete these steps before continuing:
  </td>
</tr>
<tr valign="top">
  <td align="left" class="install_td" colspan="2">
  <b><?php echo $todo ?></b>
  </td>
</tr>
<?php } ?>
<?php if ($todo == "") { ?>
<tr valign="top">
  <td align="center" colspan="2">
    <form action="mg2_install.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="step" value="2" />
    <input type="image" src="skins/admin/images/ok.gif" class="adminpicbutton" alt="Next" title="Next" />
    </form>
  </td>
</tr>
</table>
<?php } ?>
<?php } ?>

<?php if ($_REQUEST['step'] == "2") { ?>
<form action="mg2_install.php" method="post" enctype="multipart/form-data">
<table class="table_menu" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td align="center" colspan="2">
    <p><strong>Welcome to MG2 installation <?php echo $_REQUEST['step'] ?> / 3</strong><br /><br /><br /></p>
  </td>
</tr>
<tr valign="bottom">
  <td width="200" class="install_td">Gallery title</td>
  <td>
    <input type="text" name="gallerytitle" value="My gallery" size="80" class="admintext" />
  </td>
</tr>
<tr valign="middle">
  <td class="install_td" width="200">Admin email</td>
  <td>
    <input type="text" name="adminemail" value="" size="80" class="admintext" />
  </td>
</tr>
<tr>
  <td class="install_td" width="200">Default language</td>
  <td>
    <select size="1" name="defaultlang" class="admindropdown">
<?php
  for ($i=0; $i < count($lang); $i++){
?>
      <option value="<?php echo $lang[$i] ?>" <?php if($lang[$i] == "english.php") echo "selected=\"selected\"" ?>><?php echo ucfirst(substr($lang[$i],0,strlen($lang[$i])-4)) ?></option>
<?php
}
?>
    </select>
  </td>
</tr>
<tr>
  <td class="install_td" width="200">Enter password (default = 1234)</td>
  <td>
    <input type="password" name="password" value="1234" size="20" class="admintext" />
  </td>
</tr>
<tr>
  <td align="center" colspan="2">
    <input type="hidden" name="step" value="3" />
    <input type="image" src="skins/admin/images/ok.gif" class="adminpicbutton" alt="Next" title="Next" />
  </td>
</tr>
</table>
</form>
<?php } ?>

<?php if ($_REQUEST['step'] == "3") { ?>
<table class="table_menu" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td align="center" colspan="2">
    <p><strong>Welcome to MG2 installation <?php echo $_REQUEST['step'] ?> / 3</strong></p>
    <p>Congratulations, you have successfully installed MG2!</p>
    <p>MG2 has been installed using default settings. You can configure these through the admin panel.</p>
    <p><a href="admin.php" target="_self">Go to admin panel</a></p>
  </td>
</tr>
</table>
<?php } ?>

