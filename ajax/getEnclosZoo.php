<?php
//Requêtes obligatoires:
//$_GET['name'] Nom strict de la classe animal dans classes/Animaux (ex : Ours)
//$_GET['enclos'] Id de l'enclos dans lequel mettre l'annimal
session_start();
require "../config_php/db.php";
require "../config_php/autoload.php";
require "../config_php/const.php";

if(ZOO){
    if(!empty($_GET['name']) && !empty($_GET['enclos'])){
        $zooManager = new Managers\ZooManager($connexion);
        $enclosManager = new Managers\EnclosManager($connexion);
        $animalManager = new Managers\AnimalManager($connexion);

        
        if($price = $animalManager->getPrices($_GET['name']) && file_exists(P_ROOT."/classes/Animaux/".$_GET['name'].".class.php")){
            if($enclos = $enclosManager->getEnclosId($_GET['enclos'])){
                if($enclos->isFree()){
                    $zoo = $zooManager->getZooId(ZOO, false);
                    $zoo->pay($price);
                    $classAnimal = "Animaux\\".$_GET['name'];
                    $animal = new $classAnimal();
                    $animalManager->createAnimalEnclosBdd($animal, $enclos);
                    $zooManager->save($zoo);
                    echo json_encode(true);
                }
                else
                    echo json_encode(array("error" => "Enclos plein"));
            }
            else
                echo json_encode(array("error" => "Enclos introuvable"));
        }
        else
            echo json_encode(array("error" => "Commande introuvable"));
    }
    else
        echo json_encode(array("error" => "Aucune requête reçue"));
}
else
    echo json_encode(array("error" => "Non connecté"));