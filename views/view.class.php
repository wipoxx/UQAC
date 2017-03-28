<?php
class View {
    private $titre;
    private $description;
    private $style;

    
//Constructeur qui accepte 2 ou 3 paramètres (seule façon de le faire)
public function __construct()
{
    $compteurArgs = func_num_args();
    $args = func_get_args();
    switch($compteurArgs)
    {
        case 2 :
            $this->constructSansStyle($args[0],$args[1]);
            break;
        case 3:
            $this->constructAvecStyle($args[0],$args[1],$args[2]);
            break;
         default:
            break;
    }
}
 
    //Constructeur lorsque un style est spécifié een 3e paramètre
    private function constructAvecStyle(string $titre, string $description, string $style) {
        $this->titre = $titre;
        $this->description = $description;
        $this->style = $style;
        
    }
    
    //Constructeur lorsque seul le titre et la description de la page sont spécifiés
    private function constructSansStyle(string $titre, string $description) {
        $this->titre = $titre;
        $this->description = $description;
        
    }
    
    public function getTitre() {
        return $this->titre;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getStyle() {
        return $this->style;
    }

    
    protected function afficherHeader() {
        include(_TPL_ . 'header.php');
    
    }
    protected function afficherBanner() {
        include(_TPL_ . 'banner.html');
    }
    
    protected function afficherNav() {
        include(_TPL_ . 'nav_invite.html');
    }
    
    
    protected function afficherFooter() {
        include(_TPL_ . 'footer.html');
    }
    
    protected function afficherBody() {
        include(_TPL_ . 'erreur.html');
    }
    
    public function afficher() {
        $this->afficherHeader();
        $this->afficherBanner();
        $this->afficherNav();
        $this->afficherBody();
        $this->afficherFooter();
    }  
}

?>