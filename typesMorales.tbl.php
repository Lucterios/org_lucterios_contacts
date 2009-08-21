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
// table file write by SDK tool
// --- Last modification: Date 16 June 2008 22:28:24 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_typesMorales extends DBObj_Basic
{
	var $Title="Type de structures";
	var $tblname="typesMorales";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_typesMorales";

	var $DefaultFields=array(array('@refresh@'=>false, 'id'=>'1', 'nom'=>'Entreprise', 'readonly'=>'o'), array('@refresh@'=>false, 'id'=>'2', 'nom'=>'Association', 'readonly'=>'o'));
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $nom;
	var $readonly;
	var $__DBMetaDataField=array('nom'=>array('description'=>'Catégorie', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>50, 'Multi'=>false)), 'readonly'=>array('description'=>'Non supprimable', 'type'=>3, 'notnull'=>false, 'params'=>array()));

	var $__toText='$nom';
}

?>
