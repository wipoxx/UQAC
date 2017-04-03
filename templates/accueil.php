<?php

//if ($id!=0) erreur(ERR_IS_CO);

require_once(_MODELS_ . 'usager.class.php');

if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    $u = Usager::connexion($_POST['pseudo'],$_POST['password']);
    if($u != null) {
        echo '<p>Bienvenue '.$u->getPseudoUsager().', vous êtes maintenant connecté !</p><br />';
    } else {
    echo '<p>Une erreur s\'est produite pendant votre identification.<br />
                Le mot de passe et/ou le pseudo entrés ne sont pas corrects.</p>';
   }  
} ?>

    <div>
        <form method="post" action="index.php">
            <h1> Connexion </h1>
            <fieldset>
                <p>
                    <label for="pseudo">Pseudo :</label><input name="pseudo" type="text" value="<?php if (isset ($_POST['pseudo'])) echo $_POST['pseudo']; ?>"id="pseudo" /><br />
                    <label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
                </p>
            </fieldset>
            <p class="submit"> <button type="submit">Connexion </button></p>
        </form>
        <p>
            <a href="index.php?page=inscription">Pas encore inscrit ?</a></br>
            <a href="index.php?page=profil">Consulter un profil utilisateur ?</a></br>
            <a href="index.php?page=recherche">Rechercher un voyage</a></br>
            <a href="index.php?page=ajoutVoyage">Ajouter un voyage</a>
        </p>
    </div>