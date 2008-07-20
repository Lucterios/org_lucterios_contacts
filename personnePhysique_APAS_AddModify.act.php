<?php
// Action file write by SDK tool
// --- Last modification: Date 24 May 2008 22:47:37 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Ajouter/Modifier une personne physique
//@PARAM@ 
//@INDEX:personnePhysique


//@LOCK:2

function personnePhysique_APAS_AddModify($Params)
{
$self=new DBObj_org_lucterios_contacts_personnePhysique();
$personnePhysique=getParams($Params,"personnePhysique",-1);
if ($personnePhysique>=0) $self->get($personnePhysique);

$self->lockRecord("personnePhysique_APAS_AddModify");
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personnePhysique_APAS_AddModify",$Params);
$xfer_result->Caption="Ajouter/Modifier une personne physique";
$xfer_result->m_context['ORIGINE']="personnePhysique_APAS_AddModify";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->id>0)$xfer_result->Caption = "Modifier une personne physique";
else $xfer_result->Caption = "Ajouter une personne physique";
$self->setFrom($Params);
$xfer_result = $self->edit(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Ok","ok.png","AddModifyAct", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("personnePhysique_APAS_AddModify");
	throw $e;
}
return $xfer_result;
}

?>
