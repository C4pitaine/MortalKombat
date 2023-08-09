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
    $req = $bdd->prepare("SELECT * FROM galerie WHERE id=?");
    $req->execute(['id']);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header('LOCATION:galerie.php');
    }
    $req->closeCursor();

    if(isset($_POST['name']))
    {
        $err = 0;
        if(empty($_POST['name']))
        {
            $err = 1;
        }else{
            $idperso = htmlspecialchars($_POST['name']);
        }

        if($err == 0)
        {
            if(empty($_FILES['fichier']['tmp_name']))
            {
                $update = $bdd->prepare("UPDATE galerie SET idPerso=:idperso WHERE id=:myid");
                $update->execute([
                    ":idperso" => $idperso,
                    ":myid" => $id
                ]);
                $update->closeCursor();
                /* on vérifie si la checkbox ( pour changer d'autre image d'un même perso est coché et on renvoit à la galerie avec l'id du perso si c'est le cas) */
                if(isset($_POST['check']))
                {
                    header("LOCATION:galerie.php?update=".$id."&modifyid=".$idperso);
                }else{
                    header("LOCATION:galerie.php?update=".$id);
                }
                
            }else{

                $dossier = '../images/upload/';
                $fichier = basename($_FILES['fichier']['name']);
                $taille_maxi = 2000000;
                $taile = filesize($_FILES['fichier']['tmp_name']);
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['fichier']['name'],'.');

                if(!in_array($extension, $extensions))
                {
                    $err = 2;
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

                    if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier.$fichiercpt))
                    {
                        unlink("../images/upload/".$don['fichier']);

                        $update = $bdd->prepare("UPDATE galerie SET idPerso=:idperso, fichier=:img WHERE id=:myid");
                        $update->execute([
                            ":idperso" => $idperso,
                            ":img" => $fichiercpt,
                            ":myid" => $id
                        ]);
                        $update->closeCursor();
                        /* on vérifie si la checkbox ( pour changer d'autre image d'un même perso est coché et on renvoit à la galerie avec l'id du perso si c'est le cas) */
                        if(isset($_POST['check']))
                        {
                            header("LOCATION:galerie.php?update=".$id."&modifyid=".$idperso);
                        }else{
                            header("LOCATION:galerie.php?update=".$id);
                        }
                    }
                }else{
                    header("LOCATION:updateGalerie.php?id=".$id."$&error=".$err);
                }
            }
        }else{
            header("LOCATION:updateGalerie.php?id=".$id."&error=".$err);
        }
    }else{
        header("LOCATION:updateGalerie.php?id=".$id);
    }
?>