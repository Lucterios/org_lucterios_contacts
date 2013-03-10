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

class DBObj_org_lucterios_contacts_champPerso extends DBObj_Basic
{
	public $Title="";
	public $tblname="champPerso";
	public $extname="org_lucterios_contacts";
	public $__table="org_lucterios_contacts_champPerso";

	public $DefaultFields=array();
	public $NbFieldsCheck=1;
	public $Heritage="";
	public $PosChild=-1;

	public $class;
	public $description;
	public $type;
	public $param;
	public $paramText;
	public $type_title;
	public $values;
	public $__DBMetaDataField=array('class'=>array('description'=>'Type de contact', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>75, 'Multi'=>false)), 'description'=>array('description'=>'Description', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>200, 'Multi'=>false)), 'type'=>array('description'=>'Type', 'type'=>8, 'notnull'=>true, 'params'=>array('Enum'=>array('Chaine', 'Entier', 'Réel', 'Booléen', 'Enumération'))), 'param'=>array('description'=>'Paramètre de type', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>512, 'Multi'=>false)), 'paramText'=>array('description'=>'Paramètres', 'type'=>12, 'notnull'=>false, 'params'=>array('MethodGet'=>'convertParam', 'MethodSet'=>'convertParam')), 'type_title'=>array('description'=>'Type de contact', 'type'=>12, 'notnull'=>false, 'params'=>array('MethodGet'=>'get_class_title', 'MethodSet'=>'get_class_title')), 'values'=>array('description'=>'champs valeur', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_personneChamp', 'RefField'=>'champ')));

	public $__toText='$description';
}

?>
