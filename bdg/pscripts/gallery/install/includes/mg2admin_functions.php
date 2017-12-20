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

class MG2admin extends mg2db{

  function security()
  {
    $firstlogin = false;
    $class = "table_security";
    //Check pwd match, then set login var
    if (isset($_REQUEST["password"]) && md5(strrev(md5($_REQUEST["password"]))) == $this->password && !isset($_SESSION["password"])) {
      $_SESSION["password"] = md5(strrev(md5($_REQUEST["password"])));
      $_SESSION["accesstime"] = time();
      $this->log("Logon from " . getenv('REMOTE_ADDR'));
      $firstlogin = true;
    }

    //Check for login and show login screen
    if ($_SESSION["password"] != $this->password) {
      $select = 1;
      include("skins/admin/admin_table_start.php");
      include("skins/admin/admin_security.php");
?>
<tr>
<td class="td_div"><br /><p>
<?php
echo $this->lang['donate'] . "</p>";
?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="image" src="skins/admin/images/paypal.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" title="Make payments with PayPal - it's fast, free and secure!" />
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
</form>
<a href="http://www.minigal.dk" target="_blank">www.minigal.dk</a><br /><br />
</td>
</tr>
<?
      include("skins/admin/admin_table_end.php");
      include("skins/admin/admin_footer.php");
      session_destroy();
      exit();
    }
    // Renew timestamp if time not exceded
    elseif ((time() - $_SESSION["accesstime"]) < 900) {
      $_SESSION["accesstime"] = time();
    } elseif ($_REQUEST['action'] != "logoff") {

      // DO SECURITY LOGOFF
      unset($_SESSION["password"]);
      unset($_SESSION["accesstime"]);
      session_destroy();
      $select = 2;
      include("skins/admin/admin_table_start.php");
      include("skins/admin/admin_security.php");
      include("skins/admin/admin_table_end.php");
      include("skins/admin/admin_footer.php");
	  $this->log("Security logoff");
      exit();
    }
    //Logout
    if ($_REQUEST["action"] == "logoff") {
      unset($_SESSION["password"]);
      unset($_SESSION["accesstime"]);
      session_destroy();
      $select = 3;
      include("skins/admin/admin_table_start.php");
      include("skins/admin/admin_security.php");
      include("skins/admin/admin_table_end.php");
      include("skins/admin/admin_footer.php");
	  $this->log("Logoff");
      exit();
    }

    //POST LOGIN PEMISSIONS CHECK!!!
    if($firstlogin == true) {
      @rmdir("x");
      if (@mkdir("x")) {
        @rmdir("x");
      } else {
		$this->permcheck(1);
      }
      @rmdir("pictures/x/");
      if (@mkdir("pictures/x/")) {
        @rmdir("pictures/x/");
      } else {
		$this->permcheck(2);
      }
	  if(!is_writable("mg2db_idatabase.php") && is_file("mg2db_idatabase.php")) $this->permcheck(3);
	  if(!is_writable("mg2db_idatabase_temp.php") && is_file("mg2db_idatabase_temp.php")) $this->permcheck(4);
	  if(!is_writable("mg2db_fdatabase.php") && is_file("mg2db_fdatabase.php")) $this->permcheck(5);
	  if(!is_writable("mg2db_fdatabase_temp.php") && is_file("mg2db_fdatabase_temp.php")) $this->permcheck(6);
    }
  }

