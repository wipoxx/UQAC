<?php

//A decommenter pour la mise en ligne
/*if (!isset($_SERVER['DOCUMENT_ROOT'])) {
    die();
    echo "ok";
}*/

//Racine
//define('_PATH_', $_SERVER['DOCUMENT_ROOT']);

//Controllers
define('_CTRL_', 'controllers/');

//views
//define('_VIEWS_', _PATH_ . 'views/');
define('_VIEWS_', 'views/');

//Models
define('_MODELS_', 'models/');

//Templates
define('_TPL_', 'templates/');

//Bases de données
define('_BDD_', 'bdd/');
?>