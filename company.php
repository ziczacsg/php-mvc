<?php

require_once('libs/includes.php');
require_once('libs/class/dao/CompanyDao.php');

$smarty = new PortalSmarty();
$smarty->assign('title', "DEMO CRUD company table");
$smarty->display('company.tpl');

// create database object
$db = DbUtils::getConnection();
$companyDao = new CompanyDao($db);

// CRUD
echo "do insert data:  <br/>";
$param = array(
      'name' => 'vitalify'
    , 'address' => 'quan 3 hcm'
    , 'service' => 'labo and outsouring mobile application'
);
print_r($param);
$companyDao->insert($param);

echo "<br/> ------------------------ <br/>";
echo "get data inserted <br/>";
$lastRow = $companyDao->getLastInsertedId();
$data = $companyDao->get($lastRow["id"]);
print_r($data);

echo "<br/> ------------------------ <br/>";
echo "do update data: <br/>";
$paramUpdate = array(
    'name' => 'allexced'
  , 'address' => 'quan 1 hcm'
  , 'service' => 'labo and outsouring JAVA, PHP web application'
);
print_r($paramUpdate);
$companyDao->update($paramUpdate, $lastRow["id"]);
echo "<br/> ------------------------ <br/>";
echo "get data updated<br/>";
$data = $companyDao->get($lastRow["id"]);
print_r($data);

echo "<br/> ------------------------ <br/>";
echo "do delete id " . $lastRow['id'] . ".... <br/>";
$companyDao->delete($lastRow["id"]);

echo "DONE delete id " . $lastRow['id'] . "<br/>";