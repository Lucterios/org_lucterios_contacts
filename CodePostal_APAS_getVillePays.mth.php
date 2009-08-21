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
// --- Last modification: Date 25 May 2008 17:39:52 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ codePostal

function CodePostal_APAS_getVillePays(&$self,$codePostal)
{
//@CODE_ACTION@
$villes = array();
$pays = '';
if( is_string($codePostal) && ($codePostal != '')) {
	$self->codePostal = $codePostal;
	$self->orderBy('ville');
	$self->find();
	while($self->fetch()) {
		$villes[$self->ville] = $self->ville;
		$pays = $self->pays;
	}
}
return array($villes,$pays);
//@CODE_ACTION@
}

?>
