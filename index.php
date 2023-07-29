<?php
    require "connexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/style.css">
    <title>Mortal Kombat Accueil</title>
</head>
<body>
    <div class="slide" id="home">
        <header>
            <div class="wrapper">
                <img src="images/logo.png" alt="Logo Motal Kombat">
                <nav>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#pres">Présentation</a></li>
                        <li><a href="#perso">Personnages</a></li>
                        <li><a href="#galerie">Galerie</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </nav>
                <div id="burger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </header>
        <div class="logoH">
            <img src="images/dragon.png" alt="Image Dragon" id="dragon">
            <img src="images/mk11_logo.png" alt="Image Mortal kombat logo" id="logo">
        </div>
    </div>
    <div class="slide" id="pres">
        <div class="gifA"></div>
        <div class="presH">
            <div class="texte">
                <h3>Histoire</h3>
                <p>Après la défaite de Shinnok par Cassie Cage, Raiden, désormais corrompu, prévoit de protéger Le Royaume Terre en détruisant tous ses ennemis de toutes les manières possibles. Raiden décapite Shinnok, ce qui déclenche la réécriture de l'histoire par Kronika, gardienne du temps et mère de Shinnok, afin d'arrêter l'ingérence de Raiden. Une équipe de frappe des forces spéciales dirigée par Sonya Blade, Cassie et Jacqui Briggs attaque la cathédrale principale du royaume Nether. Raiden leur fournit une diversion, et l'équipe réussit à détruire la base au prix de la vie de Sonya. Kronika crée une alliance avec Liu Kang et Kitana avant de provoquer des anomalies temporelles.</p>
                <p>Kotal Kahn, l'actuel empereur de l'Outre-Monde, tente d'exécuter le Kollector, mais est interrompu par Kronika. Shao Kahn, Skarlet, Baraka et les versions plus jeunes de Kano, Erron Black, Jade, Raiden, Kitana, Liu Kang, Johnny Cage, Sonya, Jax, Scorpion et Kung Lao apparaissent sur une autre ligne du temps. La bataille dans l'arène de Kotal se termine lorsque D'Vorah transporte Baraka, Skarlet, Black, Shao Kahn et Kano dans sa ruche, les recrutant dans le giron de Kronika.</p>
                <p>Dark Raiden est effacé de son existence, laissant l'amulette de Shinnok derrière lui et étant remplacé par le Raiden du passé. Liu Kang, Kung Lao et Raiden se présentent à la base après avoir noué une alliance avec Kotal Kahn. Ils apprennent qu'il existe un signal d'énergie dans le cadre de la Wu Shi Academy. L'enquête de Liu Kang et Kung Lao mène à une bataille contre le bras droit de Kronika, Geras, et s'achève lorsque celui-ci s'évade, en contrôlant le temps lui-même, avec de puissantes capsules contenant l'énergie du Royaume Terre.</p>
                <p>Les forces spéciales apprennent que Sektor est en train de créer une cyber-armée pour Kronika. Sub-Zero et Hanzo Hasashi (anciennement Scorpion) sont envoyés sur les lieux. Avec l'aide de Cyrax, ils interrompent la cyber-initiative, forçant Geras et les deux versions de Kano à faire revivre Sektor et à reconstruire l'armée cybernétique.</p>
                <p>Raiden consulte les Dieux Anciens en espérant trouver de l'aide. Ils refusent de l'aider, mais Cetrion, la fille de Kronika, lui donne quelques astuces pour la vaincre. Kronika recrute le Jax actuel à ses côtés. Kotal Kahn et Jade se rendent dans un camp de Tarkatan afin de les éloigner de Shao Kahn, pour être capturés.</p>
                <p>La base des forces spéciales est détruite par les Black Dragons et les Cyber Lin-Kuei. Les versions plus jeunes de Johnny Cage et Sonya sont capturées. Cassie décide donc de monter une équipe afin de sauver ses parents, et Sonya tue la version plus jeune de Kano pour effacer son existence. Pendant ce temps, Kitana, Liu Kang et Kung Lao du passé tentent de convaincre Baraka dans le but de nouer une alliance avec les Tarkatans puis les Shokans, via leur reine Sheeva. Avec leur aide, Kitana achève Shao Kahn, unissant les factions de l’Outre-Monde et héritant du trône de Kotal par ce dernier, devenant ainsi «Kitana Kahn».</p>
                <p>Raiden envoie Jax et Jacqui chercher la couronne de Kronika puisant les âmes prisonnières sur l'île de Shang Tsung, mais ces derniers sont stoppés par Cetrion et le Jax actuel.</p>
            </div>
        </div>
    </div>
    <div class="blockP">
        <h4>Personnages</h4>
    </div>
    <div class="slide" id="perso">
        <?php
            $req = $bdd->query("SELECT * FROM personnages");
            while($don = $req->fetch())
            {
                echo "<a href='perso.php?id=".$don['id']."' class='perso'>";
                    echo "<img src='images/upload/".$don['image']."' alt='image de ".$don['name']."'>";
                    echo "<h5>".$don['name']."</h5>";
                echo "</a>";
            }
            $req->closeCursor();
        ?>
    </div>
    <div class="blockP">
        <h4>Galerie</h4>
    </div>
    <div class="slide" id="galerie">
        <div class="wrapper">
        <?php
            $req = $bdd->query("SELECT personnages.name,galerie.* FROM galerie INNER JOIN personnages ON personnages.id=galerie.idPerso");
            while($don = $req->fetch())
            {
                echo "<div class='perso'>";
                    echo "<img src='images/upload/".$don['fichier']."' alt='image de ".$don['name']."'>";
                    echo "<a href='perso.php?id=".$don['idPerso']."'>";
                        echo "<h5>".$don['name']."</h5>";
                    echo "</a>";
                    echo "<h6>Download</h6>";
                echo "</div>";
            }
            $req->closeCursor();
        ?>
        </div>
    </div>
    <div class="slide" id="contact">
        <div class="contact">
            <div class="wrapper">
                <h4>Contact</h4>
                <form action="traitement.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nom: </label>
                        <input type="text" name="name" id="name" placeholder="Cage">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom: </label>
                        <input type="text" name="firstname" id="firstname" placeholder="Johnny">
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" id="email" placeholder="raiden@mk11.com">
                    </div>
                    <div class="form-group">
                        <label for="message">Message: </label>
                        <textarea name="message" id="message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
        <div class="gifA"></div>
    </div>
    <footer>
        COPYRIGHT &copy; EPSE,2023
    </footer>
</body>
</html>