<?php
// Action file write by SDK tool
// --- Last modification: Date 17 June 2008 21:25:28 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Fiche d'un liaison
//@PARAM@ personneMorale
//@PARAM@ liaison_physique


//@LOCK:0

function liaison_APAS_Fiche($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_Fiche",$Params ,"personneMorale","liaison_physique"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$liaison_physique=getParams($Params,"liaison_physique",0);
$self=new DBObj_org_lucterios_contacts_liaison();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","liaison_APAS_Fiche",$Params);
$xfer_result->Caption="Fiche d'un liaison";
//@CODE_ACTION@
$liaison = new DBObj_org_lucterios_contacts_liaison;
$liaison->morale = $personneMorale;
$liaison->physique = $liaison_physique;
$liaison->find();
$liaison->fetch();
$xfer_result->setDBObject($liaison,'morale', true,0,1,4);
//
$physique = new DBObj_org_lucterios_contacts_personnePhysique;
$physique->get($liaison_physique);
$lbl = new Xfer_Comp_LabelForm('lbl_fonctions');
$lbl->setValue('{[bold]}Fonctions{[/bold]}');
$lbl->setLocation(1,1);
$xfer_result->addComponent($lbl);
//
$liaison2 = new DBObj_org_lucterios_contacts_liaison;
$liaison2->morale = $personneMorale;
$liaison2->physique = $liaison_physique;
$liaison2->find();
$list = array();
while($liaison2->fetch())$list[$liaison2->id] = $liaison2->getField('fonction')->nom;
//
$chkl = new Xfer_Comp_CheckList('liaison');
$chkl->setLocation(2,1,2,2);
$chkl->simple = true;
$chkl->setSelect($list);
$chkl->setSize(100,1);
$chkl->JavaScript = "var type=current.getValue();
var del_btn=parent.get('del');
if (del_btn!=null) {
	if ((type!=null) && (type!=''))
		del_btn.setEnabled(true);
	else
		del_btn.setEnabled(false);
}
";
$xfer_result->addComponent($chkl);
//
$btn_1 = new Xfer_Comp_Button('add');
$btn_1->setLocation(5,1);
$btn_1->setAction($liaison2->NewAction('_Ajouter','add.png','addFunction', FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$xfer_result->addComponent($btn_1);
$btn_1 = new Xfer_Comp_Button('del');
$btn_1->setLocation(5,2);
$btn_1->setAction($liaison2->NewAction('_Supprimer','suppr.png','Del', FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$xfer_result->addComponent($btn_1);
//
$xfer_result = $physique->show(0,3,$xfer_result);
//
$xfer_result->m_context['personnePhysique'] = $liaison_physique;
$xfer_result->addAction($physique->NewAction('_Modifier','edit.png','AddModify', FORMTYPE_MODAL, CLOSE_NO));
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
