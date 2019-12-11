<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');

if(isset($_POST['formajout_prod'])) 
{
   $libelle = htmlspecialchars($_POST['libelle']);
   $categorie = htmlspecialchars($_POST['categorie']);
   $marque = htmlspecialchars($_POST['marque']);
   $quantite = htmlspecialchars($_POST['quantite']);
   $prix = htmlspecialchars($_POST['prix']);
   $description = htmlspecialchars($_POST['description']);

    if(!empty($_POST['libelle']) AND !empty($_POST['categorie']) AND !empty($_POST['marque']) AND !empty($_POST['quantite']) AND !empty($_POST['prix'])) 
    {
        
        $libellelength = strlen($libelle);
        if($libellelength <= 255) {
         
            if(filter_var($libelle, FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
               $reqlibelle = $bdd->prepare("SELECT * FROM produit WHERE libelle = ?");
               $reqlibelle->execute(array($libelle));
               $libelleexist = $reqlibelle->rowCount();
               if($libelleexist == 0) {

                    $insertprod = $bdd->prepare("INSERT INTO produit(libelle, categorie, marque, quantite, prix, description) VALUES(?, ?, ?, ?, ?, ?)");
                    $insertprod->execute(array($libelle, $categorie, $marque, $quantite, $prix, $description));
                    $prodinfo = $insertprod->fetch();
                    $_SESSION['reference'] = $prodinfo['reference'];
                    $_SESSION['libelle'] = $prodinfo['libelle'];
                    $_SESSION['categorie'] = $prodinfo['categorie'];
                    $_SESSION['marque'] = $prodinfo['marque'];
                    $_SESSION['quantite'] = $prodinfo['quantite'];
                    $_SESSION['prix'] = $prodinfo['prix'];
                    $_SESSION['description'] = $prodinfo['description'];
                    $erreur = "Votre produit a bien été créé ! ";
                    header("Location: liste_produit.php?reference=" . $_SESSION['reference']);
              
                }
            }   
            else 
            {
               $erreur = "votre produit existe deja !";
            }

        
        } else {
            $erreur = "Votre libelle ne doit pas dépasser 255 caractères !";
        }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
   

?>
<html>
   <head>
      <title>Ajout produit</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>PAGE D AJOUT PRODUIT</h2>
         <br /><br />
         <form method="POST" action="ajout_prod.php">
            <table>
               <tr>
                  <td align="right">
                     <label for="libelle">Libelle :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="nom produit" id="libelle" name="libelle" value="<?php if(isset($libelle)) { echo $libelle; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="categorie">categorie :</label>
                  </td>
                  <td>
                      <input type="text" placeholder="categorie du produit" id="categorie" name="categorie" value="<?php if(isset($categorie)) { echo $categorie; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="marque">marque:</label>
                  </td>
                  <td>
                     <input type="text" placeholder="marque produit" id="marque" name="marque"  value="<?php if(isset($marque)) { echo $marque; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="quantite"> quantité :</label>
                  </td>
                  <td>
                      <input type="number" placeholder="quantite" id="quantite" name="quantite" value="<?php if(isset($quantite)) { echo $quantite; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="prix">PRIX € :</label>
                  </td>
                  <td>
                      <input type="number" placeholder="1M €" id="prix" name="prix" value="<?php if(isset($prix)) { echo $prix; } ?>" />
                      <p>
                          €
                      </p>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="description">description du produit:</label><br />
                  </td>
                  <td>
                      <textarea  id="description" name="description" value="<?php if(isset($description)) { echo $description; } ?>"></textarea>
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="formajout_prod" value="creation du nouveau produit" />
                  </td>
               </tr>
            </table>
             <a href="ajout_prod.php"> Ajouter un nouveaux produit</a>
             <a href="edit_produit.php"> Editer un produit</a>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>
