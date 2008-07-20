<?php
// Action file write by SDK tool
// --- Last modification: Date 24 May 2008 23:07:12 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Fiche d'une personne morale
//@PARAM@ 
//@INDEX:personneMorale


//@LOCK:2

function personneMorale_APAS_Fiche($Params)
{
$self=new DBObj_org_lucterios_contacts_personneMorale();
$personneMorale=getParams($Params,"personneMorale",-1);
if ($personneMorale>=0) $self->get($personneMorale);

$self->lockRecord("personneMorale_APAS_Fiche");
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_Fiche",$Params);
$xfer_result->Caption="Fiche d'une personne morale";
$xfer_result->m_context['ORIGINE']="personneMorale_APAS_Fiche";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->id == 1)$xfer_result->Caption = 'Votre identité';
$xfer_result = $self->show(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Modifier","edit.png","AddModify", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction($self->newAction("_Imprimer","print.png","PrintFile", FORMTYPE_MODAL, CLOSE_NO));
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("personneMorale_APAS_Fiche");
	throw $e;
}
return $xfer_result;
}

?>
