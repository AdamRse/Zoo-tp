<?php
//Requêtes obligatoires:
//$_GET['type'] Nom strict de la classe Enclos dans classes/Enclos (ex : Enclos)
//$_GET['px'] position X de l'enclos
//$_GET['py'] position Y de l'enclos

session_start();
require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

if(ZOO){
    if(!empty($_GET['type']) && isset($_GET['px']) && isset($_GET['py'])){
        $zooManager = new Managers\ZooManager($connexion);
        $enclosManager = new Managers\EnclosManager($connexion);
        if($price = $zooManager->getPrices($_GET['type']) && file_exists(P_ROOT."/classes/Enclos/".$_GET['type'].".class.php")){
            if($enclosManager->isPosCorrect($_GET['type'], $_GET['px'], $_GET['py'])){
                $zoo = $zooManager->getZooId(ZOO, false);
                $zoo->pay($price);
                $classEnclos = "Enclos\\".$_GET['type'];
                $enclos = new $classEnclos(array("posX" => $_GET['px'], "posY" => $_GET['py']));
                $enclosManager->createEnclosBdd($zoo, $enclos);
                $zooManager->save($zoo);
                echo json_encode(true);
            }
            else
                echo json_encode(array("error" => "Coordonées introuvables"));
        }
        else
            echo json_encode(array("error" => "Commande introuvable"));
    }
    else
        echo json_encode(array("error" => "Aucune requête reçue"));
}
else
    echo json_encode(array("error" => "Non connecté"));
