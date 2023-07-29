<?php
    session_start();

    if(isset($_SESSION['login']))
    {
        header("LOCATION:dashboard.php");
    }

    if(isset($_POST['login']) && isset($_POST['password']))
    {
        if(empty($_POST['login']) OR empty($_POST['password']))
        {
            $error = "Veuillez remplir correctement le formulaire";
        }else{
            $login = htmlspecialchars($_POST['login']);
            $password = $_POST['password'];
            require "../connexion.php";
            $req = $bdd->prepare("SELECT * FROM admin WHERE login=?");
            $req->execute([$login]);
            if($don = $req->fetch())
            {
                if(password_verify($password,$don['password']))
                {
                    $_SESSION['login'] = $don['login'];
                    header("LOCATION:dashboard.php");
                }else{
                    $error = "Le login et/ou le mot de passe est incorrect";
                }
            }else{
                $error = "Le login et/ou le mot de passe est incorrect";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Mortal Kombat Administration</title>
</head>
<body>
    <div class="container">
        <dinv class="row">
            <div class="col-md-4 offset-md-4 my-5">
                <form action="index.php" method="POST">
                    <h1>Connexion</h1>
                    <?php   
                        if(isset($error))
                        {
                            echo '<div class="alert alert-danger">'.$error.'<div>';
                        }
                    ?>
                    <div class="form-group my-3">
                        <label for="login">Login: </label>
                        <input type="text" name="login" id="login" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label for="password">Mot de passe: </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <input type="submit" value="Connexion" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </dinv>
    </div>
</body>
</html>