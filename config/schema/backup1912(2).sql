-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 déc. 2023 à 10:16
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crest`
--

-- --------------------------------------------------------

--
-- Structure de la table `closing_dates`
--

CREATE TABLE `closing_dates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `home_text` longtext DEFAULT NULL,
  `home_picture` varchar(255) DEFAULT NULL,
  `home_picture_path` varchar(255) DEFAULT NULL,
  `reminder_mail_text` longtext DEFAULT NULL,
  `reminder_mail_object` varchar(255) DEFAULT NULL,
  `send_mail_resa_admin` tinyint(1) NOT NULL DEFAULT 0,
  `send_mail_edit_resa_admin` tinyint(1) NOT NULL DEFAULT 0,
  `send_mail_delete_resa_admin` tinyint(1) NOT NULL DEFAULT 0,
  `send_mail_resa_user` tinyint(1) NOT NULL DEFAULT 0,
  `send_mail_edit_resa_user` tinyint(1) NOT NULL DEFAULT 0,
  `send_mail_delete_resa_user` tinyint(1) NOT NULL DEFAULT 0,
  `send_mail_back_resa_user` tinyint(1) NOT NULL DEFAULT 0,
  `send_mail_resa_admin_object` varchar(255) NOT NULL,
  `send_mail_resa_admin_text` longtext NOT NULL,
  `send_mail_edit_resa_admin_object` varchar(255) NOT NULL,
  `send_mail_edit_resa_admin_text` longtext NOT NULL,
  `send_mail_delete_resa_admin_object` varchar(255) NOT NULL,
  `send_mail_delete_resa_admin_text` longtext NOT NULL,
  `send_mail_resa_user_object` varchar(255) NOT NULL,
  `send_mail_resa_user_text` longtext NOT NULL,
  `send_mail_edit_resa_user_object` varchar(255) NOT NULL,
  `send_mail_edit_resa_user_text` longtext NOT NULL,
  `send_mail_delete_resa_user_object` varchar(255) NOT NULL,
  `send_mail_delete_resa_user_text` longtext NOT NULL,
  `send_mail_back_resa_user_object` varchar(255) NOT NULL,
  `send_mail_back_resa_user_text` longtext NOT NULL,
  `mail_protocol` varchar(255) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `open_monday` tinyint(1) DEFAULT 1,
  `open_tuesday` tinyint(1) DEFAULT 1,
  `open_wednesday` tinyint(1) DEFAULT 1,
  `open_thursday` tinyint(1) DEFAULT 1,
  `open_friday` tinyint(1) DEFAULT 1,
  `start_hour_monday` varchar(5) DEFAULT NULL,
  `end_hour_monday` varchar(5) DEFAULT NULL,
  `start_hour_tuesday` varchar(5) DEFAULT NULL,
  `end_hour_tuesday` varchar(5) DEFAULT NULL,
  `start_hour_wednesday` varchar(5) DEFAULT NULL,
  `end_hour_wednesday` varchar(5) DEFAULT NULL,
  `start_hour_thursday` varchar(5) DEFAULT NULL,
  `end_hour_thursday` varchar(5) DEFAULT NULL,
  `start_hour_friday` varchar(5) DEFAULT NULL,
  `end_hour_friday` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `configuration`
--

