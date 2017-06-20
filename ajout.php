<?php

include('connect.php');

$pseudo = $_POST['pseudo'];
$pass_hache = sha1($_POST['password']);
$email= $_POST['email'];

// Insertion de l'utilisateur

$req = $DB_con->prepare('INSERT INTO membres(pseudo, password, email, date_creation) VALUES(:pseudo, :password, :email, CURDATE())');

$req->execute(array(

    'pseudo' => $pseudo,
    'password' => $pass_hache,
    'email' => $email));

header('location: connexion.php');
