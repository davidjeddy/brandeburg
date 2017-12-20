<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <title><?php $mg2->output(gallerytitle) ?></title>
  <meta name="title" content="<?php $mg2->output(gallerytitle) ?>" />
  <meta name="robots" content="noindex,nofollow" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="skins/<?php $mg2->output(activeskin) ?>/css/style.css" rel="stylesheet" type="text/css"></link>
</head>
<body class="mg2body">
<table cellspacing="0" cellpadding="0" class="table-top" width="100%">
<tr>
  <td class="navigation">
        <a href="<?php $mg2->output(indexfile) ?>?slideshow=<?php $mg2->output(startimage) ?>"><img src="skins/<?php $mg2->output(activeskin) ?>/images/slideshow.gif" width="16" height="16" alt="<?php echo $mg2->lang['viewslideshow'] ?>" title="<?php echo $mg2->lang['viewslideshow'] ?>" border="0" align="absmiddle" /></a><?php $mg2->gallerynavigation(">") ?>
  </td>
  <td class="table-headline"><?php $mg2->output(title) ?></td>
</tr>
</table>
<div align="center">
  <? $mg2->output(nav_first) ?> &nbsp;
  <? $mg2->output(nav_prev) ?> &nbsp;
  <? $mg2->output(nav_current) ?> <? echo $mg2->lang['of'] ?> <? $mg2->output(nav_total) ?> &nbsp;
  <? $mg2->output(nav_next) ?> &nbsp;
  <? $mg2->output(nav_last) ?>
</div>
<table cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td class="dir_topleft"></td>
    <td class="dir_top" width="<?php $mg2->output(width) ?>"></td>
    <td class="dir_topright">
      <?php if($mg2->fullsizelink != "") { ?>
      <a href="pictures/<?php echo $result[0][1] ?>" target="_blank"><img src="skins/<?php echo $mg2->activeskin ?>/images/dir_topright_resized.gif" border="0" width="26" height="26" alt="<?php echo $mg2->lang['fullsize'] ?>" title="<?php echo $mg2->lang['fullsize'] ?>" /></a><?php } ?></td>
  </tr>
  <tr>
    <td class="dir_left"></td>
    <td class="viewimage"><a href="<?php $mg2->output(link) ?>" target="<?php $mg2->output(target) ?>" title="<?php echo $title ?>"><img src="<?php $mg2->output(imagefile) ?>" border="0" width="<?php $mg2->output(width) ?>" height="<?php $mg2->output(height) ?>" alt="" title="" /></a></td>
    <td class="dir_right"></td>
  </tr>
  <tr>
    <td class="dir_bottomleft"></td>
    <td class="dir_bottom" width="<?php $mg2->output(width) ?>"></td>
    <td class="dir_bottomright"></td>
  </tr>
</table>
<div class="description"><?php $mg2->output(description) ?></div><br />
<div class="copyright"><?php $mg2->output(copyright) ?></div>

