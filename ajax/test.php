<?php
session_start();

require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

$zooManager = new \Managers\ZooManager($connexion);
$employeeManager = new \Managers\EmployesManager($connexion);
$enclosManager = new \Managers\EnclosManager($connexion);


$zoo = $zooManager->getZooId(ZOO);

var_dump($enclosManager->getFreePosEnclos($zoo, "Enclos"));
