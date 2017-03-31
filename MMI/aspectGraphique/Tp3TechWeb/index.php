<?php

if ($id!=0) erreur(ERR_IS_CO);

if (!isset($_POST['pseudo']))
{
	echo '
    <!DOCTYPE html>
	<html>
	    <head>
	        <meta charset=UTF-8" />
            <link rel="stylesheet" href="style.css">
	    </head>
        <body>
            <div>
                    <form method="post" action="connexion.php">
                    <h1> Connexion </h1>
	                <fieldset>
	                    <p>
	                    <label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	                    <label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	                    </p>
	                </fieldset>
                    <p><class="submit"> <button type="submit">Connexion </button></p>
                </form>
	            <a href="./register.php">Pas encore inscrit ?</a>

            </div>
        </body>
    </html>';
}

else
{
    $message='';
    if (empty($_POST['nom_utilisateur']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$db->prepare('SELECT id, nom_utilisateur
        FROM table_usager WHERE nom_utilisateur = :nom_utilisateur');
        $query->bindValue(':nom_utilisateur',$_POST['nom_utilisateur'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
	if ($data['mdp'] == md5($_POST['password'])) // Acces OK !
	{
	    $_SESSION['nom_utilisateur'] = $data['nom_utilisateur'];
	    $_SESSION['id'] = $data['id'];
	    $message = '<p>Bienvenue '.$data['nom_utilisateur'].',
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="./index.php">ici</a>
			pour revenir à la page d accueil</p>';
	}
	else // Acces pas OK !
	{
	    $message = '<p>Une erreur s\'est produite
	    pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a>
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="./index.php">ici</a>
	    pour revenir à la page d accueil</p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
?>