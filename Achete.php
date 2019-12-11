<?php session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');
$listeprod = $bdd->query('SELECT * FROM produit ');
if(!empty($_GET['ref_produit']))
{
    $req = $bdd->prepare("SELECT * FROM produit WHERE reference = ?");
    $req->execute(array($_GET['ref_produit']));
    $prod = $req->fetch();
    
    if(isset($_POST['newquantite']) AND !empty($_POST['newquantite']) AND $_POST['newquantite'] != $prod['quantite'])
    {
        $newquantite = htmlspecialchars($_POST['newquantite']);
        $reste = $_POST['newquantite'] - $_GET['quantite'];
        if ($reste > 0)
        {
            $donnee = $listeprod->fetch();
            $dif_quantite = $donnee['quantite'] - $newquantite;
            $insertquantite = $bdd->prepare("UPDATE produit SET quantite = ? WHERE reference = ?");
            $insertquantite->execute(array($dif_quantite, $_GET['ref_produit']));
            header('Location: commande_prod.php?ref_produit='.$_GET['ref_produit']);
        }
        else{
            echo ' quantite demandé trop grande';
        }
        
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
                <?php
               $donnee = $listeprod->fetch();
               ?>
               <label> Nombre de produit a acheter ( le chiffre dans la bulle correspond a la quantité restante):</label>
               <input type="number" name="newquantite" placeholder="<?php echo $donnee['quantite']; ?> " value="<?php echo $prod['quantite']; ?>" ><br /><br />
               
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
             <a href="commande_prod.php"> retour page commande </a>
            
         </div>
      </div>
   </body>
</html>