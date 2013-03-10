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
// table file write by Lucterios SDK tool

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_personneChamp extends DBObj_Basic
{
	public $Title="";
	public $tblname="personneChamp";
	public $extname="org_lucterios_contacts";
	public $__table="org_lucterios_contacts_personneChamp";

	public $DefaultFields=array();
	public $NbFieldsCheck=1;
	public $Heritage="";
	public $PosChild=-1;

	public $contact;
	public $champ;
	public $value;
	public $__DBMetaDataField=array('contact'=>array('description'=>'Contact', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'org_lucterios_contacts_personneAbstraite', 'CascadeMerge'=>false)), 'champ'=>array('description'=>'Champ', 'type'=>10, 'notnull'=>true, 'params'=>array('TableName'=>'org_lucterios_contacts_champPerso', 'CascadeMerge'=>false)), 'value'=>array('description'=>'Valeur', 'type'=>7, 'notnull'=>false, 'params'=>array()));

}

?>
