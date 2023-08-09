-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 09 août 2023 à 16:53
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mortalk`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$u/FCaiwp6ly7zBNjU7Y2duQo.ShCMDO6k7IO4jEpJ3w8oQEG7RW7K');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `firstname`, `email`, `message`) VALUES
(1, 'Cage', 'Johnny', 'raiden@mk11.com', 'Test'),
(6, 'test', 'test', 'test@hotmail.com', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

DROP TABLE IF EXISTS `galerie`;
CREATE TABLE IF NOT EXISTS `galerie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idPerso` int NOT NULL,
  `fichier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `galerie`
--

INSERT INTO `galerie` (`id`, `idPerso`, `fichier`) VALUES
(1, 8, '1352417360image1'),
(2, 8, '1378469107image1'),
(3, 2, '513046087image2'),
(4, 2, '675336530image2'),
(5, 3, '722268462image5'),
(6, 3, '862765536image5'),
(14, 7, '82402943524804858mini-1396642983subzero.jpg'),
(15, 7, '10177896371177416156raiden.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `personnages`
--

DROP TABLE IF EXISTS `personnages`;
CREATE TABLE IF NOT EXISTS `personnages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnages`
--

INSERT INTO `personnages` (`id`, `name`, `description`, `image`) VALUES
(1, 'Jax', 'Jax is a fictional character in the Mortal Kombat fighting game franchise by Midway Games and NetherRealm Studios. Introduced in Mortal Kombat II (1993) as the leader of a Special Forces unit, he became a mainstay of the series, including as the protagonist of the action-adventure spin-off Mortal Kombat: Special Forces (2000). The character is distinguished by his metal bionic arms, which he first received in Mortal Kombat 3 (1995), and his abilities are based around his upper-body strength.\r\n\r\nIn the games, Jax is first depicted as the commanding officer of Special Forces operative Sonya Blade and subsequently becomes one of the warriors defending Earthrealm from various threats. He is also depicted as a primary hero in various related media, including the 1996 animated series Mortal Kombat: Defenders of the Realm, the 1997 film Mortal Kombat: Annihilation, and the 2011 web series Mortal Kombat: Legacy. Reception to the character has been generally positive for his appearance and special moves. ', '1463581791jax'),
(2, 'Sub Zero', 'Sub-Zero est un personnage fictif de la série de jeu de combat Mortal Kombat. C&#039;est également le nom de code pour deux personnages. Tout d&#039;abord Bi-Han qui apparaît dans le premier Mortal Kombat sorti en 1992, devenant ensuite Noob Saibot. Puis son frère Kuai Liang, prenant sa place à partir de Mortal Kombat II sorti en 1993. Sub-Zero est un combattant possédant la capacité de contrôler la glace sous de nombreuses formes. ', '1396642983subzero'),
(3, 'Johnny Cage', 'Johnny Cage (29 ans) 1m69, est une star du cinéma américain. Mais la critique et le public pensent que ses talents de combattants sont le fruit de trucages. Pour prouver sa maîtrise des arts martiaux, Johnny participe au tournoi Mortal Kombat. Il devient l\'un des défenseurs du royaume de la Terre contre la menace d\'Outremonde. Matérialiste, il n\'en demeure pas moins un guerrier courageux et loyal. ', '1739137118johnyy'),
(4, 'Kabal', 'Kabal est un ancien membre du Black Dragon, il devient par la suite le partenaire de Stryker au sein de la S.W.A.T pour racheter ses fautes passées. Celui-ci est brulé à vif, il est alors récupéré par son ancien compère Kano qui à l&#039;aide de Shang Tsung le remet sur pied, le matériel respiratoire qu&#039;il porte est dû à la destruction de ses poumons. Cela lui a d’ailleurs donné deux fatalités: utiliser son tuba pour faire gonfler la tête de son ennemi et même se servir de son visage balafré comme d&#039;une arme pour faire mourir de peur son ennemi dont le fantôme s&#039;enfuit en courant. S&#039;il se bat aux côtés des forces de la lumière dans le 3, il reviendra aux côtés du Dragon Noir et se battra aux côtés des forces de l&#039;ombre. Il mourra aussi avec les autres.\r\nDans MK9, MKX et MK11 il réapparaît, mais en tant que mort-vivant qui se bat pour Shinnok. ', '1433770228kabal'),
(5, 'Liu Kang', 'Disciple et descendant de Great Kung Lao, ce moine Shaolin de 24 ans appartenant au Lotus Blanc avait été entrainé par Bo\' Rai Cho. Il s\'illustra en battant Shang Tsung lors du premier tournoi en utilisant le \"flying kick\" ou coup de pied volant. Ses techniques ont été inspirées de celles de Bruce Lee.', '644492388liukang'),
(6, 'Sonya', 'Sonya Blade (appelée parfois Lt. Sonya Blade ou tout simplement Sonya) est un personnage de jeu vidéo dans la série Mortal Kombat.\r\n\r\nElle est la première combattante, les précédents personnages étant des hommes (Kitana n\'apparaîtra que dans le second épisode). Elle est Lieutenant dans les Special Forces.\r\n\r\nC\'est une alliée de Jax, lui aussi membre des forces spéciales des États-Unis. Par ailleurs dans les films et la bande-dessinée on apprend qu\'elle a de l\'attirance pour Johnny Cage.\r\n\r\nElle a été créée à partir de l\'actrice Cynthia Rothrock.', '1681236601sonya'),
(7, 'Raiden', 'Raiden (aussi connu sous le nom de Lord Raiden, et parfois épelé Rayden) est un personnage fictif de la série de jeu de combat Mortal Kombat. Raiden est un des sept personnages originaux provenant du premier Mortal Kombat sorti en 1992, il est l&#039;un des personnages centraux de la franchise1. Basé sur le dieu du tonnerre japonais, Raijin, et décrit dans la série comme étant le dieu du tonnerre et le protecteur de la Terre, Raiden défend la planète contre une multitude de menaces d&#039;un autre monde aux côtés de ses guerriers triés sur le volet. Raiden possède de nombreux pouvoirs, tels que la téléportation, le vol, le contrôle des éléments.\r\n\r\nRaiden est un personnage phare de la série, facilement reconnaissable. Il apparaît dans tous les épisodes principaux de la série à l&#039;exception de Mortal Kombat 3 et Ultimate Mortal Kombat 3. Dans le crossover Mortal Kombat vs. DC Universe, il fait partie des onze personnages de la franchise Mortal Kombat pour représenter l&#039;univers. Raiden est également présent dans le casting du jeu de combat Injustice 2 disponible via contenu téléchargeable, son design est réalisé par l&#039;artiste Jim Lee2,3.\r\n\r\nRaiden a une forte présence dans les autres médias de la franchise, incluant les trois longs-métrages (Mortal Kombat, Mortal Kombat : Destruction finale et Mortal Kombat 2021), la série d&#039;animation Mortal Kombat : Les Gardiens du royaume, la série télévisée Mortal Kombat: Conquest, la web-série Mortal Kombat: Legacy en plus de figurer sur les produits dérivés de la série officielle.\r\n\r\nEd Boon dit : « Raiden est basé sur un personnage du film Big Trouble in Little China4. » ', '1177416156raiden'),
(8, 'Scorpion', 'Scorpion est l&#039;un des personnages originaux de la série, apparaissant dans le premier Mortal Kombat sorti en 19922. Il fait partie des personnages les plus populaires de la série aux côtés de Sub Zero, il apparaît notamment sur les couvertures de Mortal Kombat X et Mortal Kombat 113,4. En tant que personnage jouable, Scorpion est présent dans tous les Mortal Kombat de la série, à l&#039;exception de Mortal Kombat 3, où il apparaît un peu plus tard dans la mise à jour intitulée Ultimate Mortal Kombat 3.\r\n\r\nScorpion est un personnage central dans l&#039;intrigue de la franchise où il est opposé directement à Sub-Zero. Les deux personnages forment un archétype de ninjas qui donneront vie à de nouveaux personnages durant les trois premiers épisodes (Smoke, Noob Saibot, Reptile, Rain, Ermac et Chameleon). Ces personnages possèdent tous la même tenue de combat au début de la série, pour des raisons de budget. Ils sont principalement différenciés par des palettes de couleurs. Scorpion a reçu une palette jaune et les développeurs ont décidé qu&#039;elle symboliserait le feu comme l&#039;exact opposé du bleu glacé de Sub-Zero, ce « qui a donné lieu à l&#039;histoire de ces personnages opposés de type clan ninja »5.\r\n\r\nSon modèle commence à évoluer dès Mortal Kombat 4 et les personnages ninjas gagnent en détails, Scorpion reçoit deux épées katana attachées à son dos dans Mortal Kombat: Deadly Alliance et un ensemble d&#039;épaulettes ornées dans Mortal Kombat: Mystification6. ', '192732199scorpion');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
