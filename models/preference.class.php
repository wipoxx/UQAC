<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Preference extends Hydratable{
    
    private $idPreference;
    private $animaux;
    private $fumeur;
    private $nbMaxBagages_Personne;

    public function __construct($data) {
        parent::__construct($data);
    }
    
    //Fonction d'enregistrement (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->idPreference)
            $this->update();
        else
            $this->insert();
    }


    //Ajoute la préférence à la base de données
    private function insert()
    {
        $query = "INSERT INTO preference (Animaux, Fumeur, NbMaxBagages_Personne) VALUES (:animaux, :fumeur, :nbMaxBagages_Personne);";
        $parameters = array(
            array( 'name' => ':animaux', 'value' => $this->getAnimaux(), 'type' => 'int'),
            array( 'name' => ':fumeur', 'value' => $this->getFumeur(), 'type' => 'int'),
            array( 'name' => ':nbMaxBagages_Personne', 'value' => $this->getNbMaxBagages_Personne(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $this->idPreference = $db->insert($query, $parameters);
    }

    //Modifie la préférence dans la base de données
    private function update()
    {
        $query = "UPDATE preference SET Animaux = :animaux, Fumeur = :fumeur, NbMaxBagages_Personne = :nbMaxBagages_Personne WHERE IdPreference = :idPreference;";
        $parameters = array(
            array( 'name' => ':animaux', 'value' => $this->getAnimaux(), 'type' => 'int'),
            array( 'name' => ':fumeur', 'value' => $this->getFumeur(), 'type' => 'int'),
            array( 'name' => ':nbMaxBagages_Personne', 'value' => $this->getNbMaxBagages_Personne(), 'type' => 'int'),
            array( 'name' => ':idPreference', 'value' => $this->getIdPreference(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Supprime la préférence de la base de données
    public function remove()
    {
        $query = "DELETE FROM preference  WHERE IdPreference = :idPreference;";
        $parameters = array(
            array( 'name' => ':idPreference', 'value' => $this->idPreference, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
     
    public static function get(int $ani, int $fum, int $bagages) {        
        $query = "SELECT * FROM preference WHERE Animaux = :animaux AND Fumeur = :fumeur AND NbMaxBagages_Personne = :nbMaxBagages_Personne;";
        
        $parameters = array(
            array( 'name' => ':animaux', 'value' => $ani, 'type' => 'int'),
            array( 'name' => ':fumeur', 'value' => $fum, 'type' => 'int'),
            array( 'name' => ':nbMaxBagages_Personne', 'value' => $bagages, 'type' => 'int')
        );
        $results = null;
        $db = BDDLocale::getInstance();

        if($db->get($query, $results, $parameters))
        {
            return new Preference($results[0]);
        }

        return null;
    }
    
  
    //-----------Acesseurs
    
    public function setIdPreference($value) {
        $this->idPreference = $value;
    }
    
    public function getIdPreference() {
        return $this->idPreference;
    }    
    
    public function setAnimaux($value) {
        $this->animaux = $value;
    }
    
    public function getAnimaux() {
        return $this->animaux;
    }
    
    public function setFumeur($value) {
        $this->fumeur = $value;
    }
    
    public function getFumeur() {
        return $this->fumeur;
    }
    
    public function setNbMaxBagages_Personne($value) {
        $this->nbMaxBagages_Personne = $value;
    }
    
    public function getNbMaxBagages_Personne() {
        return $this->nbMaxBagages_Personne;
    }
    
    
}