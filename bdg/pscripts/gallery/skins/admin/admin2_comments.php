<form method="post" name="commentform" action="admin.php">
<table class="table_actions" cellpadding="0" cellspacing="0">
<tr>
  <td class="td_headline" width="40"><?php echo $mg2->lang['delete'] ?></td>
  <td class="td_headline" width="115"><?php echo $mg2->lang['date'] ?></td>
  <td class="td_headline" width="146"><?php echo $mg2->lang['from'] ?></td>
  <td class="td_headline"><?php echo $mg2->lang['comment'] ?></td>
</tr>
<?php for ($x=count($mg2->comments)-1; $x >= 0; $x--) { ?>
<tr>
  <td class="td_files" align="center"><input type="checkbox" name="comment<?php echo $x ?>" value="on" /></td>
  <td class="td_files"><?php echo date($mg2->dateformat, $mg2->comments[$x][0]) ?></td>
  <td class="td_files"><a href="mailto:<?php echo $mg2->comments[$x][2] ?>"><?php echo $mg2->comments[$x][1] ?></a></td>
  <td class="td_files"><?php echo $mg2->comments[$x][3] ?></td>
</tr>
<?php } ?>
<tr>
  <td class="td_files" colspan="4" align="center">
    <input type="hidden" name="filename" value="<?php echo $result[0][1] ?>" />
    <input type="hidden" name="action" value="deletecomments" />
    <input type="hidden" name="list" value="<?php echo $_REQUEST['list'] ?>" />
    <input type="hidden" name="totalcomments" value="<?php echo count($mg2->comments) ?>" />
    <input type="image" src="skins/admin/images/delete.gif" class="adminpicbutton" alt="<?php echo $mg2->lang['delete'] ?>" title="<?php echo $mg2->lang['delete'] ?>" />
  </td>
</tr>
</table>
</form>
