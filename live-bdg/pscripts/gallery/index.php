<?php
include ('../../includes/httproot.php');

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

//PHPSESSION &AMP FIX
ini_set('arg_separator.output','&amp;');

session_start();

include("includes/mg2_functions.php");

$mg2 = new mg2db;

$mg2->readDB();

include ('../../includes/header.php');
include("mg2_settings.php");
include("includes/mg2_version.php");
include("skins/$mg2->activeskin/settings.php");



//
// READ LANGUAGES
//
if ($_REQUEST['changelang'] == 1) $mg2->changelanguage();
$mg2->getlanguages();

include("lang/".$mg2->defaultlang);
//
// ADD COMMENTS
//
if ($_REQUEST['action'] == "addcomment"){
  $mg2->addcomment();
}
/////////////////////////////
// DISPLAY SLIDESHOW
/////////////////////////////

if ($_REQUEST['slideshow'] != ""){
  // PASSWORD SECURITY
  $result = $mg2->select($_REQUEST['slideshow'],$mg2->all_images,0,0,0);
  $list = $result[0][2];
  $currentfolder = $mg2->select($list,$mg2->all_folders,0,0,0);
  if ($currentfolder[0][5] == "" || $_SESSION["folderpassword"] == $currentfolder[0][5]) {
    $mg2->getfoldersettings($list);
    $result = $mg2->select($_REQUEST['slideshow'],$mg2->all_images,0,$mg2->folder_sortby,$mg2->folder_sortway);
    $id = $list;
    $_REQUEST['id'] = $result[0][0];
    $slideimages = $mg2->select($list,$mg2->all_images,2,$mg2->folder_sortby,$mg2->folder_sortway);
    for ($i=0; $i < count($slideimages); $i++){
      if ($slideimages[$i][0] == $result[0][0]) {
        $nextid = $slideimages[$i+1][0];
        $mg2->nextimage = "pictures/" . $slideimages[$i+1][1];
      }
    }
    $id = $result[0][2];
    $mg2->imagenavigation($id);
    $mg2->link = $mg2->galleryindex . "?list=" . $result[0][2] . "&amp;page=" . $mg2->page;
    if (!is_file($mg2->medium("pictures/" . $result[0][1]))) {
      $mg2->image = "pictures/" . $result[0][1];
      $mg2->width = $result[0][6];
      $mg2->height = $result[0][7];
    } else {
      list($mg2->width, $mg2->height, $mg2->type, $mg2->attr) = getimagesize($mg2->medium("pictures/" . $result[0][1]));
      $mg2->image = $mg2->medium("pictures/" . $result[0][1]);
      $mg2->fullsize = "<a href=\"pictures/" . $result[0][1] . "\" target=\"_blank\">" . $mg2->lang['fullsize'] . "</a>";
    }
    $mg2->target = "_self";
    $mg2->description = $result[0][4];
    $mg2->copyright = $mg2->copyright;
    $mg2->title = $result[0][3];

    if ($nextid != "") {
      $nexturl = $mg2->indexfile."?slideshow=".$nextid;
    } else $nexturl = $mg2->indexfile."?list=".$list;
    include("skins/$mg2->activeskin/templates/viewimage_slideshow.php");
    exit();
  } else $_REQUEST['list'] = $list;
}

/////////////////////////////
// DISPLAY INDEX
/////////////////////////////

