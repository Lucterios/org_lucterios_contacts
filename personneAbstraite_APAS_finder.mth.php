<?php
// Method file write by SDK tool
// --- Last modification: Date 13 September 2008 15:17:25 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@Recherche un personneAbstraite
//@PARAM@ posY
//@PARAM@ simple
//@PARAM@ xfer_result

function personneAbstraite_APAS_finder(&$self,$posY,$simple,$xfer_result)
{
//@CODE_ACTION@
$posY=$posY+4;
$xfer_result->setDBSearch($self,"codePostal",$posY++);
$xfer_result->setDBSearch($self,"ville",$posY++);
if($simple == 0) {
	$xfer_result->setDBSearch($self,"pays",$posY++);
	$xfer_result->setDBSearch($self,"fixe",$posY++);
	$xfer_result->setDBSearch($self,"portable",$posY++);
	$xfer_result->setDBSearch($self,"mail",$posY++);
	$posY = 50;
	$xfer_result->setDBSearch($self,"commentaire",$posY++);
}
return $xfer_result;
//@CODE_ACTION@
}

?>
