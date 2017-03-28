<?php
require_once(_CTRL_ . 'trajet.class.php');
require_once(_CTRL_ . 'usager.class.php');
class Voyage {
    
    //Liste des trajets qui forment le voyage
    private $lTrajets = array();
    private $conducteur;
    private $nbPlacesVoyage;
    private $jour;
    
    
    public function __construct(Usager $conducteur, int $nbPlaces, string $date) {
    //public function __construct() {
        $this->conducteur = $conducteur;
        $this->nbPlacesVoyage = $nbPlaces;
        $this->date = $date;
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
    
}