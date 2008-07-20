<?php
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 17:39:52 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ codePostal

function CodePostal_APAS_getVillePays(&$self,$codePostal)
{
//@CODE_ACTION@
$villes = array();
$pays = '';
if( is_string($codePostal) && ($codePostal != '')) {
	$self->codePostal = $codePostal;
	$self->orderBy('ville');
	$self->find();
	while($self->fetch()) {
		$villes[$self->ville] = $self->ville;
		$pays = $self->pays;
	}
}
return array($villes,$pays);
//@CODE_ACTION@
}

?>
