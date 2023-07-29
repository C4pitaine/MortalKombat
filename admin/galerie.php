<?php
    session_start();

    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    require "../connexion.php";

    if(isset($_GET['delete']))
    {
        $id = htmlspecialchars($_GET['delete']);

        $search = $bdd->prepare("SELECT * FROM galerie WHERE id=?");
        $search->execute([$id]);
        if(!$donSearch = $search->fetch())
        {
            $search->closeCursor();
            header("LOCATION:product.php");
        }
        $search->closeCursor();
        unlink("../images/upload".$donSearch['fichier']);
        $delete = $bdd->prepare("DELETE FROM galerie WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();
        header("LOCATION:galerie.php?deletesuccess=".$id);
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Galerie Administration</title>
</head>
<body>
    <div class="container">
        <h2>Gestion des personnages</h2>
        <a href="addGalerie.php" class="btn btn-primary my-3">Ajouter une image dans la galerie</a>
        <a href="dashboard.php" class="btn btn-secondary m-3">Retour</a>
    <?php
        if(isset($_GET['addsuccess']))
        {
            echo "<div class='alert alert-success'>Vous avez bien ajouté une image dans la galerie</div>";
        }
        if(isset($_GET['update']))
        {
            echo "<div class='alert alert-warning'>L'image n°".$_GET['update']." de la galerie a été mis à jour</div>";
        }
        if(isset($_GET['deletesuccess']))
        {
            echo "<div class='alert alert-danger'>L'image n°".$_GET['deletesuccess']." de la galerie a bien été supprimé</div>";
        }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>IdPerso</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $req = $bdd->query("SELECT * FROM galerie");
                while($don = $req->fetch())
                {
                    echo "<tr>";
                        echo "<td>".$don['id']."</td>";
                        echo "<td>".$don['idPerso']."</td>";
                        echo "<td>";
                            echo "<a href='updateGalerie.php?id=".$don['id']."' class='btn btn-warning my-2 mx-2'>Modifier</a>";
                            echo "<a href='galerie.php?delete=".$don['id']."' class='btn btn-danger my-2 mx-2'>Supprimer</a>";
                        echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>