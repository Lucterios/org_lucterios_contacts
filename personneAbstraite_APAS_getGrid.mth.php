<?php
// Method file write by SDK tool
// --- Last modification: Date 23 May 2008 23:18:57 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@getList de personneAbstraite

function personneAbstraite_APAS_getGrid(&$self)
{
//@CODE_ACTION@
$grid = new Xfer_Comp_Grid("personneAbstraite");
$grid->setDBObject($self, 9);
$grid->setSize(200,750);
return $grid;
//@CODE_ACTION@
}

?>
