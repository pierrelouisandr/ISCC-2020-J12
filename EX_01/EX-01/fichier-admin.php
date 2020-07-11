<form action="mini-site-routing.php" method="post" enctype="multipart/form-data">
    <input type="file" accept="image/png, image/jpg, image/jpeg" name="file" required>
    <input type="text" name="title" placeholder="Titre">
    <input type="text" name="desc" placeholder="Description">
    <input type="text" value="login" name="login">
    <input type="text" value="password" name="password">
    <input type="submit" name="submit" value="Upload">
    
</form>
<?php
if (empty($_FILES['file']))
    echo("<p>En attente de fichier</p>");
else {
    $filename = $_FILES['file']['name'];
    $filesize = $_FILES['file']['size'];
    $destination = "./";

    if (strlen(substr($filename, 0, (strrpos($filename, ".")))) < 4)
        echo("<p>le fichier est trop volumineux: valeur ['name']</p>");
    elseif ($filesize > 2097152)
        echo("<p>Erreur dans le fichier: valeur ['size']</p>");
    else {
        if (!empty($_POST['title']))
            $_SESSION['title'] = $_POST['title'];
        if (!empty($_POST['desc']))
            $_SESSION['desc'] = $_POST['desc'];
        $_SESSION['image'] = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $_SESSION['image']);
        header("Location: mini-site-routing.php?page=1");
    }
}

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
$login=$_POST["login"];
$password=$_POST["login"];
$img_path=$_FILES["fichier"]["name"];

$users = $pdo->query("SELECT * FROM `base-site-rooting`. `utilisateurs` WHERE `login` LIKE '%$login%' ")->fetchAll();

if (empty($users[0]["login"])){
    $pdo->query("INSERT INTO `base-site-rooting`. `utilisateurs` (`id`, `login`, `password`, `img-path`) VALUES (NULL, '$login' ")->fetchAll();
    echo "ok";
}

else {
    $users->query("UPDATE `utilisateurs` SET `img-path` = '$img_path' WHERE `login` LIKE '%$login%' ");
    $users->query("UPDATE `utilisateurs` SET `password` = '$password' WHERE `login` LIKE '%$login%' ");
    echo "ok";
}
?>