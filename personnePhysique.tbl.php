<?php
// table file write by SDK tool
// --- Last modification: Date 30 May 2008 22:34:15 By  ---

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
	var $__DBMetaDataField=array('nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>30, 'Multi'=>false)), 'prenom'=>array('description'=>'Prénom', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>30, 'Multi'=>false)), 'sexe'=>array('description'=>'Sexe', 'type'=>8, 'notnull'=>false, 'params'=>array('Enum'=>array('Homme', 'Femme'))));

	var $__toText='$nom $prenom';
}

?>
