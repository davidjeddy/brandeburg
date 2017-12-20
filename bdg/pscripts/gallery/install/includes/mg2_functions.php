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

class mg2db{

  //
  // SORT SEARCH RESULTS
  //
  function sort($datatable,$field,$mode) {
     $i_cnt = count($datatable);
     for($i=0;$i<$i_cnt;$i++) {
       foreach($datatable[$i] as $key => $value) {
           $array[$key][$i] = $value;
       }
     }
     $mode == 0 ? asort($array[$field]) :  arsort($array[$field]);
     $_keys = array_keys($array[$field]);
     for($i=0;$i<$i_cnt;$i++) {
       foreach($array as $key => $value) {
           $_hash[$i][$key] = $array[$key][$_keys[$i]];
       }
     }
     return $_hash;
  }

  //
  // UPDATE DATABASE FROM TEMP FILES
  //
  function updateDB(){
    $iDB = "mg2db_idatabase.php";
    $iDB_temp = "mg2db_idatabase_temp.php";

    $fDB = "mg2db_fdatabase.php";
    $fDB_temp = "mg2db_fdatabase_temp.php";

    //OVERWRITE ORIGINAL WITH TEMP FILE IF CHANGED
    if (IS_FILE($iDB) && IS_FILE($iDB_temp) && filemtime($iDB) < filemtime($iDB_temp)){
      if (!copy($iDB_temp, $iDB)) {
      	$this->log("ERROR: Failed to copy temporary image database file");
        echo "MG2 ERROR: Failed to copy temp file (function 'readDB')";
        exit();
      }

    }
    if (IS_FILE($fDB) && IS_FILE($fDB_temp) && filemtime($fDB) < filemtime($fDB_temp)){
      if (!copy($fDB_temp, $fDB)) {
      	$this->log("ERROR: Failed to copy temporary folder database file");
        echo "MG2 ERROR: Failed to copy temp file (function 'readDB')";
        exit();
      }
    }
  }

  //
  // READ ENTIRE DATABASE
  //
  function readdb(){
    $iDB = "mg2db_idatabase.php";
    $fDB = "mg2db_fdatabase.php";

    $this->updateDB();
    if (is_file($iDB)){
      $fd = fopen($iDB,"r");
      $this->autoid = trim(fgets($fd,4096));
      while (!feof ($fd)) {
        if(fgets($fd,2) == "*")
          $this->all_images[] = fgetcsv($fd,4096,"*");
      }
      fclose($fd);
    }else {
      $fd = fopen($iDB,"w");
      fclose($fd);
    }

    if (is_file($fDB)){
      $fd = fopen($fDB,"r");
      $this->folderautoid = trim(fgets($fd,4096));
      while (!feof ($fd)) {
        if(fgets($fd,2) == "*")
          $this->all_folders[] = fgetcsv($fd,4096,"*");
      }
      fclose($fd);
    }else {
      $fd = fopen($fDB,"w");
      fwrite($fd,"1\n");
      fwrite($fd,"*1*root*root*1*0*****");
      fclose($fd);
    }
  }

  //
  // SELECT ENTRIES FROM DATABASE
  //
  function select($key,$array,$row,$sortrow,$sortmode){
    for ($idx=0; $idx < count($array); $idx++){
      if ($array[$idx][$row] == $key) $selectarray[] = $array[$idx];
    }
    if ($key == "*")
      $selectarray = $array;
    if (is_array($selectarray))
      $selectarray = $this->sort($selectarray,$sortrow,$sortmode);
    return $selectarray;
  }

  function insert($filename="", $folder="1", $password="", $description="", $filesize="", $width="", $height="", $tn_width="", $tn_height="", $filetime=""){
    $this->all_images[] = array(($this->autoid+1), $filename, $folder, $password, $description, $filesize, $width, $height, $tn_width, $tn_height, $filetime);
    $this->autoid = $this->autoid + 1;
  }
  
