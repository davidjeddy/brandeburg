<table class="table_credits" cellpadding="0" cellspacing="0">
<tr>
  <td class="td_files" width="34" align="center">
    <img src="skins/admin/images/checkbox_on.gif" width="13" height="13" alt="<? echo $MGadmin->lang["checkall"] ?>" title="<? echo $MGadmin->lang["checkall"] ?>" onclick="checkAll()" />
    <img src="skins/admin/images/checkbox_off.gif" width="13" height="13" alt="<? echo $MGadmin->lang["uncheckall"] ?>" title="<? echo $MGadmin->lang["uncheckall"] ?>" onclick="uncheckAll()" />
  </td>
  <td class="td_files">
    <select size="1" name="moveto" class="admindropdown">
<?php
  for ($i=0; $i < count($mg2->sortedfolders); $i++){
?>
      <option value="<?php echo $mg2->sortedfolders[$i][1] ?>"><?php echo $mg2->sortedfolders[$i][0] ?></option>
<?php
}
?>
    </select>
    <input type="hidden" name="selectsize" value="<? echo $totalfiles ?>" />
    <input type="hidden" name="action" value="movefiles" />
    <input type="hidden" name="list" value="<?php echo $_REQUEST['list'] ?>" />
    <input type="submit" name="submit" value="<?php echo $mg2->lang['buttonmove'] ?>" class="adminbutton" alt="<?php echo $mg2->lang['ok'] ?>" title="<?php echo $mg2->lang['ok'] ?>" />
    <input type="submit" name="submit" value="<?php echo $mg2->lang['buttondelete'] ?>" class="adminbutton" alt="<?php echo $mg2->lang['delete'] ?>" title="<?php echo $mg2->lang['delete'] ?>" onclick="return confirmSubmit()" />
  </td>
</tr>
</table>
</form>