if (!$_REQUEST['id']){

  // READ FOLDER CONTENTS
  if(strlen($_REQUEST['list']) < 1) $list = "1";
  else $list = $_REQUEST['list'];

  $mg2->getfoldersettings($list);

  $folders = $mg2->select($list,$mg2->all_folders,1,2,0);
  $result = $mg2->select($list,$mg2->all_images,2,$mg2->folder_sortby,$mg2->folder_sortway);
  if ($_REQUEST['page'] == "") $_REQUEST['page'] = 1;

  $first = $mg2->imagecolumns * $mg2->imagerows * ($_REQUEST['page'] - 1);
  $last = $mg2->imagecolumns * $mg2->imagerows * $_REQUEST['page'];
  $rowcount = 1;
  if ((count($folders) + count($result)) < $last) $last = count($folders) + count($result);
  if ($_REQUEST['page'] == "all") {
    $last = 9999999999999999999999999;
    $first = 0;
  }

  //CALCULATE NUMBER OF PAGES NEEDED
  $pages = ceil((count($result) + count($folders)) / ($mg2->imagecolumns * $mg2->imagerows));

  //STOP DISPLAYING INTRO TEXT IF PASSWORD IS NEEDED / INCORRECT
  $currentfolder = $mg2->select($list,$mg2->all_folders,0,0,0);
  $folderpwd = $currentfolder[0][5];
  if ($folderpwd != "" && $_SESSION["folderpassword"] != $folderpwd && md5(strrev(md5($_REQUEST["password"]))) != $folderpwd) $mg2->introtext = "";
 
  if ($_REQUEST['list'] == "1" || !$_REQUEST['list']) {
    $currentfolder = $mg2->gallerytitle;
  } else $currentfolder = $mg2->getfoldername($_REQUEST['list']);

  $mg2->startimage = $result[0][0];
  include("skins/$mg2->activeskin/templates/thumbnails_begin.php");

  // PASSWORD SECURITY
  $mg2->gallerysecurity($folderpwd);

  //DISPLAY EMPTY MESSAGE
  if (count($folders) == 0 && count($result) == 0) echo "<p  align=\"center\"><nobr><b>" . $mg2->lang['folderempty'] . "</b></nobr></p>";

  //DISPLAY FOLDERS
  if (count($folders) != 0){
    for ($i=0; $i < count($folders); $i++){
      if ($rowcount > $first && $rowcount <= $last) {
        $mg2->link = $mg2->indexfile . "?list=" . $folders[$i][0];
        $mg2->thumbfile = $mg2->getthumb($folders[$i][0]);
        $mg2->width = $mg2->width;
        $mg2->height = $mg2->height;
        $mg2->foldername = $folders[$i][2];
        if ($mg2->foldername == "") $mg2->foldername = "&nbsp;";
		// MARK NEW FOLDERS
		if ((time() - $folders[$i][6]) < ($mg2->marknew * 84600)) {
          $mg2->new = true;
        } else $mg2->new = false;

        include("skins/$mg2->activeskin/templates/subfolder.php");
      
        if (is_int($rowcount / $mg2->imagecolumns) && $rowcount <= (count($folders)) && $rowcount != $last) {
          echo "</tr><tr>";
        }
      }
      $rowcount++;
    }
  }


  //DISPLAY THUMBS
if (count($result) != 0)
{
	for ($i=0; $i < count($result); $i++)
	{
			if ($rowcount > $first && $rowcount <= $last)
			{
        $mg2->link = $mg2->indexfile . "?id=" . urlencode($result[$i][0]);
        $mg2->width = $result[$i][6];
        $mg2->height = $result[$i][7];
        $mg2->thumb_width = $result[$i][8];
        $mg2->thumb_height = $result[$i][9];
// title turication check, see about deleting wholesales
        if (strlen($result[$i][3]) > $skin_titlelimit)
			{
				$mg2->title = substr($result[$i][3],0,$skin_titlelimit) . "...";
        	}
		else $mg2->title = $result[$i][3];
        if ($mg2->title == "") $caption = "&nbsp;";
        if($result[$i][8] > 0){ $mg2->thumbfile = "pictures/" . $mg2->thumb($result[$i][1]);
        } else $mg2->thumbfile= "pictures/" . $result[$i][1];
		// MARK NEW FILES
		if ((time() - $result[$i][10]) < ($mg2->marknew * 84600)) {
          $mg2->new = true;
        } else $mg2->new = false;

        include("skins/$mg2->activeskin/templates/thumb.php");
        if (is_int($rowcount / $mg2->imagecolumns) &&  $rowcount < (count($result) + count($folders)) && $rowcount != $last) {
          echo "</tr><tr>";
        }
      }
      $rowcount++;
    }
  }


  // CREDITS - DO NOT REMOVE OR YOU WILL VOID MG2 TERMS OF USE!
  if (($_REQUEST['list'] == "1" || $_REQUEST['list'] == "") && !isset($_REQUEST['id'])) {
?>
  </tr>
  <tr align="center">
    <td colspan="100">
	  <br />
Gallery based on <a href="http://www.minigal.dk" target="_blank">MG2</a> v<?php echo $mg2->version ?><br><br>
<?php $mg2->pagenavigation($pages, $list); ?>
<?php if ($_REQUEST['list'] == "" || $_REQUEST['list'] == "1") { ?>
<a href="admin.php" target="_self"><img src="skins/admin/images/key.gif" width="13" height="7" alt="Admin" border="0" /></a>
<?php } ?><br><Br>
	</td>
<?
}
  // INCLUDE COUNTER CODE
  echo $mg2->countercode;

  include("skins/$mg2->activeskin/templates/thumbnails_end.php");
}


