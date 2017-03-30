<?php
require_once(_MODELS_.'hydratable.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

class Usager extends Hydratable
{
    private $id;
    private $prenom;
    private $nom;
    private $nomUtilisateur;
    private $mdp;
    private $email;
    private $tel;
    private $nbAnnulations;
    private $role;
    
    //construit un nouveau membre -> l'inscrit
    /*public function __construct($prenom, $nom, $nomUtilisateur, $mdp1, $mdp2, $email, $tel) {
        $resultat = $this->verifInscription($prenom, $nom, $nomUtilisateur, $mdp1, $mdp2, $email, $tel);
        if ($resultat == "ok") {
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->nomUtilisateur = $nomUtilisateur;
            $this->mdp = sha1($mdp1);
            $this->email = $email;
            $this->tel = $tel;
            $this->nbAnnulations = 0;
            $this->role = null;
            //Ajouter usager à la bdd
        } else {
            return $resultat;
        }*/
    
    public function __construct($prenom, $nom, $nomUtilisateur, $mdp1, $mdp2, $email, $tel) {
        if ($mdp1 == $mdp2) {
            //verifInscription
            $data = array($prenom, $nom, $nomUtilisateur, $mdp1, $mdp2, $email, $tel);
            parent::__construct($data);
        }
    }


    //Fonction d'enregistrement de l'usager (ajoute ou modifie en fonction de la valeur de l'id)
    public function save()
    {
        if($this->id)
            $this->update();
        else
            $this->insert();
    }


    //Ajoute l'usager à la base de données
    private function insert()
    {
        $query = "INSERT INTO usager PseudoUsager = :nomUtilisateur, NomUsager = :nom, SET PrenomUsager = :prenom, EmailUsager = :email, MdpUsager = :mdp,  NumTelUsager = :tel;";
        $parameters = array(
            array( 'name' => ':nomUtilisateur', 'value' => $this->getNomUtilisateur(), 'type' => 'string'),
            array( 'name' => ':nom', 'value' => $this->getNom(), 'type' => 'string'),
            array( 'name' => ':prenom', 'value' => $this->getPrenom(), 'type' => 'string'),
            array( 'name' => ':email', 'value' => $this->getEmail(), 'type' => 'string'),
            array( 'name' => ':mdp', 'value' => $this->getMdp(), 'type' => 'string'),
            array( 'name' => ':tel', 'value' => $this->getTel(), 'type' => 'int')
        );
        
        $db = BDDLocale::getInstance();
        $truc = $db->execute($query, $parameters);
        var_dump($truc);
    }

    /**
     * Modifie l'usager dans la base de données
     */
    private function update()
    {
        $query = "UPDATE usager SET PrenomUsager = :prenom, NomUsager = :nom, PseudoUsager = :nomUtilisateur, MdpUsager = :mdp, EmailUsager = :email, NumTelUsager = :tel;";
        $parameters = array(
            array( 'name' => ':prenom', 'value' => $this->getPrenom(), 'type' => 'string'),
            array( 'name' => ':nom', 'value' => $this->getNom(), 'type' => 'string'),
            array( 'name' => ':nomUtilisateur', 'value' => $this->getNomUtilisateur(), 'type' => 'string'),
            array( 'name' => ':mdp', 'value' => $this->getMdp(), 'type' => 'string'),
            array( 'name' => ':email', 'value' => $this->getEmail(), 'type' => 'string'),
            array( 'name' => ':tel', 'value' => $this->getTel(), 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }

    /**
     * Supprime l'usager de la base de données
     */
    public function remove()
    {
        $query = "DELETE FROM usager  WHERE IdUsager = :id;";
        $parameters = array(
            array( 'name' => ':id', 'value' => $this->id, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
    //Connexion d'un usager : crée les variables de session
   /* public connexion(string $nomUtilisateur, string mdp) {
        
        if ($nomUtilisateur == $this->nomUtilisateur) {
            if(sha1$(mdp) == $this->mdp) {
                session_start();
                $_SESSION['id'] = $this->id;
                $_SESSION['nomUtilisateur'] = $this->nomUtilisateur;
                $resultat = 'Vous êtes connecté.';
            } else {
                $resultat = 'Erreur de connexion : recommencez.';
            }
        } else {
            $resultat = 'Erreur de connexion : recommencez.';
        }
        
        return $resultat;
    }*/

    
    public function annulerVoyage($voyage) {
        //if ($role == )
    }
    
    //
    public function proposerVoyage($voyage) {
        
    }
    
    public function __toString() {
        $res = 'Usager ' . $this->prenom . ' ' .$this->nom . '<br />';
        $res .= 'pseudo : ' .  $this->pseudo . ' ; mdp : ' . $this->mdp . '<br />';
        $res .= 'email : ' . $this->email . ' ; tel : ' . $this->tel;
        return $res;
        
    }
    
    
    private function verifInscription($prenom, $nom, $nomUtilisateur, $mdp1, $mdp2, $email, $tel) {
        if (!empty($prenom) && !empty($nom) && !empty($nomUtilisateur) && !empty($mdp1) && !empty($mdp2) && !empty($email) && !empty($tel)) {
            if ($mdp1 == $mdp2) {
                if (strlen($prenom) > 1) {
                    if (strlen($nom) > 1) {
                        if ($this->verifEmail($email)) {
                            if ($this->verifTel($tel)) {
                                if ($this->verifNomUtilisateur($nomUtilisateur)) {
                                    $resultat = "ok";
                                } else {
                                    $resultat = "Le nom d'utilisateur est déjà utilisé";
                                }
                            } else {
                                $resultat = "Le numéro de téléphone est invalide";
                            }
                        } else {
                            $resultat = "L'adresse de courriel est invalide";
                        }
                    } else {
                        $resultat = "Le nom est trop court";
                    }
                } else {
                    $resultat = "Le prénom est trop court";
                }
            } else {
                $resultat = "Les deux mots de passe ne correspondent pas";
            }
        } else {
            $resultat = "Veuillez remplir tous les champs";
        }
    
        return $resultat;
    }
    private function verifEmail(string $email) {
        //regex pour verif email
        return true;
    }

    private function verifTel(string $email) {
        //regex pour verif le numéro de tel
        return true;
    }

    private function verifNomUtilisateur(string $pseudo) {
        //check si le pseudo est dans la bdd ou non
        return true;
    }

//------------- Accesseurs

    public function setId($value) {
        $this->id = $value;
    }

    public function getId() {
        return self::$id;
    }

    public function setPrenom($value) {
        $this->prenom = $value;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setNom($value) {
        $this->nom = $value;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNomUtilisateur($value) {
        $this->nomUtilisateur = $value;
    }

    public function getNomUtilisateur() {
        return $this->nomUtilisateur;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setMdp($value) {
        $this->mdp = $value;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setTel($value) {
        $this->tel = $value;
    }

    public function getTel() {
        return $this->tel;
    }


}
