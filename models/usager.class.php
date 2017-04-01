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
        
        //verifInscription
        if (isset ($data['mdpUsager1'])) {
            $data['mdpUsager'] = $data['mdpUsager1'];
        }
        parent::__construct($data);
        $this->nbAnnulations = 0;
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
        $db->execute($query, $parameters);
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
            array( 'name' => ':numTelUsager', 'value' => $this->getTelUsager(), 'type' => 'int'),
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
            array( 'name' => ':id', 'value' => $this->idUsager, 'type' => 'int')
        );

        $db = BDDLocale::getInstance();
        $db->execute($query, $parameters);
    }
    
    //Connexion d'un usager : crée les variables de session
   public static function connexion(string $pseudo, string $mdp) {
        
        $query = "SELECT * FROM usager WHERE PseudoUsager = :pseudoUsager AND MdpUsager = :mdpUsager;";
        $parameters = array( array('name' => ':pseudoUsager', 'value' => $pseudo, 'type' => 'string'),
                             array('name' => ':mdpUsager', 'value' => $mdp, 'type' => 'string'));
        $results = null;
        $db = BDDLocale::getInstance();

        if($db->get($query, $results, $parameters))
        {
            return new Usager($results[0]);
        }

        return null;
        
        /*if ($pseudoUsager == $this->nomUtilisateur) {
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
        
        return $resultat;*/
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
    /*private function verifInscription($pseudoUsager, $nomUsager, $pseudoUsager, $mdpUsager1, $mdpUsager2, $emailUsager, $tel) {
        if (!empty($pseudoUsager) && !empty($nomUsager) && !empty($pseudoUsager) && !empty($mdpUsager1) && !empty($mdpUsager2) && !empty($emailUsager) && !empty($tel)) {
            if ($mdpUsager1 == $mdpUsager2) {
                if (strlen($pseudoUsager) > 1) {
                    if (strlen($nomUsager) > 1) {
                        if ($this->verifemailUsager($emailUsager)) {
                            if ($this->verifTel($tel)) {
                                if ($this->verifNomUtilisateur($pseudoUsager)) {
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
    }*/
    /*private function verifemailUsager(string $emailUsager) {
        //regex pour verif email
        return true;
    }*/
    /*private function verifTel(string $tel) {
        //regex pour verif le numéro de tel
        return true;
    }*/
    /*private function verifNomUtilisateur(string $pseudo) {
        //check si le pseudo est dans la bdd ou non
        return true;
    }*/

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

}