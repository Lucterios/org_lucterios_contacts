<?php
// Method file write by SDK tool
// --- Last modification: Date 16 June 2008 21:50:52 By  ---

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
if( is_file($file_name))$lbl_img->setValue($file_name);
else $lbl_img->setValue('extensions/org_lucterios_contacts/images/NoImage.png');
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
$xfer_result->setDBObject($self,"fax", true,$posY,$posX+4);
$posY = 50;
$xfer_result->setDBObject($self,"commentaire", true,$posY++,$posX,5);
return $xfer_result;
//@CODE_ACTION@
}

?>
