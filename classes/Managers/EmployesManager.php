<?php
namespace Managers;
use \PDO;
use \Employe;
class Employes{
    protected PDO $_db;

    public function __construct(PDO $connexion) {
        $this->_db = $connexion;
    }
    public function getEmployeId($id) :Employe {
        $q = $this->_db->prepare("SELECT * FROM employe WHERE id = ?");
        $q->execute([$id]);
        return new Employe($q->fetch(PDO::FETCH_ASSOC));
    }

}