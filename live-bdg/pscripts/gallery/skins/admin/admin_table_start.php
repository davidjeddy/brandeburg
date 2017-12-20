<?php
if($class=="table_files"){
?>
<form method="post" name="fileform" action="admin.php">
<?php }?>
<table class="<?php echo $class ?>" cellpadding="0" cellspacing="0">
<?php
if($class=="table_files"){
?>
<tr>
  <td class="td_navigation" colspan="7"><?php echo $mg2->lang['navigation'] ?>: <?php $mg2->adminnavigation() ?> : <?php echo count($result) ?> <?php echo $mg2->lang['images'] ?> <?php $mg2->adminpagenavigation($pages) ?></td>
  <td class="td_div"><a href="admin.php?editfolder=<?php if ($_REQUEST['list'] != "")echo $_REQUEST['list']; else echo "root"; ?>" target="_self"><img src="skins/admin/images/edit.gif" width="24" height="24" alt="<?php echo $mg2->lang['editcurrentfolder'] ?>" title="<?php echo $mg2->lang['editcurrentfolder'] ?>" border="0" /></a></td>
<?php if ($_REQUEST['list'] != 1) {?>
  <td class="td_div"><a href="admin.php?deletefolder=<?php echo $_REQUEST['list'] ?>" target="_self"><img src="skins/admin/images/delete.gif" width="24" height="24" alt="<?php echo $mg2->lang['deletecurrentfolder'] ?>" title="<?php echo $mg2->lang['deletecurrentfolder'] ?>" border="0" /></a></td>
<?php } else { ?>
  <td class="td_div">&nbsp;</td>
<?php } ?>
</tr>
<tr>
  <td class="td_headline" width="30">&nbsp;</td>
  <td class="td_headline" width="40"><?php echo $mg2->lang['thumb'] ?></td>
  <td class="td_headline" colspan="2"><?php echo $mg2->lang['filename'] ?></td>
  <td class="td_headline" width="130"><?php echo $mg2->lang['filesize'] ?></td>
  <td class="td_headline" width="130"><?php echo $mg2->lang['dateadded'] ?></td>
  <td class="td_headline" width="40"><?php echo $mg2->lang['rebuild'] ?></td>
  <td class="td_headline" width="40"><?php echo $mg2->lang['edit'] ?></td>
  <td class="td_headline" width="40"><?php echo $mg2->lang['delete'] ?></td>
</tr>
<?
}
?>
