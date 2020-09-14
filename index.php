<?php
require_once('libs/includes.php');

$smarty = new PortalSmarty();
$smarty->assign('title', 'hello smarty');
$smarty->display('view/index.tpl');