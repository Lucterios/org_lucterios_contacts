<?php
// Action file write by SDK tool
// --- Last modification: Date 16 June 2008 21:54:32 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un personneMorale
//@PARAM@ personneMorale

//@TRANSACTION:

//@LOCK:0

function personneMorale_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personneMorale_APAS_AddModifyAct",$Params ,"personneMorale"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$self=new DBObj_org_lucterios_contacts_personneMorale();

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","personneMorale_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un personneMorale";
//@CODE_ACTION@
if($personneMorale>0)$find = $self->get($personneMorale);
$self->setFrom($Params);
if($find)$self->update();
else $self->insert();
$self->writeImage($Params);
if($self->id != 1) {
	$xfer_result->m_context = array("personneMorale" => $self->id);
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
