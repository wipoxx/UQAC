<?php

//fichier pour tester si les classes voyagen trajet et étape fonctionnent
include('config_init.php');
require_once(_CTRL_ . 'voyage.class.php');
require_once(_CTRL_ . 'trajet.class.php');
require_once(_CTRL_ . 'etape.class.php');

$e1 = new Etape('Chaumont', '8:30');
$e2 = new Etape('Dijon', '9:45');
$e3 = new Etape('Besançon', '11:00');
$e4 = new Etape('Lons le Saunier', '13:00');

$t1 = new Trajet($e1, $e2);
$t2 = new Trajet($e2, $e3);
$t3 = new Trajet($e3, $e4);

$voyage = new Voyage();
$voyage->ajoutTrajet($t1);
$voyage->ajoutTrajet($t2);
$voyage->ajoutTrajet($t3);

echo $voyage;

$voyage->rechercheItineraire('Chaumont', 'Besançon');