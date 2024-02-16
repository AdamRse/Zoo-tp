<?php
namespace Managers;
use \PDO;
use Animaux\Animal;
class AnimalManager{
    protected PDO $_db;

    public function __construct(PDO $connexion) {
        $this->_db = $connexion;
    }
    public function getAnimal($id) :Animal {
        $q = $this->_db->prepare("SELECT * FROM Animaux WHERE id = ?");
        $q->execute([$id]);
        return new Animal($q->fetch(PDO::FETCH_ASSOC));
    }
    public function getAnimalAvailableArray(){
        $q = $this->_db->query("SELECT * FROM animaux_available");
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

}