  function permcheck($level) {
	if ($level == 1) { $errorcode = $this->lang["permerror1"];
	  $whattodo = $this->lang["whattodo1"]; }
    if ($level == 2) { $errorcode = $this->lang["permerror2"];
	  $whattodo = $this->lang["whattodo2"]; }
    if ($level == 3) { $errorcode = $this->lang["permerror3"];
	  $whattodo = $this->lang["whattodo3"]; }
    if ($level == 4) { $errorcode = $this->lang["permerror4"];
	  $whattodo = $this->lang["whattodo4"]; }
    if ($level == 5) { $errorcode = $this->lang["permerror5"];
	  $whattodo = $this->lang["whattodo5"]; }
    if ($level == 6) { $errorcode = $this->lang["permerror6"];
	  $whattodo = $this->lang["whattodo6"]; }
?>
  <table class="table_menu" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
      <strong><?php echo $errorcode ?></strong><br /><br /><?php echo $whattodo ?><br /><br /><a href="admin.php" target="_self"><?php echo $this->lang['loginagain'] ?></a>
    </td>
  </tr>
  </table>
<?php
    unset($_SESSION["password"]);
    unset($_SESSION["accesstime"]);
    session_destroy();
	exit();
  }

//
// ADMIN NAVIGATION
//
  function adminnavigation(){
    if ($_REQUEST['list'] != "") $result = $_REQUEST['list'];
    $currentfolder = $this->select($_REQUEST['list'],$this->all_folders,0,1,0);
    while ($result != "1" && $result != ""){
      $result = $this->select($result,$this->all_folders,0,0,0);
      $folders[] = $result[0][1];
      $result = $result[0][1];
    }
    for ($i=count($folders) - 1; $i >= 0; $i--){
      if ($folders[$i] == "1"){
        echo "<a href=\"?list=\">" . $this->lang['root'] . "</a>";
      }else if ($folders[$i] != "0"){
        $parentfolder = $this->select($folders[$i],$this->all_folders,0,1,0);
        echo " : <a href=\"?list=" . $parentfolder[0][0] . "\">" . $parentfolder[0][2] . "</a>";
      }
    }
    if ($_REQUEST['list'] != "1" && $_REQUEST['list'])
      echo " : <a href=\"?list=" . $_REQUEST['list'] . "\">" . $currentfolder[0][2] . "</a>";
    if ($_REQUEST['list'] == "1" || $_REQUEST['list'] == "")
        echo "<a href=\"?list=" . $folders[$i] . "\">" . $this->lang['root'] . "</a>";
  }

  function rebuildID() {
    $allowed_extensions = explode(",", $this->extensions);
    $result = $this->select($_REQUEST['rebuildID'],$this->all_images,0,1,0);
    if (is_file("pictures/" . $this->thumb($result[0][1]))) unlink("pictures/" . $this->thumb($result[0][1]));
    if (is_file("pictures/" . $this->medium($result[0][1]))) unlink("pictures/" . $this->medium($result[0][1]));
    $this->createthumb($result[0][1]);
    $this->status = $this->lang['rebuildsuccess'];
    include("skins/admin/admin2_status.php");
  }

  function editID(){
    $result = $this->select($_REQUEST['id'],$this->all_images,0,1,0);
    $id = $result[0][0];
    $id = $this->search_iDB($_REQUEST['id'],0);
    $_REQUEST['filename'] = $this->charfix($_REQUEST['filename']);
    $_REQUEST['title'] = $this->charfix($_REQUEST['title']);
    $_REQUEST['description'] = $this->charfix($_REQUEST['description']);
    $_REQUEST['description'] = str_replace("\n","<br />",$_REQUEST['description']);
    $_REQUEST['description'] = str_replace("\r","",$_REQUEST['description']);
    if ($this->all_images[$id][1] != $_REQUEST['filename']) {
	  // CHECK FILENAME FOR ILLEGAL CHARACTERS
	  if (ereg(":|;|<|>|/|\|¤|~|§",$_REQUEST['filename']) != 1) {
        rename("pictures/" . $this->all_images[$id][1], "pictures/" . $_REQUEST['filename']);
        rename("pictures/" . $this->thumb($this->all_images[$id][1]), "pictures/" . $this->thumb($_REQUEST['filename']));
      } else {
        $this->status = $this->lang['renamefailure'];
        include("skins/admin/admin2_status.php");
    	return;
      }
    }
    if (is_file("pictures/" . $this->medium($this->all_images[$id][1]))) rename("pictures/" . $this->medium($this->all_images[$id][1]), "pictures/" . $this->medium($_REQUEST['filename']));
    if (is_file("pictures/" . $this->all_images[$id][1]. ".comment")) rename("pictures/" . $this->all_images[$id][1]. ".comment", "pictures/" . $_REQUEST['filename'] . ".comment");
    $this->all_images[$id][1] = $_REQUEST['filename'];
    $this->all_images[$id][3] = $_REQUEST['title'];
    $this->all_images[$id][4] = $_REQUEST['description'];
    $this->write_iDB();
    $this->updateDB();
    if ($_REQUEST['setthumb'] != "" && is_file("pictures/" . $this->thumb($_REQUEST['filename']))) {
      $fid = $this->search_fDB($_REQUEST['setthumb'],0);
      $this->all_folders[$fid][7] = $this->thumb($_REQUEST['filename']);
      list($width, $height, $type, $attr) = getimagesize("pictures/" . $this->thumb($_REQUEST['filename']));
      $this->all_folders[$fid][8] = $width;
      $this->all_folders[$fid][9] = $height;
      $this->write_fDB();
    }
    $this->status = $this->lang['updatesuccess'];
    $this->log("File edit '" . $_REQUEST['filename']. "' complete");
    include("skins/admin/admin2_status.php");
  }

