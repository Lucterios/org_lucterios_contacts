<?php
// Method file write by SDK tool
// --- Last modification: Date 31 May 2008 9:11:04 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Voir un personne physique
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personnePhysique_APAS_show(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation($posX,$posY);
$img->setValue("contactPhyique.png");
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("title");
$lbl->setLocation($posX+1,$posY++,5);
$lbl->setValue("{[bold]}{[center]}{[newline]}Personne physique{[/center]}{[/bold]}");
$xfer_result->addComponent($lbl);
//
$xfer_result->setDBObject($self,"nom", true,$posY,$posX);
$xfer_result->setDBObject($self,"prenom", true,$posY++,$posX+2);
$xfer_result->setDBObject($self,"sexe", true,$posY++,$posX);
$xfer_result = $self->Super->show($posX,$posY,$xfer_result);
return $xfer_result;
//@CODE_ACTION@
}

?>
