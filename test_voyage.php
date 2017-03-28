<?php

//fichier pour tester si les classes voyagen trajet et étape fonctionnent
include('config_init.php');
require_once(_CTRL_ . 'voyage.class.php');
require_once(_CTRL_ . 'trajet.class.php');
require_once(_CTRL_ . 'etape.class.php');
require_once(_CTRL_ . 'usager.class.php');

$c1 = new Usager('Jean-Paul', 'Sartre', 'jpLaMalice', 'mdpTropSecure', 'mdpTropSecure', 'mail@mail.com', '999-999-999');
$p1 = new Usager('Pape', 'Chaussette', 'godIsEverything', 'laFoi', 'laFoi', 'papipou@bible.vati', '23');
$p2 = new Usager('Lucifer', 'Morningstar', '3evil5you', 'enfer', 'enfer', 'diable@enfer.me', '666');
$p3 = new Usager('Ludwig', 'van Beethoven', 'iCantHearYou', 'soGood', 'soGood', 'pompompompom@music.au', '1770');
$p4 = new Usager('Stéphane Berne', 'de Ricardo', 'licornou', 'magie', 'magie', 'unicor@4ever.bitches', '14');

$e1 = new Etape('Chaumont', '8:30');
$e2 = new Etape('Dijon', '9:45');
$e3 = new Etape('Besançon', '11:00');
$e4 = new Etape('Lons le Saunier', '13:00');

$t1 = new Trajet($e1, $e2);
$t2 = new Trajet($e2, $e3);
$t3 = new Trajet($e3, $e4);

$voyage = new Voyage($c1, 3, '04/03/2017');
$voyage->ajoutTrajet($e1, $e2);
$voyage->ajoutTrajet($e2, $e3);
$voyage->ajoutTrajet($t3);


echo $voyage;

$voyage->ajoutPassager($p1, array($t2, $t3));
$voyage->ajoutPassager($p2, array($t1,$t2, $t3));
$voyage->ajoutPassager($p3, array($t2, $t3));
$voyage->ajoutPassager($p1, array($t2, $t3));


//$voyage->rechercheItineraire('Chaumont', 'Besançon');