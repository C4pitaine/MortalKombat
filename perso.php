<?php
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    require "connexion.php";
    $req = $bdd->prepare("SELECT * FROM personnages WHERE id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:index.php");
    }
    $req->closeCursor();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/style.css">
    <title>Personnage - <?=$don['name']?></title>
</head>
<body>  
    <div class="slide" id="descriptionP">
        <h3><?=$don['name']?></h3>
        <img src="images/upload/<?=$don['image']?>" alt="Image de <?=$don['name']?>">
        <div class="text">
            <p><?=$don['description']?></p>
        </div>
        <a href="index.php#perso">Retour</a>
    </div>
    <div class="blockP">
        <h4>Galerie</h4>
    </div>
    <div class="slide" id="galerie">
    <div class="wrapper">
        <?php
            $req = $bdd->prepare("SELECT galerie.*,personnages.* FROM galerie INNER JOIN personnages ON personnages.id=galerie.idPerso WHERE personnages.id=?");
            $req->execute([$id]);
            while($don = $req->fetch())
            {
                echo "<a href='#' class='perso'>";
                    echo "<img src='images/upload/".$don['fichier']."' alt='image de ".$don['name']."'>";
                    echo "<h6>Download</h6>";
                echo "</a>";
            }
            $req->closeCursor();
        ?>
        </div>
    </div>
</body>
</html>