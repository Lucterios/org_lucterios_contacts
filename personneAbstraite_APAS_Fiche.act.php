<?php
// Action file write by SDK tool
// --- Last modification: Date 13 September 2008 17:39:36 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Fiche d'un contact
//@PARAM@ 
//@INDEX:contact


//@LOCK:2

function personneAbstraite_APAS_Fiche($Params)
{
$self=new DBObj_org_lucterios_contacts_personneAbstraite();
$contact=getParams($Params,"contact",-1);
if ($contact>=0) $self->get($contact);

$self->lockRecord("personneAbstraite_APAS_Fiche");
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneAbstraite_APAS_Fiche",$Params);
$xfer_result->Caption="Fiche d'un contact";
$xfer_result->m_context['ORIGINE']="personneAbstraite_APAS_Fiche";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
$xfer_result=$self->show(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Imprimer", "print.png", "PrintFile", FORMTYPE_MODAL,CLOSE_NO));
$xfer_result->addAction(new Xfer_Action("_Fermer", "close.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("personneAbstraite_APAS_Fiche");
	throw $e;
}
return $xfer_result;
}

?>