  //
  // WRITE IMAGE DATABASE
  //
  function write_iDB(){
	if (count($this->all_images) > 0) {
      unset($buffer);
      for ($i=0; $i < count($this->all_images); $i++){
        for ($j=0; $j < count($this->all_images[$i]); $j++){
          $buffer .= "*" . $this->all_images[$i][$j];
        }
        $buffer .= "\n";
      $fd = fopen("mg2db_idatabase_temp.php","w+");
      if (flock($fd, LOCK_EX)) { // do an exclusive lock
        ftruncate($fd, 0);
        fwrite($fd, $this->autoid . "\n");
        fwrite($fd, $buffer);
        flock($fd, LOCK_UN); // release the lock
        fclose($fd);
      } else {
        $this->log("ERROR: Could not lock image database for writing");
        echo "MG2 ERROR: Could not lock temp file (function 'write_iDB')";
        }
      }
      $this->log("Writing image database");
    } else $this->log("ERROR: Writing image database - Image array empty!");
  }

  //
  // WRITE FOLDER DATABASE
  //
  function write_fDB(){
	if (count($this->all_folders) > 0) {
      unset($buffer);
      for ($i=0; $i < count($this->all_folders); $i++){
        for ($j=0; $j < count($this->all_folders[$i]); $j++){
          $buffer .= "*" . $this->all_folders[$i][$j];
        }
        $buffer .= "\n";
      $fd = fopen("mg2db_fdatabase_temp.php","w+");
      if (flock($fd, LOCK_EX)) { // do an exclusive lock
        ftruncate($fd, 0);
        fwrite($fd, $this->folderautoid . "\n");
        fwrite($fd, $buffer);
        flock($fd, LOCK_UN); // release the lock
        fclose($fd);
      } else {
        $this->log("ERROR: Could not lock folder database file for writing");
        echo "MG2 ERROR: Could not lock temp file (function 'write_fDB')";
        }
      }
      $this->log("Writing folder database");
    } else $this->log("ERROR: Writing image database - Image array empty!");
  }

  //
  // SEARCH DATABASE FOR FILENAME
  //
  function inDB($filename){
    $search = $this->select($filename,$this->all_images,1,1,0);
    if (count($search) == 0){
      return false;
    } else return true;
  }

  //
  // NEW DATABASE ENTRY
  //
  function addnew($filename, $folder="1"){
    if (is_file("pictures/" . $filename) && $this->inDB == false){

      list($width, $height, $type, $attr) = getimagesize("pictures/" . $filename);
      $filesize = filesize("pictures/" . $filename);

      if (is_file("pictures/" . $this->thumb($filename))){
        list($tn_width, $tn_height, $type, $attr) = getimagesize("pictures/" . $this->thumb($filename));
      }
        $filetime = filectime("pictures/" . $filename);
      $this->insert($filename, $folder, $password, $description, $filesize, $width, $height, $tn_width, $tn_height, $filetime);
      return true;
    } else return false;
  }

  //
  // IMPORT NEW IMAGES
  //
  function importnewimages(){
    $allowed_extensions = explode(",", $this->extensions);
    if (!$_REQUEST['list']) $_REQUEST['list'] = "1";
    if ($handle = opendir("pictures/")) {
      while (false !== ($file = readdir($handle))) {
        $fileInfo = pathinfo("pictures/" . $file);
        $extension = strtolower($fileInfo["extension"]);
	    if(is_file("pictures/" . $file) && !$this->inDB($file) && in_array(strtolower($extension), $allowed_extensions) && strpos($file, "_medium") === false && strpos($file, "_thumb") === false){
		  $this->log("Importing '$file' (" . filesize("pictures/" . $file). " bytes)");
	      $imported++;
	      @chmod("pictures/" . $file,0644);
          $this->createthumb($file);
		  $this->log(" * finished creating thumbnails");
          $this->addnew($file,$_REQUEST['list']);
		  $this->log(" * finished adding file to database");
		  $this->log(" = finished importing '$file'");
        }
      }
    $this->write_iDB();
    closedir($handle);
	$this->updateDB();
    return $imported;
    }
  }

