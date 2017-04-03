<?php
class View {
    private $titre;
    private $description;
    private $style;

    
    public function __construct(string $titre, string $description)
    {
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
        include(_TPL_ . 'nav.php');
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