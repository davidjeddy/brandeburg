<html>
<!--displays actual image-->

<table>
	<tr>
		<td colspan="2">

<?PHP include('./live-bdg/includes/topbar.php'); ?>
		</td>
	</tr>
</table>
<table border="0" cellspacing="7" cellpadding="7"  width="75%">
<tr>
  <td align="center"><h4><?php $mg2->output(title) ?></h4></td>
</tr>
<TR><TD align="center">

  <? $mg2->output(nav_first) ?> &nbsp;
  <? $mg2->output(nav_prev) ?> &nbsp;
  <? $mg2->output(nav_current) ?> <? echo $mg2->lang['of'] ?> <? $mg2->output(nav_total) ?> &nbsp;
  <? $mg2->output(nav_next) ?> &nbsp;
  <? $mg2->output(nav_last) ?> &nbsp;
</TD></TR>
<tr><td><HR color="#000000" /></td></tr>
  <tr>
<td >
<?php $mg2->output(description) ?>
</td></tr>
  <tr>
    <td align="center"><img src="<?php $mg2->output(imagefile) ?>" border="0" width="<?php $mg2->output(width) ?>" height="<?php $mg2->output(height) ?>" alt="" title="" /></td>
  </tr>
<tr><td><HR color="#000000" /></td></tr>	
