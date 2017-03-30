<?php

/**
 * connexion short summary.
 *
 * connexion description.
 *
 * @version 1.0
 * @author guill
 */
session_start();
$titre="Connexion";
include("includes/identifiants.php");
include("includes/accueil.php");
include("include/menu.php");

$page = htmlspecialchars($_POST['page']);
echo 'Cliquez <a href="'.$page.'">ici</a> pour revenir à la page précédente';

?>