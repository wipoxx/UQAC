
<?php
require_once(_VIEWS_ . 'view.class.php');
class ViewRecherche extends View {
    public function __construct() {
        parent::__construct('Recherche de voyage', '');
    }

    protected function afficherBody() {
        include(_TPL_ . 'recherche.php');
    }
}
?>