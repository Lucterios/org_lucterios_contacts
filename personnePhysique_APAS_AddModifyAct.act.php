<?php
// Action file write by SDK tool
// --- Last modification: Date 16 June 2008 21:55:24 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider une personne physique
//@PARAM@ personnePhysique

//@TRANSACTION:

//@LOCK:0

function personnePhysique_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personnePhysique_APAS_AddModifyAct",$Params ,"personnePhysique"))!=null)
	return $ret;
$personnePhysique=getParams($Params,"personnePhysique",0);
$self=new DBObj_org_lucterios_contacts_personnePhysique();

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","personnePhysique_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider une personne physique";
//@CODE_ACTION@
if($personnePhysique>0)$find = $self->get($personnePhysique);
$self->setFrom($Params);
if($find)$self->update();
else $self->insert();
$self->writeImage($Params);
$xfer_result->m_context = array("personnePhysique" => $self->id);
$xfer_result->redirectAction($self->NewAction("editer","","Fiche"));
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
