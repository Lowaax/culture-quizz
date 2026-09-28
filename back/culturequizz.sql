-- --------------------------------------------------------
-- Culture Quiz — export de la base de données
-- Généré le 24/09/2026 à 11:58
--
-- Contenu : 6 catégories et 120 questions.
--
-- Les tables `users` et `parties` sont exportées vides : elles ne
-- contiennent que des comptes et des scores de joueurs, aucune donnée
-- de contenu. Le compte administrateur se recrée avec le seeder, à
-- partir des variables ADMIN_* du fichier .env.
--
-- En développement le projet tourne sur SQLite (php artisan migrate --seed
-- reconstruit tout). Ce fichier reprend le même schéma en syntaxe MySQL.
-- --------------------------------------------------------

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `parties`;
DROP TABLE IF EXISTS `questions`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `users`;

-- --------------------------------------------------------
-- Structure
-- --------------------------------------------------------

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- reponse1 contient toujours la bonne réponse : l'API tire trois mauvaises
-- réponses au hasard parmi les neuf autres, puis mélange les quatre.
CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `categorie_id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse6` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse7` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse8` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse9` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse10` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_categorie_id_foreign` (`categorie_id`),
  CONSTRAINT `questions_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- user_id est nul quand la partie a été jouée sans compte.
CREATE TABLE `parties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `categorie_id` bigint UNSIGNED NOT NULL,
  `score` int UNSIGNED NOT NULL,
  `total` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parties_user_id_foreign` (`user_id`),
  KEY `parties_categorie_id_foreign` (`categorie_id`),
  CONSTRAINT `parties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `parties_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Données : catégories
-- --------------------------------------------------------