  //
  // IMAGE NAVIGATION
  //
  function imagenavigation($result){
    $result = $this->select($result,$this->all_images,2,$this->folder_sortby,$this->folder_sortway);
    $folders = $this->select($result[0][2],$this->all_folders,1,0,0);
    for($i=0; $i < count($result);$i++){
      if ($_REQUEST['id'] == $result[$i][0]){
        $this->page = ceil(($i + 1 + count($folders)) / ($this->imagerows * $this->imagecolumns));
	$this->nav_current = $i + 1;
	break;
      }
    }
    $this->nav_total = count($result);
    $navtxt_total = $this->lang['total'];
    if ($result[$this->nav_current - 2][0] != "") $this->nav_prev = "<a href=\"" . $this->indexfile . "?id=" . $result[$this->nav_current - 2][0] . "\">" . $this->lang['prev']. "</a>";
    else $this->nav_prev = $this->lang['prev'];

    if ($result[0][0] != $_REQUEST['id']) $this->nav_first = "<a href=\"" . $this->indexfile . "?id=" . $result[0][0] . "\">" . $this->lang['first']. "</a>";
    else $this->nav_first = $this->lang['first'];

    if ($result[$this->nav_current][0] != "") $this->nav_next = "<a href=\"" . $this->indexfile . "?id=" . $result[$this->nav_current][0] . "\">" . $this->lang['next']. "</a>";
    else $this->nav_next = $this->lang['next'];

    if ($this->nav_total != $this->nav_current) $this->nav_last = "<a href=\"" . $this->indexfile . "?id=" . $result[$this->nav_total - 1][0] . "\">" . $this->lang['last']. "</a>";
    else $this->nav_last = $this->lang['last'];
  }

  //
  // GALLERY NAVIGATION
  //
  function gallerynavigation($delimiter){
    echo "&nbsp;";
    if ($_REQUEST['list'] != "") $result = $_REQUEST['list'];
    if ($_REQUEST['id'] != "") {
      $getfolder = $this->select($_REQUEST['id'],$this->all_images,0,1,0);
      $result = $getfolder[0][2];
      $imgdisplay = 1;
    }
    while ($result != "1" && $result != ""){
      $result = $this->select($result,$this->all_folders,0,1,0);
      $folders[] = $result[0][1];
      $result = $result[0][1];
    }

  	if ($this->websitelink != "") echo "<a href=\"$this->websitelink\" target=\"_self\">" . $this->lang['website'] . "</a>";

    for ($i=count($folders) - 1; $i >= 0; $i--){
      if ($folders[$i] == "1"){
        if ($this->websitelink != "") echo " $delimiter ";
        echo "<a href=\"?list=" . $folders[$i] . "\">" . $this->lang['gallery'] . "</a>";
      }else
      echo " $delimiter <a href=\"?list=" . $folders[$i] . "\">" . $this->getfoldername($folders[$i]) . "</a>";
    }
    if ($imgdisplay == 1){
      if ($getfolder[0][2] == "1"){
        if ($this->websitelink != "") echo " $delimiter ";
        echo "<a href=\"?list=" . $folders[$i] . "\">" . $this->lang['gallery'] . "</a>";
      }else
      echo " $delimiter <a href=\"?list=" . $getfolder[0][2] . "\">" . $this->getfoldername($getfolder[0][2]) . "</a>";
    }
  }

  //
  // PAGE NAVIGATION
  //
  function pagenavigation($pages, $list) {
    if ($pages > 1) {
      echo "<p align=\"center\">" . $this->lang['page'] . " ";
      for ($i=1; $i <= $pages; $i++) {
	if ($i == $_REQUEST['page']) {
	  echo "| $i ";
	} else
	echo "| <a href=\"" . $this->galleryindex . "?list=$list&amp;page=$i\" target=\"_self\">" . $i . "</a> ";
      }
      if ($_REQUEST['page'] == "all") {
        echo "| " . $this->lang['all'];
      } else
      echo "| <a href=\"" . $this->galleryindex . "?list=$list&amp;page=all\" target=\"_self\">" . $this->lang['all']. "</a>";
      echo "</p>";
    }
  
  }

