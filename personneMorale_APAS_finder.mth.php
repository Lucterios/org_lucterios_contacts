<?php
// Method file write by SDK tool
// --- Last modification: Date 16 June 2008 22:06:57 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Recherche un personneMorale
//@PARAM@ posY
//@PARAM@ simple
//@PARAM@ xfer_result

function personneMorale_APAS_finder(&$self,$posY,$simple,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBSearch($self,"raisonSociale",$posY++);
$xfer_result = $self->Super->finder($posY,$simple,$xfer_result);
$posY = 30;
$xfer_result->setDBSearch($self,"type",$posY++);
if($simple == 0) {
	$xfer_result->setDBSearch($self,"identifiant",$posY++);
	$xfer_result->setDBSearch($self,"siren",$posY++);
}
return $xfer_result;
//@CODE_ACTION@
}

?>
