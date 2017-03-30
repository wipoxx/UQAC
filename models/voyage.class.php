<?php
require_once(_MODELS_ . 'trajet.class.php');
require_once(_MODELS_ . 'usager.class.php');
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Voyage extends Hydratable{
    
    //Liste des trajets qui forment le voyage
    private $lTrajets = array();
    private $conducteur;
    private $nbPlacesVoyage;
    private $jour;
    
    
   /* public function __construct(Usager $conducteur, int $nbPlaces, string $date) {
    //public function __construct() {
        $this->conducteur = $conducteur;
        $this->nbPlacesVoyage = $nbPlaces;
        $this->date = $date;
    }*/
    
    public function __construct($data) {
        parent::__construct($data);
    }
    
    

    //Fonction d'enregistrement du voyage (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->id)
            $this->update();
        else
            $this->insert();
    }


    //Ajoute le voyage à la base de données
    private function insert()
    {
        $query = "INSERT INTO voyage SET IdUsager = :conducteur, JourDepart = :jour, NbPlaces = :nbPlacesVoyage;";
        $parameters = array(
            array( 'name' => ':conducteur', 'value' => $this->getConducteur(), 'type' => 'string'),
            array( 'name' => ':jour', 'value' => $this->getJour(), 'type' => 'string'),
            array( 'name' => ':nbPlacesVoyage', 'value' => $this->getNbPlacesVoyage(), 'type' => 'string')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    /**
     * Modifie le voyage dans la base de données
     */
    private function update()
    {
        $query = "UPDATE voyage SET IdUsager = :conducteur, JourDepart = :jour, NbPlaces = :nbPlacesVoyage;";
        $parameters = array(
            array( 'name' => ':conducteur', 'value' => $this->getConducteur(), 'type' => 'string'),
            array( 'name' => ':jour', 'value' => $this->getJour(), 'type' => 'string'),
            array( 'name' => ':nbPlacesVoyage', 'value' => $this->getNbPlacesVoyage(), 'type' => 'string')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    /**
     * Supprime le voyage de la base de données
     */
    public function remove()
    {
        $query = "DELETE FROM voyage  WHERE IdVoyage = :id;";
        $parameters = array(
            array( 'name' => ':id', 'value' => $this->id, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    
    //Ajouter un trajet à la liste
    public function ajoutTrajet(Etape $eDep, Etape $eArr) {
        array_push($this->lTrajets, new Trajet($eDep, $eArr, $this->nbPlacesVoyage));
    }
    
    
    public function __toString() {
        $res = '';
        foreach($this->lTrajets as $value) {
            $res .= 'Trajet :<br />' . $value . '<br />';
        }
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
    
    //-----------Acesseurs
    
    public function setConducteur($value) {
        $this->conducteur = $value;
    }
    
    public function getConducteur() {
        return $this->conducteur;
    }
    
    public function setNbPlacesVoyage($value) {
        $this->nbPlacesVoyage = $value;
    }
    
    public function getNbPlacesVoyage() {
        return $this->nbPlacesVoyage;
    }
    
    public function setJour($value) {
        $this->jour = $value;
    }
    
    public function getJour() {
        return $this->jour;
    }
    
    
}