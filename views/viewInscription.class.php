<?php
require_once(_VIEWS_ . 'view.class.php');
class ViewInscription extends View {
    public function __construct() {
        parent::__construct('Inscription', 'Page d\'inscription de TravelExpress');
    }

    protected function afficherBody() {
        include(_TPL_ . 'register.php');
    }
}
?>