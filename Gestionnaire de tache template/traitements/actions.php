<?php
include_once "requetes.php";

$dossierpage = "http://localhost/php%20project/Gestionnaire%20de%20tache%20template/index.php?page=";

/****FORMULAIRE ****/

//ENREGISTREMENT JSON
function enrgJson($titre,$description,$priorite,$date_limite,$responsable){
        
    $fichier = "taches.json";

    //Lire le fichier
    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        $tasks = json_decode($contenu, true);
    } else {
        $tasks = [];
    }

    //Nouvelle tache
    $newTasks = ['titre'=>$titre,'description'=>$description,'priorite'=>$priorite,'date_limite'=>$date_limite,'responsable'=>$responsable]; 

    //Ajouter tache
    $tasks[] = $newTasks;

    //Réécrire le fichier
    file_put_contents($fichier, json_encode($tasks, JSON_PRETTY_PRINT));  
}


// AJOUTER LES TACHES 
if(isset($_POST['action']) && $_POST['action'] === 'ajouter')
{
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $priorite = $_POST['priorite'];
    $statut = $_POST['statut'];
    $date_limite = $_POST['date_limite'];
    $responsable = $_POST['responsable'];
    $page = $_POST['page'];

    addTaches($titre,$description,$priorite,$statut,$date_limite,$responsable);
    enrgJson($titre,$description,$priorite,$date_limite,$responsable);

    header("Location: $dossierpage$page");
    exit;
}

// MODIFIER LA TACHE 
if (isset($_POST['action']) && $_POST['action'] === 'modifier'){

    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $priorite = $_POST['priorite'];
    $date_limite = $_POST['date_limite'];
    $responsable = $_POST['responsable'];
    $page = $_POST['page'];

    modifTaches($titre, $description,$priorite,$date_limite,$responsable,$id);

    header("Location: $dossierpage$page");
    exit;
}

// SUPPRIMER LA TACHE 
if(isset($_GET['supprimer'])){
    
    $id = $_GET['supprimer'];
    $page = $_GET['page'] ? $_GET['page'] : "acceuil";
    delTaches($id);

}

//MODIFIER STATUT
if(isset($_GET['modif_statut']) && $_GET['modif_statut'] != "Terminée"){

    $id = $_GET['idstatut'] ? $_GET['idstatut'] : null;
    $statut = $_GET['modif_statut'];
    if($id != null){
        if($statut == "à faire"){
            modifStatut($id,"En cours");
        }
        else{
            modifStatut($id,"Terminée");
        }  
    }
}

////GESTION TACHES
//TACHE EN RETARD
function verifDateLimite($tache){
    $task_date_limite = new Datetime($tache['date_limite']);
    $now = new Datetime('today');

    if($now > $task_date_limite && $tache['statut'] != 'Terminée' ){
        return True;
    }
    else {
        return False;
    }
}

//STATUT ET PRIORITE TACHES
function statutTache($tache){
    if ($tache['statut'] == 'Terminée') {$stat = "success";} 
    else if ($tache['statut'] == 'à faire') {$stat = "danger";}
    else {$stat = "warning";}

    return $stat;
}

function prioriteTache($tache){
    if ($tache['priorite'] == 'Basse') {$prio = "secondary";} 
    else if ($tache['priorite'] == 'Moyenne') {$prio = "warning";}
    else {$prio = "danger";}

    return $prio;
}

//TERMINER TACHES
if(isset($_GET['terminer_tache'])){
    if($_GET['statut'] != 'Terminée'){
        $id = $_GET['terminer_tache'];
        terminerTache($id);
    }

}

// //FILTRER LES TACHES
if(isset($_POST['filtrer'])){
    $search = $_POST['search'];
    $statut = $_POST['statut'];
    $priorite = $_POST['priorite'];

    header("Location: ../index.php?page=indexTaches&search=$search&statut=$statut&priorite=$priorite#titre2_taches");
    exit;
}

$search   = $_GET['search'] ?? '';
$statut   = $_GET['statut'] ?? '';
$priorite = $_GET['priorite'] ?? '';
$taches_filtrer = filtrer($search,$statut,$priorite);

//DONNEES DES TACHES
$nbrTachesTerminé = count(getTachesTerminer());
$nbrTachesNonTerminé = count(getTachesNonTerminer());
$nbrTachesEnRetard = count(getTachesEnRetard());


?>
