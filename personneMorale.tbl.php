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
// --- Last modification: Date 15 August 2009 14:59:17 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_personneMorale extends DBObj_Basic
{
	var $Title="Personnes morales";
	var $tblname="personneMorale";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_personneMorale";

	var $DefaultFields=array(array('@refresh@'=>false, 'id'=>'1', 'raisonSocial'=>'Votre identité', 'type'=>'0', 'identifiant'=>'', 'siren'=>''));
	var $NbFieldsCheck=1;
	var $Heritage="org_lucterios_contacts/personneAbstraite";
	var $PosChild=2;

	var $raisonSociale;
	var $type;
	var $identifiant;
	var $siren;
	var $physiques;
	var $__DBMetaDataField=array('raisonSociale'=>array('description'=>'Raison Sociale', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>100, 'Multi'=>false)), 'type'=>array('description'=>'Catégorie', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_typesMorales')), 'identifiant'=>array('description'=>'Code interne', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'siren'=>array('description'=>'Code SIREN / SIRET', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'physiques'=>array('description'=>'Contacts', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_liaison', 'RefField'=>'morale')));

	var $__toText='$raisonSociale';
}

?>
