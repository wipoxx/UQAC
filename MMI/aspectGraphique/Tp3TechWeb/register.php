<?php

if (empty($_POST['pseudo']))
{
	echo '<!DOCTYPE html>
	<html>
	    <head>
	        <meta charset=UTF-8" />
            <link rel="stylesheet" href="style.css">
	    </head>
        <body>
            <div>
	            <h1>Inscription TravelExpress </h1>
	            <form method="post" action="register.php" enctype="multipart/form-data">
	                <fieldset> <legend>Identifiants</legend>
                        <p>
                            <INPUT type="radio" name="genre" value="Homme"> Homme
                            <INPUT type="radio" name="genre" value="Femme"> Femme
                        </p>
                        <p>
	                        <input name="prenom" type="text" id="prenom" placeholder="Prénom" size ="30"/><br />
	                        <input name="nom" type="text" id="nom" placeholder="Nom" size ="30"/><br />
	                        <input name="nom_utilisateur" type="text" id="nom_utilisateur" placeholder="Pseudo" size="30"/><br/>
                        </p>
                        <p>
	                        <input type="password" name="mdp1" id="mdp1" placeholder="Mot de passe" size ="30" ><br />
	                        <input type="password" name="mdp2" id="mdp2" placeholder="Confirmer le mot de passe" size="30"/>
                        </p>
	                </fieldset>

	                <fieldset><legend>Contacts</legend>
                            <p>
	                            <input type="text" name="mail" id="mail" placeholder="Adresse mail" size="30" /><br />
	                            <input type="text" name="tel" id="tel" placeholder="Téléphone" size="30" /><br />
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
	                <p><class="submit"> <button type="submit">S\'inscrire </button></p>
                </form>
	        </div>
	    </body>
	</html>';
}
else //On est dans le cas traitement
{
    $pseudo_erreur1 = NULL;
    $pseudo_erreur2 = NULL;
    $mdp_erreur = NULL;
    $email_erreur1 = NULL;
    $email_erreur2 = NULL;
	$tel_erreur = NULL;
}
/*//On r�cup�re les variables
$i = 0;
$temps = time();
$nom_utilisateur=$_POST['nom_utilisateur'];
$mail = $_POST['mail'];
$mdp = md5($_POST['mdp1']);
$mdp2 = md5($_POST['mdp2']);

//Vérification du pseudo
$query=$db->prepare('SELECT COUNT(*) AS nbr FROM membre WHERE membre_nom_utilisateur =:nom_utilisateur');
$query->bindValue(':nom_utilisateur',$nom_utilisateur, PDO::PARAM_STR);
$query->execute();
$nom_utilisateur_free=($query->fetchColumn()==0)?1:0;
$query->CloseCursor();
if(!$pnom_utilisateur_free)
{
	$pseudo_erreur1 = "Votre pseudo est d�j� utilis� par un membre";
	$i++;
}

if (strlen($pseudo) < 5 || strlen($pseudo) > 15)
{
	$pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
	$i++;
}

//V�rification du mdp
if ($mdp != $mdp2 || empty($mdp2) || empty($mdp))
{
	$mdp_erreur = "Votre mot de passe et votre confirmation diff�rent, ou sont vides";
	$i++;
}
 //V�rification de l'adresse mail
$query=$db->prepare('SELECT COUNT(*) AS nbr FROM membre_nom_utilisateur WHERE membre_mail =:mail');
$query->bindValue(':mail',$email, PDO::PARAM_STR);
$query->execute();
$mail_free=($query->fetchColumn()==0)?1:0;
$query->CloseCursor();

if(!$mail_free)
{
	$email_erreur1 = "Votre adresse email est d�j� utilis�e par un membre";
	$i++;
}
//On v�rifie la forme maintenant
if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || empty($mail))
{
	$mail_erreur2 = "Votre adresse E-Mail n'a pas un format valide";
	$i++;
}

//Vérification numéro téléphone français
if(!!preg_match('#^0[0-9]([ .-]?[0-9]{2}){4}$#', $tel) || empty($tel))
{
	$tel_erreur = "Votre num�ro de t�l�phone n'a pas un format valide (Fran�ais)";
}

if ($i==0)
{
echo'<h1>Inscription termin�e</h1>';
echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['nom_utilisateur'])).' vous �tes maintenant inscrit</p>
<p>Cliquez <a href="./index.php">ici</a> pour revenir � la page d accueil</p>';


$query=$db->prepare('INSERT INTO membres (prenom, nom, nom_utilisateur, mpd, mail, tel)
VALUES (:prenom, :nom, :nom_utilisateur; :mdp, :mail, :tel)');
$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
$query->bindValue(':nom', $nom, PDO::PARAM_INT);
$query->bindValue(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
$query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
$query->bindValue(':mail', $mail, PDO::PARAM_STR);
$query->bindValue(':tel', $tel, PDO::PARAM_STR);

    $query->execute();

//Et on d�finit les variables de sessions
    $_SESSION['nom_utilisateur'] = $nom_utilisateur;
    $_SESSION['id'] = $db->lastInsertId(); ;
    $query->CloseCursor();
}
else
{
    echo'<h1>Inscription interrompue</h1>';
    echo'<p>Une ou plusieurs erreurs se sont produites pendant l incription</p>';
    echo'<p>'.$i.' erreur(s)</p>';
    echo'<p>'.$pseudo_erreur1.'</p>';
    echo'<p>'.$pseudo_erreur2.'</p>';
    echo'<p>'.$mdp_erreur.'</p>';
    echo'<p>'.$email_erreur1.'</p>';
    echo'<p>'.$email_erreur2.'</p>';
    echo'<p>'.$tel_erreur.'</p>';

    echo'<p>Cliquez <a href="./register.php">ici</a> pour recommencer</p>';
}*/
?>
