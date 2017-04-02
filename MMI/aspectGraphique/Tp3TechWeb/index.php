<?php

include('config_init.php');
require_once(_MODELS_ . 'voyage.class.php');
require_once(_MODELS_ . 'trajet.class.php');
require_once(_MODELS_ . 'preference.class.php');
require_once(_MODELS_ . 'usager.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');

if ($id!=0) erreur(ERR_IS_CO);

if (!isset($_POST['pseudo']))
{
	echo '
    <!DOCTYPE html>
	<html>
	    <head>
	        <meta charset=UTF-8" />
            <link rel="stylesheet" href="style.css">
	    </head>
        <body>
            <div>
                    <form method="post" action="profil.php">
                    <h1> Connexion </h1>
	                <fieldset>
	                    <p>
	                    <label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	                    <label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	                    </p>
	                </fieldset>
                    <p><class="submit"> <button type="submit">Connexion </button></p>
                </form>
	            <p>
                    <a href="./register.php">Pas encore inscrit ?</a></br>
                    <a href="./profil.php">Consulter un profil utilisateur ?</a></br>
                    <a href="./recherche.php">Rechercher un voyage</a></br>
                    <a href="./ajoutVoyage.php">Ajouter un voyage</a>
                </p>
            </div>
        </body>
    </html>';
}

else
{
    $message='';
    if (empty($_POST['nom_utilisateur']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./index.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $p3 = Usager::connexion('nom_utilisateur', md5($_POST['password']));
    }
}
?>