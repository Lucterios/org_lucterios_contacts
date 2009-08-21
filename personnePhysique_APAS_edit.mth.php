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
// --- Last modification: Date 24 May 2008 23:19:49 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Editer un personne physique
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personnePhysique_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation($posX++,$posY,1,3);
$img->setValue("contactPhyique.png");
$xfer_result->addComponent($img);
//
$xfer_result->setDBObject($self,"nom", false,$posY,$posX);
$xfer_result->setDBObject($self,"prenom", false,$posY++,$posX+2);
$xfer_result->setDBObject($self,"sexe", false,$posY++,$posX);
$xfer_result = $self->Super->edit($posX,$posY,$xfer_result);
return $xfer_result;
//@CODE_ACTION@
}

?>
