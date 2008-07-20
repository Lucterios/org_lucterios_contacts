<?php
// Method file write by SDK tool
// --- Last modification: Date 18 June 2008 22:28:50 By  ---

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
$upload->addFilter('.gif');
$upload->addFilter('.png');
$upload->setLocation($posX+1,$posY++,3);
$xfer_result->addComponent($upload);
//
$xfer_result->resize($posX+1,150,20);
$xfer_result->resize($posX+3,150,20);
return $xfer_result;
//@CODE_ACTION@
}

?>
