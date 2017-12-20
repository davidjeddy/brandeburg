<html>
<body>
<table border="0">
<TR>
		<td colspan="2"><?PHP include('/var/www/html/live-bdg/includes/topbar.php'); ?></TD>
	</TR>
	<tr>
		<td colspan="2" align="center"><h2><?php echo $currentfolder ?></h2></td>
	</tr>
	<tr align="center">
		<td colspan="2">

<?php if ($mg2->introtext != "") { ?>
<?php $mg2->output(introtext) ?>
<?php } ?>
<?php $mg2->pagenavigation($pages, $list); ?>
		</td>
	</tr>
	
	