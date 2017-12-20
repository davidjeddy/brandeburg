<table class="table_actions" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td class="td_files" width="170" align="center"><img src="pictures/<?php echo $mg2->thumb($result[0][1]) ?>" width="<?php echo $result[0][8] ?>" height="<?php echo $result[0][9] ?>" alt="" title="" class="thumb" /></td>
  <td class="td_actions" align="center">
    <p><?php echo $mg2->lang['delete'] ?> '<?php echo $result[0][1] ?>'?</p>
    <a href="admin.php?list=<?php echo $_REQUEST['list'] ?>" target="_self"><img src="skins/admin/images/cancel.gif" width="24" height="24" alt="<?php echo $mg2->lang['cancel'] ?>" title="<?php echo $mg2->lang['cancel'] ?>" border="0" /></a>
    <a href="admin.php?action=deleteID&amp;id=<?php echo $_REQUEST['deleteID'] ?>" target="_self"><img src="skins/admin/images/ok.gif" width="24" height="24" alt="<?php echo $mg2->lang['ok'] ?>" title="<?php echo $mg2->lang['ok'] ?>" border="0" /></a>
  </td>
</tr>
</table>
