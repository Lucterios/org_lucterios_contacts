<?php
// table file write by SDK tool
// --- Last modification: Date 30 May 2008 22:33:16 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_fonctions extends DBObj_Basic
{
	var $Title="Fonctions";
	var $tblname="fonctions";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_fonctions";

	var $DefaultFields=array(array('@refresh@'=>true, 'id'=>'1', 'nom'=>'Président', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'2', 'nom'=>'Vice-Président', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'3', 'nom'=>'Trésorier', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'4', 'nom'=>'Trésorier-Adjoint', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'5', 'nom'=>'Secrétaire', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'6', 'nom'=>'Secrétaire-Adjoint', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'7', 'nom'=>'Directeur', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'8', 'nom'=>'Directeur-Adjoint', 'readonly'=>'o'));
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $nom;
	var $readonly;
	var $__DBMetaDataField=array('nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>50, 'Multi'=>false)), 'readonly'=>array('description'=>'Non supprimable', 'type'=>3, 'notnull'=>true, 'params'=>array()));

	var $__toText='$nom';
}

?>
