<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Trajet extends Hydratable{
    private $idTrajetElementaire;
    private $idVoyage;
    private $nbPlaces;
    private $villeDepart;
    private $heureDepart;
    private $villeArrivee;
    private $heureArrivee;
    private $lPassagers = array();

    
    public function __construct($data) {
        parent::__construct($data);
        $this->save();
    }

    //Fonction d'enregistrement (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->idTrajetElementaire)
            $this->update();
        else
            $this->insert();
    }

    //Ajoute le trajet à la base de données
    private function insert()
    {
        $query = "INSERT INTO trajetelementaire (IdVoyage, NbPlaces, VilleDepart, HeureDepart, VilleArrivee, HeureArrivee) VALUES (:idVoyage, :nbPlaces, :villeDepart, :heureDepart, :villeArrivee, :heureArrivee);";
        $parameters = array(
            array( 'name' => ':idVoyage', 'value' => $this->idVoyage, 'type' => 'string'),
            array( 'name' => ':nbPlaces', 'value' => $this->nbPlaces, 'type' => 'int'),
            array( 'name' => ':villeDepart', 'value' => $this->villeDepart, 'type' => 'string'),
            array( 'name' => ':heureDepart', 'value' => $this->heureDepart, 'type' => 'time'),
            array( 'name' => ':villeArrivee', 'value' => $this->villeArrivee, 'type' => 'string'),
            array( 'name' => ':heureArrivee', 'value' => $this->heureArrivee, 'type' => 'time')
        );
        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Modifie le trajet dans la base de données
    private function update()
    {
        $query = "UPDATE trajetelementaire SET IdVoyage = :idVoyage, NbPlaces = :nbPlaces, VilleDepart = :villeDepart, HeureDepart = :heureDepart, VilleArrivee = :villeArrivee, HeureArrivee = :heureArrivee WHERE IdTrajetElementaire = :idTrajetElementaire;";
        $parameters = array(
            array( 'name' => ':idVoyage', 'value' => $this->idVoyage, 'type' => 'string'),
            array( 'name' => ':nbPlaces', 'value' => $this->nbPlaces, 'type' => 'int'),
            array( 'name' => ':villeDepart', 'value' => $this->villeDepart, 'type' => 'string'),
            array( 'name' => ':heureDepart', 'value' => $this->heureDepart, 'type' => 'time'),
            array( 'name' => ':villeArrivee', 'value' => $this->villeArrivee, 'type' => 'string'),
            array( 'name' => ':heureArrivee', 'value' => $this->heureArrivee, 'type' => 'time')
        );
        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Supprime le trajet de la base de données
    public function remove()
    {
        $query = "DELETE FROM trajetelementaire  WHERE IdTrajetElementaire = :idTrajetElementaire;";
        $parameters = array(
            array( 'name' => ':idTrajetElementaire', 'value' => $this->idTrajetElementaire, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
   /* public static function getTrajet($ville) {
        $query = "SELECT * FROM voyage WHERE IdUsager = :idUsager;";
        $parameters = array( array('name' => ':idUsager', 'value' => $idUsager, 'type' => 'string'));
        $results = null;
        $db = BDDLocale::getInstance();

        if($db->get($query, $results, $parameters))
        {
            $lVoyages = array();
            foreach($results as $result) {
                $lVoyages[] = new Voyage($result);
            }
            return $lVoyages;
        }
    }*/
 
    public function __toString() {
        $res = '';
        $res .= 'Départ :<br />' . $this->villeDepart . ' à ' .$this->heureDepart. '<br />';
        $res .= 'Arrivée :<br />' . $this->villeArrivee . ' à ' .$this->heureArrivee. '<br />';
        return $res;
    }
    
    public function ajouterPassager(Usager $passager) {
        if ($this->nbPlaces > 1) {
            --$this->nbPlaces;
            $lPassagers->array_push($this->lPassagers, $passager);
            echo 'ajout passager trajet ok';
        } else {
            echo 'pas assez de place dans le trajet';
        }
    }
       
    
    
    //Accesseurs
    public function setIdTrajetElementaire($value) {
        $this->idTrajetElementaire = $value;
    }
    
    public function getIdTrajetElementaire() {
        return $this->idTrajetElementaire;
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
    
   public function setNbPlaces($value) {
        $this->nbPlaces = $value;
    }
    
    public function getNbPlaces() {
        return $this->nbPlaces;
    }   
    
}