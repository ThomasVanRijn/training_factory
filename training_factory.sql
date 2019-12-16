-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 dec 2019 om 09:55
-- Serverversie: 10.4.8-MariaDB
-- PHP-versie: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training_factory`
--
CREATE DATABASE IF NOT EXISTS `training_factory` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `training_factory`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_persons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191210104733', '2019-12-10 10:48:00'),
('20191210105033', '2019-12-10 10:50:56'),
('20191210105407', '2019-12-10 10:57:54'),
('20191210105952', '2019-12-10 10:59:59'),
('20191210110437', '2019-12-10 11:04:43'),
('20191210114127', '2019-12-10 11:42:24'),
('20191211135020', '2019-12-11 13:51:19'),
('20191213084339', '2019-12-13 08:44:05');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preprovision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailaddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hiring_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`) VALUES
(220, 'tester1@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$yo/pNM.G8umxRJ2l0nWpk.7wi4AHYBltx2A5/FNh/AXYbXxH5IYYa', 'tester1'),
(221, 'tester2@gmail.com', '[\"ROLE_USER\"]', '$2y$13$hB0QgHf4q4B1K2ttM0mTJ.9We.fR1absy7YP.twLHrUOotwgup/se', 'tester2'),
(222, 'tester3@gmail.com', '[\"ROLE_USER\"]', '$2y$13$.1PGwQQBjcBhvBzbC8azye8uk34mlVAdfRs1hg.8W/ywMCBHERx5a', 'tester3'),
(223, 'tester4@gmail.com', '[\"ROLE_USER\"]', '$2y$13$l8aX1qCXQqe65ZkWj9035uM2k0JDcWTUeBAqGIFjhyVvTdHiKqkaC', 'tester4'),
(224, 'tester5@gmail.com', '[\"ROLE_USER\"]', '$2y$13$NEs3JiPGPC4J74pOuTDGReCucFpcslQGPxrsHpoLH7SqgwevWfg4u', 'tester5');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
