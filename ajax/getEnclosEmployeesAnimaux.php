<?php
session_start();
require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

if(ZOO){
    $zooManager = new \Managers\ZooManager($connexion);
    $zoo = $zooManager->getZooId(ZOO);

    $employes = [];
    $enclos = [];

    foreach ($zoo->getEmployes() as $employe){
        $employes[] = $employe->exportAssoc();
    }
    foreach ($zoo->getEnclos() as $enclos1){
        $enclos[] = array($enclos1->exportAssoc(true));
    }
    echo json_encode(array("enclos" => $enclos, "employes" => $employes));
}
else
    echo json_encode(array("error" => "Non connecté"));