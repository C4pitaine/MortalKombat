<?php
    session_start();

    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    require "../connexion.php";
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Modifier Personnages Administration</title>
</head>
<body>
    <div class="container">
       <h2>Modifier un personnage</h2>
       <form action="treatmentUpdatePerso.php?id=<?= $don['id'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $don['id'] ?>">
            <div class="form-group my-3">
                <label for="name">Nom: </label>
                <input type="text" name="name" id="name" value="<?= $don['name'] ?>" class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="description">Description: </label>
                <textarea name="description" id="description" class="form-control"><?= $don['description'] ?></textarea>
            </div>
            <div class="form-group my-3">
                <label for="image">Image: </label>
                <div class="row">
                    <div class="col-4">
                        <img src="../images/upload/<?= $don['image'] ?>" class="img-fluid" alt="image de <?= $don['name'] ?>">
                    </div>
                </div>
                <input type="file" name="image" id="image" class="from-control">
            </div>
            <div class="form-group my-3">
                <input type="submit" value="Modifier" class="btn btn-success">
            </div>
       </form>
    </div>
</body>
</html>