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
//  // Method file write by SDK tool
// --- Last modification: Date 26 February 2010 23:10:15 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@retourne le chemin de la photo
//@PARAM@ 

function personnePhysique_APAS_getPhoto(&$self)
{
//@CODE_ACTION@
global $rootPath;
if(!isset($rootPath))$rootPath = "";

$abstract_id=$self->superId;
$file_name=$rootPath."usr/org_lucterios_contacts/Image_$abstract_id.jpg";
if (is_file($file_name))
	return $file_name;
else
	return "";
//@CODE_ACTION@
}

?>
