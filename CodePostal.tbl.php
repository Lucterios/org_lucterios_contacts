<?php
// table file write by SDK tool
// --- Last modification: Date 30 May 2008 22:31:16 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_CodePostal extends DBObj_Basic
{
	var $Title="Code postal";
	var $tblname="CodePostal";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_CodePostal";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $codePostal;
	var $ville;
	var $pays;
	var $__DBMetaDataField=array('codePostal'=>array('description'=>'Code Postal', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>6, 'Multi'=>false)), 'ville'=>array('description'=>'Ville', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>70, 'Multi'=>false)), 'pays'=>array('description'=>'Pays', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>50, 'Multi'=>false)));

	var $__toText='$codePostal $ville';
}

?>
