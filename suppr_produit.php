<?php 
// Connexion à la base de données 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');
$insertprod = $bdd->prepare('DELETE FROM produit WHERE reference = ?');
$insertprod->execute(array($_GET['ref_produit']));

header('Location: liste_produit.php');
?>