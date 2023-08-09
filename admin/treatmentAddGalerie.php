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
            $idperso = htmlspecialchars($_POST['name']);
        }
        
        if($err == 0){
            
            $dossier = '../images/upload/';
            $fichier = basename($_FILES['fichier']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['fichier']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['fichier']['name'],'.');

            if(!in_array($extension,$extensions))
            {
                $err  = 2;
            }

            if($taille>$taille_maxi)
            {
                $err = 3;
            }

            if($err == 0)
            {
                $fichier = strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

                $fichiercpt = rand().$fichier;
                if(move_uploaded_file($_FILES['fichier']['tmp_name'],$dossier.$fichiercpt))
                {
                    require "../connexion.php";
                    $insert = $bdd->prepare("INSERT INTO galerie(idPerso,fichier) VALUES(?,?)");
                    $insert->execute([$idperso,$fichiercpt]);
                    $insert->closeCursor();
                    header("LOCATION:galerie.php?addsuccess=ok");

                }else{
                    header("LOCATION:addGalerie.php?error=6");
                }
            }else{
                header("LOCATION:addGalerie.php?error=".$err);
            }
        }else{
            header("LOCATION:addGalerie.php?error=".$err);
        }

    }else{
        header("LOCATION:addGalerie.php");
    }
?>