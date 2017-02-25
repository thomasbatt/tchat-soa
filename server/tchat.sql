-- phpMyAdmin SQL Dump
-- version 4.5.5
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 13 Mars 2016 à 22:45
-- Version du serveur :  5.6.28-0ubuntu0.15.10.1
-- Version de PHP :  5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(10) UNSIGNED NOT NULL,
  `idUser_message` bigint(10) UNSIGNED NOT NULL,
  `content_message` varchar(1023) NOT NULL,
  `create_message` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `idUser_message`, `content_message`, `create_message`) VALUES
(1, 1, 'Message de thomas', '2016-03-09 21:43:06'),
(2, 1, 'Message de thomas', '2016-03-09 21:43:15'),
(3, 1, 'Message de thomas', '2016-03-09 21:47:44'),
(4, 1, 'Message de thomas', '2016-03-09 21:48:08'),
(5, 1, 'Message de thomas', '2016-03-09 21:53:58'),
(6, 1, 'wegfsdf', '2016-03-09 22:13:42'),
(7, 1, 'Messdfsdv', '2016-03-09 22:13:48'),
(8, 1, 'eagdg', '2016-03-09 22:15:04'),
(9, 1, 'dsgbdfb', '2016-03-09 22:15:08'),
(10, 1, 'Messavxgnfg', '2016-03-09 22:19:07'),
(11, 1, 'Message de thodf gsdh gmas', '2016-03-09 22:19:12'),
(12, 1, 'Medtrhgdfgsdssage de thomas', '2016-03-09 22:22:37'),
(13, 1, 'Message de thomas', '2016-03-09 22:26:00'),
(14, 1, 'Message aerrgaerg aerrg ear ger gra ghsrth srth srt hrs', '2016-03-09 22:26:08'),
(15, 1, 'Messdg df grdsage de thomas', '2016-03-09 22:26:18'),
(16, 1, 'Message de thomas', '2016-03-09 22:55:38'),
(17, 1, 'Message de thomas', '2016-03-09 23:10:12'),
(18, 1, 'Message de thomas', '2016-03-09 23:17:34'),
(19, 1, 'Message de thomas', '2016-03-09 23:17:41'),
(20, 1, 'Messagrherg ere de thomas', '2016-03-09 23:34:05'),
(21, 1, 'Message de thomas ery ery er y', '2016-03-09 23:34:11'),
(22, 1, 'Message de thomakg kug s', '2016-03-09 23:39:35'),
(23, 1, 'Message de thomaiugh iuhgs', '2016-03-09 23:44:19'),
(24, 1, 'Ã±ohjÃ±ohjoÃ±', '2016-03-09 23:44:23'),
(25, 1, 'lyglyglih liuh li', '2016-03-09 23:44:36'),
(26, 1, '{ojÃ±jhlnl{Ã±kn', '2016-03-09 23:44:40'),
(27, 1, 'lyglyufvl luh liug ', '2016-03-09 23:45:10'),
(28, 1, 'hgvluhvlh', '2016-03-09 23:45:13'),
(29, 1, 'Ã±iuglygv', '2016-03-09 23:45:19'),
(30, 1, 'Message de thomas', '2016-03-09 23:45:25'),
(31, 1, 'ouyfkuf', '2016-03-09 23:47:03'),
(32, 1, ',jhg,jyg', '2016-03-09 23:52:39'),
(33, 1, 'coucou', '2016-03-11 20:58:06'),
(34, 1, 'tu es la?', '2016-03-11 20:58:32'),
(35, 1, 'youhooooooo', '2016-03-11 20:58:41'),
(36, 6, 'hola', '2016-03-11 20:58:46'),
(37, 1, 'aaaaaa', '2016-03-11 20:58:51'),
(38, 1, 'c est mieux', '2016-03-11 20:58:59'),
(39, 6, 'ca va?', '2016-03-11 20:58:59'),
(40, 1, 'oui tres bien :)', '2016-03-11 20:59:10'),
(41, 6, 'ca me fait plaisir de te parler', '2016-03-11 20:59:20'),
(42, 6, 'c\'est drole etre par ici :p', '2016-03-11 20:59:29'),
(43, 1, 'par ou ?', '2016-03-11 20:59:40'),
(44, 6, 'par ce chat ', '2016-03-11 20:59:49'),
(45, 1, 'faut encore que je repare le beug a droite qui est tout orange ....', '2016-03-11 21:00:14'),
(46, 6, 'c\'est quoi?', '2016-03-11 21:00:26'),
(47, 1, 'Fatal error: Call to a member function fetchObject() on boolean in /var/www/html/tchat/MODULE/USER/MODEL/UserManager.class.php on line 72', '2016-03-11 21:00:28'),
(48, 1, 'du dev', '2016-03-11 21:00:44'),
(49, 6, 'ca te dirai de se voi?', '2016-03-11 21:00:55'),
(50, 6, 'voir ', '2016-03-11 21:01:00'),
(51, 1, ':*', '2016-03-11 21:01:06'),
(52, 6, 'Fatal error: Call to undefined method UserManager::getAll() in /var/www/html/tchat/MODULE/USER/APPS/list_', '2016-03-11 21:16:46'),
(53, 6, 'Fatal error: Call to undefined method UserManager::getAll() in /var/www/html/tchat/MODULE/USER/APPS/list_users.php on line 3 Call Stack', '2016-03-11 21:17:04'),
(54, 6, 'Fatal error: Call to a member function fetchObject() on boolean in /var/www/html/tchat/MODULE/USER/MODEL/UserManager.class.php on line 72', '2016-03-11 21:19:54'),
(55, 6, 'Fatal error: Call to a member function fetchObject() on boolean in /var/www/html/tchat/MODULE/USER/MODEL/UserManager.class.php on line 70', '2016-03-11 21:23:10'),
(56, 4, 'coucou', '2016-03-11 21:40:55'),
(57, 4, 'tu es la?', '2016-03-11 21:40:59'),
(58, 1, 'tu reponds pas azu?', '2016-03-11 21:41:39'),
(59, 1, 'he hooooooo !!!', '2016-03-11 21:41:52'),
(60, 4, 'c est qui azu?', '2016-03-11 21:42:05'),
(61, 6, 'hola', '2016-03-11 21:42:20'),
(62, 4, 'salut azu', '2016-03-11 21:42:30'),
(63, 6, 'moi c\'est azu', '2016-03-11 21:42:31'),
(64, 6, 'salut', '2016-03-11 21:42:42'),
(65, 1, 'guillaume je presente azu', '2016-03-11 21:42:51'),
(66, 6, 'ca va?', '2016-03-11 21:42:53'),
(67, 4, 'enchantÃ©Ã©', '2016-03-11 21:43:06'),
(68, 6, ';)', '2016-03-11 21:43:09'),
(69, 4, 'thomas tu es pas ko', '2016-03-11 21:43:26'),
(70, 1, 'si je vais me coucher', '2016-03-11 21:43:36'),
(71, 6, ':)', '2016-03-11 21:43:42'),
(72, 6, 'on se vu a la gare guillaume', '2016-03-11 21:44:09'),
(73, 4, 'aaaaaa oui c,est vrai', '2016-03-11 21:44:22'),
(74, 6, ';)', '2016-03-11 21:44:33'),
(75, 1, 'oui tu te souviens meme pas ', '2016-03-11 21:44:49'),
(76, 6, 'tu dors guio?', '2016-03-11 21:45:58'),
(77, 6, 'en fait je pense que thomas me fait marcher ', '2016-03-11 21:48:09'),
(78, 6, 'je crois que cÃ©st lui qui ecris en ton nom', '2016-03-11 21:48:43'),
(79, 6, 'c\'est vrai?', '2016-03-11 21:48:49'),
(80, 1, 'coucou', '2016-03-12 15:14:35'),
(84, 11, 'juste un petit test pour voir ma couleur', '2016-03-12 21:39:15'),
(86, 13, 'est ce que ca va encore donner une nuance de bleu...', '2016-03-12 21:42:48'),
(87, 14, 'un dernier test apres ca me saoul.', '2016-03-12 21:45:50');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `login_user` varchar(31) NOT NULL,
  `hash_user` varchar(511) NOT NULL,
  `color_user` varchar(7) NOT NULL,
  `create_user` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isAdmin_user` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `login_user`, `hash_user`, `color_user`, `create_user`, `update_user`, `isAdmin_user`) VALUES
(1, 'thomas', '$2y$12$W2I2LZCZn7NtPfbMyQHNZumWUyCur2wD5Rv/1wmxSaFeubRqu0hse', '#dca1FF', '2016-03-08 19:38:08', '2016-03-12 22:02:42', 0),
(4, 'guillaume', '$2y$12$GlHFx8AzthIK34gZcsV8keQSlBETjfEE57A3zdCkiXCgf3VoxlL.K', '#9546FF', '2016-03-08 22:06:12', '2016-03-12 21:38:41', 0),
(6, 'azul', '$2y$12$fYskeImiiYTbHL5g5i9PleKcKHh/gVi/KWwczmJpjvKJsRj.ZdPBu', '#2a83FF', '2016-03-11 20:58:15', '2016-03-11 22:23:52', 0),
(11, 'romain', '$2y$12$dHoIUPdYBzEMriIQ9JQRmu/cXwFqu9lAicwHGiHf3f31ukq/lbh4q', '#fe56FF', '2016-03-12 21:38:56', '2016-03-12 21:39:24', 0),
(13, 'pascal', '$2y$12$XwrAXYL/4vHYvkWHCJWMP.KSEBHgG4vwT5lT/bSceFONexQ8xITsW', '#e812d7', '2016-03-12 21:42:33', '2016-03-12 21:43:07', 0),
(14, 'marion', '$2y$12$4GLx5NsjEjpbJ9ZBfM5diuYSrAuAHhSIv64gFZVHPgHbSYvHM28yy', '#9056f6', '2016-03-12 21:45:30', '2016-03-12 21:45:52', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `author_message` (`idUser_message`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_author_id` FOREIGN KEY (`idUser_message`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
