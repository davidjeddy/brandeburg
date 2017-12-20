<table class="table_actions" cellpadding="0" cellspacing="0">
<tr valign="top" height="130">
  <td class="td_files" width="170" align="center"><img src="<?php echo $thumb ?>" width="<?php echo $thumb_width ?>" height="<?php echo $thumb_height ?>" alt="" title="" <?php echo $class ?> /><br /></td>
  <td class="td_actions" align="center">
    <p><?php echo $this->lang['deletefolder'] ?> '<?php echo $this->getfoldername($_REQUEST['deletefolder']) ?>'?</p>
    <a href="admin.php?list=<?php echo $_REQUEST['deletefolder'] ?>" target="_self"><img src="skins/admin/images/cancel.gif" width="24" height="24" alt="<?php echo $mg2->lang['cancel'] ?>" title="<?php echo $mg2->lang['cancel'] ?>" border="0" /></a>
    <a href="admin.php?erasefolder=<?php echo $_REQUEST['deletefolder'] ?>&amp;list=<?php echo $_REQUEST['list'] ?>" target="_self"><img src="skins/admin/images/ok.gif" width="24" height="24" alt="<?php echo $mg2->lang['ok'] ?>" title="<?php echo $mg2->lang['ok'] ?>" border="0" /></a>
  </td>
</tr>
</table>
