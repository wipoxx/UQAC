
<div>
    <h1>Recherche de voyage</h1></br>
</div>
<form method="post" action="index.php?page=recherche" enctype="multipart/form-data">
    <div>
        <p>
            <label for="depart">Depart : </label><input type="text" name="depart" id="depart" placeholder="Lieu départ" size ="25" >
            <label for="arrivee">Arrivée : </label><input type="text" name="arrivee" id="arrivee" placeholder="Lieu d\'arrivée" size ="25" >
            <input type="submit" id="image-button" value=""></input>
        </p>
    </div>
</form>

<?php

if(isset($_POST['depart']) && isset($_POST['arrivee']))