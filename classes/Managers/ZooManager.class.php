<?php
namespace Managers;
use \PDO;
use \Zoo;
class ZooManager{
    protected PDO $_db;

    public function __construct(PDO $connexion) {
        $this->_db = $connexion;
    }

    public function getZooId($id){
        $q = $this->_db->prepare("SELECT * FROM zoo WHERE id = ?");
        $q->execute([$id]);
        return new Zoo($q->fetch(PDO::FETCH_ASSOC));
    }

}