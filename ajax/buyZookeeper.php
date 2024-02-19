<?php
session_start();
require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

if(ZOO){
    $zooManager = new \Managers\ZooManager($connexion);
    $employeeManager = new \Managers\EmployesManager($connexion);
    $zoo = $zooManager->getZooId(ZOO);

    if($newEmploye = $employeeManager->createEmployeeBdd($zoo)){
        $cost = $zooManager->getPrices('ZooKeeper');
        $zoo->pay($cost);
        $zooManager->saveZoo($zoo);
        echo json_encode(array("employe" => $newEmploye->exportAssoc(), "cost" => $cost));
    }
    else
        echo json_encode(false);

}
else
    echo json_encode(false);