<?php
require_once('usager.class.php');

//if (isset ($_POST['prenom']) && isset ($_POST['nom']) && isset ($_POST['nom_utilisateur']) && isset ($_POST['mdp1']) && isset ($_POST['mdp2']) && isset ($_POST['mail']) && isset ($_POST['tel'])) {
    new Usager($_POST['prenom'], $_POST['nom'], $_POST['nom_utilisateur'], $_POST['mdp1'], $_POST['mdp2'], $_POST['mail'],  $_POST['tel']);
//} else {
//    echo "Il manque des champs";
//}