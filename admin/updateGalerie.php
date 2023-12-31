<?php
    session_start();

    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
        /* on assigne la valeur de l'id pour la réutiliser dans le traitement */
        $idPers = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    require "../connexion.php";
    $req = $bdd->prepare("SELECT galerie.*,personnages.name,personnages.id FROM galerie INNER JOIN personnages ON galerie.idPerso=personnages.id WHERE galerie.id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:index.php");
    }
    $req->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Modifier Une image de la Galerie Administration</title>
</head>
<body>
    <div class="container">
       <h2>Modifier une image de La galerie</h2>
        <!-- On envoit dans le traitement l'idPers sauvegarder pour ne pas avoir une erreur entre les différents id des différentes tables  -->
       <form action="treatmentUpdateGalerie.php?id=<?= $idPers ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $idPers ?>">
            <div class="form-group my-3">
                <label for="fichier">Fichier: </label>
                <div class="row">
                    <div class="col-4">
                        <img src="../images/upload/<?= $don['fichier'] ?>" class="img-fluid" alt="image de <?= $don['fichier'] ?>">
                    </div>
                </div>
                <input type="file" name="fichier" id="fichier" class="from-control">
            </div>
            <?php   
            /*on regarde si il y a la présence du modifyid pour demander si la personne veut modifier d'autre image du même perso ( on affichera alors à nouveau uniquement les informations de ce personnage */
                if(isset($_GET['modifyid']))
                {
                    echo "<div class='form-group'>";
                    echo "<label for='check'>Voulez vous modifier d'autres images de ce perso: </label>";
                        echo "<input type='checkbox' name='check' id='check' class='form-check'>";
                    echo "</div>";
                }
            ?>
            <div class="form-group my-3">
                <label for="name">Name: </label>
                <select name="name" id="name">
                    <option value="<?= $don['id'] ?>"><?=$don['name']?></option>
                    <?php
                        require "../connexion.php";
                        $req = $bdd->query("SELECT * FROM personnages");
                        while($don = $req->fetch())
                        {
                            echo "<option value=".$don['id'].">".$don['name']."</option>";
                        }
                        $req->closeCursor();
                    ?>
                </select>
            </div>
            <div class="form-group my-3">
                <input type="submit" value="Modifier" class="btn btn-success">
            </div>
       </form>
    </div>
</body>
</html>