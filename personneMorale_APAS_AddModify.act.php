<?php
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 14:50:17 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Ajouter/Modifier un personneMorale
//@PARAM@ Filtretype=1
//@INDEX:personneMorale


//@LOCK:2

function personneMorale_APAS_AddModify($Params)
{
$Filtretype=getParams($Params,"Filtretype",1);
$self=new DBObj_org_lucterios_contacts_personneMorale();
$personneMorale=getParams($Params,"personneMorale",-1);
if ($personneMorale>=0) $self->get($personneMorale);

$self->lockRecord("personneMorale_APAS_AddModify");
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_AddModify",$Params);
$xfer_result->Caption="Ajouter/Modifier un personneMorale";
$xfer_result->m_context['ORIGINE']="personneMorale_APAS_AddModify";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->id>0)$xfer_result->Caption = "Modifier une personne morale";
else $xfer_result->Caption = "Ajouter une personne morale";
$self->setFrom($Params);
$self->type = $Filtretype;
$xfer_result = $self->edit(0,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Ok","ok.png","AddModifyAct", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("personneMorale_APAS_AddModify");
	throw $e;
}
return $xfer_result;
}

?>
