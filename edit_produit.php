<?php session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');



if(!empty($_GET['ref_produit'])) {
   $requser = $bdd->prepare("SELECT * FROM produit WHERE reference = ?");
   $requser->execute(array($_GET['ref_produit']));
   $user = $requser->fetch();
   
   if(isset($_POST['newlibelle']) AND !empty($_POST['newlibelle']) AND $_POST['newlibelle']  != $user['libelle']) {
      $newlibelle = htmlspecialchars($_POST['newlibelle']);
      $insertlibelle = $bdd->prepare("UPDATE produit SET libelle = ? WHERE reference = ?");
      $insertlibelle->execute(array($newlibelle, $_GET['ref_produit']));
      header('Location: liste_produit.php?ref_produit='.$_GET['ref_produit']);
   }
   if(isset($_POST['newcategorie']) AND !empty($_POST['newcategorie']) AND $_POST['newcategorie'] != $user['categorie']) {
      $newcategorie = htmlspecialchars($_POST['newcategorie']);
      $insertcategorie = $bdd->prepare("UPDATE produit SET categorie = ? WHERE reference = ?");
      $insertcategorie->execute(array($newcategorie, $_GET['ref_produit']));
      header('Location: liste_produit.php?ref_produit='.$_GET['ref_produit']);
   }
   if(isset($_POST['newmarque']) AND !empty($_POST['newmarque']) AND $_POST['newmarque'] != $user['marque']) {
      $newmarque = htmlspecialchars($_POST['newmarque']);
      $insertmarque = $bdd->prepare("UPDATE produit SET marque = ? WHERE reference = ?");
      $insertmarque->execute(array($newmarque, $_GET['ref_produit']));
      header('Location: liste_produit.php?ref_produit='.$_GET['ref_produit']);
   }
   if(isset($_POST['newquantite']) AND !empty($_POST['newquantite']) AND $_POST['newquantite'] != $user['quantite']) {
      $newquantite = htmlspecialchars($_POST['newquantite']);
      $insertquantite = $bdd->prepare("UPDATE produit SET quantite = ? WHERE reference = ?");
      $insertquantite->execute(array($newquantite, $_GET['ref_produit']));
      header('Location: liste_produit.php?ref_produit='.$_GET['ref_produit']);
   }
   if(isset($_POST['newprix']) AND !empty($_POST['newprix']) AND $_POST['newprix'] != $user['prix']) {
      $newprix = htmlspecialchars($_POST['newquantite']);
      $insertprix = $bdd->prepare("UPDATE produit SET prix = ? WHERE reference = ?");
      $insertprix->execute(array($newprix, $_GET['ref_produit']));
      header('Location: liste_produit.php?ref_produit='.$_GET['ref_produit']);
   }
   if(isset($_POST['newdescription']) AND !empty($_POST['newdescription']) AND $_POST['newdescription'] != $user['description']) {
      $newdescription = htmlspecialchars($_POST['newdescription']);
      $insertdescription = $bdd->prepare("UPDATE produit SET description = ? WHERE reference = ?");
      $insertprix->execute(array($newdescription, $_GET['ref_produit']));
      header('Location: liste_produit.php?ref_produit='.$_GET['ref_produit']);
}
}
?>
<html>
   <head>
      <title>Editeur de produit</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Edition du produit</h2>
         <div align="left">
            <form method="POST" enctype="multipart/form-data">
               <label>libelle:</label>
               <input type="text" name="newlibelle" placeholder="libelle" value="<?php echo $user['libelle']; ?>" ><br /><br />
               <label>categorie :</label>
               <input type="text" name="newcategorie" placeholder="categorie" value="<?php echo $user['categorie']; ?>" /><br /><br />
               <label>marque :</label>
               <input type="text" name="newmarque" placeholder="marque" value="<?php echo $user['marque']; ?>"><br /><br />
               <label>quantite :</label>
               <input type="number" name="newquantite" placeholder="quantite" value="<?php echo $user['quantite']; ?>" ><br /><br />
               <label>prix :</label>
               <input type="number" name="newprix" placeholder="€" value="<?php echo $user['prix']; ?>"><br /><br />
               <label>description:</label>
               <textarea name="description" placeholder="description" value="<?php echo $user['description']; ?>"></textarea><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            
         </div>
      </div>
   </body>
</html>