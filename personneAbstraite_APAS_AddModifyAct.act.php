<?php
// Action file write by SDK tool
// --- Last modification: Date 13 September 2008 17:20:36 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un contact
//@PARAM@ contact=

//@TRANSACTION:

//@LOCK:2

function personneAbstraite_APAS_AddModifyAct($Params)
{
$contact=getParams($Params,"contact");
$self=new DBObj_org_lucterios_contacts_personneAbstraite();

$self->lockRecord("personneAbstraite_APAS_AddModifyAct");

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","personneAbstraite_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un contact";
$xfer_result->m_context['ORIGINE']="personneAbstraite_APAS_AddModifyAct";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($contact>0)
	$find=$self->get($contact);
$self->setFrom($Params);
if ($find)
	$self->update();
else
	$self->insert();
if (contact<=0)
{
  $xfer_result->m_context=array("contact"=>$self->id);
  $xfer_result->redirectAction($self->NewAction("editer","","Fiche"));
}
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	$self->unlockRecord("personneAbstraite_APAS_AddModifyAct");
	throw $e;
}
return $xfer_result;
}

?>