INSERT INTO `configuration` (`id`, `name`, `home_text`, `home_picture`, `home_picture_path`, `reminder_mail_text`, `reminder_mail_object`, `send_mail_resa_admin`, `send_mail_edit_resa_admin`, `send_mail_delete_resa_admin`, `send_mail_resa_user`, `send_mail_edit_resa_user`, `send_mail_delete_resa_user`, `send_mail_back_resa_user`, `send_mail_resa_admin_object`, `send_mail_resa_admin_text`, `send_mail_edit_resa_admin_object`, `send_mail_edit_resa_admin_text`, `send_mail_delete_resa_admin_object`, `send_mail_delete_resa_admin_text`, `send_mail_resa_user_object`, `send_mail_resa_user_text`, `send_mail_edit_resa_user_object`, `send_mail_edit_resa_user_text`, `send_mail_delete_resa_user_object`, `send_mail_delete_resa_user_text`, `send_mail_back_resa_user_object`, `send_mail_back_resa_user_text`, `mail_protocol`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `open_monday`, `open_tuesday`, `open_wednesday`, `open_thursday`, `open_friday`, `start_hour_monday`, `end_hour_monday`, `start_hour_tuesday`, `end_hour_tuesday`, `start_hour_wednesday`, `end_hour_wednesday`, `start_hour_thursday`, `end_hour_thursday`, `start_hour_friday`, `end_hour_friday`) VALUES
(1, 'crest_default_config', '<ul>\r\n<li id=\"module-224481\" class=\"activity fullwidth label modtype_label  launch-tiles-standard position-relative  completeonmanual\" tabindex=\"3\" data-modtype=\"label\" data-cmid=\"224481\" data-modinstance=\"58453\" data-title=\"Le CREST est ferm&eacute;.Il rouvrira en septembre 2023.B...\">\r\n<div id=\"yui_3_17_2_1_1689086075194_36\" class=\"mod-indent-outer\">\r\n<div id=\"yui_3_17_2_1_1689086075194_35\" class=\"\">\r\n<div id=\"yui_3_17_2_1_1689086075194_34\" class=\"no-overflow\">\r\n<div id=\"yui_3_17_2_1_1689086075194_33\" class=\"no-overflow\">\r\n<h4 id=\"yui_3_17_2_1_1689086075194_32\" dir=\"ltr\" style=\"text-align: left;\"><strong>le CREST est ferm&eacute;.</strong></h4>\r\n<h4 dir=\"ltr\" style=\"text-align: left;\"><strong>Il rouvrira en septembre 2024.</strong></h4>\r\n<h4 dir=\"ltr\" style=\"text-align: left;\"><strong>Bonnes vacances !</strong></h4>\r\n<p>&nbsp;</p>\r\n<h3><strong>Horaires du CREST :</strong></h3>\r\n<h4 dir=\"ltr\" style=\"text-align: left;\"><span style=\"font-size: 18pt;\">$horaires</span></h4>\r\n<p>&nbsp;</p>\r\n<h4 dir=\"ltr\" style=\"text-align: left;\"><strong><span class=\"\" style=\"color: rgb(239, 69, 64);\"><span class=\"\" style=\"color: rgb(125, 159, 211);\">LE CREST ne pr&ecirc;te plus de mat&eacute;riel aux personnes ext&eacute;rieures &agrave; l\'UGA.</span><br></span></strong></h4>\r\n</div>\r\n</div>\r\n<span id=\"label_content_224481\" class=\"label_content  completeonmanual\"></span></div>\r\n</div>\r\n</li>\r\n<li id=\"module-202111\" class=\"activity fullwidth label modtype_label  launch-tiles-standard position-relative  completeonmanual\" tabindex=\"3\" data-modtype=\"label\" data-cmid=\"202111\" data-modinstance=\"53252\" data-title=\"LE CREST ne pr&ecirc;te plus de mat&eacute;riel aux personnes e...\">\r\n<div class=\"mod-indent-outer\">\r\n<div class=\"\">\r\n<div class=\"no-overflow\">\r\n<div class=\"no-overflow\">\r\n<p><strong><span class=\"\" style=\"color: rgb(125, 159, 211);\">&Eacute;tudiant(e)s, enseignant(e)s de l\'UGA, le Centre de Ressources pour l&rsquo;Enseignement des Sciences et de la Technologie (CREST) est pour vous&nbsp;!</span></strong></p>\r\n<dl>\r\n<dt>Je suis</dt>\r\n<dd>\r\n<ul>\r\n<li>&eacute;tudiant(e) inscrit(e) &agrave; l&rsquo;Institut National du Professorat et de l&rsquo;&Eacute;ducation (INSP&Eacute;) ou dans un autre &eacute;tablissement de l\'EPE UGA</li>\r\n<li>enseignant(e) &agrave; l\'EPE UGA</li>\r\n</ul>\r\n</dd>\r\n<dt>J&rsquo;y trouve</dt>\r\n<dd>des ressources &ndash; mat&eacute;riels, documents - pour faire des sciences et de la technologie en classe ou en formation.</dd>\r\n<dt>J\'emprunte</dt>\r\n</dl>\r\n<ul>\r\n<li>gratuitement</li>\r\n<li>sur simple inscription</li>\r\n<li>pour une dur&eacute;e allant jusqu\'&agrave; 6 semaines (4 pour la robotique)</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n<span id=\"label_content_202111\" class=\"label_content  completeonmanual\"></span></div>\r\n</div>\r\n</li>\r\n<li id=\"module-202108\" class=\"activity fullwidth label modtype_label  launch-tiles-standard position-relative  completeonmanual\" tabindex=\"3\" data-modtype=\"label\" data-cmid=\"202108\" data-modinstance=\"53249\" data-title=\"Le CREST : un Centre de Ressource pour l\'Enseignem...\">\r\n<div class=\"mod-indent-outer\">\r\n<div class=\"\">\r\n<div class=\"no-overflow\">\r\n<div class=\"no-overflow\">\r\n<p dir=\"ltr\" style=\"text-align: left;\"><u><strong>Le CREST : un Centre de Ressource pour l\'Enseignement des Sciences et des Techniques</strong></u></p>\r\n<p dir=\"ltr\" style=\"text-align: left;\">L&rsquo;&eacute;panouissement d&rsquo;une culture scientifique et technologique partag&eacute;e est une cl&eacute; pour l&rsquo;ouverture au monde. La formation d&rsquo;enseignants capables de contribuer &agrave; l&rsquo;acquisition d&rsquo;une pens&eacute;e rationnelle et critique est essentielle pour la formation des citoyens. Elle s&rsquo;inscrit r&eacute;solument dans les missions de l&rsquo;Institut National Sup&eacute;rieur du Professorat et de l\'Education (INSPE). Pour y contribuer, le Centre de Ressources pour l&rsquo;Enseignement des Sciences et de la Technologie (C.R.E.S.T.) promeut un enseignement des sciences et de la technologie fond&eacute; sur l&rsquo;investigation.</p>\r\n<p>Afin de soutenir la mise en &oelig;uvre de pratiques d\'enseignement des sciences fond&eacute;es sur l\'investigation, l<strong>e CREST met &agrave; disposition gratuitement des ressources mat&eacute;rielles, scientifiques, didactiques et p&eacute;dagogiques</strong>. Il offre une plateforme mutualis&eacute;e de ressources documentaires scientifiques, didactiques et p&eacute;dagogiques associ&eacute;es &agrave; des ressources mat&eacute;rielles pour la classe. Les utilisateurs disposent de documents p&eacute;dagogiques et didactiques et peuvent y emprunter du mat&eacute;riel utile pour la mise en &oelig;uvre de s&eacute;quences &agrave; dimension exp&eacute;rimentale . Un large &eacute;ventail est propos&eacute; pour enseigner les sciences (physique, chimie, technologie, sciences de la vie et de la Terre) de la maternelle au lyc&eacute;e.<br><strong>Le C.R.E.S.T. s&rsquo;adresse &agrave; l\'ensemble des &eacute;tudiant(e)s et enseignant(e)s de l\'EPE UGA et en particulier &agrave; ceux de l\'INSPE.</strong></p>\r\n<p>Responsable du CREST : Evelyne Chevigny</p>\r\n<p>Adresse email : inspe-crest@univ-grenoble-alpes.fr</p>\r\n<p>Num&eacute;ro de t&eacute;l&eacute;phone (uniquement sur les cr&eacute;neaux d\'ouverture du CREST) : 04 56 52 07 82</p>\r\n<p>Adresse :</p>\r\n<p>CREST - INSPE - Salle J010</p>\r\n<p><span id=\"bureauId\">B&acirc;timent Berg&egrave;s</span><span id=\"bureauId\"><span id=\"addressgeoId\"></span></span><span id=\"addressgeoId\"></span><span id=\"addressgeoId\"><br></span></p>\r\n<p><span id=\"addressgeoId\">1025 avenue de la piscine</span><span id=\"addressgeoId\"><br></span></p>\r\n<p><span id=\"addressgeoId\">38610 Gi&egrave;res</span></p>\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n<span id=\"label_content_202108\" class=\"label_content  completeonmanual\"></span></div>\r\n</div>\r\n</li>\r\n<li id=\"module-202110\" class=\"activity fullwidth label modtype_label  launch-tiles-standard position-relative  completeonmanual\" tabindex=\"3\" data-modtype=\"label\" data-cmid=\"202110\" data-modinstance=\"53251\" data-title=\"Modalit&eacute;s d\'empruntPour emprunter une mallette :Co...\">\r\n<div class=\"mod-indent-outer\">\r\n<div class=\"\">\r\n<div class=\"no-overflow\">\r\n<div class=\"no-overflow\">\r\n<p dir=\"ltr\" style=\"text-align: left;\"><strong>Modalit&eacute;s d\'emprunt</strong></p>\r\n<p dir=\"ltr\" style=\"text-align: left;\">Pour emprunter une mallette :</p>\r\n<div>\r\n<ul>\r\n<li>Consultez le catalogue (ci-dessous)</li>\r\n<li>V&eacute;rifiez que la mallette souhait&eacute;e est disponible aux dates souhait&eacute;es. Pour cela, consulter la page suivante (il y a un onglet par domaine) :</li>\r\n</ul>\r\n<a href=\"https://cloud.univ-grenoble-alpes.fr/s/zwAYbb7XtNqairK\" target=\"_blank\" rel=\"noopener\">Disponibilit&eacute; des mallettes</a><br><br>\r\n<ul>\r\n<li>R&eacute;servez (<span id=\"label_content_202111\">dur&eacute;e maximum : 6 semaines, 4 semaines pour la robotique) :&nbsp; </span></li>\r\n</ul>\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - &eacute;crivez un mail &agrave; inspe-crest@univ-grenoble-alpes.fr en indiquant pr&eacute;cis&eacute;ment le nom de la mallette, les dates d\'emprunt, vos nom et pr&eacute;nom ;</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - t&eacute;l&eacute;phonez au 04 56 52 07 82 (pendant les horaires d\'ouverture du CREST) ;</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - venez sur place pendant les permanences.</div>\r\n<div>\r\n<ul>\r\n<li>Venez chercher la mallette <strong>pendant </strong><strong>les plages d\'ouverture</strong> : salle J0010, B&acirc;timent Berg&egrave;s, 1025 rue de la piscine, sur le campus de l\'UGA.</li>\r\n</ul>\r\n</div>\r\n<div><strong>Horaires d\'ouverture du CREST :</strong></div>\r\n<ul>\r\n<li>lundi : 12h00-13h30 et 17h00-18h30</li>\r\n<li>mardi : 12h00-13h30</li>\r\n<li>mercredi : 17h00-18h30</li>\r\n<li>jeudi : 12h00-13h30</li>\r\n<li>vendredi : 12h00-13h30 <span class=\"\" style=\"color: rgb(239, 69, 64);\">(et les 9 et 16 juin de 17h00 &agrave; 18h30)</span></li>\r\n</ul>\r\n<div><strong>Le CREST est ferm&eacute; pendant les vacances scolaires.</strong></div>\r\n<div>&nbsp;</div>\r\n<div><strong><span class=\"\" style=\"color: rgb(239, 69, 64);\">Lors du premier emprunt, il vous sera demand&eacute; de proc&eacute;der &agrave; l\'inscription </span></strong><span class=\"\" style=\"color: rgb(239, 69, 64);\">(gratuite). </span><strong><span class=\"\" style=\"color: rgb(239, 69, 64);\">Vous devez pouvoir justifier de votre appartenance &agrave; l\'EPE UGA </span></strong><span class=\"\" style=\"color: rgb(239, 69, 64);\">(carte d\'&eacute;tudiant ou carte professionnelle).</span></div>\r\n<br>\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n<span id=\"label_content_202110\" class=\"label_content  completeonmanual\"></span></div>\r\n</div>\r\n</li>\r\n<li id=\"module-202113\" class=\"activity fullwidth label modtype_label  launch-tiles-standard position-relative  completeonmanual\" tabindex=\"3\" data-modtype=\"label\" data-cmid=\"202113\" data-modinstance=\"53253\" data-title=\"CATALOGUELes ressources sont class&eacute;es par domaine.\">\r\n<div class=\"mod-indent-outer\">\r\n<div class=\"\">\r\n<div class=\"no-overflow\">\r\n<div class=\"no-overflow\">\r\n<h4><strong><span class=\"\" style=\"color: rgb(239, 69, 64);\">CATALOGUE</span></strong></h4>\r\n<div>Les ressources sont class&eacute;es par domaine.</div>\r\n</div>\r\n</div>\r\n<span id=\"label_content_202113\" class=\"label_content  completeonmanual\"></span></div>\r\n</div>\r\n</li>\r\n</ul>', 'Bandeau CREST.png', '13265924864aec938611f06.55873404Bandeau CREST.png', '<p>Bonjour <strong>$firstname&nbsp; $lastname</strong>,<br>Vous recevez ce mail car &nbsp;votre r&eacute;servation <strong>n&deg;$id</strong> pour la ressource&nbsp; <strong>$resource </strong>du&nbsp; <strong>$start</strong> au&nbsp; <strong>$end</strong> est arriv&eacute;e &agrave; son terme. Merci de penser &agrave; rapporter celle-ci au CREST.</p>\r\n<p>Pour rappel, les heures d\'ouverture du CREST sont :<br><strong>$horaires</strong></p>\r\n<p>Bien &agrave; vous.</p>', '[CREST - $resource] Une de vos réservation est arrivée à son terme !', 0, 0, 0, 0, 0, 0, 0, '[CREST - $resource] - Nouvelle réservation', '<p>Bonjour<strong>,</strong></p>\r\n<p>$firstname $lastname (<strong>$login</strong>) a cr&eacute;&eacute; une r&eacute;servation (<strong>n&deg;$id</strong>) pour la ressource <strong>$resource</strong> du <strong>$start</strong> au <strong>$end</strong>.</p>', '[CREST - Réservation n°$id] - Modification de réservation', '<p>Bonjour,</p>\r\n<p>La r&eacute;servation <strong>n&deg;$id</strong> a &eacute;t&eacute; modifi&eacute;e en :</p>\r\n<p><strong>Ressource : </strong>$resource</p>\r\n<p><strong>Utilisateur : </strong>$firstname $lastname ($login)</p>\r\n<p><strong>Date de d&eacute;but :</strong> $start</p>\r\n<p><strong>Date de fin :</strong> $end</p>', '[CREST - Réservation n°$id] - Suppression de réservation', '<p>Bonjour,</p>\r\n<p>La r&eacute;servation <strong>n&deg;$id&nbsp;</strong>de l\'utilisateur $firstname $lastname concernant la resource <strong>$resource</strong> du <strong>$start </strong>au <strong>$end</strong> a &eacute;t&eacute; supprim&eacute;e.</p>', '[CREST] - Confirmation de votre réservation', '<p>Bonjour $firstname $lastname,</p>\r\n<p>Nous vous confirmons la cr&eacute;ation de la r&eacute;servation <strong>n&deg;$id</strong> pour la resource<strong> $resource</strong> du <strong>$start</strong> au <strong>$end</strong>.</p>\r\n<p>Pour rappel, les heures d\'ouverture du CREST sont :<br><strong>$horaires</strong></p>\r\n<p>Bien &agrave; vous.</p>', '[CREST] Modification de réservation', '<p>Bonjour $firstname $lastname,</p>\r\n<p>Votre r&eacute;servation <strong>n&deg;$id</strong> a bien &eacute;t&eacute; modifi&eacute;e. Elle concernera la resource <strong>$resource</strong> du <strong>$start</strong> au <strong>$end</strong>.</p>\r\n<p>Bien &agrave; vous.</p>', '[CREST] - Suppression de réservation', '<p>Bonjour $firstname $lastname,</p>\r\n<p>Votre r&eacute;servation <strong>n&deg;$id</strong> pour la resource <strong>$resource</strong> du <strong>$start </strong>au <strong>$end </strong>a &eacute;t&eacute; supprim&eacute;e.</p>\r\n<p>Bien &agrave; vous.</p>', '[CREST] Changement de statut sur une de vos réservation', '<p>Bonjour $firstname $lastname,</p>\r\n<p>Votre r&eacute;servation <strong>n&deg;$id</strong> concernant la ressource <strong>$resource</strong> du <strong>$start </strong>au <strong>$end</strong> a &eacute;t&eacute; d&eacute;finie comme <strong>$back</strong>.</p>\r\n<p>Bien &agrave; vous.</p>', 'Smtp', 'sandbox.smtp.mailtrap.io', '2525', '8712408a9d7e90', 'f1686438a41698', 1, 1, 1, 1, 0, '13h30', '14h00', '13h30', '14h00', '08h00', '12h00', '13h30', '14h00', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `domains`
--

CREATE TABLE `domains` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `domains`
--

INSERT INTO `domains` (`id`, `name`, `picture`, `picture_path`, `description`) VALUES
(11, 'Robotique', 'Shadow_Hand_Bulb_large.jpg', '181681185764aecb52c277f7.44845316Shadow_Hand_Bulb_large.jpg', '<p>Ceci est un <strong><span style=\"color: rgb(53, 152, 219);\">domaine qui repr&eacute;sente la <span style=\"font-family: impact, sans-serif;\">robotique</span></span></strong></p>'),
(12, 'Matière', '440px-Ripples.jpg', '204404355064aecb5de8de21.91469370440px-Ripples.jpg', ''),
(13, 'Signal et information', 'EdisonPhonograph.jpg', '10477859964aecb769c9ad5.55172525EdisonPhonograph.jpg', ''),
(14, 'Lumière, Astronomie', 'Omega_Nebula.jpg', '118848740864aecb85d74932.77417084Omega_Nebula.jpg', ''),
(15, 'Energie et mouvement', '720px-Lightning_over_Oradea_Romania_2.jpg', '19388197664aecb90f0b9e8.14593461720px-Lightning_over_Oradea_Romania_2.jpg', ''),
(16, 'Electricité', '1084px-Batterijen.jpg', '108105820464aecb9d85e970.172508281084px-Batterijen.jpg', ''),
(17, 'Monde des objets', '1440px-Nepal_Himalaya_Pavillon_Wiesent_12(1).jpg', '78675076264aecbb393f754.564606651440px-Nepal_Himalaya_Pavillon_Wiesent_12(1).jpg', ''),
(18, 'Construction et mécanisme', '1626px-Lego_Space.jpg', '108661916064aecbc47ab9d0.511328591626px-Lego_Space.jpg', ''),
(19, 'Découverte sensorielle', 'Sommelier_F.I.S.A.R..jpg', '199119557664aecbdbdede60.51088324Sommelier_F.I.S.A.R..jpg', ''),
(20, 'Etre vivant et milieu', 'Biology-0001.jpg', '188395152064aecbf463d729.71150965Biology-0001.jpg', ''),
(21, 'Fonction du vivant', 'Skeletons.png', '98396405264aecc03db0173.26485666Skeletons.png', ''),
(22, 'Géologie', 'Siccar_Point_red_capstone_closeup.jpg', '90927478364aecc0f9fe829.29682792Siccar_Point_red_capstone_closeup.jpg', '');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`id`, `name`, `file_path`, `resource_id`) VALUES
(61, 'Mallette Beebot 1 robot.pdf', '1560985464afbbc5c42034.99937741Mallette Beebot 1 robot.pdf', 30),
(62, 'Ensemble de 6 robots blue-bot.pdf', '71350862064afbc2f8c1918.89739292Ensemble de 6 robots blue-bot.pdf', 31),
(63, 'guide_primo français cubetto.pdf', '51839828164afbc8a0fffa8.17987561guide_primo français cubetto.pdf', 33),
(64, 'Mallette Cubetto (1).pdf', '50860677864afbc8a2a2b50.82952742Mallette Cubetto (1).pdf', 33),
(65, 'Mallette Cubetto.pdf', '123634460664afbc8a2afa60.07803431Mallette Cubetto.pdf', 33),
(66, 'Mallette Pro-Bot (2 mallettes).pdf', '111680052364afbcebd10340.60273573Mallette Pro-Bot (2 mallettes).pdf', 35),
(67, 'Mallette Pro-Bot.pdf', '79713670664afbcebda13d1.57139731Mallette Pro-Bot.pdf', 35),
(68, 'Pro-Bot_GuideFR.pdf', '51790864464afbcebdaf352.40987873Pro-Bot_GuideFR.pdf', 35),
(69, 'contenu mallette speechi.odg', '71874021964afbee59f78f0.28877613contenu mallette speechi.odg', 36),
(70, 'Mallette Speechi.pdf', '134613451464afbee5ba7ab9.02918412Mallette Speechi.pdf', 36),
(71, 'speechi.odg', '12065052864afbee5bb64e6.39991760speechi.odg', 36),
(72, 'speechi.pdf', '196895183164afbee5bcf1f6.52207228speechi.pdf', 36),
(73, 'Malette -ThymioSansWifi-CREST.pdf', '146465794064afbf11c583c4.76360087Malette -ThymioSansWifi-CREST.pdf', 37),
(74, 'Mallette Thymio sans wifi.pdf', '30056364064afbf11cdcf22.90115553Mallette Thymio sans wifi.pdf', 37),
(75, 'Malette -Thymio-CREST.pdf', '194661577964afc29de24f33.48358048Malette -Thymio-CREST.pdf', 38),
(76, 'Mallette Thymio wifi.pdf', '208938444364afc29e07d1a8.27883922Mallette Thymio wifi.pdf', 38),
(79, 'beebot un seul robot.pdf', '208885163864b4e92699b410.35153355beebot un seul robot.pdf', 30),
(80, 'Mallette Mallette États de leau.pdf', '64460872764b5113ea110f5.25952227Mallette Mallette États de leau.pdf', 40),
(81, 'Mallette-etats-eau-melanges.pdf', '127441611364b5113ec2c184.49397210Mallette-etats-eau-melanges.pdf', 40),
(82, 'Thermomètre de démonstration CREST.docx', '113675373064b5113ec39100.43101745Thermomètre de démonstration CREST.docx', 40),
(83, 'Liste de matériel.pdf', '121167617564b5116aed07d7.32205581Liste de matériel.pdf', 41),
(84, 'malette 1,2,3 couleurs.docx', '172820667564b5116b0154d1.57336713malette 1,2,3 couleurs.docx', 41),
(85, 'malette 1,2,3 couleurs.pdf', '182715360364b5116b026972.76280859malette 1,2,3 couleurs.pdf', 41),
(86, 'Malle 123 Couleurs.docx', '38067949864b5116b0347e0.10055858Malle 123 Couleurs.docx', 41),
(87, 'Mallette cosmographe N°01.pdf', '134949141864b524842dc2f8.99572700Mallette cosmographe N°01.pdf', 42),
(88, 'Mallette cosmographe N°01-FicheDescriptive.pdf', '36375282264b5248444ea46.05554896Mallette cosmographe N°01-FicheDescriptive.pdf', 42),
(89, 'Mallette Cosmographe.pdf', '24219680164b5248445aaf7.47039975Mallette Cosmographe.pdf', 42),
(90, 'Notice cosmographe.pdf', '10385383364b5248446ba79.09142854Notice cosmographe.pdf', 42),
(95, 'Mallette cosmographe N°01.pdf', '16544893276507f2382dda71.13717612Mallette cosmographe N°01.pdf', 50);


