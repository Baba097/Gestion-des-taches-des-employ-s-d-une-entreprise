<?php
include_once "db.php";


function getTaches(){
    global $pdo;
    $sql = "SELECT* FROM taches ORDER BY date_creation DESC";
    $exe = $pdo->query($sql);
    return $exe->fetchAll();
}

function getTacheModif($id){
    global $pdo;
    return $req = $pdo->query("SELECT* FROM taches WHERE id = $id")->fetch();
}

function addTaches($titre,$description,$priorite,$statut,$date_limite,$responsable){
    global $pdo;
    $sql = "INSERT INTO taches(titre,description,priorite,statut,date_limite,responsable) VALUES(?,?,?,?,?,?)";
    $req = $pdo->prepare($sql);
    $req->execute([$titre,$description,$priorite,$statut,$date_limite,$responsable]); 
}

function delTaches($id){
    global $pdo;
    $sql = "DELETE FROM taches WHERE id = ?";
    $req = $pdo->prepare($sql);
    $req->execute([$id]);
}

function modifTaches($titre, $description,$priorite,$date_limite,$responsable,$id){
    global $pdo;
    $sql = "UPDATE taches 
            SET titre = ? , description = ? , priorite = ? , date_limite = ? , responsable = ?
            WHERE id = ? ";

    $req = $pdo->prepare($sql);
    $req->execute([$titre, $description,$priorite,$date_limite,$responsable,$id]);
}

function modifStatut($id,$statut){
    global $pdo;
    $sql = "UPDATE taches SET statut = ? WHERE id = ? ";
    $req = $pdo->prepare($sql);
    $req ->execute([$statut,$id]); 
}

function terminerTache($id){
    global $pdo;
    $req = $pdo->prepare("UPDATE taches SET statut = 'Terminée' WHERE id = ? AND statut != ?");
    $req->execute([$id,"Terminée"]);
}

function getTachesTerminer(){
    global $pdo;
    $sql = "SELECT* FROM taches WHERE statut = 'Terminée' ";
    return $pdo->query($sql)->fetchAll();
}

function getTachesNonTerminer(){
    global $pdo;
    $sql = "SELECT* FROM taches WHERE statut != 'Terminée' ";
    return $pdo->query($sql)->fetchAll();
}

function getTachesEnRetard(){
    global $pdo;
    $sql = "SELECT* FROM taches WHERE statut != 'Terminée' AND date_limite < CURRENT_TIMESTAMP()";
    return $pdo->query($sql)->fetchAll();
}

function filtrer($search,$statut,$priorite){
    global $pdo;
    $sql = "SELECT* FROM taches WHERE 1=1 ";

    if(!empty($search)){
        $sql .= "AND (titre LIKE '%$search%' or description LIKE '%$search%')";
    }
    if(!empty($statut)){
        $sql .= "AND statut = '$statut'";
    }
    if(!empty($priorite)){
        $sql .= "AND priorite = '$priorite'";
    }
    
    $sql .= " ORDER BY date_creation DESC";

    return $pdo->query($sql)->fetchAll();
}
?>