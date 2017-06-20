<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
  <title>Login SQL</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="style.css" type="text/CSS">
 </head>

 <body>

<?php
include('connect.php');
// Hachage du mot de passe
$pseudo = $_POST['pseudo1'];
$pass_hache = sha1($_POST['password1']);


// Vérification des identifiants
$req = $DB_con->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND password = :password');
$req->execute(array(
    'pseudo' => $pseudo,
    'password' => $pass_hache));

$resultat = $req->fetch();

if (!$resultat) {
    echo 'Mauvais identifiant ou mot de passe !';
} else {
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $pseudo;
    echo 'Vous êtes connecté !';
}
if (isset($_SESSION['id']) and isset($_SESSION['pseudo'])) {
    echo 'Bonjour ' . $_SESSION['pseudo'];
    echo '<a href="deconnexion.php">Deconnexion</a>';
}
?>

</body>

</html>
