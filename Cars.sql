-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 14. Mrz 2019 um 10:21
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `Cars`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Booking`
--

CREATE TABLE `Booking` (
  `BookingId` int(11) NOT NULL,
  `BookingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TakeDate` datetime DEFAULT NULL,
  `BackDate` datetime DEFAULT NULL,
  `CarId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Car`
--

CREATE TABLE `Car` (
  `CarId` int(11) NOT NULL,
  `Model` varchar(30) NOT NULL,
  `Type` varchar(60) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `Car`
--

INSERT INTO `Car` (`CarId`, `Model`, `Type`, `Price`) VALUES
(1, 'BMW', 'X6', 100),
(2, 'Mercedes', 'ML500', 200),
(3, 'Skoda', 'Fabia', 50),
(4, 'BMW', '1er', 50),
(5, 'BMW', '2er', 60),
(6, 'BMW', '3er', 70),
(7, 'BMW', '4er', 80),
(8, 'BMW', '5er', 90),
(9, 'BMW', '6er', 110),
(10, 'BMW', '7er', 150),
(11, 'Mazda', 'CX-3', 40),
(12, 'Audi', 'S5', 130);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Booking`
--
ALTER TABLE `Booking`
  ADD PRIMARY KEY (`BookingId`),
  ADD KEY `CarId` (`CarId`),
  ADD KEY `userId` (`userId`);

--
-- Indizes für die Tabelle `Car`
--
ALTER TABLE `Car`
  ADD PRIMARY KEY (`CarId`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Booking`
--
ALTER TABLE `Booking`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `Car`
--
ALTER TABLE `Car`
  MODIFY `CarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Booking`
--
ALTER TABLE `Booking`
  ADD CONSTRAINT `Booking_ibfk_1` FOREIGN KEY (`CarId`) REFERENCES `Car` (`CarId`),
  ADD CONSTRAINT `Booking_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
