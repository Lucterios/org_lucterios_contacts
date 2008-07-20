<?php
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
