<?php
//Requêtes obligatoires:
//$_GET['name'] Nom strict de la classe animal dans classes/Animaux (ex : Ours)
//$_GET['enclos'] Id de l'enclos dans lequel mettre l'annimal
session_start();
require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

use Managers\ZooManager;

if(ZOO){
    $zooManager = new Managers\ZooManager($connexion);
    $zoo = $zooManager->getZooId(ZOO);

    $enclos = [];

    foreach ($zoo->getEnclos() as $enclos1){
        $enclos[] = $enclos1->exportAssoc(true);
    }
    
    echo json_encode(array("enclos" => $enclos));
}