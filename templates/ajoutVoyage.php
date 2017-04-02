<?php

echo '<!DOCTYPE html>
	<html>
	    <head>
	        <meta charset=UTF-8" />
            <link rel="stylesheet" href="style.css">
	    </head>
        <body>
            <div>
	            <h1>Ajout d\'un voyage</h1></br>
            </div>
            <form method="post" action="ajoutVoyage.php" enctype="multipart/form-data">
                <div>
                    <fieldset><legend>Localisation</legend>
                        <p>
                            Départ : <input type="text" name="depart" id="depart" placeholder="Lieu départ" size ="25" >
                            Heure de départ : <input type="time" name="heure" id="hDep">
                        </p>
                            <div id="villePassage">
                                <p>
                                    Ajouter une ville de passage?
                                    <input type="button" id="image-add" onclick="fAddText()"></input>
                                </p>
                            </div>
                        <p>
                            Arrivée : <input type="text" name="arrivee" id="arrivee" placeholder="Lieu d\'arrivée" size ="25" >
                            Heure d\'arrivée: <input type="time" name="heure" id="hArr">
                        </p>
                    </fieldset>
                    <fieldset><legend>Informations complémentaires</legend>
                        <p>
                            Date : <input type="date" name="date" id="date">
                        </p>
                        <p>
                                Fréquence :
                            <select name="frequence" id="frequence" />
                            <option value="1">Tous les jours</option>
                            <option value="2">Toutes les semaines</option>
                            <option value="3">Tous les mois</option>
                            </select>
                        <p>
                    </fieldset>
                    <class="submit"> <button type="submit">Ajouter le voyage</button>
                </div>
            </form>
        </body>
    </html>'

?>

<script type="text/javaScript">
    function fAddText() {
        document.getElementById('villePassage').innerHTML = '<input type="text" placeholder="Ville de passage" id="villePassage" />';
    }
</script>
