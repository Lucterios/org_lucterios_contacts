<?php
// table file write by SDK tool
// --- Last modification: Date 30 May 2008 22:33:45 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_personneAbstraite extends DBObj_Basic
{
	var $Title="Personnes";
	var $tblname="personneAbstraite";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_personneAbstraite";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $adresse;
	var $codePostal;
	var $ville;
	var $pays;
	var $fixe;
	var $portable;
	var $fax;
	var $mail;
	var $commentaire;
	var $__DBMetaDataField=array('adresse'=>array('description'=>'Adresse', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>200, 'Multi'=>true)), 'codePostal'=>array('description'=>'Code Postal', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>8, 'Multi'=>false)), 'ville'=>array('description'=>'Ville', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>70, 'Multi'=>false)), 'pays'=>array('description'=>'Pays', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'fixe'=>array('description'=>'Tel. Fixe', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'portable'=>array('description'=>'Tel. Portable', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'fax'=>array('description'=>'Fax', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'mail'=>array('description'=>'Courriel', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>100, 'Multi'=>false)), 'commentaire'=>array('description'=>'Commentaire', 'type'=>7, 'notnull'=>false, 'params'=>array()));

}

?>
