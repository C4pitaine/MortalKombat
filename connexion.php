<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=mortalk;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //Instanciation 
    }
    catch(Exception $e)     //$e devient un objet
    {
        die('Erreur: '.$e->getMessage());    // Il arrête de lire le code qui suit et affiche ce qu'il y a entre les parenthèses
    }
?>