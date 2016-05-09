<?php
/**
 * ten_hinhanh resize while uploading
 * @author Resalat Haque
 * @link http://www.w3bees.com/2013/03/resize-ten_hinhanh-while-upload-using-php.html
 */
 
/**
 * ten_hinhanh resize
 * @param int $width
 * @param int $height
 */
function resize($width, $height){
	/* Get original ten_hinhanh x y*/
	list($w, $h) = getten_hinhanhsize($_FILES['ten_hinhanh']['tmp_name']);
	/* calculate new ten_hinhanh size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	$path = URL.'public/admin/hinhanh/'.$width.'x'.$height.'_'.$_FILES['ten_hinhanh']['name'];
	/* read binary data from ten_hinhanh file */
	$imgString = file_get_contents($_FILES['ten_hinhanh']['tmp_name']);
	/* create ten_hinhanh from string */
	$ten_hinhanh = ten_hinhanhcreatefromstring($imgString);
	$tmp = ten_hinhanhcreatetruecolor($width, $height);
	ten_hinhanhcopyresampled($tmp, $ten_hinhanh,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	/* Save ten_hinhanh */
	switch ($_FILES['ten_hinhanh']['type']) {
		case 'ten_hinhanh/jpeg':
			ten_hinhanhjpeg($tmp, $path, 100);
			break;
		case 'ten_hinhanh/png':
			ten_hinhanhpng($tmp, $path, 0);
			break;
		case 'ten_hinhanh/gif':
			ten_hinhanhgif($tmp, $path);
			break;
		default:
			exit;
			break;
	}
	return $path;
	/* cleanup memory */
	ten_hinhanhdestroy($ten_hinhanh);
	ten_hinhanhdestroy($tmp);
}
?>