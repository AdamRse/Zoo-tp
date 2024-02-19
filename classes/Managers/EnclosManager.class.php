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
    public function getBddEnclos(Zoo $zoo){
        $q = $this->_db->prepare("SELECT * FROM enclos WHERE id_zoo = ?");
        $q->execute([$zoo->getId()]);
        while($e = $q->fetch(PDO::FETCH_ASSOC))
            $zoo->addEnclos(new $e['type']($e));
    }
    public function assignPositionAvailable(Zoo $zoo, Enclos $enclos){
        $q = $this->_db->prepare("SELECT id, posX, posY FROM position_enclos WHERE type = ?");
        $q->execute([$enclos->getType()]);
        $EnclosGrid = $q->fetchAll();
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
    public function createEnclosBdd(Zoo $zoo, $type = "Enclos"){
        $enclos = new $type();
        $this->assignPositionAvailable($zoo, $enclos);
        $q = $this->_db->prepare("INSERT INTO enclos (id_zoo, type, proprete, maxAnimaux, posX, posY) VALUES (:id_zoo, :type, :proprete, :maxAnimaux, :posX, :posY)");
        $q->execute([
            "idZoo" => $zoo->getId()
            , "type" => $enclos->getType()
            , "proprete" => $enclos->getPropete()
            , "maxAnimaux" => $enclos->getMaxAnimaux()
            , "posX" => $enclos->getPosX()
            , "posY" => $enclos->getPosY()
        ]);
        $q2 = $this->_db->query("SELECT * FROM enclos WHERE id = ".$this->_db->lastInsertId());
        return new $enclos($q2->fetch());
    }
}