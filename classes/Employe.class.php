<?php
use Animaux\Animal;
use Enclos\Enclos;
class Employe
{
    protected int $_id;
    protected string $_name;
    protected int $_age;
    protected string $_sexe;
    protected $_role;
    protected $_experience;
    protected $_img;
    public function __construct($hydrate = false){
        if(!empty($hydrate) && is_array($hydrate)){
            $this->hydrate($hydrate);
        }
        else{
            $nomsHomme = ["Waldo", "Philippe", "John", "Henry"];
            $nomsFemme = ["Olivia", "Emma", "Charlotte", "Amelia", "Sophia"];
            $sexe = rand(0, 1);
            $this->_age = rand(18, 64);
            $this->_sexe = $sexe;
            $this->_name = $sexe == 0 ? $nomsHomme[rand(0, sizeof($nomsHomme)-1)] : $nomsFemme[rand(0, sizeof($nomsFemme)-1)];
            $this->_role = "ZooKeeper";
            $this->_experience = 0;
        }
    }
    public function hydrate($tab){
        foreach ($tab as $attribut => $value) {
            $method = 'set'.ucfirst($attribut);
            if(is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }
    public function exportAssoc(){
        return array(
            "id" => $this->_id
            , "name" => $this->_name
            , "age" => $this->_age
            , "sexe" => $this->_sexe
            , "role" => $this->_role
            , "experience" => $this->_experience
        );
    }
    public function Nettoyer ($enclos)
    {
        $enclos->ClearEnclos();
    }
    public function Nourrir($animal)
    {
        $animal->manger();
    }
    public function Ajouter ($enclos)
    {
        $enclos->AddAnimal();
    }
    public function Supprimer ($enclos)
    {
        $enclos->DeleteAnimal();
    }
    public function Transfert (Enclos $enclos, Animal $animal)
    {
        $enclos->DeleteAnimal($animal);
        $enclos->AddAnimal($animal);
    }

    // GETTER
    public function getId()
    {
        return $this->_id;
    }
    public function getName()
    {
        return $this->_name;
    }
    public function getAge()
    {
        return $this->_age;
    }
    public function getSexe()
    {
        return $this->_sexe;
    }
    public function getRole()
    {
        return $this->_role;
    }
    public function getExperience()
    {
        return $this->_experience;
    }
    public function getImg(){
        return $this->_img;
    }
    
    // SETTER
    public function setId($_id)
    {
        $this->_id = $_id;
    }

    public function setName($_name)
    {
        $this->_name = $_name;
    }
    public function setAge($_age)
    {
        $this->_age = $_age;
    }
    public function setSexe($s)
    {
        $this->_sexe = $s;
    }
    public function setRole($r)
    {
        $this->_role = $r;
    }
    public function setExperience($e)
    {
        $this->_experience = $e;
    }
    public function setImg($i)
    {
        $this->_img = $i;
    }
}