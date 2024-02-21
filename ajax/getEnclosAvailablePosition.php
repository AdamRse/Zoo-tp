<?php
session_start();

require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

if(isset($_GET['type']) && file_exists(P_ROOT."/classes/Enclos/".$_GET['type'].".class.php")){
    $zooManager = new \Managers\ZooManager($connexion);
    $enclosManager = new \Managers\EnclosManager($connexion);
    
    $zoo = $zooManager->getZooId(ZOO);
    echo json_encode($enclosManager->getFreePosEnclos($zoo, $_GET['type']));
}
else
    echo json_encode(["error" => "Type inconnu"]);