--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_back` tinyint(1) DEFAULT 0,
  `back_date` date DEFAULT NULL,
  `last_mail_date` date DEFAULT NULL,
  `resource_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Structure de la table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `max_duration` int(10) UNSIGNED DEFAULT 0,
  `archive` tinyint(1) DEFAULT 0,
  `color` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `resources`
--

INSERT INTO `resources` (`id`, `name`, `picture`, `picture_path`, `description`, `domain_id`, `max_duration`, `archive`, `color`) VALUES
(28, 'Beebot (Nb2)', 'beebot-reduit.jpg', '16532535664afbb81348ad3.11566025beebot-reduit.jpg', '', 11, 42, 0, '#EC266C'),
(29, 'Beebot pour étudiant et formateur INSPE (Nb1)', 'beebot-reduit.jpg', '58740441764afbba1818457.66097699beebot-reduit.jpg', '<p><span style=\"color: rgb(35, 111, 161);\"><strong>Ceci est un robot styl&eacute;</strong></span></p>', 11, 42, 0, '#2E1BD9'),
(30, 'Beebot un seul robot (Nb1)', 'Beebot un seul robot.JPG', '175912031364afbbc5abaae4.57809035Beebot un seul robot.JPG', '', 11, 42, 0, '#3388d8'),
(31, 'Bluebot (Nb1)', 'Photo Blue-Bot.JPG', '7206739864afbc2f8ab9c7.55697341Photo Blue-Bot.JPG', '', 11, 42, 0, '#3388d8'),
(32, 'Bluebot pour étudiant formateur INSPE (Nb1)', 'Photo Blue-Bot.JPG', '120964766364afbc5da5d390.92589836Photo Blue-Bot.JPG', '', 11, 42, 0, '#3388d8'),
(33, 'Cubetto (Nb3)', 'Photo cubetto 1 Réduit.jpg', '113323861064afbc8a0ec642.25566356Photo cubetto 1 Réduit.jpg', '', 11, 42, 0, '#3388d8'),
(34, 'M\'BOT (Nb1)', 'Photo Mbot.jpg', '74934834164afbcce68b0e4.09228954Photo Mbot.jpg', '', 11, 42, 0, '#3388d8'),
(35, 'Pro-Bot (Nb2)', 'PRO-BOT Photo 2 redimensionnée.jpg', '118044986664afbcebcfa3e8.61546725PRO-BOT Photo 2 redimensionnée.jpg', '', 11, 23, 0, '#3388d8'),
(36, 'Speechi (Nb3)', 'Photo Speechi.jpg', '79758939264afbee59cdba5.40331186Photo Speechi.jpg', '', 11, 51, 0, '#3388d8'),
(37, 'Thymio sans wifi (Nb3)', 'Photo pour le site.JPG', '99598810964afbf11c44f85.86014439Photo pour le site.JPG', '', 11, 42, 0, '#3388d8'),
(38, 'Thymio wifi (Nb3)', 'Photo pour le site.JPG', '50207296564afc29ddfba83.45793602Photo pour le site.JPG', '', 11, 42, 0, '#3388d8'),
(40, 'Etats de l\'eau et mélanges (Nb3)', 'TP-Etats-eau-melange.jpg', '168891591564b5113e97c173.38067467TP-Etats-eau-melange.jpg', '', 12, 42, 0, '#3388d8'),
(41, '1 2 3 couleur (Nb1)', 'malle123couleurs.png', '100922941664b5116aeb3d99.32966279malle123couleurs.png', '', 14, 42, 0, '#3388d8'),
(42, 'Cosmographe (Nb1)', 'Photo redimentionné mallette cosmographe.jpg', '74849042264b524842bded0.71163569Photo redimentionné mallette cosmographe.jpg', '', 14, 0, 0, '#3388d8'),
(50, 'Testnocolor', 'Photo redimentionné mallette cosmographe.jpg', '3434351996507f2382ab6a0.71854645Photo redimentionné mallette cosmographe.jpg', '', 21, 2, 0, '#9D6192');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `active`, `admin`) VALUES
(11, 'admin', 'admin', 'admin', 'quentin.bouchon@univ-grenoble-alpes.fr', '$2y$10$TOG.aPgUem2yZDbc3Hr7dejeBm0R1/gpzYQO9ohiHsE24L0d2WelG', 1, 1),
(12, 'user', 'user', 'user', 'user@user.user', '$2y$10$4OTlHxC1dBSTR2jXwx2a4ev3fF78NLRxKihPMx08Lu/1uKglzSwvq', 1, 0),
(13, 'bouchonq', 'bouchonq', 'bouchonq', 'bouchonq@b.com', NULL, 1, 0),
(14, 'bouchonq', 'bouchonq', 'qbouchon', 'bouchonq@bb.fr', NULL, 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `closing_dates`
--
ALTER TABLE `closing_dates`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_id` (`resource_id`);


--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domain_id` (`domain_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `closing_dates`
--
ALTER TABLE `closing_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;


--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT pour la table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
