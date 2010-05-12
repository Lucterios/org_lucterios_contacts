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
// --- Last modification: Date 11 May 2010 12:11:26 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/extension_params.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Editer une personne morale
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personneMorale_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$DBParam=new DBObj_CORE_extension_params;
$contPara=$DBParam->getParameters('org_lucterios_contacts');

$img = new Xfer_Comp_Image("img");
$img->setLocation($posX++,$posY,1,3);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);
//
$xfer_result->setDBObject($self,"raisonSociale", false,$posY++,$posX);
$xfer_result = $self->Super->edit($posX,$posY,$xfer_result);
$posY = 30;
$dec_pos=0;
if($self->id != 1) {
	$xfer_result->setDBObject($self,"type", false,$posY,$posX);
	$dec_pos=2;
}
if ($contPara['withInterneCode']=='o')
	$xfer_result->setDBObject($self,"identifiant", false,$posY,$posX+$dec_pos);
$posY++;
$xfer_result->setDBObject($self,"siren", false,$posY++,$posX,3);
return $xfer_result;
//@CODE_ACTION@
}

?>
