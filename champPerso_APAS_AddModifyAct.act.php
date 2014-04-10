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
// Action file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneChamp.tbl.php');
require_once('extensions/org_lucterios_contacts/champPerso.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un champ personalisé
//@PARAM@ champPerso

//@TRANSACTION:

//@LOCK:0

function champPerso_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "champPerso_APAS_AddModifyAct",$Params ,"champPerso"))!=null)
	return $ret;
$champPerso=getParams($Params,"champPerso",0);
$self=new DBObj_org_lucterios_contacts_champPerso();

global $connect;
$connect->begin();
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_contacts","champPerso_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un champ personalisé";
//@CODE_ACTION@
if($champPerso>0)
	$find=$self->get($champPerso);
$self->setFrom($Params);
$extend=array();
switch($self->type) {
	case 0: // str
		$extend['Multi']=$Params['ValMulti']!='n';
		break;
	case 1: // entier
		$extend['Min']=(int)$Params['ValMin'];
		$extend['Max']=(int)$Params['ValMax'];
		break;
	case 2: // réel
		$extend['Min']=(float)$Params['ValMin'];
		$extend['Max']=(float)$Params['ValMax'];
		$extend['Prec']=(int)$Params['ValPrec'];
		break;
	case 3: // bool
		break;
	case 4: // énumération
		$extend['Enum']=explode(";",trim($Params['ValEnum']));
		break;
}
include_once("CORE/setup_param.inc.php");
$self->param=Param_Parameters::ArrayToString($extend);
if ($find)
	$self->update();
else
	$self->insert();
$DBAdhChamp=new DBObj_org_lucterios_contacts_personneChamp;
$DBAdhChamp->checkContact();
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
