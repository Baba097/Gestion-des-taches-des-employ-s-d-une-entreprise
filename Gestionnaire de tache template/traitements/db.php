<?php 
$host = "localhost";
$db_name = "gestio_taches_tmp"; 
$user = "root";
$password ="";

try{
    $pdo = new PDO("mysql:host=$host; dbname=$db_name", $user , $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $excep){ 
    die("Erreur de connexion " . $excep->getMessage());
}
?>