  //
  // SEARCH IMAGE DATABASE
  //
  function search_iDB($string, $field){
    for ($i=0; $i < count($this->all_images); $i++) {
      if ($this->all_images[$i][$field] == $string) {
	return $i;
      }
    }
  }

  //
  // SEARCH FOLDER DATABASE
  //
  function search_fDB($string, $field){
    for ($i=0; $i < count($this->all_folders); $i++) {
      if ($this->all_folders[$i][$field] == $string) {
	return $i;
      }
    }
  }

  //
  // DETERMINE THUMBNAIL
  //
  function getthumb($folder){
    unset($this->subfolder_class);
    unset($this->icon_comp);
    $subfiles = $this->select($folder,$this->all_images,2,1,0);
    $subfolders = $this->select($folder,$this->all_folders,1,1,0);
    $currentfolder = $this->select($folder,$this->all_folders,0,1,0);

    // DOES STANDARD THUMB EXIST?
    if ($currentfolder[0][7] != "") {
      if ($this->foldericons == 1) {
        $this->width = 150;
        $this->height = 100;
        $icon_comp = 2;
        $this->subfolder_class = "subfolder";
        return "skins/$this->activeskin/images/folder.gif";
      }
      $this->width = $currentfolder[0][8];
      $this->height = $currentfolder[0][9];
      $this->subfolder_class = "subfolder border";
      return "pictures/" . $currentfolder[0][7];
    }
    
    // IS FOLDER LOCKED?
    else if ($currentfolder[0][5] != "") {
      $this->width = 150;
      $this->height = 100;
      $this->subfolder_class = "subfolder";
      $icon_comp = 2;
      return "skins/$this->activeskin/images/locked.gif";
    }

    // DOES FOLDER CONTAIN IMAGES?
    if (count($subfiles) > 0){
      if ($this->foldericons == 1) {
        $this->width = 150;
        $this->height = 100;
        $this->subfolder_class = "subfolder";
        $icon_comp = 2;
        return "skins/$this->activeskin/images/folder.gif";
      }
      $random = array_rand($subfiles);
      $this->width = $subfiles[$random][8];
      $this->height = $subfiles[$random][9];
      $this->subfolder_class = "subfolder border";
      return "pictures/" . $this->thumb($subfiles[$random][1]);

    // DOES FOLDER CONTAIN FOLDERS?
    }else if (count($subfolders) > 0) {
      $this->width = 150;
      $this->height = 100;
      $this->subfolder_class = "subfolder";
      $icon_comp = 2;
      return "skins/$this->activeskin/images/folder.gif";
    }

    // FOLDER IS EMPTY
    else{
      $this->width = "150";
      $this->height = "100";
      $this->subfolder_class = "subfolder";
      $this->icon_comp = 2;
      return "skins/$this->activeskin/images/emptyfolder.gif";
    }
  }

  //
  // READ FOLDER SORTING SETTINGS
  //
  function getfoldersettings($list){
    $this->folder_pwd = 0;
    $result = $this->select($list,$this->all_folders,0,0,0);
    if($result[0][3] == "") $this->folder_sortby = 1;
    else $this->folder_sortby = $result[0][3];
    if($result[0][4] == "") $this->folder_sortway = 1;
    else $this->folder_sortway = $result[0][4];
    $this->introtext = $result[0][10];
    if($result[0][5] != "") $this->folder_pwd = 1;
  }
  
  //
  // DELETE DATABASE ENTRY
  //
  function array_delete ( $array, $index ) {
   if ( is_array ( $array ) ) {
     unset ( $array[$index] );
     array_unshift ( $array, array_shift ( $array ) );
     return $array;
     }
   else {
     return false;
     }
	$this->log("Database entry deleted");
   }

