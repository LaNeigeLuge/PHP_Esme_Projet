<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');
$listeprod = $bdd->query('SELECT * FROM produit ');
?>
<html>
    <head>
        <title>VOTRE PROFLIL CLIENT</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="tableaux.css" />
    </head>
    <body>
        <form action="commande_prod.php" method="get">
            <table>

                <caption><strong> Acheter des produit!!!! :</strong></caption>
                <tr>
                    <th>reference</th>
                    <th>libelle</th>
                    <th>categorie</th>
                    <th>marque</th>
                    <th>quantite</th>
                    <th>prix</th>
                    <th>description</th>
                    <th>acheter</th>
                    <th>commentaire</th>
                </tr>
                <?php
                while ($donnee = $listeprod->fetch()) {
                    ?>
                    <tr>
                        <td><?php echo $donnee['reference']; ?></td>


                        <td><?php echo $donnee['libelle']; ?></td>


                        <td><?php echo $donnee['categorie']; ?></td>


                        <td><?php echo $donnee['marque']; ?></td>


                        <td><?php echo $donnee['quantite']; ?></td>


                        <td><?php echo $donnee['prix']; ?></td>


                        <td><?php echo $donnee['description']; ?></td>


                        <td><a href="achete.php?ref_produit=<?php echo $donnee["reference"]; ?>">Acheter</a></td>


                        <td> 
                            <a href="Ajouter_un_commentaire.php?ref_produit=<?php echo $donnee["reference"]; ?>">Ecrire un commentaire</a>
                        </td>

                    </tr>
                    <?php
                }
                ?>


                <a href="acceuil.php">Acceuil</a>
                <a href="profil_client.php">retour page client </a>
            </table>
            <input type="submit" value="Valider">
        </form>
    </body>
</html>
<?php
$listeprod->closeCursor();
?>
