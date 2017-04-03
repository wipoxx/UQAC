<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Usager extends Hydratable
{
    private $idUsager;
    private $pseudoUsager;
    private $nomUsager;
    private $prenomUsager;
    private $mdpUsager;
    private $emailUsager;
    private $numTelUsager;
    private $nbAnnulations;
    private $role;
    
    private static $erreurInscription = false;
    private static $lErreurs_inscription = array();
    
    //construit un nouveau membre -> l'inscrit
    /*public function __construct($pseudoUsager, $nomUsager, $pseudoUsager, $mdpUsager1, $mdpUsager2, $emailUsager, $tel) {
        $resultat = $this->verifInscription($pseudoUsager, $nomUsager, $pseudoUsager, $mdpUsager1, $mdpUsager2, $emailUsager, $tel);
        if ($resultat == "ok") {
            $this->prenom = $pseudoUsager;
            $this->nom = $nomUsager;
            $this->nomUtilisateur = $pseudoUsager;
            $this->mdp = sha1($mdpUsager1);
            $this->emailUsager = $emailUsager;
            $this->tel = $tel;
            $this->nbAnnulations = 0;
            $this->role = null;
            //Ajouter usager à la bdd
        } else {
            return $resultat;
        }*/
    
    public function __construct($data = array()) {
            parent::__construct($data);
            $this->nbAnnulations = 0;
            $this->save();
            $this->demarrerSession();
        
    }
    
    public static function inscription($data = array()) {
        //verifInscription
        if(isset($data['pseudoUsager']) && isset($data['mdpUsager1']) && isset($data['mdpUsager2']) && isset($data['emailUsager']) && isset($data['numTelUsager'])) {
            if(!empty($data['pseudoUsager']) &&!empty($data['mdpUsager1']) &&!empty($data['mdpUsager2']) &&!empty($data['emailUsager']) &&!empty($data['numTelUsager'])) {
                Usager::verifemailUsager($data['emailUsager']);
                Usager::verifTel($data['numTelUsager']);
                Usager::verifNomUtilisateur($data['pseudoUsager']);
                Usager::verifMdp($data['mdpUsager1'], $data['mdpUsager2']);
                //Si l'inscription est possible
                $erreur = Usager::getErreurInscription();
                if(!$erreur) {
                    if (isset ($data['mdpUsager1'])) {
                        $data['mdpUsager'] = $data['mdpUsager1'];
                    }
                    $u = new Usager($data);
                    echo'<h1>Inscription terminée</h1>';
                    echo'<p>Bienvenue '. $u->pseudoUsager. ' vous êtes maintenant inscrit</p> 
                    <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';            
                }
            } else {
            echo 'Il manque au moins un champ obligatoire';
            }   
        } 
    }
    
    public static function verifInscription($pseudoUsager, $mdpUsager1, $mdpUsager2, $emailUsager, $tel) {
        Usager::verifemailUsager($emailUsager);
        Usager::verifTel($tel);
        Usager::verifNomUtilisateur($pseudoUsager);
        Usager::verifMdp($mdpUsager1, $mdpUsager2);
        
    }
    
    //vérifie si l'email est déjà pris ou qu'il n'a pas la forme requise
    private static function verifemailUsager(string $emailUsager) {   
        $query = "SELECT COUNT(*) AS nbr FROM usager NATURAL JOIN voyage  WHERE EmailUsager = :email;";
        $parameters = array( array('name' => ':email', 'value' => $emailUsager, 'type' => 'string'));
        $results = null;
        $mail_ok = true;
        $db = BDDLocale::getInstance();
        if($db->get($query, $results, $parameters))
        {
            if($results[0]['nbr'] > 0) {
                echo "Votre adresse email est déjà utilisée par un membre";
                $mail_ok = false;
                Usager::setErreurInscription(true);
            }
        }
        
        if ($mail_ok) {
            //On vérifie la forme maintenant
            /*if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || empty($mail))
            {
                $lErreurs_inscription[] = "Votre adresse E-Mail n'a pas un format valide";  
            }*/
        }
    }
    
    //verifie si le num de tel n'est pas dans le format français
    private static function verifTel(string $tel) {
        /*if(!!preg_match('#^0[0-9]([ .-]?[0-9]{2}){4}$#', $tel) || empty($tel))
        {
            $lErreurs_inscription[] = "Votre numéro de téléphone n'a pas un format valide (Français)";
        }*/
    }
    
    //verifie que le nom de l'utilisateur a la bonne taille est n'est pas pris par un membre
    private static function verifNomUtilisateur(string $pseudo) {
        $query = "SELECT COUNT(*) AS nbr FROM usager WHERE PseudoUsager = :pseudoUsager;";
        $parameters = array( array('name' => ':pseudoUsager', 'value' => $pseudo, 'type' => 'string'));
        $results = null;
        $pseudo_ok = true;
        $db = BDDLocale::getInstance();
        if($db->get($query, $results, $parameters))
        {
            if ($results[0]['nbr'] > 0) {
                echo 'Votre pseudo est déjà utilisé par un membre';
                $pseudo_ok = false;
                Usager::setErreurInscription(true);
            }            
        }
        
        if($pseudo_ok) {
            if (strlen($pseudo) < 5 || strlen($pseudo) > 15)
            {
                echo 'Votre pseudo est soit trop grand, soit trop petit (entre 5 et 15 caractères)';
                Usager::setErreurInscription(true);
            }
        }
    }
    
    //Vérifie que les 2 mdp correspondent
    private static function verifMdp(string $mdp, string $mdp2) {
        if ($mdp != $mdp2)
        {
            echo 'Votre mot de passe et votre confirmation diffèrent.';
            Usager::setErreurInscription(true);
        }
    }

    private function demarrerSession() {
        if(!isset($_SESSION['pseudoUsager']) && !isset($_SESSION['idUsager'])) {
            $_SESSION['pseudoUsager'] = $this->pseudoUsager;
            $_SESSION['idUsager'] = $this->idUsager;
        }
    }
    
    //Fonction d'enregistrement de l'usager (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->idUsager)
            $this->update();
        else
            $this->insert();
    }

    //Ajoute l'usager à la base de données
    private function insert()
    {
        $query = "INSERT INTO usager (PseudoUsager, NomUsager, PrenomUsager, EmailUsager, NumTelUsager, MdpUsager) VALUES (:pseudoUsager, :nomUsager, :prenomUsager, :emailUsager, :numTelUsager, :mdpUsager);";
        $parameters = array(
            array( 'name' => ':pseudoUsager', 'value' => $this->getPseudoUsager(), 'type' => 'string'),
            array( 'name' => ':nomUsager', 'value' => $this->getNomUsager(), 'type' => 'string'),
            array( 'name' => ':prenomUsager', 'value' => $this->getPrenomUsager(), 'type' => 'string'),
            array( 'name' => ':emailUsager', 'value' => $this->getemailUsager(), 'type' => 'string'),
            array( 'name' => ':mdpUsager', 'value' => $this->getMdpUsager(), 'type' => 'string'),
            array( 'name' => ':numTelUsager', 'value' => $this->getNumTelUsager(), 'type' => 'int')
        );
        $db = BDDLocale::getInstance();
        $this->idUsager = $db->insert($query, $parameters);
    }

    //Modifie l'usager dans la base de données
    private function update()
    {
        $query = "UPDATE usager SET PrenomUsager = :prenomUsager, NomUsager = :nomUsager, PseudoUsager = :pseudoUsager, MdpUsager = :mdpUsager, emailUsager = :emailUsager, NumTelUsager = :numTelUsager WHERE IdUsager = :idUsager;";
        $parameters = array(
            array( 'name' => ':prenomUsager', 'value' => $this->getPrenomUsager(), 'type' => 'string'),
            array( 'name' => ':nomUsager', 'value' => $this->getNomUsager(), 'type' => 'string'),
            array( 'name' => ':nomUtilisateur', 'value' => $this->getPseudoUsager(), 'type' => 'string'),
            array( 'name' => ':mdpUsager', 'value' => $this->getMdpUsager(), 'type' => 'string'),
            array( 'name' => ':emailUsager', 'value' => $this->getemailUsager(), 'type' => 'string'),
            array( 'name' => ':numTelUsager', 'value' => $this->getNumTelUsager(), 'type' => 'int'),
            array( 'name' => ':idUsager', 'value' => $this->getIdUsager(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    //Supprime l'usager de la base de données
    public function remove()
    {
        $query = "DELETE FROM usager  WHERE IdUsager = :idUsager;";
        $parameters = array(
            array( 'name' => ':idUsager', 'value' => $this->idUsager, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
    //Connexion d'un usager : crée les variables de session
   public static function connexion(string $pseudo, string $mdp) {
        $query = "SELECT * FROM usager WHERE PseudoUsager = :pseudoUsager AND MdpUsager = :mdpUsager;";
        $parameters = array( array('name' => ':pseudoUsager', 'value' => $pseudo, 'type' => 'string'),
                             array('name' => ':mdpUsager', 'value' =>$mdp, 'type' => 'string'));
        $results = null;
        $db = BDDLocale::getInstance();

        if($db->get($query, $results, $parameters))
        {
            return new Usager($results[0]);
        }

        return null;
    }
    
   /* public function annulerVoyage($voyage) {
        //if ($role == )
    }*/
/*    public function proposerVoyage($voyage) {
        
    }*/
    public function __toString() {
        $res = 'Usager ' . $this->prenomUsager . ' ' .$this->nomUsager . '<br />';
        $res .= 'pseudo : ' .  $this->pseudoUsager . ' ; mdp : ' . $this->mdpUsager . '<br />';
        $res .= 'emailUsager : ' . $this->emailUsager . ' ; tel : ' . $this->numTelUsager;
        return $res;
        
    }    
    
//------------- Accesseurs

    public function setIdUsager($value) {
        $this->idUsager = $value;
    }
    public function getIdUsager() {
        return $this->idUsager;
    }
    public function setPrenomUsager($value) {
        $this->prenomUsager = $value;
    }
    public function getPrenomUsager() {
        return $this->prenomUsager;
    }
    public function setNomUsager($value) {
        $this->nomUsager = $value;
    }
    public function getNomUsager() {
        return $this->nomUsager;
    }
    public function setPseudoUsager($value) {
        $this->pseudoUsager = $value;
    }
    public function getPseudoUsager() {
        return $this->pseudoUsager;
    }
    public function setEmailUsager($value) {
        $this->emailUsager = $value;
    }
    public function getEmailUsager() {
        return $this->emailUsager;
    }
    public function setMdpUsager($value) {
        $this->mdpUsager = $value;
    }
    public function getMdpUsager() {
        return $this->mdpUsager;
    }
    public function setNumTelUsager($value) {
        $this->numTelUsager = $value;
    }
    public function getNumTelUsager() {
        return $this->numTelUsager;
    }
    public static function getErreurInscription() {
        return Usager::$erreurInscription;
    }
    public static function setErreurInscription($value) {
        Usager::$erreurInscription = $value;
    }

}