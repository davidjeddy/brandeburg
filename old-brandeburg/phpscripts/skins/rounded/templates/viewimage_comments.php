<br />
<br />
<form action="<?php echo $mg2->indexfile ?>" method="post">
<table cellspacing="0" class="table-comments" align="center">
<?php if (is_file("pictures/" . $result[0][1] . ".comment")) { ?>
<tr height="30">
  <td align="center">
    <b><? echo $mg2->lang['comments'] ?></b>
  </td>
</tr>
<?php for ($x=0; $x < count($mg2->comments); $x++) { ?>
<tr>
  <td class="comment-aboveline"><?php echo date($mg2->dateformat, $mg2->comments[$x][0]) ?>
  <?php echo $mg2->lang['by'] ?>
  <a href="mailto:<?php echo $mg2->comments[$x][2] ?>"><?php echo $mg2->comments[$x][1] ?></a></td>
</tr>
<tr>
  <td class="comment-belowline"><?php echo $mg2->comments[$x][3] ?></td>
</tr>
<?php } } ?>
<tr>
  <td align="center">
    <br /><b><?php echo $mg2->lang['addcomment'] ?></b>
  </td>
</tr>
<tr>
  <td>
      <?php echo $mg2->lang['comment'] ?><br />
<!--      <input type="text" size="90" name="input" class="comment-textfield" /> -->
      <textarea cols="68" rows="3" name="input" class="comment-textfield"></textarea>
  </td>
</tr>
<tr>
  <td>
      <?php echo $mg2->lang['name'] ?><br />
      <input type="text" size="90" name="name" class="comment-textfield" />
  </td>
</tr>
<tr>
  <td>
      <?php echo $mg2->lang['email'] ?><br />
      <input type="text" size="90" name="email" class="comment-textfield" /><br /><br />
      <input type="hidden" name="action" value="addcomment" />
      <input type="hidden" name="filename" value="<?php echo $result[0][1] ?>" />
      <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>" />
      <input type="submit" value="<?php echo $mg2->lang['addcomment'] ?>" class="comment-button" />
  </td>
</tr>
</table>
</form>