  function deleteID() {
    $id = $this->search_iDB($_REQUEST['id'],0);
    $_REQUEST['list'] = $this->all_images[$id][2];
    if (is_file("pictures/" . $this->all_images[$id][1])) {
      unlink("pictures/" . $this->all_images[$id][1]);
      if (is_file("pictures/" . $this->thumb($this->all_images[$id][1]))) {
        unlink("pictures/" . $this->thumb($this->all_images[$id][1]));
      }
      if (is_file("pictures/" . $this->medium($this->all_images[$id][1]))) {
        unlink("pictures/" . $this->medium($this->all_images[$id][1]));
      }
      if (is_file("pictures/" . $this->all_images[$id][1] . ".comment")) {
        unlink("pictures/" . $this->all_images[$id][1] . ".comment");
      }
      $this->all_images = $this->array_delete($this->all_images,$id);
      $this->write_iDB();
      $this->status = $this->lang['filedeleted'];
    }else {
      $this->all_images = $this->array_delete($this->all_images,$id);
      $this->write_iDB();
      $this->status = $this->lang['filenotfound'];
    }
    $this->log("Deleted " . $this->all_images[$id][1]);
    include("skins/admin/admin2_status.php");
  }

  function import() {
    $imported = $this->importnewimages();
    if($imported > 0) {
      $this->status = $imported . " " . $this->lang['filesimported'] . "<br /><br /><a href=\"admin.php?list=" . $_REQUEST['list'] . "\"target=\"_self\">"  . $this->lang['backtofolder'] . "</a>";
    } else {
	  $imported = 0;
	  $this->status = $this->lang['nofilestoimport'] . "<br /><br /><a href=\"admin.php?list=" . $_REQUEST['list'] . "\"target=\"_self\">"  . $this->lang['backtofolder'] . "</a>";
	}
    $this->log("Finished importing $imported file(s). Gallery now contains " . count($this->all_images) . " images");
    include("skins/admin/admin2_status.php");
  }

  function editfolder() {
    $result = $this->select($_REQUEST['editfolder'],$this->all_folders,0,1,0);
    $folder = $result[0][2];
    if ($result[0][0] == "1") $folder = "1";
    if ($result[0][7] == "" || $this->foldericons == 1) {
      $thumb = "skins/admin/images/folder.gif";
      $thumb_width = "150";
      $thumb_height = "100";
    } else {
      $thumb = "pictures/" . $result[0][7];
      $thumb_width = $result[0][8];
      $thumb_height = $result[0][9];
      $class = "class=\"thumb\"";
    }
    if ($_REQUEST['editfolder'] == "1") {
      $thumb = "skins/admin/images/folder.gif";
      $thumb_width = "150";
      $thumb_height = "100";
      unset($class);
    }
    $introtext = str_replace("<br />", "\n", $result[0][10]);
    include("skins/admin/admin2_editfolder.php");
  }

