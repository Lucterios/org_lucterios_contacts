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
// --- Last modification: Date 14 November 2008 0:35:01 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_personnePhysique extends DBObj_Basic
{
	var $Title="Personnes physiques";
	var $tblname="personnePhysique";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_personnePhysique";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="org_lucterios_contacts/personneAbstraite";
	var $PosChild=2;

	var $nom;
	var $prenom;
	var $sexe;
	var $user;
	var $__DBMetaDataField=array('nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>30, 'Multi'=>false)), 'prenom'=>array('description'=>'Prénom', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>30, 'Multi'=>false)), 'sexe'=>array('description'=>'Sexe', 'type'=>8, 'notnull'=>false, 'params'=>array('Enum'=>array('Homme', 'Femme'))), 'user'=>array('description'=>'Connexion', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'CORE_users')));

	var $__toText='$nom $prenom';
}

?>
