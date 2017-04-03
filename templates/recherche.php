
<div>
    <h1>Recherche de voyage</h1></br>
</div>
<form method="post" action="index.php?page=recherche" enctype="multipart/form-data">
    <div>
        <p>
            <label for="depart">Départ : </label><input type="text" name="depart" id="depart" placeholder="Lieu de départ" value="<?php if (isset ($_POST['depart'])) echo $_POST['prenom']; ?>"size ="25" >
            <label for="arrivee">Arrivée : </label><input type="text" name="arrivee" id="arrivee" placeholder="Lieu d'arrivée" size ="25" value="<?php if (isset ($_POST['arrivee'])) echo $_POST['prenom']; ?>" >
            <input type="submit" id="image-button" value=""></input>
        </p>
    </div>
</form>

<?php

require_once(_MODELS_ . 'voyage.class.php');
if(isset($_POST['depart']) && isset($_POST['arrivee'])) {
  $v1 = Voyage::getVoyagesApresDate(date('Y-m-d'), $_POST['depart'], $_POST['arrivee']);
    foreach($v1 as $lTrajets) {
        foreach($lTrajets as $trajet1) {
            echo $trajet1 ;
            echo '<br />';
        }
    }
}