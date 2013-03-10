<?php
// This file is part of Lucterios, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// Thanks to have payed a donation for using this module.
// 
// Lucterios is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Method file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@Voir un personneAbstraite
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personneAbstraite_APAS_show(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
global $rootPath;
if(!isset($rootPath))
	$rootPath = "";
if(!isset($xfer_result->m_context['PRINT'])) {
	$lbl_plan = new Xfer_Comp_LinkLabel('plan');
	$lbl_plan->setValue('plan');
	$adress = $self->adresse;
	$adress = str_replace(' ','+',$adress);
	$adress = str_replace('{[newline]}','+',$adress);
	$lbl_plan->setLink('http://maps.google.fr/maps?near='.$adress.'+'.$self->codePostal.'+'.$self->ville);
	$lbl_plan->setLocation($posX+3,$posY);
	$xfer_result->addComponent($lbl_plan);
}
$lbl_img = new Xfer_Comp_Image('logo');
$file_name = "usr/org_lucterios_contacts/Image_".$self->id.".jpg";
if( is_file($rootPath.$file_name))
	$lbl_img->setValue($file_name);
else
	$lbl_img->setValue('extensions/org_lucterios_contacts/images/NoImage.png');
$lbl_img->setLocation($posX+5,$posY-2,1,4);
$xfer_result->addComponent($lbl_img);
//
$xfer_result->setDBObject($self,"adresse", true,$posY++,$posX,2);
//
$xfer_result->setDBObject($self,"codePostal", true,$posY,$posX);
$xfer_result->setDBObject($self,"ville", true,$posY++,$posX+2);
//
$xfer_result->setDBObject($self,"pays", true,$posY,$posX);
$lbl = new Xfer_Comp_LabelForm('lblmail');
$lbl->setValue('{[bold]}Courriel{[/bold]}');
$lbl->setLocation($posX+2,$posY);
$xfer_result->addComponent($lbl);
$lbl_mail = new Xfer_Comp_LinkLabel('mail');
$lbl_mail->setValue($self->mail);
$lbl_mail->setLink('mailto:'.$self->mail);
$lbl_mail->setLocation($posX+3,$posY++,3);
$xfer_result->addComponent($lbl_mail);
//
$xfer_result->setDBObject($self,"fixe", true,$posY,$posX);
$xfer_result->setDBObject($self,"portable", true,$posY,$posX+2);
$xfer_result->setDBObject($self,"fax", true,$posY++,$posX+4);

$DBAdhChamp=$self->getField('champPerso','','champ');
$nb=0;
while ($DBAdhChamp->fetch()) {
	$xfer_result=$DBAdhChamp->show($posX+($nb%3)*2, $posY+(int)($nb/3), $xfer_result);
	$nb++;
}
$posY+=max(50,(int)($nb/3)+50);
$xfer_result->setDBObject($self,"commentaire", true,$posY++,$posX,5);

$DBcurrent=$self;
while ($DBcurrent->getSon()!=null)
	$DBcurrent=$DBcurrent->getSon();
global $rootPath;
if(!isset($rootPath)) $rootPath = "";
require_once('CORE/extensionManager.inc.php');
if (count(getDaughterClassesList($DBcurrent->extname.'/'.$DBcurrent->tblname,$rootPath))>0) {
	$xfer_result->m_context['current_table']=$DBcurrent->__table;
	$xfer_result->m_context['current_id']=$DBcurrent->id;
	$xfer_result->m_context['origininal_action']=$xfer_result->m_extension."/".$xfer_result->m_action;

	$lbl = new Xfer_Comp_Button('upClass');
	$lbl->setAction(new Xfer_Action("_Promouvoir","up.png",'CORE','upRecordClass',FORMTYPE_MODAL,CLOSE_YES));
	$lbl->setLocation($posX,$posY++,5);
	$xfer_result->addComponent($lbl);
}

return $xfer_result;
//@CODE_ACTION@
}

?>
