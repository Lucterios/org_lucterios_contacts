<?php
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 16:08:12 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@getList de personneMorale
//@PARAM@ 

function personneMorale_APAS_getGrid(&$self)
{
//@CODE_ACTION@
$grid = new Xfer_Comp_Grid("personneMorale");
$grid->setDBObject($self,array("raisonSociale","fixe","fax","mail"));
$grid->addAction($self->newAction("_Editer","edit.png","Fiche", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->newAction("_Ajouter","add.png","AddModify", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->setSize(200,750);
return $grid;
//@CODE_ACTION@
}

?>
