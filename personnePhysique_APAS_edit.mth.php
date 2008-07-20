<?php
// Method file write by SDK tool
// --- Last modification: Date 24 May 2008 23:19:49 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Editer un personne physique
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personnePhysique_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation($posX++,$posY,1,3);
$img->setValue("contactPhyique.png");
$xfer_result->addComponent($img);
//
$xfer_result->setDBObject($self,"nom", false,$posY,$posX);
$xfer_result->setDBObject($self,"prenom", false,$posY++,$posX+2);
$xfer_result->setDBObject($self,"sexe", false,$posY++,$posX);
$xfer_result = $self->Super->edit($posX,$posY,$xfer_result);
return $xfer_result;
//@CODE_ACTION@
}

?>
