<?php
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 21:14:54 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Ajouter un responsable
//@PARAM@ personneMorale
//@PARAM@ personnePhysique
//@PARAM@ fonction

//@TRANSACTION:

//@LOCK:0

function liaison_APAS_AddSearchSelect($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_AddSearchSelect",$Params ,"personneMorale","personnePhysique","fonction"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$personnePhysique=getParams($Params,"personnePhysique",0);
$fonction=getParams($Params,"fonction",0);
$self=new DBObj_org_lucterios_contacts_liaison();

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","liaison_APAS_AddSearchSelect",$Params);
$xfer_result->Caption="Ajouter un responsable";
//@CODE_ACTION@
$self->setFrom($Params);
$self->morale = $personneMorale;
$self->physique = $personnePhysique;
$self->fonction = $fonction;
$self->insert();
if( liaison<=0) {
	$xfer_result->m_context = array("liaison_physique" => $personnePhysique,'personneMorale' => $personneMorale);
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
