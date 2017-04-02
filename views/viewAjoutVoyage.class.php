<?php
require_once(_VIEWS_ . 'view.class.php');
class ViewAjoutVoyage extends View {
    public function __construct() {
        parent::__construct('Ajout de voyage', '');
    }

    protected function afficherBody() {
        include(_TPL_ . 'ajoutVoyage.php');
    }
}
?>