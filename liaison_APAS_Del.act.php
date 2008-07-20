<?php
// Action file write by SDK tool
// --- Last modification: Date 23 May 2008 23:32:33 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Supprimer un liaison
//@PARAM@ 
//@INDEX:liaison

//@TRANSACTION:

//@LOCK:2

function liaison_APAS_Del($Params)
{
$self=new DBObj_org_lucterios_contacts_liaison();
$liaison=getParams($Params,"liaison",-1);
if ($liaison>=0) $self->get($liaison);

$self->lockRecord("liaison_APAS_Del");

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","liaison_APAS_Del",$Params);
$xfer_result->Caption="Supprimer un liaison";
$xfer_result->m_context['ORIGINE']="liaison_APAS_Del";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($xfer_result->confirme("Etes vous sûre de vouloir supprimer cette responsabilité?"))$self->delete();
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	$self->unlockRecord("liaison_APAS_Del");
	throw $e;
}
return $xfer_result;
}

?>
