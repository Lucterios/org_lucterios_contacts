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
// --- Last modification: Date 06 August 2008 8:22:36 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@Editer une personne abstraite
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personneAbstraite_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBObject($self,"adresse", false,$posY++,$posX,3);
$xfer_result->setDBObject($self,"codePostal", false,$posY,$posX);
$DBObjCodePostal = new DBObj_org_lucterios_contacts_CodePostal;
$pays = $DBObjCodePostal->fillVilleInXferCustom($self->codePostal,$self->ville,$posX+2,$posY++,$xfer_result);
if($pays != '')$self->pays = $pays;
$xfer_result->setDBObject($self,"pays", false,$posY++,$posX);
$xfer_result->setDBObject($self,"fixe", false,$posY,$posX);
$xfer_result->setDBObject($self,"portable", false,$posY++,$posX+2);
$xfer_result->setDBObject($self,"fax", false,$posY++,$posX);
$xfer_result->setDBObject($self,"mail", false,$posY++,$posX,3);
$posY = 50;
$xfer_result->setDBObject($self,"commentaire", false,$posY++,$posX,3);
//
$lbl = new Xfer_Comp_LabelForm('Lbl_uploadlogo');
$lbl->setValue('{[bold]}Image{[/bold]}');
$lbl->setLocation($posX,$posY);
$xfer_result->addComponent($lbl);
$upload = new Xfer_Comp_UpLoad('uploadlogo');
$upload->setValue('');
$upload->addFilter('.jpg');
if(function_exists('imageCreateFromGIF'))
	$upload->addFilter('.gif');
if(function_exists('imageCreateFromPNG'))
	$upload->addFilter('.png');
if(function_exists('imageCreateFromWBMP'))
	$upload->addFilter('.bmp');
$upload->setLocation($posX+1,$posY++,3);
$xfer_result->addComponent($upload);

$lbl = new Xfer_Comp_LabelForm('Lbl_warning');
$lbl->setValue("{[center]}{[italic]}{[font size='-2']}Importer de préférence une image JPEG de 100x100 pts.{[/font]}{[/italic]}{[/center]}");
$lbl->setLocation($posX,$posY,4);
$xfer_result->addComponent($lbl);
//
$xfer_result->resize($posX+1,150,20);
$xfer_result->resize($posX+3,150,20);
return $xfer_result;
//@CODE_ACTION@
}

?>
