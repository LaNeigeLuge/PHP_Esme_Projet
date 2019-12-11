<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');

if (isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    $profilconnect = htmlspecialchars($_POST['profil']);

    if (!empty($mailconnect) AND ! empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ? AND profil = ?");
        $requser->execute(array($mailconnect, $mdpconnect, $profilconnect));
        $userexist = $requser->rowCount();
        if ($userexist == 1) {
            //je cherche a faire comme dans connexion pour recup la valeur de profil peut etre la teste ici et pas ailleur
            if ($profilconnect == "manager") {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                $_SESSION['mail'] = $userinfo['mail'];
                $_SESSION['profil'] = $userinfo['profil'];
                header("Location: profil_mana.php?id=" . $_SESSION['id']);
            } else {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                $_SESSION['mail'] = $userinfo['mail'];
                $_SESSION['profil'] = $userinfo['profil'];
                header("Location: profil_client.php?id=" . $_SESSION['id']);
            }
        } else {
            $erreur = "Mauvais mail, mot de passe ! ou vous n'etes pas MANAGER";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>
<html>
    <head>
        <title>connexion</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Connexion</h2>
        <div align="center">
            <h3>Connexion</h3>
            <br /><br />
            <form method="POST" action="">
                Profil<select name="profil">
                    <option value="client" selected = "selected">Client</option>
                    <option value="manager">Manager</option>

                </select><br>
                <input type="email" name="mailconnect" placeholder="Mail" />
                <input type="password" name="mdpconnect" placeholder="Mot de passe" />
                <br /><br />
                <input type="submit" name="formconnexion" value="Se connecter !" />
            </form>
            <a href="Authentification.php">Pas encore de compte ?</a>
<?php
if (isset($erreur)) {
    echo '<font color="red">' . $erreur . "</font>";
}
?>
    </body>
</html>