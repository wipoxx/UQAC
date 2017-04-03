<?php
require_once(_MODELS_ . 'usager.class.php');
require_once(_MODELS_ . 'voyage.class.php');
require_once(_MODELS_ . 'trajetElementaire.class.php');


if(isset($_SESSION['idUsager'])) {
    if(isset($_POST['depart']) && isset($_POST['hDep']) && isset($_POST['arrivee']) && isset($_POST['hArr']) && isset($_POST['date'])) {
    $usager = Usager::get($_SESSION['idUsager']);
    $preference = Preference::get(1, 1, 2);
    $lEtapes = array(
        array('ville' => $_POST['depart'], 'heure' => $_POST['hDep'])
    );
        
    if (isset($_POST['etape1'])) {
       $lEtapes[] =  array('ville' => $_POST['etape1'], 'heure' => $_POST['hEt1']);
    }
    if (isset($_POST['etape2'])) {
       $lEtapes[] =  array('ville' => $_POST['etape2'], 'heure' => $_POST['hEt2']);
    }
    if (isset($_POST['etape3'])) {
       $lEtapes[] =  array('ville' => $_POST['etape3'], 'heure' => $_POST['hEt3']);
    }

    $lEtapes[] =  array('ville' => $_POST['arrivee'], 'heure' => $_POST['hArr']);

    $taille = count($lEtapes) - 1;

    $voyage = new Voyage(array(
                    'idUsager' => $_SESSION['idUsager'],
                    'nbPlaces' => 3,
                    'idPreference' => $preference->getIdPreference(),
                    'dateDepart' => $_POST['date']
                ));
    $voyage->save();

    $lTrajets = array();
    for ($i = 0 ; $i < $taille ; ++$i) { 
    //taille - 1 car on doit s'arrêter à l'avant dernière étape pour créer un trajet elt avant-dernière étape/dernière étape
        $etape1 = $lEtapes[$i];
        $etape2 = $lEtapes[$i+1];

        $trajet =  new TrajetElementaire(array(
                                    'idVoyage' => $voyage->getIdVoyage(),
                                    'nbPlaces' => 3,
                                    'villeDepart' => $etape1['ville'], 
                                    'heureDepart' => $etape1['heure'],
                                    'villeArrivee' => $etape2['ville'],
                                    'heureArrivee' => $etape2['heure']
                            ));
        $trajet->save();
        $lTrajets[] = $trajet;
    }
        echo 'Voyage bien ajouté !';
}

?>

<div>
    <h2>Ajout d'un voyage</h2></br>
</div>
<form method="post" action="index.php?page=ajoutVoyage" enctype="multipart/form-data">
    <div>
        <fieldset><legend>Localisation</legend>
            <p>
                Départ * : <input type="text" name="depart" id="depart" placeholder="Lieu départ" size ="25" >
                Heure de départ  * : <input type="time" name="hDep" id="hDep">
            </p>
            
            <p>
                Etape (facultatif) : <input type="text" name="etape1" id="etape1" placeholder="Ville" size ="25" >
                Heure de passage: <input type="time" name="hEt1" id="hEt1">
            </p>
            <p>
                Etape (facultatif) : <input type="text" name="etape2" id="etape2" placeholder="Ville" size ="25" >
                Heure de passage: <input type="time" name="hEt2" id="hEt2">
            </p>
            <p>
                Etape (facultatif) : <input type="text" name="etape3" id="etape3" placeholder="Ville" size ="25" >
                Heure de passage: <input type="time" name="hEt3" id="hEt3">
            </p>
            <p>
                Arrivée  * : <input type="text" name="arrivee" id="arrivee" placeholder="Lieu d\'arrivée" size ="25" >
                Heure d'arrivée * : <input type="time" name="hArr" id="hArr">
            </p>
        </fieldset>
        <fieldset><legend>Informations complémentaires</legend>
            <p>
                Date  * : <input type="date" name="date" id="date">
            </p>
            <p>
                    Fréquence :
                <select name="frequence" id="frequence" />
                <option value="jours">Tous les jours</option>
                <option value="semaines">Toutes les semaines</option>
                <option value="mois">Tous les mois</option>
                <option value="unique">Juste une fois</option>
                </select>
            <p>
        </fieldset>
        <button type="submit">Ajouter le voyage</button>
    </div>
</form>
<?php
} else {
    echo 'Veuillez vous connecter avant d\'ajouter un voyage';
}
?>
