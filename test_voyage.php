<?php

//fichier pour tester si les classes voyagen trajet et étape fonctionnent
include('config_init.php');
require_once(_MODELS_ . 'voyage.class.php');
require_once(_MODELS_ . 'trajet.class.php');
require_once(_MODELS_ . 'preference.class.php');
require_once(_MODELS_ . 'usager.class.php');
require_once(_BDD_ . 'BDDLocale.class.php');


/*$c1 = new Usager('Jean-Paul', 'Sartre', 'jpLaMalice', 'mdpTropSecure', 'mdpTropSecure', 'mail@mail.com', '999-999-999');
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
*/

//$bdd = BDDLocale::getInstance();
//$res = '';
//$bdd->get('SELECT * FROM usager WHERE IdUsager=1', $res);
//echo $re

//$voyage->rechercheItineraire('Chaumont', 'Besançon');


/*-------- Inscription
$data = array(
                'prenomUsager' => 'Ludwig', 
                'nomUsager' => 'van Beethoven', 
                'pseudoUsager' => 'iCantHearYou', 
                'mdpUsager1' => 'soGood', 
                'mdpUsager2' => 'soGood', 
                'emailUsager' => 'pompompompom@music.au', 
                'numTelUsager' => '1770'
                );

if ($data['mdpUsager1'] == $data['mdpUsager2']) {
    $p3 = new Usager($data);
}*/

// --------- Connexion
//√ $p3 = Usager::connexion('iCantHearYou', 'soGood');
//var_dump($p3);
//$p3->save();

// ----------- Préférence
/*$pref1 = array(
                'animaux' => 1,
                'fumeur' => 1,
                'nbMaxBagages_Personne' => 2
);*/

//$preference = new Preference($pref1);
//$preference = Preference::get(1, 1, 2);
//$preference->save();

$v1 = array(
                'idUsager' => 21,
                'nbPlaces' => 3,
                'idPreference' => 1,
                'dateDepart' => '2017-04-02'
            );  

//$voyage = new Voyage($v1);
//$voyage = Voyage::getVoyagesDeUsager(21);
//$voyage->save();

//$data = Voyage::getVoyagesConducteur(1);
//$data = Voyage::getVoyagesDate('2017-04-02');


//-----------NBPLACES DOIT ÊTRE INITIALISÉ AU NB PLACES DU VOYAGE 
/*$t = array(
    'idVoyage' => 1,
    'nbPlaces' => 3,
    'villeDepart' => 'Tamere', 
    'heureDepart' => '6:00:00',
    'villeArrivee' => 'Homer',
    'heureArrivee' => '3:00:00'
);*/

//$trajet1 = new Trajet($t);
//$trajet1 
//var_dump($trajet1);
//$trajet1->save();
    
$usager = Usager::connexion('iCantHearYou', 'soGood');
$preference = Preference::get(1, 1, 2);


$ville1 = 'Chaumont';
$heure1 = '7:30:00';

$ville2 = 'Dijon';
$heure2 = '8:30:00';

$ville3 = 'Besançon';
$heure3 = '9:30:00';

$ville4 = 'Lons-Le-Saunier';
$heure4 = '11:30:00';

$ville5 = 'Trépugnat';
$heure5 = '12:00:00';

$lEtapes = array(
    array('ville' => $ville1, 'heure' => $heure1),
    array('ville' => $ville2, 'heure' => $heure2),
    array('ville' => $ville3, 'heure' => $heure3),
    array('ville' => $ville4, 'heure' => $heure4),
    array('ville' => $ville5, 'heure' => $heure5)
);

$taille = count($lEtapes) - 1;

$voyage = new Voyage(array(
                'idUsager' => $usager->getIdUsager(),
                'nbPlaces' => 3,
                'idPreference' => $preference->getIdPreference(),
                'dateDepart' => '2017-04-10'
            ));
$voyage->save();

$lTrajets = array();

for ($i = 0 ; $i < $taille ; ++$i) { 
//taille - 1 car on doit s'arrêter à l'avant dernière étape pour créer un trajet elt avant-dernière étape/dernière étape
    $etape1 = $lEtapes[$i];
    $etape2 = $lEtapes[$i+1];
    
    $trajet =  new Trajet(array(
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