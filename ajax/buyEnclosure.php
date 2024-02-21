<?php
session_start();
require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

if(ZOO){
    $zooManager = new \Managers\ZooManager($connexion);
    $employeeManager = new \Managers\EmployesManager($connexion);
    $enclosManager = new \Managers\EnclosManager($connexion);
    $zoo = $zooManager->getZooId(ZOO);
    $newEnclos = $enclosManager->getEnclosId(Enclos);

    if($newEnclos = $enclosManager->getBddEnclos($zoo)){
        $cost = $zooManager->getPrices('Enclosure','Aviary','Aquarium');
        $zoo->pay($cost);
        //$zooManager->saveZoo($zoo);
        echo json_encode(array("enclos" => $newEnclos->exportAssoc(), "cost" => $cost));
    }
    else
        echo json_encode(false);

}
else
    echo json_encode(false);