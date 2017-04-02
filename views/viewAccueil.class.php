<?php
require_once(_VIEWS_ . 'view.class.php');
class ViewAccueil extends View {
    public function __construct() {
        parent::__construct('Bienvenue sur TravelExpress !', 'Page d\'accueil de TravelExpress');
    }

    protected function afficherBody() {
        include(_TPL_ . 'accueil.php');
    }
}
?>