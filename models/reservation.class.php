<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Reservation extends Hydratable
{
    //Clé primaire : idUsager & idTrajet
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
        if($this->idUsager && $this->idTrajet)
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
        $db->execute($query, $parameters);
    }

    //Modifie dans la base de données
    private function update()
    {
        $query = "UPDATE reservation SET IdUsager = :idUsager, IdTrajet = :idTrajet, NbPlaces = :nbPlaces;";
        $parameters = array(
            array( 'name' => ':idUsager', 'value' => $this->getIdUsager(), 'type' => 'int'),
            array( 'name' => ':idTrajet', 'value' => $this->getIdTrajet(), 'type' => 'int'),
            array( 'name' => ':nbPlaces', 'value' => $this->getNbPlaces(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Supprime de la base de données
    public function remove()
    {
        $query = "DELETE FROM reservation  WHERE IdUsager = :idUsager AND IdTrajet = :idTrajet;";
        $parameters = array(
            array( 'name' => ':idUsager', 'value' => $this->idUsager, 'type' => 'int'),
            array( 'name' => ':idTrajet', 'value' => $this->getIdTrajet(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
//------------- Accesseurs

    public function setIdUsager($value) {
        $this->idUsager = $value;
    }
    public function getIdUsager() {
        return $this->idUsager;
    }
    public function setPrenomUsager($value) {
        $this->prenomUsager = $value;
    }
    public function getPrenomUsager() {
        return $this->prenomUsager;
    }
    public function setNomUsager($value) {
        $this->nomUsager = $value;
    }
    public function getNomUsager() {
        return $this->nomUsager;
    }
    public function setPseudoUsager($value) {
        $this->pseudoUsager = $value;
    }
    public function getPseudoUsager() {
        return $this->pseudoUsager;
    }
    public function setEmailUsager($value) {
        $this->emailUsager = $value;
    }
    public function getEmailUsager() {
        return $this->emailUsager;
    }
    public function setMdpUsager($value) {
        $this->mdpUsager = $value;
    }
    public function getMdpUsager() {
        return $this->mdpUsager;
    }
    public function setNumTelUsager($value) {
        $this->numTelUsager = $value;
    }
    public function getNumTelUsager() {
        return $this->numTelUsager;
    }

}