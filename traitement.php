<?php 

    if(isset($_POST['name']))
    {
        $err = 0;
        if(empty($_POST['name']))
        {
            $err = 1;
        }else{
            $nom = htmlspecialchars($_POST['name']);
        }

        if(empty($_POST['firstname']))
        {
            $err = 2;
        }else{
            $prenom = htmlspecialchars($_POST['firstname']);
        }

        if(empty($_POST['email']))
        {
            $err = 3;
        }else{
            $email = htmlspecialchars($_POST['email']);
        }

        if(empty($_POST['message']))
        {
            $err = 4;
        }else{
            $message = htmlspecialchars($_POST['message']);
        }

        if($err == 0)
        {
            require "connexion.php";
            $insert = $bdd->prepare("INSERT INTO contact(name,firstname,email,message) VALUES(?,?,?,?)");
            $insert->execute([$nom,$prenom,$email,$message]);
            $insert->closeCursor();
            header("LOCATION:index.php");
        }else{
            header("LOCATION:index.php");
        }
    }else{
        header("LOCATION:index.php");
    }
?>