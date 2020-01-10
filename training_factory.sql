-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 jan 2020 om 12:58
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
  `time` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_persons` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL
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
('20191210104733', '2020-01-08 10:12:42'),
('20191210105033', '2020-01-08 10:12:42'),
('20191210105407', '2020-01-08 10:12:42'),
('20191210105952', '2020-01-08 10:12:42'),
('20191210110437', '2020-01-08 10:12:42'),
('20191210114127', '2020-01-08 10:12:42'),
('20191211135020', '2020-01-08 10:12:42'),
('20191213084339', '2020-01-08 10:12:42'),
('20191216090137', '2020-01-08 10:12:42'),
('20191216090418', '2020-01-08 10:12:42'),
('20191216101250', '2020-01-08 10:12:42'),
('20191218125740', '2020-01-08 10:12:42'),
('20191218141627', '2020-01-08 10:12:43'),
('20200110075601', '2020-01-10 07:56:06'),
('20200110075729', '2020-01-10 07:57:33'),
('20200110101941', '2020-01-10 10:19:45'),
('20200110113409', '2020-01-10 11:34:28'),
('20200110113756', '2020-01-10 11:38:02'),
('20200110114015', '2020-01-10 11:40:26'),
('20200110114351', '2020-01-10 11:43:54');

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
  `duration` time NOT NULL,
  `costs` int(11) NOT NULL,
  `brochure_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `training`
--

INSERT INTO `training` (`id`, `naam`, `description`, `duration`, `costs`, `brochure_filename`) VALUES
(1, 'Kickboxen', 'leuk', '01:00:00', 12, 'pf1-5e185550d699f.jpeg'),
(2, 'gayzijn', 'thomas is big gay', '01:00:00', 5, '');

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

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `loginname`, `firstname`, `preprovision`, `lastname`, `dateofbirth`, `gender`, `hiring_date`, `salary`, `street`, `postal_code`, `place`) VALUES
(1, 'thvrijn2002@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$sXRyCykEc.j7LPs5cn3YuutbMtzX/lo8MV1N65S9XqouSeofXmOPe', 'Thoompje', 'Thomas', 'van', 'Rijn', '2002-10-02', 'man', '', '0.00', 'J.W Frisodreef', '2224BG', 'Katwijk'),
(3, 'admin@gmail.com', '[]', '$2y$13$Ps3lu8eeUIg0W1MV/OpUdeKV6YV.BKhiOpSCqJIC7znnOROucPm42', 'Admin', 'Klaas', NULL, 'Vaak', '1987-05-19', 'man', NULL, NULL, 'straat', '1234ab', 'voorburg'),
(4, 'instructeur@test.com', '[\"ROLE_INSTRUCTEUR\"]', '$2y$13$EZziovkEOnJ46j98/fmnN.1ZQnmps7JQKu3oF3kSgu1WKypBExqO.', 'instructeur', 'instructeur', NULL, '1', '1900-03-01', 'man', NULL, NULL, 'straat', '1234ab', 'den haag'),
(5, 'user@test.com', '[]', '$2y$13$IB8ouQh8NM70mpoprARpJuW//8l78miUzm6n3ORo5A8gVENQJA69.', 'User', 'user', NULL, '1', '1961-06-16', 'man', NULL, NULL, 'straat', '1234ab', 'den haag');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3BEFD98D1` (`training_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F3BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
