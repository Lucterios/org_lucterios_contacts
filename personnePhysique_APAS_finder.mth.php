<?php
// Method file write by SDK tool
// --- Last modification: Date 16 June 2008 22:06:30 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Recherche un personne physique
//@PARAM@ posY
//@PARAM@ simple
//@PARAM@ xfer_result

function personnePhysique_APAS_finder(&$self,$posY,$simple,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBSearch($self,"nom",$posY++);
$xfer_result->setDBSearch($self,"prenom",$posY++);
$xfer_result->setDBSearch($self,"sexe",$posY++);
$xfer_result = $self->Super->finder($posY,$simple,$xfer_result);
return $xfer_result;
//@CODE_ACTION@
}

?>
