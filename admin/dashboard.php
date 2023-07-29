<?php
    session_start();

    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    if(isset($_GET['deco']))
    {
        session_destroy();
        header("LOCATION:index.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Dashboard Administration</title>
</head>
<body>
    <div class="container">
        <a href="dashboard.php?deco=ok" class="btn btn-danger my-2">Déconnexion</a>
        <br>
        <a href="perso.php" class="btn btn-warning my-2">Gestion des personnages</a>
        <br>
        <a href="galerie.php" class="btn btn-secondary my-2">Gestion de la galerie</a>
        <br>
        <a href="contact.php" class="btn btn-primary my-2">Gestion des messages</a>
    </div>
</body>
</html>