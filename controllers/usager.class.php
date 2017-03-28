<?php

class Usager
{
    private $id;
    private $prenom;
    private $nom;
    private $nom_utilisateur;
    private $mdp;
    private $email;
    private $tel;
    private $nbAnnulations;
    private $role;
    
    //construit un nouveau membre -> l'inscrit
    public function __construct($prenom, $nom, $nom_utilisateur, $mdp1, $mdp2, $email, $tel) {
        $resultat = $this->verifInscription($prenom, $nom, $nom_utilisateur, $mdp1, $mdp2, $email, $tel);
        if ($resultat == "ok") {
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->nom_utilisateur = $nom_utilisateur;
            $this->mdp = sha1($mdp1);
            $this->email = $email;
            $this->tel = $tel;
            $this->nbAnnulations = 0;
            $this->role = null;
            //Ajouter usager à la bdd
        } else {
            return $resultat;
        }
        
        
    }
    
    //Connection d'un usager : crée les variables de session
   /* public connexion(string $nom_utilisateur, string mdp) {
        
        if ($nom_utilisateur == $this->nom_utilisateur) {
            if(sha1$(mdp) == $this->mdp) {
                session_start();
                $_SESSION['id'] = $this->id;
                $_SESSION['nom_utilisateur'] = $this->nom_utilisateur;
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
    
    
    private function verifInscription($prenom, $nom, $nom_utilisateur, $mdp1, $mdp2, $email, $tel) {
        if (!empty($prenom) && !empty($nom) && !empty($nom_utilisateur) && !empty($mdp1) && !empty($mdp2) && !empty($email) && !empty($tel)) {
            if ($mdp1 == $mdp2) {
                if (strlen($prenom) > 1) {
                    if (strlen($nom) > 1) {
                        if ($this->verifEmail($email)) {
                            if ($this->verifTel($tel)) {
                                if ($this->verifNomUtilisateur($nom_utilisateur)) {
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
}
