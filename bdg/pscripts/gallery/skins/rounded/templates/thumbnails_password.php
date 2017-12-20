  <td>
    <div align="center">
      <form name="login" method="post" action="<?php if(isset($_REQUEST['list'])) {?>index.php?list=<?php echo $_REQUEST['list']; }else {?>index.php?id=<?php echo $_REQUEST['id']; } ?>">
        <p><b><?php echo $this->lang['enterpassword'] ?></b></p>
        <p><?php echo $this->lang['thissection'] ?></p>
        <p><input type="password" name="password" class="comment-textfield" /></p>
        <p><input type="image" src="skins/<?php echo $this->activeskin ?>/images/ok.gif" class="adminpicbutton" alt="<?php echo $this->lang['ok'] ?>" title="<?php echo $this->lang['ok'] ?>" /></p>
      </form>
    </div>
  </td>
</tr>
</table>
</body>
</html>

