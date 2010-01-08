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
//  // Test file write by SDK tool
// --- Last modification: Date 08 January 2010 22:43:08 By  ---


//@TABLES@
//@TABLES@

//@DESC@Controle de la configuration
//@PARAM@ 

function org_lucterios_contacts_ParamCheck(&$test)
{
//@CODE_ACTION@
$rep=$test->CallAction("org_lucterios_contacts","confMailSMS",array(),"Xfer_Container_Custom");
$comp1=$rep->getComponents("MailSmtpServer");
$test->assertEquals("",$comp1->m_value,"MailSmtpServer I");
$comp2=$rep->getComponents("MailSmtpUser");
$test->assertEquals("",$comp2->m_value,"MailSmtpUser I");
$comp3=$rep->getComponents("MailSmtpPass");
$test->assertEquals("",$comp3->m_value,"MailSmtpPass I");
$comp4=$rep->getComponents("MailConnectionMsg");
$test->assertEquals("",$comp4->m_value,"MailConnectionMsg I");

$comp5=$rep->getComponents("MailToConfig");
$test->assertEquals("Pour",$comp5->m_value,"MailToConfig I");

$test->CallAction("CORE","extension_params_APAS_validerModif",array("extensionName"=>"org_lucterios_contacts",
"MailSmtpServer"=>'smtp.lucterios.org',"MailSmtpUser"=>'moi',"MailSmtpPass"=>'abc123',"MailConnectionMsg"=>'message{[newline]}tout gentil',"MailToConfig"=>'2'),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","confMailSMS",array(),"Xfer_Container_Custom");
$comp1=$rep->getComponents("MailSmtpServer");
$test->assertEquals("smtp.lucterios.org",$comp1->m_value,"MailSmtpServer II");
$comp2=$rep->getComponents("MailSmtpUser");
$test->assertEquals("moi",$comp2->m_value,"MailSmtpUser II");
$comp3=$rep->getComponents("MailSmtpPass");
$test->assertEquals("abc123",$comp3->m_value,"MailSmtpPass II");
$comp4=$rep->getComponents("MailConnectionMsg");
$test->assertEquals("message{[newline]}tout gentil",$comp4->m_value,"MailConnectionMsg II");

$comp5=$rep->getComponents("MailToConfig");
$test->assertEquals("Copie caché à",$comp5->m_value,"MailToConfig II");

$rep=$test->CallAction("org_lucterios_contacts","ChangeParamMail",array(),"Xfer_Container_Custom");
$test->assertEquals(10,$rep->getComponentCount(),"Nb Comp");
$test->assertEquals(2,count($rep->m_actions),"Nb act");

$comp1=$rep->getComponents("MailSmtpServer");
$test->assertClass("Xfer_Comp_edit",$comp1,"MailSmtpServer");
$test->assertEquals("smtp.lucterios.org",$comp1->m_value,"MailSmtpServer III");
$comp2=$rep->getComponents("MailSmtpUser");
$test->assertClass("Xfer_Comp_edit",$comp2,"MailSmtpUser");
$test->assertEquals("moi",$comp2->m_value,"MailSmtpUser III");
$comp3=$rep->getComponents("MailSmtpPass");
$test->assertClass("Xfer_Comp_edit",$comp3,"MailSmtpPass");
$test->assertEquals("abc123",$comp3->m_value,"MailSmtpPass III");
$comp4=$rep->getComponents("MailConnectionMsg");
$test->assertClass("Xfer_Comp_Memo",$comp4,"MailConnectionMsg");
$test->assertEquals("message{[newline]}tout gentil",$comp4->m_value,"MailConnectionMsg III");

$rep=$test->CallAction("org_lucterios_contacts","ChangeParamOptions",array(),"Xfer_Container_Custom");
$test->assertEquals(4,$rep->getComponentCount(),"Nb Comp");
$test->assertEquals(2,count($rep->m_actions),"Nb act");
$comp5=$rep->getComponents("MailToConfig");
$test->assertClass("Xfer_Comp_Select",$comp5,"MailToConfig");
$test->assertEquals("2",$comp5->m_value,"MailToConfig III");
//@CODE_ACTION@
}

?>
