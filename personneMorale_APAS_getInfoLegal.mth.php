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
// --- Last modification: Date 11 May 2010 13:53:58 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Retourne les informations légales formatées
//@PARAM@ 

function personneMorale_APAS_getInfoLegal(&$self)
{
//@CODE_ACTION@
$info_legal=array();
$info_legal_list=explode('{[newline]}',$self->siren);
$info_legal_line="";
foreach($info_legal_list as $info_legal_item) {
	if ($info_legal_line!='')
		$info_legal_line.=" - ";
	$info_legal_line.=trim($info_legal_item);
	if (strlen($info_legal_line)>100) {
		$info_legal[]=$info_legal_line;
		$info_legal_line='';
	}
}
if ($info_legal_line!='')
	$info_legal[]=$info_legal_line;
return implode('{[newline]}',$info_legal);
//@CODE_ACTION@
}

?>
