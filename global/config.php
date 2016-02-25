<?php 

// Identifiants pour la base de donn�es. N�cessaires a PDO2.
define('SQL_DSN', 'mysql:dbname=formatif_pour_lab4;host=localhost');
define('SQL_USERNAME', 'root');
define('SQL_PASSWORD', '');

// Chemins � utiliser pour acc�der aux vues/modeles/librairies
$module = empty($module) ? !empty($_GET['module']) ? $_GET['module']
: 'index' : $module;
define('CHEMIN_VUE', 'modules/'.$module.'/vues/');
define('CHEMIN_MODELE', 'modeles/');
define('CHEMIN_LIB', 'libs/');
define('CHEMIN_VUE_GLOBALE', 'vues_globales/');
define('CHEMIN_INSCRIPTION', 'inscription/');
?>