/////////////////////////////
// DISPLAY IMAGE
/////////////////////////////

if ($_REQUEST['id']){
  $folder = $mg2->select($_REQUEST['id'],$mg2->all_images,0,0,0);

  // PASSWORD SECURITY
  $currentfolder = $mg2->select($folder[0][2],$mg2->all_folders,0,0,0);
  $mg2->gallerysecurity($currentfolder[0][5]);

  $mg2->getfoldersettings($folder[0][2]);
  $result = $mg2->select($_REQUEST['id'],$mg2->all_images,0,$mg2->folder_sortby,$mg2->folder_sortway);

  // NO IMAGE ERROR MESSAGE
  if (count($result) == 0) {
    include("skins/$mg2->activeskin/templates/thumbnails_begin.php");
	echo "<p align=\"center\"><nobr><b>" . $mg2->lang['noimage'] . "</b></nobr></p>";
	echo "<p align=\"center\"><a href=\"" . $mg2->indexfile . "\" target=\"_self\">" . $mg2->lang['viewgallery'] . "</a></p>";
    exit();
  }

  $id = $result[0][2];
  $mg2->imagenavigation($id);
  $mg2->link = $mg2->galleryindex . "?list=" . urlencode($result[0][2]) . "&amp;page=" . $mg2->page;
  if (!is_file("pictures/" . $mg2->medium($result[0][1]))) {
    $mg2->imagefile = "pictures/" . $result[0][1];
    $mg2->width = $result[0][6];
    $mg2->height = $result[0][7];
  } else {
    list($mg2->width, $mg2->height, $mg2->type, $mg2->attr) = getimagesize("pictures/" . $mg2->medium($result[0][1]));
    $mg2->imagefile = "pictures/" . $mg2->medium($result[0][1]);
    $mg2->fullsizelink = "<a href=\"pictures/" . $result[0][1] . "\" target=\"_blank\">" . $mg2->lang['fullsize'] . "</a>";
  }
  $mg2->startimage = $result[0][0];
  $mg2->target = "_self";
  $mg2->description = $result[0][4];
  $mg2->title = $result[0][3];
  include("skins/$mg2->activeskin/templates/viewimage_begin.php");

  // DISPLAY EXIF
  if ($mg2->showexif == "1"){
    include("includes/exif.php");
    exif("pictures/" . $result[0][1]);

    if ($exif_data['Model'] != "") {
      $exif_data['ExposureTime'] = $mg2->dec2frac($exif_data['ExposureTime']) . $mg2->lang['seconds'];
      $exif_data['ExposureBias'] = round($exif_data['ExposureBias'],2);
      $exif_data['FNumber'] = "f" . $exif_data['FNumber'];
      $exif_data['FocalLength'] = $exif_data['FocalLength'] . $mg2->lang['mm'];
      include("skins/$mg2->activeskin/templates/viewimage_exif.php");
    }

  }
  // DISPLAY COMMENTS
  if ($mg2->showcomments == 1) {
    $mg2->readcomments("pictures/" . $result[0][1] . ".comment");
    include("skins/$mg2->activeskin/templates/viewimage_comments.php");
  }

  include("skins/$mg2->activeskin/templates/viewimage_end.php");
  }

?>
