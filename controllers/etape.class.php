<?php
class Etape {
    
    private $ville;
    private $heure;
    
    public function __construct($ville, $heure) {
        $this->ville = $ville;
        $this->heure = $heure;
    }
    
    public function __toString() {
        $res = 'Ville : ' . $this->ville . '<br />';
        $res .= 'Heure : ' .$this->heure . '<br />';
        return $res;
    }
    
    public function getVille() {
        return $this->ville;
    }
}