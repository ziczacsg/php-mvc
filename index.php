<?php
require_once('libs/includes.php');

$smarty = new PortalSmarty();
$smarty->assign('title', 'hello smarty template');
// Test smarty config is OK ?
// $smarty->testInstall();
$smarty->display('index.tpl');

//$ini_array = parse_ini_file("appsetting.ini");
//// prints the entire parsed .ini file
//print_r($ini_array);

$Parsedown = new Parsedown();
echo $Parsedown->text('### markdown template');