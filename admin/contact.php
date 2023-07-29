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

        $delete = $bdd->prepare("DELETE FROM contact WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();
        header("LOCATION:contact.php?deletesuccess=".$id);
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Contact Administration</title>
</head>
<body>
    <div class="container">
        <h2>Gestion des personnages</h2>
        <a href="dashboard.php" class="btn btn-secondary my-3">Retour</a>
    <?php
        if(isset($_GET['deletesuccess']))
        {
            echo "<div class='alert alert-danger'>Le message n°".$_GET['deletesuccess']." a bien été supprimé</div>";
        }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $req = $bdd->query("SELECT * FROM contact");
                while($don = $req->fetch())
                {
                    echo "<tr>";
                        echo "<td>".$don['id']."</td>";
                        echo "<td>".$don['name']."</td>";
                        echo "<td>".$don['firstname']."</td>";
                        echo "<td>".$don['message']."</td>";
                        echo "<td>";
                            echo "<a href='contact.php?delete=".$don['id']."' class='btn btn-danger'>Supprimer</a>";
                        echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>