<?php

echo '<!DOCTYPE html>
	<html>
	    <head>
	        <meta charset=UTF-8" />
            <link rel="stylesheet" href="style.css">
	    </head>
        <body>
            <div>
	            <h1>Recherche de voyage</h1></br>
            </div>
            <form method="post" action="recherche.php" enctype="multipart/form-data">
                <div>
                    <p>
                        Depart : <input type="text" name="depart" id="depart" placeholder="Lieu départ" size ="25" >
                        Arrivée : <input type="text" name="arrivee" id="arrivee" placeholder="Lieu d\'arrivée" size ="25" >
                        <input type="submit" id="image-button" value=""></input>
                    </p>
                </div>
            </form>
        </body>
    </html>';

?>