<?php
require_once(_VIEWS_ . 'view.class.php');
require_once(_VIEWS_ . 'viewAccueil.class.php');

class MainController
{
    private $view;
    
    public function __construct()
    {
        $this->traiterDonneesGet();
        $this->afficher();
        
    }
    
    public function traiterDonneesGet()
    {
        $page = $_GET['page'];
        if ($page != null) {
            if ($page == 'loisirs') {
                echo 'truc';
            } else {
                $this->view = new View('Erreur');
            }
        } else {
            $this->view = new ViewAccueil();
        }
    }
        
    public function afficher()
    {
        $this->view->afficher();
    }
}
