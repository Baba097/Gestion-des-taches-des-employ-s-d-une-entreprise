<?php
$dossierpublic = "http://localhost/php%20project/Gestionnaire%20de%20tache%20template/public";
include_once "includes/header.php";
include_once "includes/navbar.php";
include_once "includes/sidebar.php";
require_once "traitements/requetes.php";
require_once "traitements/actions.php";


$taches = getTaches();

$nbrTaches = count($taches);
$pourcentageTT = number_format(($nbrTachesTerminé*100) / $nbrTaches,2);
$pourcentageTNT = number_format(($nbrTachesNonTerminé*100) / $nbrTaches,2);

$tache_a_modifier = isset($_GET['modifier']) ? getTacheModif($_GET['modifier']) : null;


$page = isset($_GET['page']) ? $_GET['page'] : "acceuil";
if (file_exists("pages/$page.php")){
    include_once "pages/$page.php";
}
else{
    include_once 'pages/error404.php';
}

include_once "includes/footer.php";
?>