  //
  // DECIMAL TO FRACTION
  //
  function dec2frac( $decimal ) {
    $decimal = (string)$decimal;
    $num = '';
    $den = 1;
    $dec = false;

    // find least reduced fractional form of number
    for( $i = 0, $ix = strlen( $decimal ); $i < $ix; $i++ )
    {
     // build the denominator as we 'shift' the decimal to the right
     if( $dec ) $den *= 10;

     // find the decimal place/ build the numberator
     if( $decimal{$i} == '.' ) $dec = true;
     else $num .= $decimal{$i};
    }
    $num = (int)$num;

    // whole number, just return it
    if( $den == 1 ) return $num;

    $num2 = $num;
    $den2 = $den;
    $rem  = 1;
    // Euclid's Algorithm (to find the gcd)
    while( $num2 % $den2 ) {
     $rem = $num2 % $den2;
     $num2 = $den2;
     $den2 = $rem;
    }
    if( $den2 != $den ) $rem = $den2;

    // now $rem holds the gcd of the numerator and denominator of our fraction
    return ($num / $rem ) . "/" . ($den / $rem);
  }

  //
  // GET GD LIB VERSION
  //
  function gd_version() {
    $gdInfo = gd_info();
    $this->gd_version_number = trim(ereg_replace("[A-Za-z()]", "", $gdInfo["GD Version"]));
    return $this->gd_version_number;
  }

  //
  // GET FOLDER NAME
  //
  function getfoldername($id) {
    $result = $this->select($id,$this->all_folders,0,1,0);
    if ($result[0][2] == "1") $result[0][2] = "root";
    return $result[0][2];
  }

  //
  // SUBGALLERY SECURITY
  //
  function gallerysecurity($folderpassword) {
    if (md5(strrev(md5($_REQUEST["password"]))) == $folderpassword) {
      $_SESSION["folderpassword"] = md5(strrev(md5($_REQUEST["password"])));
    }else if ($_SESSION["folderpassword"] == $folderpassword) {
    }else if ($folderpassword != "" && md5(strrev(md5($_REQUEST["password"]))) != $folderpassword) {
      include("skins/$this->activeskin/templates/thumbnails_password.php");
      exit();
    }
  }

  function charfix($string) {
    $string = str_replace("*","#",$string);
    $string = str_replace(chr(92).chr(34),"&quot;",$string);
    $string = str_replace("\'","'",$string);
    $string = str_replace(chr(34),"&quot;",$string);
    return $string;
  }

  function readcomments($filename) {
    if (is_file($filename)){
      $fd = fopen($filename,"r");
      while (!feof ($fd)) {
        if(fgets($fd,2) == "*")
          $this->comments[] = fgetcsv($fd,4096,"*");
      }
      fclose($fd);
      $this->comments = $this->sort($this->comments,0,1);
	  $this->log("Read file comments from '$filename'");
    }
  }

  function writecomments($filename) {
	$filename = "pictures/" . $filename;
    unset($buffer);
    if (count($this->comments) != 0) {
    for ($i=0; $i < count($this->comments); $i++){
      for ($j=0; $j < count($this->comments[$i]); $j++){
        $buffer .= "*" . $this->comments[$i][$j];
      }
      $buffer .= "\n";
    $fd = fopen($filename,"w+");
    if (flock($fd, LOCK_EX)) { // do an exclusive lock
      ftruncate($fd, 0);
      fwrite($fd, $buffer);
      flock($fd, LOCK_UN); // release the lock
      fclose($fd);
	  $this->log("Wrote comment to '$filename'");
    } else {
	  $this->log("ERROR: Could not lock commentfile '$filename' for writing");
      echo "MG2 ERROR: Could not lock $filename (function 'writecomments')";
      }
    }
    } else unlink($filename);
  }

