<?php
// table file write by SDK tool
// --- Last modification: Date 30 May 2008 22:33:34 By  ---

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
	var $__DBMetaDataField=array('physique'=>array('description'=>'Personne', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_personnePhysique')), 'morale'=>array('description'=>'Personne morale', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_personneMorale')), 'fonction'=>array('description'=>'Fonction', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_fonctions')));

}

?>
