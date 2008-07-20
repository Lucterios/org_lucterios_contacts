<?php
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 16:08:01 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Editer une personne morale
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personneMorale_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation($posX++,$posY,1,3);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);
//
$xfer_result->setDBObject($self,"raisonSociale", false,$posY++,$posX);
$xfer_result = $self->Super->edit($posX,$posY,$xfer_result);
$posY = 30;
$xfer_result->setDBObject($self,"identifiant", false,$posY,$posX);
if($self->id != 1)$xfer_result->setDBObject($self,"type", false,$posY++,$posX+2);
else $posY++;
$xfer_result->setDBObject($self,"siren", false,$posY++,$posX);
return $xfer_result;
//@CODE_ACTION@
}

?>
