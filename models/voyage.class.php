<?php
require_once(_MODELS_ . 'trajet.class.php');
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
    //private $preference;
    private $nbPlaces;
    private $dateDepart;
    
    public function __construct($data) {
        parent::__construct($data);
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
    
        public static function getVoyagesDate($date) {
        $query = "SELECT * FROM voyage WHERE DateDepart = :dateDepart;";
        $parameters = array( array('name' => ':dateDepart', 'value' => $date, 'type' => 'string'));
        $results = null;
        $db = BDDLocale::getInstance();

        if($db->get($query, $results, $parameters))
        {
            $lVoyages = array();
            foreach($results as $result) {
                $lVoyages[] = new Voyage($result);;
            }
            return $lVoyages;
        }
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
    
    //En fait il faudrait bouger ce code à l'endroit où on gère le formulaire de recherche et le faire sur tous les voyages présents dans la bdd et avec une date 
    //Recherche des voyages passant par les deux villes en entrée dans le sens villeDep -> villeArr
    public function rechercheItineraire(string $villeDep, string $villeArr) {
        //Récupère toutes les villes du voyage
        $lVilles = array();
        foreach($this->lTrajets as $trajet) {
            $lVilles = array_merge($lVilles, $trajet->getVilles());
        }
        
        foreach($lVilles as $ville) { //Boucle pour chercher la première ville
            if ($ville == $villeDep) {
                $indexVilleDep = array_search($villeDep, $lVilles);
                foreach($lVilles as $ville2) {  //Boucle pour chercher la deuxième ville
                    if($ville2 == $villeArr) {
                        $indexVilleArr = array_search($villeArr, $lVilles);
                        if($indexVilleDep < $indexVilleArr) {   //Si le trajet va bien dans le bon sens
                            echo 'recherche ok';
                        } else {
                            echo 'pas le bon sens';
                        }
                    } else {
                        echo 'pas ville d\'arrivee';
                    }
                }
            } else {
                echo 'pas ville de départ';
            }
        }
        
        //Regarde si les villes de la recherche font parties du voyage
        /*if (in_array($villeDep, $lVilles)) {
            $indexVilleDep = array_search($villeDep, $lVilles);
            if(in_array($villeArr, $lVilles)) {
                $indexVilleArr = array_search($villeArr, $lVilles);
                if($indexVilleDep < $indexVilleArr) {   //Si le trajet va bien dans le bon sens
                    echo 'recherche ok';
                } else {
                    echo 'pas le bon sens';
                }
            } else {
                echo 'pas ville d\'arrivee';
            }
        } else {
            echo 'pas ville de départ';
        }*/
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