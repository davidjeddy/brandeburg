<?php
//////////////////////////////////////////////////////////////////////////////////
//                                                                              //
//    MG2                                                                       //
//    A PHP/HTML based image gallery script.                                    //
//                                                                              //
//    Copyright 2005 by Thomas Rybak                                            //
//    http://www.minigal.dk                                                     //
//    support@minigal.dk                                                        //
//                                                                              //
//    The script utilises Exif reader v 1.2 (free to use)                       //
//    Exif reader v 1.2                                                         //
//    By Richard James Kendall (richard@richardjameskendall.com)                //
//                                                                              //
//    -----------------                                                         //
//                                                                              //
//    MG2 is free software; you can redistribute it and/or modify               //
//    it under the terms of the GNU General Public License as published by      //
//    the Free Software Foundation; either version 2 of the License, or         //
//    (at your option) any later version.                                       //
//                                                                              //
//    MG2 is distributed in the hope that it will be useful,                    //
//    but WITHOUT ANY WARRANTY; without even the implied warranty of            //
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the              //
//    GNU General Public License for more details.                              //
//                                                                              //
//    TO COMPLY WITH THIS LICENSE, DO NOT REMOVE THE LINK TO THE MINIGAL        //
//    WEBSITE FROM YOUR GALLERY FRONT PAGE. THIS IS THE LEAST YOU CAN DO TO     //
//    SUPPORT THE DEVELOPMENT OF MG2!                                           //
//                                                                              //
//    You should have received a copy of the GNU General Public License         //
//    along with this program; if not, you can find it here:                    //
//    http://www.gnu.org/copyleft/gpl.html                                      //
//                                                                              //
//    -----------------                                                         //
//                                                                              //
//    If you find this script useful, please make a donation via the main       //
//    website:                                                                  //
//                          http://www.minigal.dk                               //
//                                                                              //
//////////////////////////////////////////////////////////////////////////////////

// DISPLAY ERRORS BUT HIDE NOTICES
error_reporting(E_ALL ^ E_NOTICE);

// TRIGGER INSTALLATION
if(!is_file("mg2_settings.php"))include("mg2_install.php");

if ($_REQUEST['action'] != "import") {
  session_start();
}

