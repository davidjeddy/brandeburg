<?php
  @rmdir("pictures/x");
  if (@mkdir("pictures/x")) {
    @rmdir("pictures/x");
  } else {echo "ERROR: Cannot write to 'pictures' folder. Chmod 'pictures' to 777 before continuing!";exit();}

include('includes/mg2_functions.php');
$mg2 = new mg2db;

    if ($handle = opendir("pictures/")) {
      while (false !== ($file = readdir($handle))) {
		if (strrchr($file, '.') == ".thumb") {
          rename("pictures/" . $file, "pictures/" . $mg2->thumb(substr($file, 0, -strlen(strrchr($file, '.')))));
        }
		if (strrchr($file, '.') == ".medium") {
          rename("pictures/" . $file, "pictures/" . $mg2->medium(substr($file, 0, -strlen(strrchr($file, '.')))));
        }
	  }
    }
echo "Your gallery should now be upgraded to 0.5.0 - IMPORTANT: DELETE UPGRADE.PHP USING FTP NOW!!!";
?>
