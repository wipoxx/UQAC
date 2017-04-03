
<div>
    <h2>Ajout d'un voyage</h2></br>
</div>
<form method="post" action="index.php?page=ajoutVoyage" enctype="multipart/form-data">
    <div>
        <fieldset><legend>Localisation</legend>
            <p>
                Départ : <input type="text" name="depart" id="depart" placeholder="Lieu départ" size ="25" >
                Heure de départ : <input type="time" name="heure" id="hDep">
            </p>
            
            <p>
                Etape (facultatif) : <input type="text" name="etape1" id="etape1" placeholder="Ville" size ="25" >
                Heure de passage: <input type="time" name="heure" id="hArr">
            </p>
            <p>
                Etape (facultatif) : <input type="text" name="arrivee" id="arrivee" placeholder="Ville" size ="25" >
                Heure de passage: <input type="time" name="heure" id="hArr">
            </p>
            <p>
                Etape (facultatif) : <input type="text" name="arrivee" id="arrivee" placeholder="Ville" size ="25" >
                Heure de passage: <input type="time" name="heure" id="hArr">
            </p>
            <p>
                Arrivée : <input type="text" name="arrivee" id="arrivee" placeholder="Lieu d\'arrivée" size ="25" >
                Heure d'arrivée: <input type="time" name="heure" id="hArr">
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
        <button type="submit">Ajouter le voyage</button>
    </div>
</form>
