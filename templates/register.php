<?php
require_once(_MODELS_ . 'usager.class.php');
if (isset($_POST['nom_utilisateur'])) //On est dans le cas traitement
{
    $data = array(
                    'prenomUsager' => $_POST['prenom'],
                    'nomUsager' => $_POST['nom'],
                    'pseudoUsager' => $_POST['nom_utilisateur'],
                    'mdpUsager1' => md5($_POST['mdp1']),
                    'mdpUsager2' => md5($_POST['mdp2']),
                    'emailUsager' => $_POST['mail'],
                    'numTelUsager' => $_POST['tel'],
                    'nouvUsager' => true
                    );
    $u = Usager::inscription($data);

}
?>
<div>
    <h1>Inscription TravelExpress </h1>
    <form method="post" action="index.php?page=inscription" enctype="multipart/form-data">
        <fieldset> <legend>Identifiants</legend>
            <p>
                <input name="prenom" type="text" id="prenom" placeholder="Prénom" 
                       value="<?php if (isset ($_POST['prenom'])) echo $_POST['prenom']; ?>" size ="30"/><br />
                
                <input name="nom" type="text" id="nom" value="<?php if (isset ($_POST['nom'])) echo $_POST['nom']; ?>" placeholder="Nom" size ="30"/><br />
                
                <input name="nom_utilisateur" type="text" id="nom_utilisateur" value="<?php if (isset ($_POST['nom_utilisateur'])) echo $_POST['nom_utilisateur']; ?>" placeholder="Pseudo" size="30"/><br/>
            </p>
            <p>
                <input type="password" name="mdp1" id="mdp1" value="<?php if (isset ($_POST['mdp1'])) echo $_POST['mdp1']; ?>" placeholder="Mot de passe" size ="30" ><br />
                <input type="password" name="mdp2" id="mdp2" value="<?php if (isset ($_POST['mdp2'])) echo $_POST['mdp2']; ?>" placeholder="Confirmer le mot de passe" size="30"/>
            </p>
        </fieldset>

        <fieldset><legend>Contacts</legend>
                <p>
                    <input type="text" name="mail" id="mail" value="<?php if (isset ($_POST['mail'])) echo $_POST['mail']; ?>" placeholder="Adresse mail" size="30" /><br />
                    <input type="text" name="tel" id="tel" value="<?php if (isset ($_POST['tel'])) echo $_POST['tel']; ?>" placeholder="Téléphone" size="30" /><br />
                </p>
        </fieldset>

        <fieldset><legend>Préférences</legend>
            <liste>
                <p>
                    <input type="checkbox" name="animaux"> J\'accepte les animaux<br>
                    <input type="checkbox" name="fumeur"> J\'accepte les fumeurs<br>
                    <input type="number" name="nbPassagers" min="0" step="1" size="5"> personne(s) maximum<br>
                </p>
            </liste>
        </fieldset>
        <p class="submit"> <button type="submit">S'inscrire </button></p>
    </form>
</div>