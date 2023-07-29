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

        $search = $bdd->prepare("SELECT * FROM personnages WHERE id=?");
        $search->execute([$id]);
        if(!$donSearch = $search->fetch())
        {
            $search->closeCursor();
            header("LOCATION:perso.php");
        }
        $search->closeCursor();
        unlink("../images/upload".$donSearch['image']);
        $delete = $bdd->prepare("DELETE FROM personnages WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();
        header("LOCATION:perso.php?deletesuccess=".$id);
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Personnages Administration</title>
</head>
<body>
    <div class="container">
        <h2>Gestion des personnages</h2>
        <a href="addPerso.php" class="btn btn-primary my-3">Ajouter un personnage</a>
        <a href="dashboard.php" class="btn btn-secondary m-3">Retour</a>
    <?php
        if(isset($_GET['addsuccess']))
        {
            echo "<div class='alert alert-success'>Vous avez bien ajouté un personnage dans la base de données</div>";
        }
        if(isset($_GET['update']))
        {
            echo "<div class='alert alert-warning'>Le personnage n°".$_GET['update']." a été mis à jour</div>";
        }
        if(isset($_GET['deletesuccess']))
        {
            echo "<div class='alert alert-danger'>Le personnage n°".$_GET['deletesuccess']." a bien été supprimé</div>";
            echo "<a href='galerie.php?suppid=".$_GET['deletesuccess']."' class='btn btn-danger'>Supprimer les images de la galerie</a>";
        }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $req = $bdd->query("SELECT * FROM personnages");
                while($don = $req->fetch())
                {
                    echo "<tr>";
                        echo "<td>".$don['id']."</td>";
                        echo "<td>".$don['name']."</td>";
                        echo "<td>".$don['description']."</td>";
                        echo "<td>";
                            echo "<a href='updatePerso.php?id=".$don['id']."' class='btn btn-warning my-2'>Modifier</a>";
                            echo "<a href='perso.php?delete=".$don['id']."' class='btn btn-danger my-2'>Supprimer</a>";
                        echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>