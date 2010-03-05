<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Action file write by SDK tool
// --- Last modification: Date 04 March 2010 23:33:25 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('CORE/users.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Mot de passe perdu
//@PARAM@ 


//@LOCK:0

function passForgot($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","passForgot",$Params);
$xfer_result->Caption="Mot de passe perdu";
//@CODE_ACTION@
$img= &new Xfer_Comp_Image('img');
$img->setValue('passwd.png');
$img->setLocation(0, 0, 1, 3);
$xfer_result->addComponent($img);

$lab = new Xfer_Comp_LabelForm("title");
$lab->setValue("{[center]}{[italic]}{[bold]}Vous avez perdu votre mot de passe ou votre identifiant ?{[/bold]}{[/italic]}{[/center]}{[newline]}");
$lab->setLocation(1,0,2);
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_LabelForm("lblmail");
$lab->setValue("{[bold]}Précisez votre adresse courriel{[/bold]}");
$lab->setLocation(1,1);
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_Edit("mail");
$lab->setLocation(2,1);
$lab->needed=true;
$xfer_result->addComponent($lab);

$xfer_result->addAction(new Xfer_Action('_Valider','ok.png','org_lucterios_contacts','passForgotAct',FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction(new Xfer_Action('_Annuler','cancel.png'));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