  function addcomment() {
    $_REQUEST['filename'] = $this->charfix($_REQUEST['filename']);
    $_REQUEST['input'] = $this->charfix($_REQUEST['input']);
    $_REQUEST['email'] = $this->charfix($_REQUEST['email']);
    $_REQUEST['name'] = $this->charfix($_REQUEST['name']);
    $_REQUEST['input'] = strip_tags($_REQUEST['input'], "<b></b><i></i><u></u><strong></strong><em></em>");
    $_REQUEST['input'] = str_replace("\n","<br />",$_REQUEST['input']);
    $_REQUEST['input'] = str_replace("\r","",$_REQUEST['input']);
    if ($_REQUEST['input'] != "" && $_REQUEST['name'] != "" && $_REQUEST['email'] != "") {
      $this->readcomments("pictures/" . $_REQUEST['filename'] . ".comment");
      $comment_exists = $this->select($_REQUEST['input'],$this->comments,3,1,0);
      $comment_exists = $this->select($_REQUEST['name'],$comment_exists,1,1,0);
      $comment_exists = $this->select($_REQUEST['email'],$comment_exists,2,1,0);
      if (count($comment_exists) == 0) {
        $this->comments[] = array(time(), $_REQUEST['name'], $_REQUEST['email'], $_REQUEST['input']);
        $this->writecomments($_REQUEST['filename'] . ".comment");

	// SEND COMMENT EMAIL
	if ($this->sendmail == 1) {
          mail($this->adminemail, $this->gallerytitle . ": " . $this->lang['commentadded'], strtoupper($this->lang['from']) . ":\n" . $_REQUEST['name'] . "(" . $_REQUEST['email'] .  ")\n\n" . strtoupper($this->lang['comment']) . ":\n" . str_replace("<br />", "\n",$_REQUEST['input']) . "\n\n" . "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . "?id=" . $_REQUEST['id'], "From: " . $_REQUEST["email"] . "\nReply-to: " . $_REQUEST["email"]);
	$this->log("Sent comment email");
	}
        echo "<div align=\"center\"><strong><b>" . $this->lang['commentadded'] . "</b></strong></div>";
      } else echo "<div align=\"center\"><strong><b>" . $this->lang['commentexists'] . "</b></strong></div>";
    } else echo "<div align=\"center\"><strong><b>" . $this->lang['commentmissing'] . "</b></strong></div>";
    unset($this->comments);
  }

  function getlanguages() {
    $workdir = opendir("lang");
    while (false !== ($pointer = readdir($workdir))) {
      if ($pointer !== "." && $pointer !== "..") {
        $this->languages[] = ucfirst(substr($pointer,0,(strlen($pointer)-4)));
      }
    }
    sort($this->languages);
  }

  function output($var) {
	if (isset($this->$var)) {
	  echo $this->$var;
	} else echo "No data (" . $var . ")";
  }

  function log($entry) {
	$logfile = "mg2_log.txt";
	// DELETE LARGE LOG FILE
	if (is_file($logfile) && filesize($logfile) > 300000) unlink($logfile);
	// CREATE NEW LOGFILE
	if (!is_file($logfile)) {
      $fd = fopen($logfile,"a+");
      fwrite($fd,"MG2 LFS (Log File System)\n\n");
      fwrite($fd,"Version: " . $this->version . "\n");
      fwrite($fd,"Install date: " . date("Y-m-d",$this->installdate) . "\n\n---LOG BEGIN------------------\n\n");
      fwrite($fd,date("Ymd, H.i.s : ") . $entry . "\n");
    } else {
      $fd = fopen($logfile,"a+");
      fwrite($fd,date("Ymd, H.i.s : ") . $entry . "\n");
    }
  }

  function medium($name) {
    $ext = strrchr($name, '.');
    if($ext !== false) {
        $name = substr($name, 0, -strlen($ext)) . "_medium." . end(explode('.',$name));
    }
    return $name;
  }

  function thumb($name) {
    $ext = strrchr($name, '.');
    if($ext !== false) {
        $name = substr($name, 0, -strlen($ext)) . "_thumb." . end(explode('.',$name));
    }
    return $name;
  }

  function name_remove($name) {
	$name = str_replace("_medium", "", $name);
	$name = str_replace("_thumb", "", $name);
    return $name;
  }

}
?>
