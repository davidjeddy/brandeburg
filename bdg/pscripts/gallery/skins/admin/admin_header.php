<html>
<head>

<title>ADMIN: <? echo $mg2->gallerytitle; ?></title>
<meta name="title" content="<? echo $mg2->gallerytitle ?>" />
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noarchive,nofollow"></meta>
<?php
if($_REQUEST['action'] == "upload"){
echo "<SCRIPT language=\"JavaScript\"> \n";
echo "<!--\n";
echo "function redirect(){ \n";
echo "  window.location=\"admin.php?action=import&list=" . $_REQUEST['list'] . "\";\n";
echo "} \n";
echo "setTimeout('redirect()',1000); \n";
echo "//--> \n";
echo "</SCRIPT>\n"; 
}
?>
<link href="<?PHP print $httproot ?>css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
<!--
function checkAll() {
  for (var j = 0; j < document.fileform.selectsize.value; j++) {
    box = eval("document.fileform.selectfile" + j);
    if (box.checked == false) box.checked = true;
  }
}
function uncheckAll() {
  for (var j = 0; j < document.fileform.selectsize.value; j++) {
    box = eval("document.fileform.selectfile" + j);
    if (box.checked == true) box.checked = false;
   }
}
function confirmSubmit()
{
var agree=confirm("<?php echo $mg2->lang['deleteconfirm'] ?>");
if (agree)
	return true ;
else
	return false ;
}
 function formFocus() {
  if (document.forms.length > 0)  document.forms[0].elements[0].focus();
}
-->
</script>

<!-- WYSIWYG -->

<script type="text/javascript">
   _editor_url = "skins/admin/wysiwyg/";
   _editor_lang = "en";
</script>

<script type="text/javascript" src="skins/admin/wysiwyg/htmlarea.js"></script>

<script type="text/javascript" defer="1">

var config = new HTMLArea.Config();

//config.width = '400';
config.height = '200px';

	// the following sets a style for the page body (black text on yellow page)
	// and makes all paragraphs be bold by default
//config.pageStyle =
  //'body { background-color: yellow; color: black; font-family: verdana,sans-serif } ' +
  //'p { font-width: bold; } ';


config.toolbar = [
[ //"fontname", "space",
  "fontsize", "space", "formatblock", "space", "textindicator"],

[ "bold", "italic", "underline", "strikethrough", "separator",
  "subscript", "superscript", "separator",
  "forecolor", "hilitecolor"],
  
[ "justifyleft", "justifycenter", "justifyright", "justifyfull", "separator",
  "insertorderedlist", "insertunorderedlist", "outdent", "indent"],
  
[ "inserthorizontalrule", "createlink", "inserttable", "separator", "htmlmode", "separator",
  //"popupeditor", "separator",  
  "space", "space", "showhelp", "about" ]
];

</script>

<!-- /WYSIWYG -->

</head>
<body <?php if (basename($_SERVER['PHP_SELF']) == "admin.php" && $_SESSION['password'] == "" && md5(strrev(md5($_REQUEST["password"]))) != $mg2->password) {echo " onload=\"HTMLArea.replace('editor',config);formFocus();\"";}else ?> onload="HTMLArea.replace('editor',config);">