<?php
// Action file write by SDK tool
// --- Last modification: Date 17 June 2008 20:56:13 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Rechercher une personne pour ajout
//@PARAM@ personneMorale


//@LOCK:0

function liaison_APAS_AddSearch($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_AddSearch",$Params ,"personneMorale"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$self=new DBObj_org_lucterios_contacts_liaison();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","liaison_APAS_AddSearch",$Params);
$xfer_result->Caption="Rechercher une personne pour ajout";
//@CODE_ACTION@
$self->morale = $personneMorale;
$xfer_result->setDBObject($self,'morale', true,0,0,2);
$xfer_result->setDBObject($self,'fonction', false,1,0,2);
$physique = $self->getField('physique');
$physique->setFrom($Params);
$xfer_result = $physique->finder(2,1,$xfer_result);
$xfer_result->addAction($self->newAction("_Ok","ok.png","AddSearchyAct", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
