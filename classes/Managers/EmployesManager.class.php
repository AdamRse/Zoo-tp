<?php
namespace Managers;
use \PDO;
use \Zoo;
use \Employe;
class EmployesManager{
    protected PDO $_db;

    public function __construct(PDO $connexion) {
        $this->_db = $connexion;
    }
    public function getEmployeId($id) :Employe {
        $q = $this->_db->prepare("SELECT * FROM employe WHERE id = ?");
        $q->execute([$id]);
        return new Employe($q->fetch(PDO::FETCH_ASSOC));
    }
    public function getEmployees(Zoo $zoo){
        $q = $this->_db->prepare("SELECT * FROM employe WHERE id_zoo = ?");
        $q->execute([$zoo->getId()]);
        while($e = $q->fetch(PDO::FETCH_ASSOC))
            $zoo->addEmployee(new Employe($e));
    }
    public function createEmployeeBdd(Zoo $zoo){
        $employe = new Employe();
        $q = $this->_db->prepare("INSERT INTO employe SET name = id_zoo = :idZoo :name, age = :age, sexe = :sexe, role = :role");
        $q->execute([
            "idZoo" => $zoo->getId()
            , "age" => $employe->getAge()
            , "sexe" => $employe->getSexe()
            , "role" => $employe->getRole()
        ]);
        $q2 = $this->_db->query("SELECT * FROM employe WHERE id = ".$this->_db->lastInsertId());
        return new Employe($q2->fetch());
    }
}