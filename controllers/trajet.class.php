<?php
require_once(_CTRL_ . 'etape.class.php');

class Trajet {
    private $etapeDepart;
    private $etapeArrivee;
    
    public function __construct(Etape $depart, Etape $arrivee) {
        $this->etapeDepart = $depart;
        $this->etapeArrivee = $arrivee;
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
}