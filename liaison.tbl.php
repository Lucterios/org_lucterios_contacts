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
//  // table file write by SDK tool
// --- Last modification: Date 06 January 2010 23:56:43 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_liaison extends DBObj_Basic
{
	var $Title="Résponsabilité";
	var $tblname="liaison";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_liaison";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $physique;
	var $morale;
	var $fonction;
	var $__DBMetaDataField=array('physique'=>array('description'=>'Personne', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'org_lucterios_contacts_personnePhysique')), 'morale'=>array('description'=>'Personne morale', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'org_lucterios_contacts_personneMorale')), 'fonction'=>array('description'=>'Fonction', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'org_lucterios_contacts_fonctions')));

}

?>
