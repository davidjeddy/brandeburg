<br />
<br />
<table cellspacing="5" cellpadding="0" class="table_exif" width="300" align="center">
  <tr>
    <td colspan="2" align="center"><b><? echo $mg2->lang['exif info'] ?></b></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['model'] ?></td>
    <td><? echo $exif_data['Model'] ?></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['shutter'] ?></td>
    <td><? echo $exif_data['ExposureTime'] ?></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['aperture'] ?></td>
    <td><? echo $exif_data['FNumber'] ?></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['focallength'] ?></td>
    <td><? echo $exif_data['FocalLength'] ?></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['iso'] ?></td>
    <td><? echo $exif_data['ISOSpeedRating'] ?></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['exposurecomp'] ?></td>
    <td><? echo $exif_data['ExposureBias'] ?></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['flash'] ?></td>
    <td><? echo $exif_data['Flash'][1] ?></td>
  </tr>
  <tr>
    <td><? echo $mg2->lang['original'] ?></td>
    <td><? echo $exif_data['DateTime'] ?></td>
  </tr>
</table>

