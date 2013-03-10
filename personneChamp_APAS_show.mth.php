<?php
// This file is part of Lucterios, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// Thanks to have payed a donation for using this module.
// 
// Lucterios is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Method file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneChamp.tbl.php');
//@TABLES@

//@DESC@Voir un champs
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personneChamp_APAS_show(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$champPerso=$self->getField('champ');
$lbl=new Xfer_Comp_LabelForm('lblpersonneChamp_'.$self->id);
$lbl->setValue("{[bold]}".$champPerso->description."{[/bold]}");
$lbl->setLocation($posX,$posY);
$xfer_result->addComponent($lbl);

$edt=new Xfer_Comp_LabelForm('personneChamp_'.$self->id);
$edt->setValue($self->getValueText());
$edt->setLocation($posX+1,$posY);
$xfer_result->addComponent($edt);
return $xfer_result;
//@CODE_ACTION@
}

?>
