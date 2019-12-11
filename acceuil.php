<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0) 
    {

   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
    }
?>

<html>
    <head>
        <title>Acceuil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <h1> mydevice.com </h1>
        <div>

            <nav>

                <strong>
                    <a href="Authentification.php">Authentification</a> 
                    <a href="connexion.php">LOGIN</a> 
                    
                
                </strong>
            </nav>	

            <article>

                <p>

                    YOU PORT est votre centre de production en fabrication additive, que ce soit pour 1 ou 100 000 pièces. Avec 10 technologies et 75+ combinaisons de matériaux et finitions, commandez vos pièces en quelques clics, quand et où vous le souhaitez.
                <p>
                    Nous vous proposons à la vente tout type de matériel informatique (PC et MAC). Notre équipe de professionnels saura vous conseiller afin de définir vos besoins et vous proposer des produits fiables et performants. Notre atelier permet de prendre en charge tous les dépannages informatiques ainsi que les installations de logiciels ou les changements de pièces détachées, vous assurant ainsi service après-vente efficace et réactif.</p>

                <p>

                    <table>

                        <caption><strong>Quelques chiffres</strong></caption>
                        <tr>
                                <td>8</td>
                                <td>Employés</td>
                        </tr>
                        <tr>
                                <td>1600</td>
                                <td>Réparations en atelier</td>
                        </tr>
                        <tr>
                                <td>1000</td>
                                <td>Clients professionnels</td>
                        </tr>
                        <tr>
                                <td>2000</td>
                                <td>Clients particuliers</td>
                        </tr>
                    </table>
                </p>

                <aside>

                    <strong>Les partenaires:</strong> 
                    <ul>
                        <li>Microsoft</li>
                        <li>HP</li> 
                        <li>Orange</li>
                        <li>Dell</li>
                    </ul> 
                </aside>

                <footer>
                    Adresse: RUE DE LA MARMELADE, 69420 Tupin-et-semons
                </footer>

            </article>
        </div>
        
    </body>
</html>

