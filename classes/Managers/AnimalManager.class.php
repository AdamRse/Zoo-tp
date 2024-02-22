<?php
namespace Managers;
use \PDO;
use \Enclos\Enclos;
use Animaux\Animal;
class AnimalManager{
    protected PDO $_db;

    public function __construct(PDO $connexion) {
        $this->_db = $connexion;
    }
    public function getAnimal($id) :Animal {
        $q = $this->_db->prepare("SELECT * FROM Animaux WHERE id = ?");
        $q->execute([$id]);
        $animalBdd = $q->fetch(PDO::FETCH_ASSOC);
        $classe = "Animaux\\".$animalBdd['name'];
        return new $classe($animalBdd);
    }
    
    public function getAnimalAvailableArray(){
        $q = $this->_db->query("SELECT * FROM animaux_available");
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBddAnimauxEnclos(Enclos $enclos){
        $q = $this->_db->prepare("SELECT * FROM Animaux WHERE enclos_id = ?");
        $q->execute([$enclos->getId()]);
        while($animal = $q->fetch(PDO::FETCH_ASSOC)){
            $classAnimal = "\Animaux\\".$animal['name'];
            $enclos->AddAnimal(new $classAnimal($animal));
        }
    }
    public function getPrices($name){
        $q = $this->_db->prepare('SELECT cost FROM animaux_available WHERE name = ?');
        $q->execute([$name]);
        return $q->fetchColumn();
    }
    public function save(Animal $animal){
        $sql = "UPDATE Animaux SET ";
        foreach($animal->exportAssoc() as $col => $val){
            if($col != "id")
                $sql .= "$col = :$col
            , ";
        }
        $sql = substr($sql, 0, -2)." WHERE id = :id";
        $q = $this->_db->prepare($sql);
        return $q->execute($animal->exportAssoc());
    }
    public function createAnimalEnclosBdd(Animal $animal, Enclos $enclos){
        $q = $this->_db->prepare("INSERT INTO Animaux (enclos_id, age, poids, taille, name, faim, dort, malade, crie, icon) VALUES(:enclos_id, :age, :poids, :taille, :name, :faim, :dort, :malade, :crie, :icon)");
        $q->execute([
            "enclos_id" => $enclos->getId()
            , "age" => $animal->getAge()
            , "poids" => $animal->getPoids()
            , "taille" => $animal->getTaille()
            , "name" => $animal->getName()
            , "faim" => $animal->getFaim()
            , "dort" => $animal->getDort()
            , "malade" => $animal->getMalade()
            , "crie" => $animal->getCrie()
            , "icon" => $animal->getIcon()
        ]);
    }

}