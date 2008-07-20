<?php
// Action file write by SDK tool
// --- Last modification: Date 18 June 2008 22:33:27 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Suppression d`une fonction
//@PARAM@ 
//@INDEX:fonction

//@TRANSACTION:

//@LOCK:2

function fonctions_APAS_suppr($Params)
{
$self=new DBObj_org_lucterios_contacts_fonctions();
$fonction=getParams($Params,"fonction",-1);
if ($fonction>=0) $self->get($fonction);

$self->lockRecord("fonctions_APAS_suppr");

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","fonctions_APAS_suppr",$Params);
$xfer_result->Caption="Suppression d`une fonction";
$xfer_result->m_context['ORIGINE']="fonctions_APAS_suppr";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->readonly == 'o') {
	$xfer_result->message("Il est interdit de supprimer cette fonction.",4);
}
else {
	$DBObjliaison = new DBObj_org_lucterios_contacts_liaison;
	$DBObjliaison->fonction = $fonction;
	$nb = $DBObjliaison->find();
	if($nb>0)$xfer_result->message("Suppression interdite: cette fonction est utilisée.",4);
	else if($xfer_result->confirme("Etes vous sûre de vouloir supprimer cette fonction?")) {
		$self->delete();
	}
}
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	$self->unlockRecord("fonctions_APAS_suppr");
	throw $e;
}
return $xfer_result;
}

?>