INSERT INTO `categories` (`id`, `categorie`, `created_at`, `updated_at`) VALUES
(1, 'Personnages', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(2, 'Planètes & Lieux', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(3, 'Vaisseaux & Technologie', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(4, 'La Force & les Jedi', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(5, 'Sagas & Films', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(6, 'Créatures & Espèces', '2026-09-15 15:15:17', '2026-09-15 15:15:17');

-- --------------------------------------------------------
-- Données : questions
-- --------------------------------------------------------

INSERT INTO `questions` (`id`, `categorie_id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `reponse5`, `reponse6`, `reponse7`, `reponse8`, `reponse9`, `reponse10`, `created_at`, `updated_at`) VALUES
(1, 1, 'Qui est le père de Luke Skywalker ?', 'Dark Vador', 'Obi-Wan Kenobi', 'Han Solo', 'L\'Empereur Palpatine', 'Yoda', 'Boba Fett', 'Qui-Gon Jinn', 'Owen Lars', 'Lando Calrissian', 'Mace Windu', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(2, 1, 'Quel est le véritable nom de Dark Vador ?', 'Anakin Skywalker', 'Ben Solo', 'Kylo Ren', 'Sheev Palpatine', 'Jango Fett', 'Dooku', 'Qui-Gon Jinn', 'Obi-Wan Kenobi', 'Finn', 'Poe Dameron', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(3, 1, 'Qui est la sœur jumelle de Luke Skywalker ?', 'Leia Organa', 'Padmé Amidala', 'Rey', 'Jyn Erso', 'Ahsoka Tano', 'Mon Mothma', 'Qi\'ra', 'Sabine Wren', 'Rose Tico', 'Bazine Netal', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(4, 1, 'Quelle espèce est Chewbacca ?', 'Wookiee', 'Ewok', 'Rodien', 'Twi\'lek', 'Gungan', 'Zabrak', 'Jawa', 'Trandoshan', 'Sullustain', 'Mon Calamari', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(5, 1, 'Quel est le véritable nom de Kylo Ren ?', 'Ben Solo', 'Poe Dameron', 'Finn', 'Hux', 'Snoke', 'Luke Skywalker', 'Anakin Skywalker', 'Dooku', 'Palpatine', 'Rey', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(6, 1, 'Qui est le maître Jedi qui entraîne Luke sur Dagobah ?', 'Yoda', 'Obi-Wan Kenobi', 'Mace Windu', 'Qui-Gon Jinn', 'Ki-Adi-Mundi', 'Plo Koon', 'Yaddle', 'Luminara Unduli', 'Dooku', 'Kit Fisto', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(7, 1, 'Qui est le capitaine du Faucon Millenium au début de la saga (Episode IV) ?', 'Han Solo', 'Lando Calrissian', 'Chewbacca', 'Poe Dameron', 'Wedge Antilles', 'Nien Nunb', 'Rey', 'Finn', 'Qi\'ra', 'Obi-Wan Kenobi', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(8, 1, 'Quel chasseur de primes capture Han Solo dans L\'Empire contre-attaque ?', 'Boba Fett', 'Jango Fett', 'Cad Bane', 'Greedo', 'Bossk', 'Dengar', 'IG-88', 'Zam Wesell', 'Embo', 'Aurra Sing', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(9, 1, 'Quel droïde astromécano accompagne le plus souvent Luke Skywalker ?', 'R2-D2', 'C-3PO', 'BB-8', 'K-2SO', 'D-O', 'R5-D4', 'IG-11', 'L3-37', 'Chopper', '8D8', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(10, 1, 'Qui devient Empereur de la Galaxie sous le nom de Dark Sidious ?', 'Palpatine', 'Dooku', 'Maul', 'Tarkin', 'Thrawn', 'Anakin Skywalker', 'Snoke', 'Vador', 'Krennic', 'Motti', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(61, 1, 'Qui est la mère de Luke et Leia ?', 'Padmé Amidala', 'Shmi Skywalker', 'Beru Lars', 'Mon Mothma', 'Ahsoka Tano', 'Satine Kryze', 'Breha Organa', 'Qi\'ra', 'Jyn Erso', 'Rey', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(62, 1, 'Qui est la mère d\'Anakin Skywalker ?', 'Shmi Skywalker', 'Padmé Amidala', 'Beru Lars', 'Mon Mothma', 'Sola Naberrie', 'Ahsoka Tano', 'Breha Organa', 'Jyn Erso', 'Rey', 'Satine Kryze', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(63, 1, 'Qui est la Padawan d\'Anakin Skywalker pendant la Guerre des Clones ?', 'Ahsoka Tano', 'Barriss Offee', 'Aayla Secura', 'Luminara Unduli', 'Shaak Ti', 'Sabine Wren', 'Hera Syndulla', 'Bo-Katan Kryze', 'Jyn Erso', 'Rey', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(64, 1, 'Quelle sénatrice fonde l\'Alliance Rebelle et la dirige politiquement ?', 'Mon Mothma', 'Leia Organa', 'Padmé Amidala', 'Bail Organa', 'Amiral Ackbar', 'Jyn Erso', 'Cassian Andor', 'Lando Calrissian', 'Poe Dameron', 'Wedge Antilles', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(65, 1, 'Quel ami de Han Solo administre la Cité des Nuages de Bespin ?', 'Lando Calrissian', 'Boba Fett', 'Wedge Antilles', 'Poe Dameron', 'Nien Nunb', 'Greedo', 'Jabba le Hutt', 'Dryden Vos', 'Bail Organa', 'Saw Gerrera', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(66, 1, 'Quel est le nom de l\'oncle qui élève Luke sur Tatooine ?', 'Owen Lars', 'Cliegg Lars', 'Biggs Darklighter', 'Ben Kenobi', 'Watto', 'Jira', 'Dexter Jettster', 'Lor San Tekka', 'Anakin Skywalker', 'Bail Organa', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(67, 1, 'Quel pilote rebelle est l\'ami d\'enfance de Luke sur Tatooine ?', 'Biggs Darklighter', 'Wedge Antilles', 'Poe Dameron', 'Nien Nunb', 'Jek Porkins', 'Dak Ralter', 'Cassian Andor', 'Bodhi Rook', 'Snap Wexley', 'Han Solo', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(68, 1, 'Qui commande la flotte rebelle lors de la bataille d\'Endor ?', 'Amiral Ackbar', 'Amiral Raddus', 'Amiral Holdo', 'Général Dodonna', 'Général Rieekan', 'Nien Nunb', 'Amiral Piett', 'Grand Moff Tarkin', 'Général Hux', 'Amiral Statura', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(69, 1, 'Quel Grand Moff commande l\'Étoile de la Mort dans Un Nouvel Espoir ?', 'Grand Moff Tarkin', 'Amiral Piett', 'Général Veers', 'Directeur Krennic', 'Général Hux', 'Amiral Ozzel', 'Moff Gideon', 'Grand Amiral Thrawn', 'Capitaine Needa', 'Colonel Yularen', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(70, 1, 'Quel apprenti Sith au visage rouge et noir affronte Qui-Gon Jinn sur Naboo ?', 'Dark Maul', 'Dark Vador', 'Comte Dooku', 'Palpatine', 'Général Grievous', 'Savage Opress', 'Asajj Ventress', 'Kylo Ren', 'Dark Bane', 'Dark Plagueis', '2026-09-19 16:55:09', '2026-09-19 16:55:09');

INSERT INTO `questions` (`id`, `categorie_id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `reponse5`, `reponse6`, `reponse7`, `reponse8`, `reponse9`, `reponse10`, `created_at`, `updated_at`) VALUES
(11, 2, 'Sur quelle planète Luke Skywalker grandit-il ?', 'Tatooine', 'Naboo', 'Coruscant', 'Alderaan', 'Hoth', 'Endor', 'Dagobah', 'Jakku', 'Bespin', 'Kamino', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(12, 2, 'Quelle planète est détruite par l\'Étoile de la Mort dans Un Nouvel Espoir ?', 'Alderaan', 'Naboo', 'Hoth', 'Coruscant', 'Dantooine', 'Jedha', 'Hosnian Prime', 'Kashyyyk', 'Bespin', 'Ryloth', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(13, 2, 'Sur quelle planète glacée se trouve la base rebelle Echo dans L\'Empire contre-attaque ?', 'Hoth', 'Tatooine', 'Dagobah', 'Endor', 'Bespin', 'Naboo', 'Kamino', 'Jakku', 'Crait', 'Ilum', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(14, 2, 'Sur quelle planète Yoda vit-il en exil ?', 'Dagobah', 'Tatooine', 'Naboo', 'Coruscant', 'Endor', 'Hoth', 'Mustafar', 'Kashyyyk', 'Bespin', 'Myrkr', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(15, 2, 'Quelle est la planète natale des Ewoks ?', 'Endor', 'Kashyyyk', 'Naboo', 'Dagobah', 'Yavin 4', 'Felucia', 'Mygeeto', 'Sullust', 'Batuu', 'Ajan Kloss', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(16, 2, 'Quelle est la capitale de la République puis de l\'Empire galactique ?', 'Coruscant', 'Naboo', 'Corellia', 'Alderaan', 'Chandrila', 'Hosnian Prime', 'Kamino', 'Scarif', 'Takodana', 'Bespin', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(17, 2, 'Sur quelle planète se déroule le duel final entre Obi-Wan Kenobi et Anakin dans La Revanche des Sith ?', 'Mustafar', 'Naboo', 'Geonosis', 'Kamino', 'Utapau', 'Coruscant', 'Tatooine', 'Polis Massa', 'Dagobah', 'Alderaan', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(18, 2, 'Quelle est la planète natale de Chewbacca ?', 'Kashyyyk', 'Naboo', 'Endor', 'Ryloth', 'Dathomir', 'Rodia', 'Mandalore', 'Felucia', 'Trandosha', 'Sullust', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(19, 2, 'Sur quelle planète Rey est-elle abandonnée durant son enfance ?', 'Jakku', 'Tatooine', 'Ahch-To', 'Crait', 'Pasaana', 'Exegol', 'Takodana', 'Endor', 'Naboo', 'Kijimi', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(20, 2, 'Quelle planète abrite la cité flottante de Bespin où se trouve Lando Calrissian ?', 'Bespin', 'Naboo', 'Coruscant', 'Hoth', 'Tatooine', 'Endor', 'Dagobah', 'Mustafar', 'Kamino', 'Alderaan', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(71, 2, 'Sur quelle planète Anakin et Padmé se marient-ils en secret ?', 'Naboo', 'Coruscant', 'Alderaan', 'Tatooine', 'Scarif', 'Kamino', 'Geonosis', 'Mandalore', 'Corellia', 'Bespin', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(72, 2, 'Sur quelle planète océanique l\'armée de clones est-elle fabriquée ?', 'Kamino', 'Geonosis', 'Naboo', 'Mustafar', 'Scarif', 'Coruscant', 'Hoth', 'Bespin', 'Dathomir', 'Corellia', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(73, 2, 'Sur quelle planète tropicale les Rebelles volent-ils les plans de l\'Étoile de la Mort dans Rogue One ?', 'Scarif', 'Jedha', 'Eadu', 'Yavin IV', 'Endor', 'Tatooine', 'Lothal', 'Crait', 'Naboo', 'Hoth', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(74, 2, 'De quelle lune décollent les chasseurs rebelles pour attaquer la première Étoile de la Mort ?', 'Yavin IV', 'Endor', 'Dantooine', 'Hoth', 'Crait', 'Jedha', 'Scarif', 'Lothal', 'Ajan Kloss', 'Naboo', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(75, 2, 'Sur quelle planète au sol de sel rouge se déroule la bataille finale des Derniers Jedi ?', 'Crait', 'Hoth', 'Mustafar', 'Jakku', 'Ahch-To', 'Cantonica', 'Exegol', 'Endor', 'Scarif', 'Dagobah', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(76, 2, 'Sur quelle planète couverte d\'îles Rey retrouve-t-elle Luke Skywalker en exil ?', 'Ahch-To', 'Dagobah', 'Jakku', 'Crait', 'Exegol', 'Tatooine', 'Lothal', 'Takodana', 'Kef Bir', 'Mustafar', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(77, 2, 'Sur quelle planète se trouve la ville-casino de Canto Bight ?', 'Cantonica', 'Coruscant', 'Bespin', 'Takodana', 'Corellia', 'Nar Shaddaa', 'Scarif', 'Jakku', 'Crait', 'Naboo', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(78, 2, 'Quelle planète cachée des Sith Rey découvre-t-elle dans L\'Ascension de Skywalker ?', 'Exegol', 'Moraband', 'Mustafar', 'Dathomir', 'Crait', 'Ahch-To', 'Jakku', 'Korriban', 'Malachor', 'Kef Bir', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(79, 2, 'Sur quelle planète se dresse le château de Maz Kanata ?', 'Takodana', 'Jakku', 'Naboo', 'Endor', 'Batuu', 'Corellia', 'Cantonica', 'Crait', 'Ahch-To', 'Bespin', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(80, 2, 'De quelle planète Han Solo est-il originaire ?', 'Corellia', 'Tatooine', 'Coruscant', 'Naboo', 'Jakku', 'Bespin', 'Alderaan', 'Kashyyyk', 'Nar Shaddaa', 'Chandrila', '2026-09-19 16:55:09', '2026-09-19 16:55:09');

INSERT INTO `questions` (`id`, `categorie_id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `reponse5`, `reponse6`, `reponse7`, `reponse8`, `reponse9`, `reponse10`, `created_at`, `updated_at`) VALUES
(21, 3, 'Comment s\'appelle le vaisseau de Han Solo et Chewbacca ?', 'Le Faucon Millenium', 'L\'Étoile de la Mort', 'Le Destroyer Stellaire', 'La Navette Tydirium', 'Le Slave I', 'L\'Ebon Hawk', 'Le Ghost', 'La Razor Crest', 'Le Rebel Transport', 'L\'X-wing', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(22, 3, 'Quel type de vaisseau est le Faucon Millenium ?', 'Un cargo corellien', 'Un chasseur TIE', 'Un croiseur rebelle', 'Un destroyer stellaire', 'Un chasseur X-wing', 'Une navette impériale', 'Un croiseur mon calamari', 'Un chasseur TIE Interceptor', 'Un vaisseau Naboo', 'Un chasseur A-wing', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(23, 3, 'Quel est le nom du chasseur stellaire piloté par les pilotes rebelles comme Luke Skywalker à la bataille de Yavin ?', 'X-wing', 'Y-wing', 'A-wing', 'TIE Fighter', 'B-wing', 'Chasseur Jedi', 'N-1 Starfighter', 'U-wing', 'Slave I', 'TIE Interceptor', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(24, 3, 'Quel est le petit chasseur utilisé par les pilotes de l\'Empire, reconnaissable à ses ailes hexagonales ?', 'Le chasseur TIE', 'X-wing', 'Y-wing', 'A-wing', 'B-wing', 'Le Faucon Millenium', 'Slave I', 'N-1 Starfighter', 'U-wing', 'Croiseur mon calamari', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(25, 3, 'Quelle arme ultime l\'Empire construit-il, capable de détruire une planète entière ?', 'L\'Étoile de la Mort', 'Starkiller Base', 'L\'Exécuteur', 'Le Dévastateur', 'La Citadelle Noire', 'Le Whirlwind', 'L\'Arme de Coruscant', 'Le Sarlacc', 'La Station de Geonosis', 'Le Némésis', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(26, 3, 'Dans quoi Han Solo est-il congelé par Dark Vador sur Bespin ?', 'La carbonite', 'La glace de Hoth', 'Un caisson cryogénique', 'Le sable de Tatooine', 'La lave de Mustafar', 'Un champ de force', 'Un bloc de trandium', 'Le gel bacta', 'Une capsule de stase', 'Un cristal de kyber', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(27, 3, 'Quel droïde est spécialisé dans le protocole et la traduction, toujours accompagné de R2-D2 ?', 'C-3PO', 'BB-8', 'K-2SO', 'D-O', 'IG-88', 'L3-37', 'R5-D4', 'HK-47', '8D8', 'Chopper', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(28, 3, 'Quelle est l\'arme emblématique des Jedi et des Sith ?', 'Le sabre laser', 'Le blaster', 'Le fusil ionique', 'La lance à énergie', 'Le fouet à plasma', 'Le bâton de combat', 'Le lance-grenades', 'L\'arc vibrant', 'Le fusil sniper', 'Le vibro-poignard', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(29, 3, 'Quelle base secrète de l\'Ordre Premier est construite à l\'intérieur d\'une planète entière ?', 'Starkiller Base', 'L\'Étoile de la Mort', 'L\'Exécuteur', 'La Citadelle Noire', 'Exegol', 'La Forteresse de Vador', 'Le Dévastateur', 'La Base Echo', 'La Base de Scarif', 'La Base de Crait', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(30, 3, 'De quelle couleur est le sabre laser de Luke Skywalker dans Le Retour du Jedi ?', 'Vert', 'Bleu', 'Rouge', 'Violet', 'Jaune', 'Orange', 'Blanc', 'Noir', 'Rose', 'Cyan', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(81, 3, 'Quel énorme véhicule impérial à quatre pattes attaque la base rebelle de Hoth ?', 'Le TB-TT (AT-AT)', 'Le TR-TT (AT-ST)', 'Le speeder T-47', 'Le TIE Bomber', 'Le Juggernaut', 'Le AT-TE', 'Le snowspeeder', 'Le landspeeder X-34', 'Le STAP', 'Le char AAT', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(82, 3, 'Quel est le nom du vaisseau personnel de Boba Fett ?', 'Le Slave I', 'Le Faucon Millenium', 'Le Razor Crest', 'Le Tantive IV', 'Le Ghost', 'L\'Outrider', 'Le Havoc Marauder', 'Le Nightbrother', 'Le Naboo N-1', 'Le Rogue Shadow', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(83, 3, 'Quel vaisseau diplomatique de la princesse Leia est capturé au début d\'Un Nouvel Espoir ?', 'Le Tantive IV', 'Le Faucon Millenium', 'Le Slave I', 'Le Ghost', 'Le Devastator', 'Le Profundity', 'Le Home One', 'Le Radiant VII', 'Le Razor Crest', 'Le Nebulon-B', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(84, 3, 'Quel bombardier rebelle en forme de marteau participe à la bataille de Yavin ?', 'Le Y-wing', 'Le X-wing', 'Le A-wing', 'Le B-wing', 'Le U-wing', 'Le TIE Bomber', 'Le Z-95', 'Le V-wing', 'L\'ARC-170', 'Le TIE Interceptor', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(85, 3, 'Comment s\'appelle le Super Destroyer Stellaire de Dark Vador ?', 'L\'Executor', 'Le Devastator', 'Le Finalizer', 'Le Supremacy', 'Le Home One', 'Le Profundity', 'Le Malevolence', 'L\'Invisible Hand', 'Le Chimaera', 'L\'Eclipse', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(86, 3, 'Quel droïde sphérique orange et blanc accompagne Poe Dameron ?', 'BB-8', 'R2-D2', 'D-O', 'K-2SO', 'BD-1', 'R5-D4', 'C-3PO', 'IG-11', 'L3-37', 'Chopper', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(87, 3, 'Quel droïde impérial reprogrammé accompagne Cassian Andor dans Rogue One ?', 'K-2SO', 'BB-8', 'R2-D2', 'IG-88', 'C-3PO', 'L3-37', 'D-O', 'Chopper', 'IG-11', '2-1B', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(88, 3, 'Quel dispositif permet à un vaisseau de voyager plus vite que la lumière ?', 'L\'hyperdrive', 'Le moteur ionique', 'Le répulseur', 'Le propulseur subluminique', 'Le turbolaser', 'Le rayon tracteur', 'Le générateur de bouclier', 'Le compensateur inertiel', 'Le noyau hypermatière', 'Le déflecteur', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(89, 3, 'Quelle arme de poing Han Solo porte-t-il à la ceinture ?', 'Le blaster DL-44', 'L\'arbalète laser', 'Le fusil E-11', 'Le sabre laser', 'Le disrupteur', 'Le fusil DLT-19', 'Le pistolet Westar-34', 'Le détonateur thermique', 'L\'électro-bâton', 'Le lance-flammes', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(90, 3, 'Quelle arme Chewbacca porte-t-il en bandoulière ?', 'L\'arbalète laser (bowcaster)', 'Le blaster DL-44', 'Le fusil E-11', 'Le sabre laser', 'Le lance-roquettes', 'Le fusil de Tusken', 'La vibro-hache', 'Le disrupteur', 'Le fouet énergétique', 'Le fusil DLT-19', '2026-09-19 16:55:09', '2026-09-19 16:55:09');

INSERT INTO `questions` (`id`, `categorie_id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `reponse5`, `reponse6`, `reponse7`, `reponse8`, `reponse9`, `reponse10`, `created_at`, `updated_at`) VALUES
(31, 4, 'Comment appelle-t-on le côté maléfique de la Force ?', 'Le Côté Obscur', 'Le Côté Lumineux', 'Le Chaos', 'La Discorde', 'L\'Anéantissement', 'La Voie Grise', 'Le Chemin des Ombres', 'La Force Noire', 'Le Néant', 'Le Vide', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(32, 4, 'Quel maître Jedi est connu pour sa petite taille et sa grande sagesse ?', 'Yoda', 'Mace Windu', 'Obi-Wan Kenobi', 'Qui-Gon Jinn', 'Ki-Adi-Mundi', 'Plo Koon', 'Kit Fisto', 'Dooku', 'Yaddle', 'Even Piell', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(33, 4, 'Comment appelle-t-on les utilisateurs du Côté Obscur de la Force ?', 'Les Sith', 'Les Jedi', 'Les Nightsisters', 'Les Mandaloriens', 'Les Acolytes', 'Les Séparatistes', 'Les Chasseurs de primes', 'Les Sénateurs', 'Les Clones', 'Les Inquisiteurs', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(34, 4, 'Qui est le maître de Dark Vador après sa transformation ?', 'L\'Empereur Palpatine', 'Dark Maul', 'Comte Dooku', 'Dark Plagueis', 'Dark Tyranus', 'Snoke', 'Dark Bane', 'Dark Malgus', 'Dark Revan', 'Dark Krayt', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(35, 4, 'Quel Jedi entraîne Anakin Skywalker en tant que Padawan ?', 'Obi-Wan Kenobi', 'Qui-Gon Jinn', 'Yoda', 'Mace Windu', 'Dooku', 'Ki-Adi-Mundi', 'Plo Koon', 'Luminara Unduli', 'Kit Fisto', 'Even Piell', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(36, 4, 'Quel Jedi entraîne Obi-Wan Kenobi avant de mourir face à Dark Maul ?', 'Qui-Gon Jinn', 'Mace Windu', 'Yoda', 'Dooku', 'Ki-Adi-Mundi', 'Plo Koon', 'Luminara Unduli', 'Kit Fisto', 'Even Piell', 'Adi Gallia', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(37, 4, 'Comment nomme-t-on les cristaux qui alimentent les sabres laser ?', 'Cristaux Kyber', 'Cristaux Adegan', 'Cristaux Corusca', 'Cristaux de carbonite', 'Cristaux Sith', 'Cristaux Nghasa', 'Cristaux Opila', 'Cristaux Ergo', 'Cristaux Mestra', 'Cristaux Ilum', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(38, 4, 'Quel maître Jedi affronte Palpatine en duel dans La Revanche des Sith mais est vaincu ?', 'Mace Windu', 'Yoda', 'Obi-Wan Kenobi', 'Qui-Gon Jinn', 'Ki-Adi-Mundi', 'Plo Koon', 'Kit Fisto', 'Luminara Unduli', 'Dooku', 'Saesee Tiin', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(39, 4, 'Qui exécute la majorité des Jedi lors de l\'Ordre 66 ?', 'Les clones', 'Les Sith', 'Les droïdes de combat', 'Les Séparatistes', 'Les Mandaloriens', 'Les Inquisiteurs', 'Les Nightsisters', 'Les chasseurs de primes', 'Les Wookiees', 'Les Gungans', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(40, 4, 'Quel titre porte Rey à la toute fin de la trilogie séquelle ?', 'Chevalier Jedi', 'Maître Sith', 'Impératrice', 'Padawan', 'Sénatrice', 'Mandalorienne', 'Chancelière', 'Inquisitrice', 'Générale', 'Contrebandière', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(91, 4, 'Quelle formule les Jedi emploient-ils pour se souhaiter bonne chance ?', 'Que la Force soit avec toi', 'Je suis un Jedi, comme mon père avant moi', 'Fais-le, ou ne le fais pas', 'C\'est un piège !', 'Je sais', 'La Force est puissante dans ta famille', 'Tu étais l\'Élu !', 'Ainsi meurt la liberté', 'Adieu, vieil ami', 'La rébellion est morte', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(92, 4, 'Combien de Sith peuvent exister en même temps selon la Règle des Deux ?', 'Deux', 'Un', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Dix', 'Douze', 'Aucun', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(93, 4, 'Quel rang un Jedi occupe-t-il avant de devenir Chevalier ?', 'Padawan', 'Initié', 'Maître', 'Grand Maître', 'Youngling', 'Apprenti Sith', 'Gardien', 'Consulaire', 'Sentinelle', 'Sénateur', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(94, 4, 'Quels organismes microscopiques présents dans le sang mesurent la sensibilité à la Force ?', 'Les midi-chloriens', 'Les cristaux kyber', 'Les holocrons', 'Les vergences', 'Les symbiotes', 'Les nanodroïdes', 'Les spores', 'Les bactas', 'Les plasmoïdes', 'Les krayts', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(95, 4, 'Quel objet renferme les savoirs secrets transmis entre Jedi ?', 'L\'holocron', 'Le datapad', 'Le cristal kyber', 'Le sabre noir', 'Le talisman Sith', 'Le codex Jedi', 'Le grimoire', 'La balise Jedi', 'Le prisme', 'La relique de Malachor', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(96, 4, 'Sur quelle planète glacée les jeunes Jedi récoltent-ils leur cristal kyber ?', 'Ilum', 'Hoth', 'Dagobah', 'Jedha', 'Christophsis', 'Mustafar', 'Crait', 'Exegol', 'Lothal', 'Dathomir', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(97, 4, 'Qui est le maître Sith de Palpatine ?', 'Dark Plagueis', 'Dark Maul', 'Comte Dooku', 'Dark Bane', 'Dark Vador', 'Savage Opress', 'Dark Tyranus', 'Snoke', 'Dark Revan', 'Dark Nihilus', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(98, 4, 'Quel nom Sith le Comte Dooku porte-t-il ?', 'Dark Tyranus', 'Dark Maul', 'Dark Bane', 'Dark Sidious', 'Dark Plagueis', 'Dark Vador', 'Dark Revan', 'Dark Nihilus', 'Kylo Ren', 'Savage Opress', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(99, 4, 'Quelle technique de la Force Dark Vador utilise-t-il pour étouffer ses officiers à distance ?', 'L\'étranglement de la Force', 'La poussée de la Force', 'La persuasion Jedi', 'Les éclairs de Force', 'Le saut de la Force', 'La guérison par la Force', 'La vitesse de la Force', 'La projection de la Force', 'La vision de la Force', 'La fusion des esprits', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(100, 4, 'Quel pouvoir Palpatine déchaîne-t-il contre Luke dans Le Retour du Jedi ?', 'Les éclairs de Force', 'L\'étranglement de la Force', 'La persuasion Jedi', 'La guérison par la Force', 'La projection de la Force', 'La télékinésie', 'Le saut de la Force', 'La vision de la Force', 'La vitesse de la Force', 'Le camouflage par la Force', '2026-09-19 16:55:09', '2026-09-19 16:55:09');

INSERT INTO `questions` (`id`, `categorie_id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `reponse5`, `reponse6`, `reponse7`, `reponse8`, `reponse9`, `reponse10`, `created_at`, `updated_at`) VALUES
(41, 5, 'Quel est le titre de l\'Episode IV de Star Wars ?', 'Un Nouvel Espoir', 'L\'Empire contre-attaque', 'Le Retour du Jedi', 'La Menace fantôme', 'L\'Attaque des clones', 'La Revanche des Sith', 'Le Réveil de la Force', 'Les Derniers Jedi', 'L\'Ascension de Skywalker', 'Rogue One', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(42, 5, 'Quel est le premier film de la saga Star Wars sorti au cinéma, en 1977 ?', 'Un Nouvel Espoir', 'La Menace fantôme', 'L\'Empire contre-attaque', 'Le Retour du Jedi', 'L\'Attaque des clones', 'La Revanche des Sith', 'Le Réveil de la Force', 'Rogue One', 'Solo', 'Les Derniers Jedi', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(43, 5, 'Quel réalisateur a créé Star Wars ?', 'George Lucas', 'Steven Spielberg', 'J.J. Abrams', 'Irvin Kershner', 'Richard Marquand', 'Rian Johnson', 'Ron Howard', 'Gareth Edwards', 'James Cameron', 'Peter Jackson', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(44, 5, 'Quel film narre la bataille d\'Endor et la destruction de la deuxième Étoile de la Mort ?', 'Le Retour du Jedi', 'Un Nouvel Espoir', 'L\'Empire contre-attaque', 'La Menace fantôme', 'L\'Attaque des clones', 'La Revanche des Sith', 'Le Réveil de la Force', 'Les Derniers Jedi', 'Rogue One', 'Solo', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(45, 5, 'Quel est le titre de l\'Episode I ?', 'La Menace fantôme', 'L\'Attaque des clones', 'La Revanche des Sith', 'Un Nouvel Espoir', 'L\'Empire contre-attaque', 'Le Retour du Jedi', 'Le Réveil de la Force', 'Les Derniers Jedi', 'L\'Ascension de Skywalker', 'Rogue One', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(46, 5, 'Quel film spin-off raconte le vol des plans de l\'Étoile de la Mort avant Un Nouvel Espoir ?', 'Rogue One', 'Solo', 'La Menace fantôme', 'Les Derniers Jedi', 'L\'Ascension de Skywalker', 'Le Réveil de la Force', 'L\'Attaque des clones', 'La Revanche des Sith', 'L\'Empire contre-attaque', 'Le Retour du Jedi', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(47, 5, 'Quel film spin-off raconte la jeunesse de Han Solo ?', 'Solo: A Star Wars Story', 'Rogue One', 'La Menace fantôme', 'Le Réveil de la Force', 'Les Derniers Jedi', 'L\'Ascension de Skywalker', 'L\'Attaque des clones', 'La Revanche des Sith', 'L\'Empire contre-attaque', 'Le Retour du Jedi', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(48, 5, 'Qui réalise Le Réveil de la Force (Episode VII) ?', 'J.J. Abrams', 'George Lucas', 'Rian Johnson', 'Irvin Kershner', 'Richard Marquand', 'Ron Howard', 'Gareth Edwards', 'Steven Spielberg', 'James Cameron', 'Peter Jackson', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(49, 5, 'Quel est le dernier film de la trilogie séquelle ?', 'L\'Ascension de Skywalker', 'Le Réveil de la Force', 'Les Derniers Jedi', 'Le Retour du Jedi', 'La Revanche des Sith', 'Rogue One', 'Solo', 'Un Nouvel Espoir', 'La Menace fantôme', 'L\'Attaque des clones', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(50, 5, 'En quelle année sort le tout premier film Star Wars au cinéma ?', '1977', '1980', '1983', '1999', '2002', '2005', '2015', '2017', '2019', '1975', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(101, 5, 'Quel est le titre de l\'Episode V ?', 'L\'Empire contre-attaque', 'Le Retour du Jedi', 'Un Nouvel Espoir', 'La Menace fantôme', 'L\'Attaque des clones', 'La Revanche des Sith', 'Le Réveil de la Force', 'Les Derniers Jedi', 'L\'Ascension de Skywalker', 'Rogue One', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(102, 5, 'Quel est le titre de l\'Episode II ?', 'L\'Attaque des clones', 'La Menace fantôme', 'La Revanche des Sith', 'Un Nouvel Espoir', 'L\'Empire contre-attaque', 'Le Retour du Jedi', 'Le Réveil de la Force', 'Les Derniers Jedi', 'L\'Ascension de Skywalker', 'Solo', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(103, 5, 'Qui compose la musique de la saga Star Wars ?', 'John Williams', 'Hans Zimmer', 'Howard Shore', 'Ennio Morricone', 'Michael Giacchino', 'Danny Elfman', 'James Horner', 'Alan Silvestri', 'Jerry Goldsmith', 'John Powell', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(104, 5, 'Qui réalise Les Derniers Jedi (Episode VIII) ?', 'Rian Johnson', 'J.J. Abrams', 'George Lucas', 'Gareth Edwards', 'Ron Howard', 'Irvin Kershner', 'Richard Marquand', 'Colin Trevorrow', 'Tony Gilroy', 'Dave Filoni', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(105, 5, 'Qui réalise L\'Empire contre-attaque ?', 'Irvin Kershner', 'George Lucas', 'Richard Marquand', 'J.J. Abrams', 'Rian Johnson', 'Ron Howard', 'Gareth Edwards', 'Steven Spielberg', 'Lawrence Kasdan', 'Dave Filoni', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(106, 5, 'Quelle série animée suit Anakin et Ahsoka pendant la Guerre des Clones ?', 'The Clone Wars', 'Rebels', 'The Bad Batch', 'Resistance', 'Visions', 'Tales of the Jedi', 'The Mandalorian', 'Andor', 'Ahsoka', 'Droids', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(107, 5, 'Quelle série suit un chasseur de primes mandalorien et l\'enfant Grogu ?', 'The Mandalorian', 'Andor', 'Obi-Wan Kenobi', 'Ahsoka', 'The Book of Boba Fett', 'Rebels', 'The Acolyte', 'Skeleton Crew', 'Resistance', 'The Bad Batch', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(108, 5, 'Quel groupe rachète Lucasfilm en 2012 ?', 'Disney', 'Warner Bros', 'Universal', 'Sony', 'Paramount', 'Netflix', '20th Century Fox', 'MGM', 'Amazon', 'Pixar', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(109, 5, 'Quel studio distribue les six premiers films de la saga au cinéma ?', '20th Century Fox', 'Disney', 'Warner Bros', 'Universal', 'Paramount', 'Columbia', 'MGM', 'United Artists', 'Lionsgate', 'New Line', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(110, 5, 'Comment appelle-t-on le texte jaune qui défile au début de chaque film ?', 'Le crawl d\'ouverture', 'Le générique', 'Le prologue', 'L\'épilogue', 'Le teaser', 'Le carton-titre', 'La voix off', 'Le synopsis', 'L\'intertitre', 'Le chapitre', '2026-09-19 16:55:09', '2026-09-19 16:55:09');

INSERT INTO `questions` (`id`, `categorie_id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `reponse5`, `reponse6`, `reponse7`, `reponse8`, `reponse9`, `reponse10`, `created_at`, `updated_at`) VALUES
(51, 6, 'Quelle créature géante vit dans une fosse près du palais de Jabba le Hutt ?', 'Le Sarlacc', 'Le Rancor', 'Le Wampa', 'Le Krayt Dragon', 'L\'Exogorth', 'Le Dianoga', 'Le Gundark', 'Le Nexu', 'L\'Acklay', 'Le Reek', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(52, 6, 'Quelle créature des glaces attaque Luke Skywalker sur Hoth ?', 'Le Wampa', 'Le Rancor', 'Le Sarlacc', 'Le Tauntaun', 'L\'Exogorth', 'Le Krayt Dragon', 'Le Dianoga', 'Le Gundark', 'Le Nexu', 'L\'Acklay', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(53, 6, 'Quel animal Luke et Han montent-ils pour se déplacer sur Hoth ?', 'Le Tauntaun', 'Le Wampa', 'Le Bantha', 'Le Rancor', 'Le Dewback', 'Le Ronto', 'Le Nerf', 'Le Fathier', 'Le Kaadu', 'Le Massif', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(54, 6, 'Quel animal est souvent utilisé comme monture par les Jawas et les Tuskens sur Tatooine ?', 'Le Bantha', 'Le Tauntaun', 'Le Dewback', 'Le Wampa', 'Le Ronto', 'Le Nerf', 'Le Varactyl', 'Le Fathier', 'Le Kaadu', 'Le Massif', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(55, 6, 'Quelle espèce de petits pilleurs encapuchonnés récupère des droïdes sur Tatooine ?', 'Les Jawas', 'Les Ewoks', 'Les Tuskens', 'Les Ugnaughts', 'Les Ithorians', 'Les Gungans', 'Les Gamorréens', 'Les Rodiens', 'Les Chadra-Fan', 'Les Sullustains', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(56, 6, 'Quelle espèce de petits guerriers vivant dans les arbres d\'Endor aide les Rebelles ?', 'Les Ewoks', 'Les Jawas', 'Les Gungans', 'Les Wookiees', 'Les Ugnaughts', 'Les Ithorians', 'Les Gamorréens', 'Les Rodiens', 'Les Chadra-Fan', 'Les Sullustains', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(57, 6, 'Quelle espèce amphibie maladroite habite Naboo aux côtés des humains ?', 'Les Gungans', 'Les Ewoks', 'Les Jawas', 'Les Twi\'leks', 'Les Mon Calamari', 'Les Ithorians', 'Les Rodiens', 'Les Zabraks', 'Les Toydariens', 'Les Quarren', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(58, 6, 'Quelle est l\'espèce de Jabba le Hutt ?', 'Hutt', 'Toydarien', 'Rodien', 'Twi\'lek', 'Gungan', 'Mon Calamari', 'Sullustain', 'Trandoshan', 'Quarren', 'Neimoidien', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(59, 6, 'Quelle espèce à tête de poisson dirige la flotte rebelle aux côtés de l\'Amiral Ackbar ?', 'Les Mon Calamari', 'Les Quarren', 'Les Gungans', 'Les Ithorians', 'Les Twi\'leks', 'Les Rodiens', 'Les Sullustains', 'Les Toydariens', 'Les Chadra-Fan', 'Les Aqualish', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(60, 6, 'Quelle espèce de guerriers velus, dont fait partie Chewbacca, vit sur Kashyyyk ?', 'Les Wookiees', 'Les Ewoks', 'Les Trandoshans', 'Les Gungans', 'Les Jawas', 'Les Gamorréens', 'Les Rodiens', 'Les Zabraks', 'Les Sullustains', 'Les Ithorians', '2026-09-15 15:15:17', '2026-09-15 15:15:17'),
(111, 6, 'Quelle créature griffue attaque Luke sous le palais de Jabba le Hutt ?', 'Le Rancor', 'Le Sarlacc', 'Le Wampa', 'Le Krayt Dragon', 'Le Nexu', 'L\'Acklay', 'Le Reek', 'Le Gundark', 'Le Dianoga', 'Le Varactyl', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(112, 6, 'Quel monstre tentaculaire vit dans le compacteur de déchets de l\'Étoile de la Mort ?', 'Le Dianoga', 'Le Sarlacc', 'Le Rancor', 'L\'Exogorth', 'Le Wampa', 'Le Gundark', 'Le Mynock', 'Le Nexu', 'Le Krayt Dragon', 'Le Reek', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(113, 6, 'Quelle créature géante avale le Faucon Millenium dans un champ d\'astéroïdes ?', 'L\'Exogorth (ver de l\'espace)', 'Le Dianoga', 'Le Sarlacc', 'Le Rancor', 'Le Mynock', 'Le Krayt Dragon', 'Le Purrgil', 'Le Summa-verminoth', 'Le Wampa', 'Le Gundark', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(114, 6, 'Quels parasites ailés s\'accrochent à la coque du Faucon Millenium ?', 'Les Mynocks', 'Les Porgs', 'Les Dianogas', 'Les Gundarks', 'Les Purrgils', 'Les Womp rats', 'Les Nexus', 'Les Reeks', 'Les Acklays', 'Les Tauntauns', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(115, 6, 'Quels petits oiseaux marins peuplent l\'île d\'Ahch-To ?', 'Les Porgs', 'Les Mynocks', 'Les Convors', 'Les Loth-chats', 'Les Fathiers', 'Les Vulptex', 'Les Tauntauns', 'Les Womp rats', 'Les Kowakiens', 'Les Nerfs', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(116, 6, 'Quelles créatures de cristal ressemblant à des renards vivent sur Crait ?', 'Les Vulptex', 'Les Porgs', 'Les Loth-chats', 'Les Fathiers', 'Les Convors', 'Les Mynocks', 'Les Tauntauns', 'Les Nexus', 'Les Massifs', 'Les Corvax', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(117, 6, 'À quelle espèce cornue appartient Dark Maul ?', 'Les Zabraks', 'Les Twi\'leks', 'Les Togrutas', 'Les Rodiens', 'Les Trandoshans', 'Les Gamorréens', 'Les Nautolans', 'Les Kaminoans', 'Les Quarren', 'Les Chagrians', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(118, 6, 'Quelle espèce élancée aux grands yeux fabrique l\'armée de clones ?', 'Les Kaminoans', 'Les Mon Calamari', 'Les Géonosiens', 'Les Neimoidiens', 'Les Muuns', 'Les Quarren', 'Les Gungans', 'Les Ithorians', 'Les Toydariens', 'Les Bith', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(119, 6, 'Quelle espèce insectoïde construit les usines de droïdes de Geonosis ?', 'Les Géonosiens', 'Les Kaminoans', 'Les Neimoidiens', 'Les Gungans', 'Les Wookiees', 'Les Ugnaughts', 'Les Jawas', 'Les Rodiens', 'Les Trandoshans', 'Les Bith', '2026-09-19 16:55:09', '2026-09-19 16:55:09'),
(120, 6, 'De quelle espèce aux montrals rayés est Ahsoka Tano ?', 'Togruta', 'Twi\'lek', 'Zabrak', 'Nautolan', 'Mirialan', 'Rodien', 'Chiss', 'Pantoran', 'Mon Calamari', 'Kaminoan', '2026-09-19 16:55:09', '2026-09-19 16:55:09');

SET FOREIGN_KEY_CHECKS = 1;
