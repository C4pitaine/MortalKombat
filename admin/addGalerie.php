<?php
    session_start();

    if(!isset($_SESSION['login']))
    {
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
    <title>Ajouts image Galerie Administration</title>
</head>
<body>
    <div class="container">
       <h2>Ajouter une image dans la galerie</h2>
       <?php
            if(isset($_GET['error'])){
                echo "<div class='alert alert-danger'>Veuillez remplir tout les champs</div>";
            }
       ?>
       <form action="treatmentAddGalerie.php" method="POST" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label for="name">Name: </label>
                <select name="name" id="name">
                    <?php
                        require "../connexion.php";
                        $req = $bdd->query("SELECT * FROM personnages");
                        while($don = $req->fetch())
                        {
                            echo "<option value=".$don['id'].">".$don['name']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group my-3">
                <label for="fichier">Fichier: </label>
                <input type="file" name="fichier" id="fichier" class="from-control">
            </div>
            <div class="form-group my-3">
                <input type="submit" value="Ajouter" class="btn btn-success">
            </div>
       </form>
    </div>
</body>
</html>