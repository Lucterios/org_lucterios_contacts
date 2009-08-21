<?php
//
//  This file is part of Lucterios.
//
//  Lucterios is free software; you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation; either version 2 of the License, or
//  (at your option) any later version.
//
//  Lucterios is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with Lucterios; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//
//	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//
// Action file write by SDK tool
// --- Last modification: Date 30 May 2008 19:51:53 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@
//@PARAM@ personneMorale
//@PARAM@ liaison_physique


//@LOCK:0

function liaison_APAS_addFunction($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_addFunction",$Params ,"personneMorale","liaison_physique"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$liaison_physique=getParams($Params,"liaison_physique",0);
$self=new DBObj_org_lucterios_contacts_liaison();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","liaison_APAS_addFunction",$Params);
$xfer_result->Caption="";
//@CODE_ACTION@
$fct = new DBObj_org_lucterios_contacts_fonctions;
$fct->find();
$grid = new Xfer_Comp_Grid('fonctions');
$grid->setDBObject($fct,array('nom'));
$grid->addAction($self->NewAction('_Ajouter','add.png','addFunctionAct', FORMTYPE_MODAL, CLOSE_YES, SELECT_MULTI));
$grid->addAction($self->NewAction('A_nnuler','cancel.png'));
$grid->setSize(300,300);
$xfer_result->addComponent($grid);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
