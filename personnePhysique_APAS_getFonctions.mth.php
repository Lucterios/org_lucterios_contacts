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
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 20:48:00 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Ensembles des fonctions d'une structure
//@PARAM@ personneMorale

function personnePhysique_APAS_getFonctions(&$self,$personneMorale)
{
//@CODE_ACTION@
$liaison = new DBObj_org_lucterios_contacts_liaison;
$liaison->physique = $self->id;
$liaison->morale = $personneMorale;
$liaison->find();
$liaison->orderBy('fonction');
$res = "";
while($liaison->fetch()) {
	$val = $liaison->getField('fonction');
	$res .= $val->toText()."{[newline]}";
}
if($res != '')$res = substr($res,0,-11);
return $res;
//@CODE_ACTION@
}

?>
