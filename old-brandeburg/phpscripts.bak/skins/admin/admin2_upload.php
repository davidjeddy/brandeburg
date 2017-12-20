<form action="admin.php" method="post" enctype="multipart/form-data">
<table class="table_actions" cellpadding="0" cellspacing="0">
<? for ($x = 0; $x < 10; $x++) { ?>
<tr class="admintdleft">
  <td colspan="2" class="td_actions"><?php echo $mg2->lang['image'] ?> <? echo $x+1 ?></td>
  <td colspan="8" class="td_actions"><input type="file" name="file<? echo $x ?>" size="80" class="admintext" /></td>
</tr>
<? } ?>
<tr>
  <td class="td_actions" align="center" colspan="10">
    <input type="hidden" name="list" value="<? echo $_REQUEST['uploadto'] ?>" />
    <input type="hidden" name="action" value="upload" />
    <a href="admin.php?list=<?php echo $_REQUEST['list'] ?>"><img src="skins/admin/images/cancel.gif" class="adminpicbutton" width="24" height="24" border="0" alt="<?php echo $mg2->lang['cancel'] ?>" title="<?php echo $mg2->lang['cancel'] ?>" /></a>
    <input type="image" src="skins/admin/images/ok.gif" class="adminpicbutton" alt="<?php echo $mg2->lang['upload'] ?>" title="<?php echo $mg2->lang['upload'] ?>" />
  </td>
</tr>
</table>
</form>

