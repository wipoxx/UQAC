<?php
require_once(_MODELS_ . 'trajetElementaire.class.php');
require_once(_MODELS_ . 'usager.class.php');
require_once(_MODELS_ . 'preference.class.php');
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Voyage extends Hydratable{
    
    //Liste des trajets qui forment le voyage
    private $lTrajets = array();
    private $idVoyage;
    private $idUsager;  //Le conducteur
    private $idPreference;
    private $nbPlaces;
    private $dateDepart;
    
    public function __construct($data) {
        parent::__construct($data);
        $this->save();
    }

    //Fonction d'enregistrement (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->idVoyage)
            $this->update();
        else
            $this->insert();
    }

    //Ajoute le voyage à la base de données
    private function insert()
    {
        $query = "INSERT INTO voyage (IdUsager, DateDepart, NbPlaces, IdPreference) VALUES (:idUsager, :dateDepart, :nbPlaces, :idPreference);";
        $parameters = array(
            array( 'name' => ':idUsager', 'value' => $this->getIdUsager(), 'type' => 'string'),
            array( 'name' => ':dateDepart', 'value' => $this->getDateDepart(), 'type' => 'string'),
            array( 'name' => ':nbPlaces', 'value' => $this->getNbPlaces(), 'type' => 'string'),
            array( 'name' => ':idPreference', 'value' => $this->getIdPreference(), 'type' => 'string')
        );

        $db = BDDLocale::getInstance();
        $this->idVoyage = $db->insert($query, $parameters);
    }

    //Modifie le voyage dans la base de données
    private function update()
    {
        $query = "UPDATE voyage SET IdUsager = :idUsager, DateDepart = :dateDepart, NbPlaces = :nbPlaces, IdPreference = :idPreference WHERE IdVoyage = :idVoyage;";
        $parameters = array(
            array( 'name' => ':idUsager', 'value' => $this->getIdUsager(), 'type' => 'string'),
            array( 'name' => ':dateDepart', 'value' => $this->getDateDepart(), 'type' => 'string'),
            array( 'name' => ':nbPlaces', 'value' => $this->getNbPlaces(), 'type' => 'string'),
            array( 'name' => ':idPreference', 'value' => $this->getIdPreference(), 'type' => 'string'),
            array( 'name' => ':idVoyage', 'value' => $this->getIdVoyage(), 'type' => 'string')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Supprime de la base de données
    public function remove()
    {
        $query = "DELETE FROM voyage  WHERE IdVoyage = :idVoyage;";
        $parameters = array(
            array( 'name' => ':idVoyage', 'value' => $this->idVoyage, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
    //Récupère le voyage correspondant à l'id en entrée
    public static function get($id) {
        $query = "SELECT * FROM voyage WHERE IdVoyage = :idVoyage;";
        $parameters = array( array('name' => ':idVoyage', 'value' => $id, 'type' => 'string'));
        $results = null;
        $db = BDDLocale::getInstance();

        if($db->get($query, $results, $parameters))
        {
            return new Voyage($results[0]);
        }
    }
 
    //Récupère tous les voyages d'un conducteur
    public static function getVoyagesConducteur($idUsager) {
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
    }
    
    
    public static function getVoyagesApresDate($date, $villeDep, $villeArr) {
        /*$dateMin = date('Y-m-d H:i:s', abs(strtotime($date) - 28800));
        $dateMax = date('Y-m-d H:i:s', abs(strtotime($date) + 43200));
        $query = "SELECT * FROM voyage WHERE DateDepart BETWEEN :date1 AND :date2;";
        $parameters = array( array('name' => ':date1', 'value' => $dateMin, 'type' => 'string'),
                             array('name' => ':date2', 'value' => $dateMax, 'type' => 'string'));*/
        
        $query = "SELECT * FROM voyage WHERE DateDepart >= :date;";
        $parameters = array( array('name' => ':date', 'value' => $date, 'type' => 'string'));
        $results = null;
        $db = BDDLocale::getInstance();

        if($db->get($query, $results, $parameters))
        {
            $lVoyages = array();
            foreach($results as $result) {
                $voyage = new Voyage($result);
                //Récupère l'id des trajets elt contenant la ville de départ ou la ville d'arrivée dans un même voyage
                $lIdDepArr = $voyage->rechercheTrajet($villeDep, $villeArr); 
                $lIdTrajets = array();
                if($lIdDepArr != null) {
                    //Récupère tous les trajets elt pour réaliser le trajet demandé par l'usager
                    $lTrajets[] = TrajetElementaire::getWithId($lIdDepArr[0], $lIdDepArr[1]);
                }
            }
            return $lTrajets;
        }
    }

    //Récupère toutes les villes de départ + heure dans les trajets du voyage
    private function getVillesDepart() {
        $query = "SELECT idTrajetElementaire, villeDepart FROM trajetelementaire NATURAL JOIN voyage  WHERE IdVoyage = :idVoyage;";
        $parameters = array( array('name' => ':idVoyage', 'value' => $this->idVoyage, 'type' => 'int'));
        $results = null;
        $db = BDDLocale::getInstance();
        if($db->get($query, $results, $parameters))
        {
            return $results;
        }
    }
        
    //Récupère toutes les villes d'arrivée + heure dans les trajets du voyage
    private function getVillesArrivee() {
        $query = "SELECT idTrajetElementaire,villeArrivee FROM trajetelementaire NATURAL JOIN voyage  WHERE IdVoyage = :idVoyage;";
        $parameters = array( array('name' => ':idVoyage', 'value' => $this->idVoyage, 'type' => 'string'));
        $results = null;
        $db = BDDLocale::getInstance();
        if($db->get($query, $results, $parameters))
        {
            return $results;
        }
    }
    
    //Trouve s'il est possible d'aller d'une ville A à une ville B dans le voyage 
    //(même si elles ne sont pas du même trajet élémentaire)
    private function rechercheTrajet($villeDep, $villeArr) {
        $lDep = $this->getVillesDepart();
        $lArr = $this->getVillesArrivee();
        $res = null;
        for ($i = 0 ; $i < count($lDep) ; $i++) {
            if($villeDep == $lDep[$i]['villeDepart']) {
                for ($j = $i ; $j < count($lArr) ; $j++) {  
                    //Permet de ne regarder que les villes qui se trouvent après dans le voyage
                    if ($villeArr == $lArr[$j]['villeArrivee']) {
                        //retourne l'id du trajetElt de départ et l'id de trajetElt d'arrivée
                         $res=  array($lDep[$i]['idTrajetElementaire'], $lArr[$j]['idTrajetElementaire']);
                    }
                }
            }
        }
        return $res;
    }
    
    //Ajouter un trajet à la liste
    public function ajoutTrajet(Etape $eDep, Etape $eArr) {
        array_push($this->lTrajets, new Trajet($eDep, $eArr, $this->nbPlacesVoyage));
    } 
    
    public function __toString() {
        $res = 'idVoyage : ' .$this->idVoyage. ' - id Conducteur : ' .$this->idUsager. '<br />';
        $res .= 'Date : ' .$this->dateDepart. '<br />';
        /*foreach($this->lTrajets as $value) {
            $res .= 'Trajet :<br />' . $value . '<br />';
        }*/
        return $res;
    }
    
    //Ajouter un passager aux trajets
    //--------Faire en sorte qu'en entrée il n'y ai qu'une ville de départ et d'arrivée et que ça mette le passager dans les bons trajets du voyage
    public function ajouterPassager(Usager $passager, $lTrajetsPassager) {
        foreach($this->lTrajetsPassager as $trajetPassager) {
            echo $trajetPassager;
            $trajetPassager->ajouterPassager($passager);
        }
        echo 'Passager ajouté voyage';
    }
    
    //-----------Accesseurs
    public function setIdUsager($value) {
        $this->idUsager = $value;
    }
    
    public function getIdUsager() {
        return $this->idUsager;
    }
    
    public function setNbPlaces($value) {
        $this->nbPlaces = $value;
    }
    
    public function getNbPlaces() {
        return $this->nbPlaces;
    }
    
    public function setDateDepart($value) {
        $this->dateDepart = $value;
    }
    
    public function getDateDepart() {
        return $this->dateDepart;
    }
    
    public function setIdVoyage($value) {
        $this->idVoyage = $value;
    }
    
    public function getIdVoyage() {
        return $this->idVoyage;
    }
    
    public function setIdPreference($value) {
        $this->idPreference = $value;
    }
    
    public function getIdPreference() {
        return $this->idPreference;
    } 
}