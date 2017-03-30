<?php

/**
 * functions short summary.
 *
 * functions description.
 *
 * @version 1.0
 * @author guill
 */
function erreur($err=''){
	$message=($err!='')? $err:'Une erreur inconnue s\'est produite';
	exit('<p>'.$mess.'<\p>
	<p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
}
?>