<?php
    session_start();
    $titre="Profil";

    //On r�cup�re la valeur de nos variables pass�es par URL
   /* $action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'consulter';
    $membre = isset($_GET['m'])?(int) $_GET['m']:'';*/

    echo '<!DOCTYPE html>
	<html>
	    <head>
	        <meta charset=UTF-8" />
            <link rel="stylesheet" href="style.css">
	    </head>
        <body>
            <h1>Profil TravelExpress</h1>
            <profil>
                <img src="utilisateur.png" height="170" width="170"/>
                <description>
                        <h2>Prénom, Sexe</h2>
                        <h2>Préférences (sexuelles)</h2>
                        <h3>Mail</h3>
                        <h3>Téléphone</h3>
                    <droite>
                        <h3>Réservations en cours</h3>  
                    </droite>
                </description>
            </profil>
        </body>
    </html>';

?>