<?php
    session_start();
    $titre="Profil";

    //On récupère la valeur de nos variables passées par URL
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
                <presentation>
                    <img src="utilisateur.png" height="170" width="170" border="3"/>
                        <h2>Prénom, Sexe</br>
                        Préférences (sexuelles)</h2>
                        <h3>Mail</h3>
                        <h3>Téléphone</h3>
                </presentation>
                <description></br>
                        <h3>Réservations en cours</h3>
                        <h3>Voyages à venir</h3>
                </description>
            </profil>
        </body>
    </html>';

?>