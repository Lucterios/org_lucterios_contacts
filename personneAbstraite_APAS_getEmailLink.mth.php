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
// --- Last modification: Date 03 November 2009 23:47:22 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@Retour un composant link sur les couriels
//@PARAM@ DBPersonnes

function personneAbstraite_APAS_getEmailLink(&$self,$DBPersonnes)
{
//@CODE_ACTION@
global $MAILTO_TYPE;
$email_list="";
while($DBPersonnes->fetch()) {
	$DBPersonnes->mail = trim($DBPersonnes->mail);
	if(($DBPersonnes->mail!="") && ($DBPersonnes->mail==htmlentities($DBPersonnes->mail))) {
    		if($email_list=="")
			$email_list .= $DBPersonnes->mail;
		else
			$email_list .= ','.$DBPersonnes->mail;
	}
}
$link = new Xfer_Comp_LinkLabel('emailAll');
$link->setValue('Ecrire a tous');
switch ($MAILTO_TYPE) {
	case 1: // CC
		$link->setLink('mailto:?cc='.$email_list);
		break;
	case 2: //BCC
		$link->setLink('mailto:?bcc='.$email_list);
		break;
	default: //TO
		$link->setLink('mailto:'.$email_list);
}
return $link;
//@CODE_ACTION@
}

?>
