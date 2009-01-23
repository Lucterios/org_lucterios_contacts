<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Method file write by SDK tool
// --- Last modification: Date 08 January 2009 21:49:19 By  ---

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
global $rootPath;
if(!isset($rootPath))$rootPath = "";

$uploadlogo = $Params['uploadlogo'];
list($name_upload,$value_upload) = split(';',$uploadlogo);
if($name_upload != '') {
	require_once "CORE/Lucterios_Error.inc.php";
	$path = $rootPath."usr/org_lucterios_contacts";
	if(! is_dir($path))@mkdir($path,0777);
	$source_pic = $path."/Image_temp.jpg";
	$destination_pic = $path."/Image_".$self->id.".jpg";
	$content = base64_decode(str_replace(array('\n',' ','\t'),'',$value_upload), true);
	@unlink($source_pic);
	if($handle = @fopen($source_pic,'a')) {
		if( fwrite($handle,$content) == 0)
			throw new LucteriosException(IMPORTANT,"Image non sauvé!");
		fclose($handle);
	}
	//
	$max_width = 100;
	$max_height = 100;
	$image_info = @getImageSize($source_pic);
	if(!isset($image_info))
		throw new LucteriosException(IMPORTANT,"Format d'image non supporté!");
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
	$only_copy=false;
	switch($image_info['mime']) {
	case 'image/jpeg':
		$only_copy=(($width<=$max_width) && ($height<=$max_height));
		if (!$only_copy) {
			if(!function_exists('imageCreateFromJPEG'))
				throw new LucteriosException(IMPORTANT,"Format JPEG non supporté!");
			$src = imageCreateFromJPEG($source_pic);
		}
		break;
	case 'image/gif':
		if(!function_exists('imageCreateFromGIF'))
			throw new LucteriosException(IMPORTANT,"Format GIF non supporté!");
		$src = imageCreateFromGIF($source_pic);
		break;
	case 'image/png':
		if(!function_exists('imageCreateFromPNG'))
			throw new LucteriosException(IMPORTANT,"Format PNG non supporté!");
		$src = imageCreateFromPNG($source_pic);
		break;
	case 'image/wbmp':
	case 'image/bmp':
		if(!function_exists('imageCreateFromWBMP'))
			throw new LucteriosException(IMPORTANT,"Format BMP non supporté!");
		$src = imageCreateFromWBMP($source_pic);
		break;
	}
	if(isset($src) || $only_copy) {
		@unlink($destination_pic);
		if ($only_copy) {
			rename($source_pic,$destination_pic);
		}
		else {
			$tmp = imagecreatetruecolor($tn_width,$tn_height);
			$r = imagecopyresampled($tmp,$src,0,0,0,0,$tn_width,$tn_height,$width,$height);
			$r = imagejpeg($tmp,$destination_pic,100);
			$r = imagedestroy($tmp);
			@unlink($source_pic);
		}
		if (isset($src))
			$r = imagedestroy($src);
	}
	else {
		throw new LucteriosException(IMPORTANT,"Image illisible!");
	}

}
//@CODE_ACTION@
}

?>
