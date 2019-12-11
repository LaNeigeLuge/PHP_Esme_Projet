<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');

if (isset($_GET['id']))//ici mettredifference client manager
{
    $getid = intval($_GET['id']);//ne sait pas pourquoi avoir besoin
    $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();//changer pour plustard userinfo
?>
<html>
    <head>
        <title>VOTRE PROFLIL CLIENT</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div align="center">
            <h2>Profil de <?php echo $userinfo['pseudo'];?></h2>
            <br /><br />
            Type de profil = <?php echo $userinfo['profil'];?>
            <br />
            Pseudo = <?php echo $userinfo['pseudo'];?>
            <br />
            Mail = <?php echo $userinfo['mail'];?>
            <br />
            Tel = <?php echo $userinfo['tel'];?>
            <br />
            Adresse = <?php echo $userinfo['adresse'];?>
            <br />
            <?php
            if(isset($erreur))
            {
                echo '<font color = "red">'.$erreur."</font>";       
             
            }
            if($userinfo['id'] == $_SESSION['id'])
            {
            ?>
            <a href="editprofil.php"> Editer mon profil</a>
            <a href="deconnexion.php">Deconnexion</a>
            <a href="commande_prod.php">Commander un produit</a>
            <a href="espace_commentaire.php">ajouter un commentaire</a>
            <?php
            }
            ?>
        </div>
   </body>
</html>
<?php   
}
else
{
    header("Location: Authentification.php");
}
?>