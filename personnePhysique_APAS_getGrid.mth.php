<?php
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 14:08:36 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@getList de personne physique
//@PARAM@ 

function personnePhysique_APAS_getGrid(&$self)
{
//@CODE_ACTION@
$grid = new Xfer_Comp_Grid("personnePhysique");
$grid->setDBObject($self,array("prenom","nom","fixe","portable","mail"));
$grid->addAction($self->newAction("_Editer","edit.png","Fiche", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->newAction("_Ajouter","add.png","AddModify", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->setSize(200,750);
return $grid;
//@CODE_ACTION@
}

?>
