<?php
// Action file write by SDK tool
// --- Last modification: Date 24 May 2008 23:48:59 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un liaison
//@PARAM@ personneMorale
//@PARAM@ liaison

//@TRANSACTION:

//@LOCK:0

function liaison_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_AddModifyAct",$Params ,"personneMorale","liaison"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$liaison=getParams($Params,"liaison",0);
$self=new DBObj_org_lucterios_contacts_liaison();

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","liaison_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un liaison";
//@CODE_ACTION@
if($liaison>0)$find = $self->get($liaison);
$self->setFrom($Params);
$self->morale = $personneMorale;
if($find) {
	$physique = $self->getField('physique');
	$physique->setFrom($Params);
	$physique->update();
	$self->update();
}
else {
	$physique = new DBObj_org_lucterios_contacts_personnePhysique;
	$physique->setFrom($Params);
	$self->physique = $physique->insert();
	$self->insert();
}
if( liaison<=0) {
	$xfer_result->m_context = array("liaison" => $self->id);
	$xfer_result->redirectAction($self->NewAction("editer","","Fiche"));
}
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
