<?php
require_once(_VIEWS_ . 'view.class.php');
class ViewProfil extends View {
    public function __construct() {
        parent::__construct('Profil', '');
    }

    protected function afficherBody() {
        include(_TPL_ . 'profil.php');
    }
}
?>