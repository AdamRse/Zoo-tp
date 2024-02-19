<?php
ini_set("html_errors", "1");
ini_set("error_prepend_string", "<pre style='color: #333; font-family:monospace; white-space: pre-wrap;font-size: 17px;color:#855'>");
ini_set("error_append_string ", "</pre>");

session_start();

require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

$zooManager = new \Managers\ZooManager($connexion);
$employeeManager = new \Managers\EmployesManager($connexion);
$enclosManager = new \Managers\EnclosManager($connexion);


$zoo = $zooManager->getZooId(ZOO);
$enclos = new Enclos\Enclos();
$enclosManager->assignPositionAvailable($zoo, $enclos);

var_dump($enclos);
