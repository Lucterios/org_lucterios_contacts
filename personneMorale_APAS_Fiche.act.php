<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Action file write by SDK tool
// --- Last modification: Date 23 November 2008 10:58:16 By  ---

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
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_Fiche",$Params);
$xfer_result->Caption="Fiche d'une personne morale";
$xfer_result->m_context['ORIGINE']="personneMorale_APAS_Fiche";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->id == 1)$xfer_result->Caption = 'Votre identit�';
$xfer_result = $self->show(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Modifier","edit.png","AddModify", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction($self->newAction("_Imprimer","print.png","PrintFile", FORMTYPE_MODAL, CLOSE_NO));
$xfer_result=$self->addDeleteButton($xfer_result);
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
