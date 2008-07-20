<?php
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 21:03:24 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@

//@DESC@getList de liaison
//@PARAM@ personneMorale

function liaison_APAS_getGrid(&$self,$personneMorale)
{
//@CODE_ACTION@
$physique = new DBObj_org_lucterios_contacts_personnePhysique;
$q = "select DISTINCT org_lucterios_contacts_personnePhysique.* FROM org_lucterios_contacts_personnePhysique,org_lucterios_contacts_liaison WHERE org_lucterios_contacts_personnePhysique.id=org_lucterios_contacts_liaison.physique AND org_lucterios_contacts_liaison.morale=".$personneMorale;
$physique->query($q);
// creation de la grille correspondante
$grid = new Xfer_Comp_Grid("liaison_physique");
$grid->setDBObject($physique,array("nom","prenom","fonctions". SEP_SHOW."FCT","fixe","portable","mail"));
$grid->addAction($self->newAction("_Editer","edit.png","Fiche", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->NewAction('_Rechercher/Ajouter','add.png','AddSearch', FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
foreach($grid->m_records as $key => $value) {
	$physique = new DBObj_org_lucterios_contacts_personnePhysique;
	$physique->get($key);
	$grid->m_records[$key]["fonctions". SEP_SHOW."FCT"] = $physique->getFonctions($personneMorale);
}
return $grid;
//@CODE_ACTION@
}

?>
