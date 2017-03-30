<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Trajet extends Hydratable{
    private $villeDepart;
    private $heureDepart;
    private $villeArrivee;
    private $heureArrivee;
    private $nbPlacesTrajet;
    private $idVoyage;
    private $lPassagers = array();
    
    /*public function __construct(Etape $depart, Etape $arrivee, $nbPlaces) {
        $this->etapeDepart = $depart;
        $this->etapeArrivee = $arrivee;
        $this->nbPlacesTrajet = $nbPlaces;
    }*/
    
    public function __construct($data) {
        parent::__construct($data);
    }

    //Fonction d'enregistrement du trajet (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->id)
            $this->update();
        else
            $this->insert();
    }


    //Ajoute le trajet à la base de données
    private function insert()
    {
        $query = "INSERT INTO trajetelementaire SET IdVoyage = :idVoyage, VilleDepart = :villeDepart, HeureDepart = :heureDepart, VilleArrivee = :villeArrivee, HeureArrivee = :heureArrivee, NbPlacesTrajet = :nbPlacesTrajet;";
        $parameters = array(
            array( 'name' => ':idVoyage', 'value' => $this->getVoyage(), 'type' => 'string'),
            array( 'name' => ':villeDepart', 'value' => $this->villeDepart(), 'type' => 'string'),
            array( 'name' => ':heureDepart', 'value' => $this->heureDepart(), 'type' => 'time'),
            array( 'name' => ':villeArrivee', 'value' => $this->villeArrivee(), 'type' => 'string'),
            array( 'name' => ':heureArrivee', 'value' => $this->heureArrivee(), 'type' => 'time'),
            array( 'name' => ':nbPlacesTrajet', 'value' => $this->getNbPlacesTrajet(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    /**
     * Modifie le trajet dans la base de données
     */
    private function update()
    {
        $query = "UPDATE trajetelementaire SET IdVoyage = :idVoyage, VilleDepart = :villeDepart, HeureDepart = :heureDepart, VilleArrivee = :villeArrivee, HeureArrivee = :heureArrivee, NbPlacesTrajet = :nbPlacesTrajet;";
        $parameters = array(
            array( 'name' => ':idVoyage', 'value' => $this->getVoyage(), 'type' => 'string'),
            array( 'name' => ':villeDepart', 'value' => $this->villeDepart(), 'type' => 'string'),
            array( 'name' => ':heureDepart', 'value' => $this->heureDepart(), 'type' => 'time'),
            array( 'name' => ':villeArrivee', 'value' => $this->villeArrivee(), 'type' => 'string'),
            array( 'name' => ':heureArrivee', 'value' => $this->heureArrivee(), 'type' => 'time'),
            array( 'name' => ':nbPlacesTrajet', 'value' => $this->getNbPlacesTrajet(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    /**
     * Supprime le trajet de la base de données
     */
    public function remove()
    {
        $query = "DELETE FROM trajetelementaire  WHERE IdTrajetElementaire = :id;";
        $parameters = array(
            array( 'name' => ':id', 'value' => $this->id, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    
    public function __toString() {
        $res = '';
        $res .= 'Départ :<br />' . $this->etapeDepart . '<br />';
        $res .= 'Arrivée :<br />' . $this->etapeArrivee . '<br />';
        return $res;
    }
    
    /*public function getVilles() {
        return array($this->etapeDepart->getVille(), $this->etapeArrivee->getVille());
    }*/
    
    public function ajouterPassager(Usager $passager) {
        if ($this->nbPlacesTrajet > 1) {
            --$this->nbPlacesTrajet;
            $lPassagers->array_push($this->lPassagers, $passager);
            echo 'ajout passager trajet ok';
        } else {
            echo 'pas assez de place dans le trajet';
        }
    }
    
    
    //Accesseurs
    public function setId($value) {
        $this->id = $value;
    }
    
    public function getId() {
        return $this->id;
    }
    
   public function setIdVoyage($value) {
        $this->idVoyage = $value;
    }
    
    public function getIdVoyage() {
        return $this->idVoyage;
    }
    
   public function setVilleDepart($value) {
        $this->villeDepart = $value;
    }
    
    public function getVilleDepart() {
        return $this->villeDepart;
    }   
    
   public function setHeureDepart($value) {
        $this->heureDepart = $value;
    }
    
    public function getHeureDepart() {
        return $this->heureDepart;
    }   
    
   public function setVilleArrivee($value) {
        $this->villeArrivee = $value;
    }
    
    public function getVilleArrivee() {
        return $this->villeArrivee;
    }   
    
   public function setHeureArrivee($value) {
        $this->heureArrivee = $value;
    }
    
    public function getHeureArrivee() {
        return $this->heureArrivee;
    }   
    
   public function setNbPlacesTrajet($value) {
        $this->nbPlacesTrajet = $value;
    }
    
    public function getNbPlacesTrajet() {
        return $this->nbPlacesTrajet;
    }   
    
}