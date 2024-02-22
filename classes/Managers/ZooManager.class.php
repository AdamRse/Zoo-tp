<?php
namespace Managers;
use \PDO;
use \Zoo;
class ZooManager{
    protected PDO $_db;

    public function __construct(PDO $connexion) {
        $this->_db = $connexion;
    }

    public function getZooId($id, bool $complete = true){
        $q = $this->_db->prepare("SELECT * FROM zoo WHERE id = ?");
        $q->execute([$id]);
        $zoo = new Zoo($q->fetch(PDO::FETCH_ASSOC));
        if($complete){
            $EmM = new EmployesManager($this->_db);
            $EncM = new EnclosManager($this->_db);
            $EmM->getBddEmployees($zoo);
            $EncM->getBddEnclos($zoo);
        }
        return $zoo;
    }
    public function getAllZoo(){
        $zoos = [];
        $q = $this->_db->query('SELECT * FROM zoo');
        while($zoo = $q->fetch(PDO::FETCH_ASSOC)){
            $zoos[] = new Zoo($zoo);
        }
        return $zoos;
    }
    public function getPrices($name){
        $q = $this->_db->prepare('SELECT cost FROM buy WHERE name = ?');
        $q->execute([$name]);
        return $q->fetchColumn();
    }
    public function save(Zoo $zoo){
        $sql = "UPDATE zoo SET ";
        foreach($zoo->exportAssoc() as $col => $val){
            if($col != "id")
                $sql .= "$col = :$col, ";
        }
        $sql = substr($sql, 0, -2)." WHERE id = :id";
        $q = $this->_db->prepare($sql);
        return $q->execute($zoo->exportAssoc());
    }
}