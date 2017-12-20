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
    <!--<a href="<?php $mg2->output(indexfile) ?>?slideshow=<?php $mg2->output(startimage) ?>"><img src="skins/<?php $mg2->output(activeskin) ?>/images/slideshow.gif" width="16" height="16" alt="<?php echo $mg2->lang['viewslideshow'] ?>" title="<?php echo $mg2->lang['viewslideshow'] ?>" border="0" align="absmiddle" /></a><?php $mg2->gallerynavigation(">") ?>-->
  </td>
  <td class="table-headline"><?php echo $currentfolder ?></td></tr>
</table>
<br />
<?php if ($mg2->introtext != "") { ?>
<div class="introtext"><?php $mg2->output(introtext) ?></div>
<?php } ?>
<?php $mg2->pagenavigation($pages, $list); ?>
<table cellspacing="0" cellpadding="0" align="center">
 <tr>

