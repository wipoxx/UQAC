<?php
require_once(_VIEWS_ . 'view.class.php');
require_once(_VIEWS_ . 'viewAccueil.class.php');
require_once(_VIEWS_ . 'viewInscription.class.php');

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
        if (isset($_GET['page'])) {
           $page = $_GET['page'];
        
            if ($page == 'inscription') {
                $this->view = new ViewInscription();
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