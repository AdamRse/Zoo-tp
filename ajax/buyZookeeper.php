<?php
session_start();
require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

if(ZOO){
    $zooManager = new \Managers\ZooManager($connexion);
    $employeeManager = new \Managers\EmployesManager($connexion);
    $zoo = $zooManager->getZooId(ZOO, false);

    $cost = $zooManager->getPrices('ZooKeeper');
    $zoo->pay($cost);
    $employeeManager->createEmployeeBdd($zoo);
    $zooManager->save($zoo);
    echo json_encode(true);
}
else
    echo json_encode(array("error" => "Non connecté"));