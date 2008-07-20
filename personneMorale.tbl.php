<?php
// table file write by SDK tool
// --- Last modification: Date 30 May 2008 22:34:00 By  ---

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
	var $__DBMetaDataField=array('raisonSociale'=>array('description'=>'Raison Sociale', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'type'=>array('description'=>'Catégorie', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_typesMorales')), 'identifiant'=>array('description'=>'Code interne', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'siren'=>array('description'=>'Code SIREN / SIRET', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'physiques'=>array('description'=>'Contacts', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_liaison', 'RefField'=>'morale')));

	var $__toText='$raisonSociale';
}

?>
