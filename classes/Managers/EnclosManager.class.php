<?php
namespace Managers;
use \PDO;
use \Zoo;
use \Enclos\Enclos;
class EnclosManager{
    protected PDO $_db;

    public function __construct(PDO $connexion) {
        $this->_db = $connexion;
    }
    public function getEnclosId($id) :Enclos {
        $q = $this->_db->prepare("SELECT * FROM enclos WHERE id = ?");
        $q->execute([$id]);
        return new Enclos($q->fetch(PDO::FETCH_ASSOC));
    }
    public function save(Enclos $enclos){
        $sql = "UPDATE enclos SET ";
        foreach($enclos->exportAssoc() as $col => $val){
            if($col != "id")
                $sql .= "$col = :$col, ";
        }
        $sql = substr($sql, 0, -2)." WHERE id = :id";
        $q = $this->_db->prepare($sql);
        return $q->execute($enclos->exportAssoc());
    }
    public function getBddEnclos(Zoo $zoo, $complete = true){
        $q = $this->_db->prepare("SELECT * FROM enclos WHERE id_zoo = ?");
        $q->execute([$zoo->getId()]);
        if($complete)
            $am = new AnimalManager($this->_db);
        while($e = $q->fetch(PDO::FETCH_ASSOC)){
            $className = "Enclos\\".$e['type'];
            $newEnclos = new $className($e);
            if($complete){
                $am->getBddAnimauxEnclos($newEnclos);
                $zoo->addEnclos($newEnclos);
            }
        }
    }
    public function assignPositionAvailable(Zoo $zoo, Enclos $enclos){
        $q = $this->_db->prepare("SELECT id, posX, posY FROM position_enclos WHERE type = ?");
        $q->execute([$enclos->getType()]);
        $EnclosGrid = $q->fetchAll(PDO::FETCH_ASSOC);
        $enclosZoo = $zoo->getEnclos();
        $posTrouve = [];
        foreach ($EnclosGrid as $k => $enclosGrid1){
            foreach ($enclosZoo as $enclosZoo1) {
                if($enclosGrid1['posX'] == $enclosZoo1->getPosX() && $enclosGrid1['posY'] == $enclosZoo1->getPosY())
                    array_splice($EnclosGrid, $k, 1);
            }
        }
        if(!empty($EnclosGrid)){
            $nbPosTrouve = sizeof($EnclosGrid);
            $rand = $nbPosTrouve>1 ? rand(0, $nbPosTrouve-1) : 0;
            $enclos->setPosX($EnclosGrid[$rand]["posX"]);
            $enclos->setPosY($EnclosGrid[$rand]["posY"]);
        }
    }
    public function isPosCorrect($type, $posX, $posY){
        $q = $this->_db->prepare("SELECT id FROM position_enclos WHERE posX = ? AND posY = ? AND type = ?");
        $q->execute([$posX, $posY, $type]);
        return empty($q->fetchColumn()) ? false : true;
    }
    public function createEnclosBdd(Zoo $zoo, Enclos $enclos){
        if(empty($enclos->getPosX()) || empty($enclos->getPosY()))
            $this->assignPositionAvailable($zoo, $enclos);
        $q = $this->_db->prepare("INSERT INTO enclos (id_zoo, type, proprete, maxAnimaux, posX, posY) VALUES (:idZoo, :type, :proprete, :maxAnimaux, :posX, :posY)");
        $q->execute([
            "idZoo" => $zoo->getId()
            , "type" => $enclos->getType()
            , "proprete" => $enclos->getPropete()
            , "maxAnimaux" => $enclos->getMaxAnimaux()
            , "posX" => $enclos->getPosX()
            , "posY" => $enclos->getPosY()
        ]);
    }
    public function getFreePosEnclos(Zoo $zoo, $type){
        $zooEnclos = $zoo->getEnclos();
        $q = $this->_db->prepare("SELECT posX, posY FROM position_enclos WHERE type = ?");
        $q->execute([$type]);
        $EnclosGrid = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($EnclosGrid as $k => $enclosGrid1){
            foreach ($zooEnclos as $zooEnclos1) {
                if($enclosGrid1['posX'] == $zooEnclos1->getPosX() && $enclosGrid1['posY'] == $zooEnclos1->getPosY())
                    array_splice($EnclosGrid, $k, 1);
            }
        }
        return $EnclosGrid;
    }
}