<?php
    session_start();

    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    if(isset($_POST['name']))
    {
        $err = 0;
        if(empty($_POST['name']))
        {
            $err = 1;
        }else{
            $name = htmlspecialchars($_POST['name']);
        }
        if(empty($_POST['description']))
        {
            $err = 2;
        }else{
            $description = htmlspecialchars($_POST['description']);
        }
        if($err == 0){
            
            $dossier = '../images/upload/';
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'],'.');

            if(!in_array($extension,$extensions))
            {
                $err  = 4;
            }

            if($taille>$taille_maxi)
            {
                $err = 5;
            }

            if($err == 0)
            {
                $fichier = strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

                $fichiercpt = rand().$fichier;
                if(move_uploaded_file($_FILES['image']['tmp_name'],$dossier.$fichiercpt))
                {
                    require "../connexion.php";
                    $insert = $bdd->prepare("INSERT INTO personnages(name,description,image) VALUES(?,?,?)");
                    $insert->execute([$name,$description,$fichiercpt]);
                    $insert->closeCursor();
                    header("LOCATION:perso.php?addsuccess=ok");

                }else{
                    header("LOCATION:addPerso.php?error=6");
                }
            }else{
                header("LOCATION:addPerso.php?error=".$err);
            }
        }else{
            header("LOCATION:addPerso.php?error=".$err);
        }

    }else{
        header("LOCATION:addPerso.php");
    }
?>