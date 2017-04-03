<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Trajet extends Hydratable{
    private $idTrajet;
    private $idTrajetElementaire;
    private $idReservation;

    public function __construct($data) {
        parent::__construct($data);
        $this->save();
    }

    //Fonction d'enregistrement (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->idTrajet)
            $this->update();
        else
            $this->insert();
    }

    //Ajoute le trajet à la base de données
    private function insert()
    {
        $query = "INSERT INTO trajet (IdTrajetElementaire, IdReservation) VALUES (:idTrajetElementaire, idReservation);";
        $parameters = array(
            array( 'name' => ':idTrajetElementaire', 'value' => $this->idTrajetElementaire, 'type' => 'string'),
            array( 'name' => ':idReservation', 'value' => $this->idReservation, 'type' => 'int')
        );
        $db = BDDLocale::getInstance();
        $this->idTrajet = $db->insert($query, $parameters);
    }

    //Modifie le trajet dans la base de données
    private function update()
    {
        $query = "UPDATE trajetelementaire SET IdTrajetElementaire = :idTrajetElementaire, IdReservation = :idReservation WHERE IdTrajet = :idTrajet;";
        $parameters = array(
            array( 'name' => ':idTrajetElementaire', 'value' => $this->idTrajetElementaire, 'type' => 'string'),
            array( 'name' => ':idReservation', 'value' => $this->idReservation, 'type' => 'int'),
            array( 'name' => ':idTrajet', 'value' => $this->idTrajet, 'type' => 'int')
        );
        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Supprime le trajet de la base de données
    public function remove()
    {
        $query = "DELETE FROM trajet  WHERE IdTrajet = :idTrajet;";
        $parameters = array(
            array( 'name' => ':idTrajet', 'value' => $this->idTrajet, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
    
    //Accesseurs
    public function setIdTrajetElementaire($value) {
        $this->idTrajetElementaire = $value;
    }
    
    public function getIdTrajetElementaire() {
        return $this->idTrajetElementaire;
    }
    
   public function setIdReservation($value) {
        $this->idReservation = $value;
    }
    
    public function getIdReservation() {
        return $this->idReservation;
    } 
    
   public function setIdTrajet($value) {
        $this->idTrajet = $value;
    }
    
    public function getIdTrajet() {
        return $this->idTrajet;
    } 
    
}