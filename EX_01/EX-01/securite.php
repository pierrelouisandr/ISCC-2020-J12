<?php

    
function connect_to_database(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "base-site-rooting";
    
    try{
        $pdo = new PDO ("mysql:host=$servername;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully ";
        return $pdo;
    }
        catch(PDOException $e){
            echo "Connection failed" . $e->getMessage();
    }
    }

$pdo = connect_to_database();

$users=$pdo->query("SELECT * FROM `base-site-rooting`. `utilisateurs`")->fetchAll();

foreach ($users as $user){
    if ($_POST["password"] == $users["password"]){

        session_start ();
    $_SESSION ["login"] = $_POST ["login"];
    setcookie ('login', $_SESSION ['login']);
    
    header ("Location: mini-site-routing.php?page=1");
}  

else {
    
    echo '<p> "Mauvais couple identifiant : mot de passe." </p>';
    echo ('<a href= "mini-site-routing.php?page=connexion" > lien de connexion </a>');
}
}

if (!isset($_SESSION["login"])) {
if (isset($_COOKIE["login"])) {
$_SESSION["login"]= $_COOKIE["login"];
}
}

if (!isset($_SESSION["img-path"])) {
if (isset($_COOKIE["img-path"])) {
$_SESSION["img-path"]= $_COOKIE["img-path"];
    }
    }
?>