  function updatefolder() {
    $result = $this->select($_REQUEST['list'],$this->all_folders,0,1,0);
    $_REQUEST['introtext'] = $this->charfix($_REQUEST['introtext']);
    $_REQUEST['introtext'] = str_replace("\n","<br />",$_REQUEST['introtext']);
    $_REQUEST['introtext'] = str_replace("\r","",$_REQUEST['introtext']);
    $id = $this->search_fDB($_REQUEST['list'],0);
    $this->all_folders[$id][2] = $this->charfix($_REQUEST['name']);
    if ($_REQUEST['password']){
      $this->all_folders[$id][5] = md5(strrev(md5($_REQUEST["password"])));
    }
    $this->all_folders[$id][1] = $_REQUEST['moveto'];
    $this->all_folders[$id][3] = $_REQUEST['sortby'];
    $this->all_folders[$id][4] = $_REQUEST['direction'];
    $this->all_folders[$id][10] = $_REQUEST['introtext'];
    if ($_REQUEST['deletethumb'] == 1) {
      $this->all_folders[$id][7] = "";
      $this->all_folders[$id][8] = "";
      $this->all_folders[$id][9] = "";
    }
    if ($_REQUEST['deletepassword'] == 1) {
      $this->all_folders[$id][5] = "";
    }
    $this->write_fDB();
    $this->status = $this->lang['folderupdated'];
    $this->log("Folder edit '" . $this->getfoldername($_REQUEST['list']). "' complete");
    include("skins/admin/admin2_status.php");
  }


  function deletefolder() {
    $result = $this->select($_REQUEST['deletefolder'],$this->all_images,2,1,0);
    $folders = $this->select($_REQUEST['deletefolder'],$this->all_folders,1,1,0);
    $thisfolder = $this->select($_REQUEST['deletefolder'],$this->all_folders,0,1,0);
    if (count($folders) > 0 || count($result) > 0) {
      $this->status = $this->lang['foldernotempty'];
      include("skins/admin/admin2_status.php");
    } else
      if ($thisfolder[0][7] == "" || $this->foldericons == 1) {
        $thumb = "skins/$this->activeskin/images/folder.gif";
        $thumb_width = "150";
        $thumb_height = "100";
        include("skins/admin/admin2_deletefolder.php");
      } else {
        $thumb = $thisfolder[0][7];
        $thumb_width = $thisfolder[0][8];
        $thumb_height = $thisfolder[0][9];
        $class = "class=\"thumb\"";
        include("skins/admin/admin2_deletefolder.php");
      }
  }


  function erasefolder() {
    $foldername = $this->getfoldername($_REQUEST['erasefolder']);

    $id = $this->search_fDB($_REQUEST['erasefolder'],0);
    $this->all_folders = $this->array_delete($this->all_folders,$id);
    $id = $this->search_fDB($_REQUEST['erasefolder'],0);
    $this->write_fDB();
    $this->status = $this->lang['folderdeleted'];
    $this->log("Deleted folder '$foldername'");
    include("skins/admin/admin2_status.php");
  }


  function makefolder() {
    $_REQUEST['name'] = $this->charfix($_REQUEST['name']);
    $result = $this->select($_REQUEST['name'],$this->all_folders,2,1,0);
    if (is_array($result)) {
      $result = $this->select($_REQUEST['list'],$result,1,1,0);
    }
    if (count($result) < 1) {
      if ($_REQUEST['password'] != "") {
        $password = md5(strrev(md5($_REQUEST["password"])));
      } else $password = "";
      $this->folderautoid++;
      $this->all_folders[] = array($this->folderautoid, $_REQUEST['list'], $_REQUEST['name'],$_REQUEST['sortby'],$_REQUEST['direction'],$password,time(),"","","","","");
      $this->write_fDB();
      $this->status = $this->lang['foldercreated'];
      include("skins/admin/admin2_status.php");
    } else {
      $this->status = $this->lang['folderexists'];
      include("skins/admin/admin2_status.php");
    }
	$this->log("Created folder '" . $_REQUEST['name'] . "'");
  }

  function upload() {
    @set_time_limit(0);
    for ($x = 0; $x < 10; $x++) {
      if (!is_file("pictures/" . $_FILES["file" . $x]["name"])) {
        if ($_FILES["file". $x]["size"] > 0) {
          $fra = $_FILES["file" . $x]["tmp_name"];
          $tempname = $_FILES["file" . $x]["name"];
          $til = "pictures/" . $tempname;
          if (function_exists("move_uploaded_file")) {
            move_uploaded_file($fra, $til);
          } else {
            copy($fra, $til);
          }
        }
      } else if (filesize($_FILES["file" . $x]["name"]) != $_FILES["file". $x]["size"] && $_FILES["file". $x]["size"] > 0){
        $file_parts = pathinfo('dir/' . $_FILES['file' . $x]['name']);
        $file_extension = strtolower($file_parts['extension']);
        $fra = $_FILES["file" . $x]["tmp_name"];
        $tempname = $_FILES["file" . $x]["name"];
        $til = str_replace("." . $file_extension,"",$tempname). "_autorenamed" . rand(1000,9999) . "." . $file_extension;
        if (function_exists("move_uploaded_file")) {
          move_uploaded_file($fra, $til);
        } else {
          copy($fra, $til);
        }
      }
      
    }
    $this->status = $this->lang['filesuploaded'];
	$this->log("Uploaded files");
    include("skins/admin/admin2_status.php");
  }

