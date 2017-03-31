<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Etape extends Hydratable {
    
    private $ville;
    private $heure;
    private $idTrajet;
    
    /*public function __construct($ville, $heure) {
        $this->ville = $ville;
        $this->heure = $heure;
    }*/
    
    public function __construct($data) {
        parent::__construct($data);
    }
    
    

    //Fonction d'enregistrement de l'étape (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->id)
            $this->update();
        else
            $this->insert();
    }


    //Ajoute l'étape à la base de données
    private function insert()
    {
        $query = "INSERT INTO etape SET VilleEtape = :ville, HeureArrivee = :heure, IdTrajetElementaire = :idTrajet;";
        $parameters = array(
            array( 'name' => ':ville', 'value' => $this->getVille(), 'type' => 'string'),
            array( 'name' => ':heure', 'value' => $this->getHeure(), 'type' => 'string'),
            array( 'name' => ':idTrajet', 'value' => $this->getIdTrajet(), 'type' => 'string')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    /**
     * Modifie l'étape dans la base de données
     */
    private function update()
    {
        $query = "UPDATE etape SET VilleEtape = :ville, HeureArrivee = :heure, IdTrajetElementaire = :idTrajet;";
        $parameters = array(
            array( 'name' => ':ville', 'value' => $this->getVille(), 'type' => 'string'),
            array( 'name' => ':heure', 'value' => $this->getHeure(), 'type' => 'string'),
            array( 'name' => ':idTrajet', 'value' => $this->getIdTrajet(), 'type' => 'string')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    /**
     * Supprime l'étape de la base de données
     */
    public function remove()
    {
        $query = "DELETE FROM travelExpress  WHERE IdUsager = :id;";
        $parameters = array(
            array( 'name' => ':id', 'value' => $this->id, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    
    public function __toString() {
        $res = 'Ville : ' . $this->ville . '<br />';
        $res .= 'Heure : ' .$this->heure . '<br />';
        return $res;
    }
    
    //-----------Accesseurs
    
    public function getVille() {
        return $this->ville;
    }
    
    public function setVille($value) {
        $this->ville = $value;
    }
    
    public function getIdTrajet() {
        return $this->idTrajet;
    }
    
    public function setIdTrajet($value) {
        $this->idTrajet = $value;
    }
    
    public function getHeure() {
        return $this->heure;
    }
    
    public function setHeure($value) {
        $this->heure = $value;
    }
    

}