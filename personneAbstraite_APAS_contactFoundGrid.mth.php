<?php
// Method file write by SDK tool
// --- Last modification: Date 17 September 2008 20:59:21 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ classname
//@PARAM@ Params

function personneAbstraite_APAS_contactFoundGrid(&$self,$classname,$Params)
{
//@CODE_ACTION@
$contact=$self->contactFound($classname, $Params);
$grid=$contact->getGrid();
$grid->m_name = 'contact';
return $grid;
//@CODE_ACTION@
}

?>
