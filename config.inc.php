<?php
// library file write by SDK tool
// --- Last modification: Date 25 May 2008 19:27:24 By  ---

//@BEGIN@

function org_lucterios_contacts_config(&$xfer_result) {
	// Fonction pour ajouter des composants dans la fenêtre de configuration
	require_once"extensions/org_lucterios_contacts/personneMorale.tbl.php";
	$xfer_result->m_context['personneMorale'] = 1;
	$contact = new DBObj_org_lucterios_contacts_personneMorale;
	$contact->get(1);
	$xfer_result = $contact->show(0,1,$xfer_result);
	$title = $xfer_result->getComponents('title_personne');
	$title->setValue('');
	$xfer_result->newTab("Coordonnées");
	$btn = new Xfer_Comp_Button('editer');
	$btn->setAction($contact->newAction('_Modifier','edit.png','AddModify', FORMTYPE_MODAL, CLOSE_NO));
	$btn->setLocation(0,60,2);
	$xfer_result->addComponent($btn);
}

//@END@
?>
