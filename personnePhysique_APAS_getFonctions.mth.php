<?php
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 20:48:00 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Ensembles des fonctions d'une structure
//@PARAM@ personneMorale

function personnePhysique_APAS_getFonctions(&$self,$personneMorale)
{
//@CODE_ACTION@
$liaison = new DBObj_org_lucterios_contacts_liaison;
$liaison->physique = $self->id;
$liaison->morale = $personneMorale;
$liaison->find();
$liaison->orderBy('fonction');
$res = "";
while($liaison->fetch()) {
	$val = $liaison->getField('fonction');
	$res .= $val->toText()."{[newline]}";
}
if($res != '')$res = substr($res,0,-11);
return $res;
//@CODE_ACTION@
}

?>
