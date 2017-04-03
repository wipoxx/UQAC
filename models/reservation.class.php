<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Reservation extends Hydratable
{
    //Clé primaire : idUsager & idTrajet
    private $idReservation;
    private $idUsager;
    private $idTrajet;
    private $nbPlaces;  //Nb place que l'usager réserve
    
    public function __construct($data) {
        parent::__construct($data);
        $this->save();
    }

    //Fonction d'enregistrement (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->idReservation)
            $this->update();
        else
            $this->insert();
    }

    //Ajoute à la base de données
    private function insert()
    {
        $query = "INSERT INTO reservation (IdUsager, IdTrajet, NbPlaces) VALUES (:idUsager, :idTrajet, :nbPlaces);";
        $parameters = array(
            array( 'name' => ':idUsager', 'value' => $this->getIdUsager(), 'type' => 'int'),
            array( 'name' => ':idTrajet', 'value' => $this->getIdTrajet(), 'type' => 'int'),
            array( 'name' => ':nbPlaces', 'value' => $this->getNbPlaces(), 'type' => 'int')
        );
        $db = BDDLocale::getInstance();
        $this->idReservation = $db->insert($query, $parameters);
    }

    //Modifie dans la base de données
    private function update()
    {
        $query = "UPDATE reservation SET IdUsager = :idUsager, IdTrajet = :idTrajet, NbPlaces = :nbPlaces WHERE IdReservation = :idReservation;";
        $parameters = array(
            array( 'name' => ':idUsager', 'value' => $this->getIdUsager(), 'type' => 'int'),
            array( 'name' => ':idTrajet', 'value' => $this->getIdTrajet(), 'type' => 'int'),
            array( 'name' => ':nbPlaces', 'value' => $this->getNbPlaces(), 'type' => 'int'),
            array( 'name' => ':idReservation', 'value' => $this->idReservation, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Supprime de la base de données
    public function remove()
    {
        $query = "DELETE FROM reservation  WHERE IdReservation = :idReservation;";
        $parameters = array(
            array( 'name' => ':idReservation', 'value' => $this->idReservation, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
//------------- Accesseurs
    public function setIdReservation($value) {
        $this->idReservation = $value;
    }
    public function getIdReservation() {
        return $this->idReservation;
    }
    public function setIdUsager($value) {
        $this->idUsager = $value;
    }
    public function getIdUsager() {
        return $this->idUsager;
    }
    public function setIdTrajet($value) {
        $this->idTrajet = $value;
    }
    public function getIdTrajet() {
        return $this->idTrajet;
    }
    public function setNbPlaces($value) {
        $this->nbPlaces = $value;
    }
    public function getNbPlaces() {
        return $this->nbPlaces;
    }

}