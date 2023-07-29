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
    $req->execute(['id']);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header('LOCATION:perso.php');
    }
    $req->closeCursor();

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

        if($err == 0)
        {
            if(empty($_FILES['image']['tmp_name']))
            {
                $update = $bdd->prepare("UPDATE personnages SET name=:name, description=:descri WHERE id=:myid");
                $update->execute([
                    ":name" => $name,
                    ":descri" => $description,
                    ":myid" => $id
                ]);
                $update->closeCursor();
                header("LOCATION:perso.php?update=".$id);
            }else{

                $dossier = '../images/upload/';
                $fichier = basename($_FILES['image']['name']);
                $taille_maxi = 2000000;
                $taile = filesize($_FILES['image']['tmp_name']);
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['image']['name'],'.');

                if(!in_array($extension, $extensions))
                {
                    $err = 3;
                }

                if($taille>$taille_maxi)
                {
                    $err = 4;
                }

                if($err == 0)
                {
                    $fichier = strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

                    $fichiercpt = rand().$fichier;

                    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichiercpt))
                    {
                        unlink("../images/upload/".$don['image']);

                        $update = $bdd->prepare("UPDATE personnages SET name=:name, description=:descri, image=:img WHERE id=:myid");
                        $update->execute([
                            ":name" => $name,
                            ":descri" => $description,
                            ":img" => $fichiercpt,
                            ":myid" => $id
                        ]);
                        $update->closeCursor();
                        header("LOCATION:perso.php?update=".$id);
                    }
                }else{
                    header("LOCATION:updatePerso.php?id=".$id."$&error=".$err);
                }
            }
        }else{
            header("LOCATION:updatePerso.php?id=".$id."&error=".$err);
        }
    }else{
        header("LOCATION:updatePerso.php?id=".$id);
    }
?>