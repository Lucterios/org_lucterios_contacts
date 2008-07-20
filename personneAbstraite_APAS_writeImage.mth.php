<?php
// Method file write by SDK tool
// --- Last modification: Date 31 May 2008 9:01:28 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ Params

function personneAbstraite_APAS_writeImage(&$self,$Params)
{
//@CODE_ACTION@
$uploadlogo = $Params['uploadlogo'];
list($name_upload,$value_upload) = split(';',$uploadlogo);
if($name_upload != '') {
	$path = "usr/org_lucterios_contacts";
	if(! is_dir($path))@mkdir($path,0777);
	$source_pic = $path."/Image_temp.jpg";
	$destination_pic = $path."/Image_".$self->id.".jpg";
	if($handle = fopen($source_pic,'w')) {
		$content = base64_decode($value_upload, true);
		if( fwrite($handle,$content) !== FALSE) fclose($handle);
	}
	@unlink($destination_pic);
	//
	$max_width = 100;
	$max_height = 100;
	$image_info = getImageSize($source_pic);
	list($width,$height) = $image_info;
	$x_ratio = $max_width/$width;
	$y_ratio = $max_height/$height;
	if(($width<=$max_width) && ($height<=$max_height)) {
		$tn_width = $width;
		$tn_height = $height;
	}
	elseif (($x_ratio*$height)<$max_height) {
		$tn_height = ceil($x_ratio*$height);
		$tn_width = $max_width;
	}
	else {
		$tn_width = ceil($y_ratio*$width);
		$tn_height = $max_height;
	}
	switch($image_info['mime']) {
	case 'image/gif':
		if( imagetypes()& IMG_GIF) {
			// not the same as IMAGETYPE
			$src = imageCreateFromGIF($source_pic);
		}
		break;
	case 'image/jpeg':
		if( imagetypes()& IMG_JPG) {
			$src = imageCreateFromJPEG($source_pic);
		}
		break;
	case 'image/png':
		if( imagetypes()& IMG_PNG) {
			$src = imageCreateFromPNG($source_pic);
		}
		break;
	case 'image/wbmp':
		if( imagetypes()& IMG_WBMP) {
			$src = imageCreateFromWBMP($source_pic);
		}
		break;
	}
	if(isset($src)) {
		$tmp = imagecreatetruecolor($tn_width,$tn_height);
		$r = imagecopyresampled($tmp,$src,0,0,0,0,$tn_width,$tn_height,$width,$height);
		$r = imagejpeg($tmp,$destination_pic,100);
		$r = imagedestroy($src);
		$r = imagedestroy($tmp);
	}
}
//@CODE_ACTION@
}

?>
