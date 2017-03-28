<p>
    <form action=<?php echo _MODELS_ . "inscription_post.php"; ?> method="post" id="form_inscription">
        <span>
            <input type="text" name="prenom" placeholder="Prénom" class="champ_divise"/>
            <input type="text" name="nom" placeholder="Nom" class="champ_divise"/><br />
        </span>
        <input type="text" name="nom_utilisateur" placeholder="Nom d'utilisateur"/><br />
        <span>
            <input type="password" name="mdp1" placeholder="Mot de passe" class="champ_divise"/>
            <input type="password" name="mdp2" placeholder="Vérification du mot de passe" class="champ_divise"/><br />
        </span>
        <input type="mail" name="mail" placeholder="Adresse mail"/><br />
        <input type="tel" name="tel" placeholder="Téléphone cellulaire"/><br />
        <input type="submit" name="valider" value="S'inscrire"/><br />
        
    </form>
</p>