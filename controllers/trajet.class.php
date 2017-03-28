<?php
require_once(_CTRL_ . 'etape.class.php');

class Trajet {
    private $etapeDepart;
    private $etapeArrivee;
    private $nbPlacesTrajet;
    private $lPassagers = array();
    
    public function __construct(Etape $depart, Etape $arrivee, $nbPlaces) {
        $this->etapeDepart = $depart;
        $this->etapeArrivee = $arrivee;
        $this->nbPlacesTrajet = $nbPlaces;
    }
    
    public function __toString() {
        $res = '';
        $res .= 'Départ :<br />' . $this->etapeDepart . '<br />';
        $res .= 'Arrivée :<br />' . $this->etapeArrivee . '<br />';
        return $res;
    }
    
    public function getVilles() {
        return array($this->etapeDepart->getVille(), $this->etapeArrivee->getVille());
    }
    
    public function ajouterPassager(Usager $passager) {
        if ($this->nbPlacesTrajet > 1) {
            --$this->nbPlacesTrajet;
            $lPassagers->array_push($this->lPassagers, $passager);
            echo 'ajout passager trajet ok';
        } else {
            echo 'pas assez de place dans le trajet';
        }
    }
}