// Set headers to prevent browser caching of pages
header("Cache-control: private, no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); # Past date
header("Pragma: no-cache");

include("includes/mg2_functions.php");
include("includes/mg2admin_functions.php");

$mg2 = new MG2admin;

include("mg2_settings.php");
include("includes/mg2_version.php");
if ($mg2->defaultlang == "") $mg2->defaultlang = "english.php";
include("lang/".$mg2->defaultlang);

$mg2->readDB();
include("skins/admin/admin_header.php");

//LOGIN SECURITY CHECK
if ($_REQUEST['action'] != "import") {
  $mg2->security();
}

////////////////////////////
// MENU
////////////////////////////
if (!$_REQUEST['list']) $list = "1"; else $list = $_REQUEST['list'];
if ($_REQUEST['editfolder']) $list = $_REQUEST['editfolder'];
for ($i=0; $i < count($mg2->all_images);$i++) {
  $total_size = $total_size + $mg2->all_images[$i][5];
}
  $dec = "1"; $val = " bytes";
  if (strlen($total_size) > 3) { $dec="1024"; $val=" Kb"; }
  if (strlen($total_size) > 6) { $dec="1048576"; $val=" Mb"; }
  $total_size = round($total_size/$dec,2) . $val;
  $total_images = count($mg2->all_images);
  if ($total_images == 1) $total_images = $total_images . " " . $mg2->lang['file']; else $total_images = $total_images . " " . $mg2->lang['files'];
  $total_folders = count($mg2->all_folders) - 1;
  if ($total_folders < 0) $total_folders = 0;
  if ($total_folders == 1) $total_folders = $total_folders . " " . $mg2->lang['folder']; else $total_folders = $total_folders . " " . $mg2->lang['folders'];
include("skins/admin/admin1_menu.php");


if($_REQUEST['submit'] == $mg2->lang['buttondelete']){
  $mg2->deletefiles();
}

if($_REQUEST['action'] == "editID"){
  $mg2->editID();
  $mg2->getfoldersettings($_REQUEST['list']);
  $findfile = $mg2->select($_REQUEST['list'],$mg2->all_images,2,$mg2->folder_sortby,$mg2->folder_sortway);
  for ($i=0; $i < count($findfile); $i++) {
	if ($findfile[$i][0] == $_REQUEST['id']) $_REQUEST['editID'] = $findfile[$i+1][0];
  }
}

if($_REQUEST['action'] == "dbbackup"){
  $mg2->db_backup();
}

if($_REQUEST['action'] == "import"){
  $mg2->log("Import started");
  $mg2->import();
}

if($_REQUEST['action'] == "newfolder"){
  include("skins/admin/admin2_newfolder.php");
}

if($_REQUEST['action'] == "makefolder"){
  $mg2->makefolder();
}

if($_REQUEST['action'] == "deleteID"){
  $mg2->deleteID();
}

if($_REQUEST['action'] == "upload"){
  $mg2->upload();
  include("skins/admin/admin4_credits.php");
  include("skins/admin/admin_footer.php");
  exit();
}

if($_REQUEST['action'] == "updatefolder"){
  $mg2->updatefolder();
}
if($_REQUEST['action'] == "writesetup"){
  $mg2->writesetup();
}
if($_REQUEST['action'] == "deletecomments"){
  $mg2->deletecomments();
}

//MG2 SETUP
if($_REQUEST['action'] == "setup"){
  $mg2->setup();
  include("skins/admin/admin4_credits.php");
  include("skins/admin/admin_footer.php");
  exit();
}

if($_REQUEST['uploadto']){
  include("skins/admin/admin2_upload.php");
}

if($_REQUEST['editfolder']){
  $mg2->makefolderlist();
  $mg2->editfolder();
  $_REQUEST['list'] = $_REQUEST['editfolder'];
}

if($_REQUEST['deleteID']){
  $result = $mg2->select($_REQUEST['deleteID'],$mg2->all_images,0,1,0);
  include("skins/admin/admin2_delete.php");
}

if($_REQUEST['deletefolder']){
  $mg2->deletefolder();
}
if($_REQUEST['erasefolder']){
  $mg2->erasefolder();
}

if ($_REQUEST['submit'] == $mg2->lang['buttonmove']) {
  $mg2->movefiles();
};

if($_REQUEST['rebuildID']){
  $mg2->rebuildID();
}

if($_REQUEST['rotate']){
  $mg2->rotateimage($_REQUEST['rotate'], $_REQUEST['direction']);
}

if($_REQUEST['editID']){
  $mg2->makefolderlist();
  $result = $mg2->select($_REQUEST['editID'],$mg2->all_images,0,1,0);
  $description = str_replace("<br />", "\n", $result[0][4]);
  $_REQUEST['list'] = $result[0][2];
  include("skins/admin/admin2_edit.php");
  if (is_file("pictures/" . $result[0][1] . ".comment")) {
    $mg2->readcomments("pictures/" . $result[0][1] . ".comment");
    include("skins/admin/admin2_comments.php");
  }
}

if($_REQUEST['action'] != "import") {

if(strlen($_REQUEST['list']) < 1) $_REQUEST['list'] = "1";

$mg2->getfoldersettings($_REQUEST['list']);
$folders = $mg2->select($_REQUEST['list'],$mg2->all_folders,1,2,0);
$result = $mg2->select($_REQUEST['list'],$mg2->all_images,2,$mg2->folder_sortby,$mg2->folder_sortway);

//
// PAGE COUNTER
//
if($_REQUEST["page"] == "") $_REQUEST["page"] = 1;
$prpage = 20;
$pages = ceil(count($result) / $prpage);
$start = ($_REQUEST["page"] - 1) * $prpage;
$end = $start + $prpage;
if($_REQUEST["page"] == "all") {
  $start = 0;
  $end = 999999999999999999999999999;
}

//
// LIST FOLDERS
//
$class = "table_files";
include("skins/admin/admin_table_start.php");
for ($i=0; $i < count($folders);$i++){
  include("skins/admin/admin3_folders.php");
}

//
// LIST FILES
//
for ($i=$start; $i < count($result) && $i < $end;$i++){
  $dec = 1;
  $val = " bytes";
  if (strlen($result[$i][5]) > 3) { $dec="1024"; $val=" KB"; }
  if (strlen($result[$i][5]) > 6) { $dec="1048576"; $val=" MB"; }
  $filesize = round(($result[$i][5]/$dec),2) . $val;
  include("skins/admin/admin3_files.php");
}
$totalfiles = count($result);

include("skins/admin/admin_table_end.php");


//
$_REQUEST['editfolder'] = "";
$_REQUEST['editID'] = "";
$mg2->makefolderlist();
include("skins/admin/admin4_controls.php");
}
include("skins/admin/admin4_credits.php");

include("skins/admin/admin_footer.php");
?>