  function createthumb($filename) {
	$filename = "pictures/" . $filename;
    if(is_file($filename) && !is_file($this->thumb($filename))) {
      $dst_filename = $this->thumb($filename);
      $size = getimagesize($filename);
      $fileInfo = pathinfo($filename);
      $ext = strtolower($fileInfo["extension"]);
      $counter = 1;
      $max_width = "150";
      $max_height = "150";

      // IS MEDIUMSIZED PIC NEEDED
      if ($this->mediumimage > 0 && ($size[0] > ($this->mediumimage -100) || $size[1] > ($this->mediumimage-100))) {
	if (!is_file($this->medium($filename))) {
          $counter = 2;
        }
      }
      for ($i=1; $i <= $counter; $i++) {

        // MEDIUMDSIZED PICTURE SETTINGS
        if ($i == 2) {
          $dst_filename = $this->medium($filename);
          if ($size[0] > $size[1]) { $max_width = $this->mediumimage - 100; }
          else { $max_height = $this->mediumimage - 100; }
        }

        
        if ($ext == 'jpg' || $ext == 'jpeg') {
          $src_img = imagecreatefromjpeg($filename) or die( 'Cannot load input JPEG image' );
        } else if ($ext == 'png') {
          $src_img = imagecreatefrompng($filename) or die( 'Cannot load input PNG image' );
        } else if ($ext == 'gif') {
          $src_img = imagecreatefromgif($filename) or die( 'Cannot load input GIF image' );
        }
        if ($size[0] > $size[1]) {
          $max_height = ($max_width/$size[0]) * $size[1];
        } else {
          $max_width = ($max_height/$size[1]) * $size[0];
        }
	if ($size[0] <= $max_width) $max_width = $size[0];
	if ($size[1] <= $max_height) $max_height = $size[1];
        $dst_img = imagecreatetruecolor($max_width, $max_height);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, $size[0], $size[1]);
        imagejpeg($dst_img, $dst_filename, $this->thumbquality);
        imagedestroy($src_img);
        imagedestroy($dst_img);
      }
    }
  }

  function setup() {
    $workdir = opendir("lang");
    while (false !== ($pointer = readdir($workdir))) {
      if ($pointer !== "." && $pointer !== "..") {
        $lang[] = $pointer;
      }
    }
    sort($lang);

    $workdir = opendir("skins");
    while (false !== ($pointer = readdir($workdir))) {
      if ($pointer !== "." && $pointer !== ".." && $pointer !== "admin") {
        $skins[] = $pointer;
      }
    }
    sort($skins);
    include("skins/admin/admin2_setup.php");
  }

  function writesetup() {
    $_REQUEST['gallerytitle'] = $this->charfix($_REQUEST['gallerytitle']);
    $_REQUEST['copyright'] = $this->charfix($_REQUEST['copyright']);
    $_REQUEST['password'] = $this->charfix($_REQUEST['password']);
    $_REQUEST['websitelink'] = $this->charfix($_REQUEST['websitelink']);

    if ($_REQUEST['oldpassword'] != "" || $_REQUEST['password'] != "" || $_REQUEST['passwordconfirm'] != "") {
      if ($_REQUEST['password'] != $_REQUEST['passwordconfirm'] || md5(strrev(md5($_REQUEST["oldpassword"]))) != $_SESSION['password']) {
        $bufferpwd = $_SESSION["password"];
        $this->status = $this->lang['nopwdmatch'];
      } else {
        $bufferpwd = md5(strrev(md5($_REQUEST["password"])));
        $_SESSION["password"] = $bufferpwd;
        md5(strrev(md5($_REQUEST["password"])));
        $this->status = $this->lang['settingssaved'];
      }
    } else {
      $bufferpwd = $_SESSION["password"];
      $this->status = $this->lang['settingssaved'];
    }
    $filebuffer = "<?php\n";
    $filebuffer.= "$" . "mg2->"."gallerytitle = ".chr(34).$_REQUEST["gallerytitle"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."adminemail = ".chr(34).$_REQUEST["adminemail"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."defaultlang = ".chr(34).$_REQUEST["defaultlang"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."activeskin = ".chr(34).$_REQUEST["activeskin"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."dateformat = ".chr(34).$_REQUEST["dateformat"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."marknew = ".chr(34).$_REQUEST["marknew"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."sendmail = ".chr(34).$_REQUEST["sendmail"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."foldericons = ".chr(34).$_REQUEST["foldericons"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."showexif = ".chr(34).$_REQUEST["showexif"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."showcomments = ".chr(34).$_REQUEST["showcomments"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."autolang = ".chr(34).$_REQUEST["autolang"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."copyright = ".chr(34).$_REQUEST["copyright"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."password = ".chr(34).$bufferpwd.chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."extensions = ".chr(34).str_replace(" ", "",$_REQUEST["extensions"]).chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."mediumimage = ".chr(34).$_REQUEST["mediumimage"].chr(34).";\n";
    $filebuffer.= "$" . "mg2->"."indexfile = ".chr(34).$_REQUEST["indexfile"].chr(34).";\n";
    $filebuffer .= "$" . "mg2->"."thumbquality = ".chr(34).$_REQUEST["thumbquality"].chr(34).";\n";
    $filebuffer .= "$" . "mg2->"."imagecolumns = ".chr(34).$_REQUEST["imagecolumns"].chr(34).";\n";
    $filebuffer .= "$" . "mg2->"."imagerows = ".chr(34).$_REQUEST["imagerows"].chr(34).";\n";
    $filebuffer .= "$" . "mg2->"."slideshowdelay = ".chr(34).$_REQUEST["slideshowdelay"].chr(34).";\n";
    $filebuffer .= "$" . "mg2->"."websitelink = ".chr(34).$_REQUEST["websitelink"].chr(34).";\n";
    $filebuffer .= "$" . "mg2->"."installdate = ".chr(34). $this->installdate .chr(34).";\n";
    $filebuffer .= "?>";
    $fd = fopen("mg2_settings.php","w+");
    fwrite($fd,$filebuffer);
    fclose($fd);
	$this->log("Setup saved");
    include("skins/admin/admin2_status.php");
  }

  function movefiles() {
    $howmany = 0;
    for ($i=0;$i < $_REQUEST['selectsize']; $i++) {
      $_REQUEST["selectfile" . $i] = $this->charfix($_REQUEST["selectfile" . $i]);
      if (is_file("pictures/" . $_REQUEST["selectfile" . $i])) {
        $id = $this->search_iDB($_REQUEST["selectfile" . $i],1);
	$this->all_images[$id][2] = $_REQUEST['moveto'];
	$howmany++;
      }
    }
    $this->write_iDB();
    $this->status = $howmany . " " . $this->lang['filesmovedto'] . " '" . $this->getfoldername($_REQUEST['moveto']) . "'";
	$this->log("Moved $howmany file(s) to '" . $this->getfoldername($_REQUEST['moveto']) . "'");
    include("skins/admin/admin2_status.php");
  }

  function deletefiles() {
    $howmany = 0;
    for ($i=0;$i < $_REQUEST['selectsize']; $i++) {
      $_REQUEST["selectfile" . $i] = $this->charfix($_REQUEST["selectfile" . $i]);
      if (is_file("pictures/" . $_REQUEST["selectfile" . $i])) {
        $id = $this->search_iDB($_REQUEST["selectfile" . $i],1);
        $this->all_images = $this->array_delete($this->all_images,$id);
        $this->all_images = $this->select("*",$this->all_images,0,0,0);
        unlink("pictures/" . $_REQUEST["selectfile" . $i]);
        if (is_file("pictures/" . $this->thumb($_REQUEST["selectfile" . $i]))) {
          unlink("pictures/" . $this->thumb($_REQUEST["selectfile" . $i]));
        }
        if (is_file("pictures/" . $this->medium($_REQUEST["selectfile" . $i]))) {
          unlink("pictures/" . $this->medium($_REQUEST["selectfile" . $i]));
        }
        if (is_file("pictures/" . $_REQUEST["selectfile" . $i] . ".comment")) {
          unlink("pictures/" . $_REQUEST["selectfile" . $i] . ".comment");
        }
	$howmany++;
      }
    }
    $this->write_iDB();
    $this->status = $howmany . " " . $this->lang['filesdeleted'];
	$this->log("Deleted $howmany file(s)");
    include("skins/admin/admin2_status.php");
  }

  function getparentfolder($id) {
    $parentfolder = $this->select($id,$this->all_folders,0,1,0);
    return $parentfolder;
  }


  function deletecomments() {
    $filename = $_REQUEST['filename'] . ".comment";
    $this->readcomments("pictures/" . $filename);
    for ($i=0;$i < $_REQUEST['totalcomments']; $i++) {
      if ($_REQUEST['comment' . $i] != "on") {
        $keepcomments[] = $this->comments[$i];
      }
    }
    unset($this->comments);
    $this->comments = $keepcomments;
    $this->writecomments($filename);
    $this->status = $this->lang['commentsdeleted'];
	$this->log("Deleted comments from '" . $_REQUEST['filename']. "'");
    include("skins/admin/admin2_status.php");
  }
  
  function makefolderlist() {
    unset($this->sortedfolders);
    $folders = $this->select("*",$this->all_folders,0,1,1);
    for ($x=0; $x < count($folders); $x++) {
      $result = $folders[$x][0];
      unset($parentfolder);
      unset($fullpath);
      unset($parentid);
      while ($result != "1" && $result != "" && $result != $_REQUEST['editfolder']){
          $result = $this->select($result,$this->all_folders,0,0,0);
          $parentfolder[] = $result[0][2];
	  if (!$parentid) $parentid = $result[0][1];

          $result = $result[0][1];
      }
      for ($i = count($parentfolder) -1 ; $i >= 0; $i--) {
        $fullpath .= $parentfolder[$i];
        if ($i != 0) $fullpath .= " : ";
      }
      $this->sortedfolders[] = array($fullpath, $folders[$x][0], $parentid);
    }
	if (is_array($this->sortedfolders)) sort($this->sortedfolders);

	//USE LIST FOR EDITID ELSE FOR CONTROLS
	if ($_REQUEST[editID] != "") {
      $this->sortedfolders[0][0] = $this->lang["nofolderselected"];
    } else {
      $this->sortedfolders[0][0] = $this->lang['root'];
      $this->sortedfolders[0][1] = "1";
    }
    if (isset($_REQUEST['editfolder'])) {
      $thisfolder = $this->select($_REQUEST['editfolder'],$this->all_folders,0,0,0);
      $this->parentid = $thisfolder[0][1];
    }
  }

  function adminpagenavigation($pages) {
	if ($pages > 1) {
	  echo " - " . $this->lang["page"];
  	  for ($i=1; $i <= $pages; $i++) {
		if ($_REQUEST["page"] == $i) {
		  echo " | " . $i;
        }else
          echo " | <a href=\"admin.php?list=" . $_REQUEST["list"]. "&amp;page=$i\" target=\"_self\">" . $i . "</a>";
      }
	  if ($_REQUEST["page"] == "all") {
        echo " | " . $this->lang["all"];
      }else
        echo " | <a href=\"admin.php?list=" . $_REQUEST["list"]. "&amp;page=all\" target=\"_self\">" . $this->lang["all"] . "</a>";
	}
  }

  function rotateimage($id, $direction){
	unset($filename);
    if (function_exists(imagerotate)) {
      $result = $this->select($id,$this->all_images,0,1,0);
	  $filename[] = "pictures/" . $result[0][1];
      $all_id = $this->search_iDB($id,0);
	  $_REQUEST['editID'] = $id;
	  if ($direction == "left") $degrees = 90;
	  if ($direction == "right") $degrees = -90;
	  if(is_file($this->thumb($filename[0]))) $filename[] = $this->thumb($filename[0]);
	  if(is_file($this->medium($filename[0]))) $filename[] = $this->medium($filename[0]);
	  for ($i=0; $i < count($filename); $i++) {
        $fileInfo = pathinfo($filename[0]);
        $extension = strtolower($fileInfo["extension"]);
        if ($extension == 'jpg' || $ext == 'jpeg') {
          $source = imagecreatefromjpeg($filename[$i]);
          $rotate = imagerotate($source, $degrees, 0);
          unlink($filename[$i]);
          imagejpeg($rotate, $filename[$i],100);
          $this->status = $howmany . " " . $this->lang['imagerotated'];
        } else if ($extension == 'png') {
		  if ($i == 0) {
            $source = imagecreatefrompng($filename[$i]);
            $rotate = imagerotate($source, $degrees, 0);
            unlink($filename[$i]);
            imagepng($rotate, $filename[$i],100);
          } else {
            $source = imagecreatefromjpeg($filename[$i]);
            $rotate = imagerotate($source, $degrees, 0);
            unlink($filename[$i]);
            imagejpeg($rotate, $filename[$i],100);
          }
          $this->status = $howmany . " " . $this->lang['imagerotated'];
        } else if ($extension == 'gif') {
          $this->status = $howmany . " " . $this->lang['gifnotrotated'];
        }
      }
	  //UPDATE DATABASE ENTRY
	  $newsize = filesize($filename[0]);
      list($newwidth, $newheight, $newtype, $newattr) = getimagesize($filename[0]);
      list($thumb_newwidth, $thumb_newheight, $thumb_newtype, $thumb_newattr) = getimagesize($filename[1]);
      $this->all_images[$all_id][5] = $newsize;
      $this->all_images[$all_id][6] = $newwidth;
      $this->all_images[$all_id][7] = $newheight;
      $this->all_images[$all_id][8] = $thumb_newwidth;
      $this->all_images[$all_id][9] = $thumb_newheight;
      $this->write_iDB();
    } else echo "MG2 ERROR: Imagerotate function missing (Function: rotateimage)";
    $this->log("Rotated image #$id $direction");
    include("skins/admin/admin2_status.php");
  }


  function db_backup(){
    copy("mg2db_idatabase.php", "mg2db_idatabase.php.backup");
    copy("mg2db_fdatabase.php", "mg2db_fdatabase.php.backup");
    $this->status = $this->lang['backupcomplete'];
	$this->log("Database backup complete");
    include("skins/admin/admin2_status.php");
  }

  function check_new_version() {
    $url_parsed = parse_url("http://www.minigal.dk/mg2_scriptversion.php");
    $path = $url_parsed["path"];
    if ($url_parsed["query"] != "")
      $path .= "?".$url_parsed["query"];
    $out = "GET $path HTTP/1.0\r\nHost: ".$url_parsed["host"]."\r\n\r\n";

    $fp = fsockopen($url_parsed["host"], 80, $errno, $errstr, 1);

    if (!$fp) {
      return "$errstr ($errno)<br />\n";
    } else {
      fwrite($fp, $out);
      $body = false;
      while (!feof($fp)) {
        $mainversion = fgets($fp, 1024);

        // If the server is down/file is gone.
        if($mainversion == "HTTP/1.1 404 Not Found\r\n") return;

        //Clever little thing to remove the header.
        if ($body)
        $in[] = explode("*",$mainversion);
        if ( $mainversion == "\r\n" )
        $body = true;
      }
	}
    fclose($fp);
    switch (version_compare(trim($mainversion),$this->version)) {
    case 0:
      echo "<h2>" . $this->lang["version1"] . "</h2>";
      break;
    case 1:
      echo "<h3>" . str_replace("X", $mainversion, $this->lang["version2"]) . "</h3>";
	  echo "<a href=\"http://www.minigal.dk/download.php\" target=\"_blank\">" . $this->lang["goto"] . " www.minigal.dk</a><br />";
      break;
    case -1:
      echo "<h4>" . $this->lang["version3"] . "</h4>";
	  echo "<a href=\"http://www.minigal.dk/download.php\" target=\"_blank\">" . $this->lang["goto"] . " www.minigal.dk</a><br />";
      break;
    }
  }

}
?>
