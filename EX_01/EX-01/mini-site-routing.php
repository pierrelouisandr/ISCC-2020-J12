<DOCTYPE !>
<html>
<head>
<title>mini-site-routing</title>
<meta charset="utf-8">
<meta name="viexport" content = "width-device-width, initial-scale-1.0">
</head>
<body>


<nav>
<ul>
<li><a href="mini-site-routing.php?page=1">Accueil</a></li>
<li><a href="mini-site-routing.php?page=2">Page 2</a></li>
<li><a href="mini-site-routing.php?page=3">Page 3</a></li>
<li><a href="mini-site-routing.php?page=connexion">Connexion</a></li>
</ul>
</nav>

<?php
session_start ();
if (!isset($_SESSION["id"])) {
    
}
?>


 <?php
include("connexion.php"); 

if (isset($_SESSION["login"])) {
    if (isset($_COOKIE["login"])) {
        $_SESSION["login"] = $_COOKIE["login"];
    }
}

if (!isset ($_SESSION["img-path"])){
    if (isset ($_COOKIE["img-path"])){
        $_SESSION["img-path"] = $_COOKIE["img-path"];
    }
}

    if ($_GET ['page'] == 1)
        echo "<p> Accueil </p>"; 

    else if ($_GET['page'] == 2) 
        echo "<p> Page 2 </p>";

    else if ($_GET['page'] == 3) 
        echo "<p> Page 3 </p>"; 

    if (isset($_SESSION["id"])) 
        echo "<p> Login : ". ($_SESSION["id"]) . "</p>";
        echo ("<img class=\"image\" src =\"unnamed.jpg\" alt=\"reunion\">");
    
?>

</body>
</html>

