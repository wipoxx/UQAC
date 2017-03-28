<?php
require_once(_CTRL_ . 'trajet.class.php');
require_once(_CTRL_ . 'usager.class.php');
class Voyage {
    
    //Liste des trajets qui forment le voyage
    private $lTrajets = array();
    
    private $conducteur;
    
    private $nbPlacesRestantes;
    
    private $lPassagers = array();
    
    //public function __construct(Usager $conducteur, int $nbPlaces) {
    public function __construct() {
   //     $this->conducteur = $conducteur;
    //    $this->nbPlacesRestantes = $nbPlaces;
    }
    
    //Ajouter un trajet à la liste
    public function ajoutTrajet(Trajet $trajet) {
        array_push($this->lTrajets, $trajet);
    }
    
    
    public function __toString() {
        $res = '';
        foreach($this->lTrajets as $value) {
            $res .= 'Trajet :<br />' . $value . '<br />';
        }
        return $res;
    }
    
    //Ajouter un passager au t
    public function ajouterPassager(Usager $passager) {
        --$nbPlacesRestantes;
        array_push($lPassagers, $passager);
        echo 'Passager ajouté';
    }
    
    public function rechercheItineraire(string $villeDep, string $villeArr) {
        //Récupère toutes les villes du voyage
        $lVilles = array();
        foreach($this->lTrajets as $trajet) {
            $lVilles = array_merge($lVilles, $trajet->getVilles());
        }
        //Regarde si les villes de la recherche font parties du voyage
        if (in_array($villeDep, $lVilles)) {
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
        }
    }
    
}