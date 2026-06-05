-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2026 at 07:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pontszamok`
--

-- --------------------------------------------------------

--
-- Table structure for table `tier1`
--

CREATE TABLE `tier1` (
  `BŰNVADÁSZOK` text NOT NULL,
  `Fogatlan5` text NOT NULL,
  `Team Scout` text NOT NULL,
  `Team Bloodline` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tier1`
--

INSERT INTO `tier1` (`BŰNVADÁSZOK`, `Fogatlan5`, `Team Scout`, `Team Bloodline`) VALUES
('4', '3', '1', '2'),
('4', '3', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tier2`
--

CREATE TABLE `tier2` (
  `veremfekve` text NOT NULL,
  `woltfutarosok` text NOT NULL,
  `Zsebkendo` text NOT NULL,
  `1WIN` text NOT NULL,
  `CYBER` text NOT NULL,
  `Marielitos Crew` text NOT NULL,
  `Thor's` text NOT NULL,
  `amir` text NOT NULL,
  `NS GAMING` text NOT NULL,
  `Eclipse` text NOT NULL,
  `BREVEK` text NOT NULL,
  `woltfutarosacademy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tier3`
--

CREATE TABLE `tier3` (
  `1312` text NOT NULL,
  `nacsumi` text NOT NULL,
  `Weszelyes Elemek` text NOT NULL,
  `Botality` text NOT NULL,
  `Csikiak` text NOT NULL,
  `LFI` text NOT NULL,
  `Taktikai Pörkölt` text NOT NULL,
  `NYZO` text NOT NULL,
  `FrozenZ` text NOT NULL,
  `KREKK` text NOT NULL,
  `Bojler Eladó Esport` text NOT NULL,
  `szolnok motor utca 8` text NOT NULL,
  `overlocked` text NOT NULL,
  `The Serial Killer'S` text NOT NULL,
  `KVfőzők` text NOT NULL,
  `Team Falgoats` text NOT NULL,
  `Turul Vihar` text NOT NULL,
  `LÉLEKVADÁSZ` text NOT NULL,
  `nakmcs` text NOT NULL,
  `Team Nyíregyháza` text NOT NULL,
  `Demonic Roosters` text NOT NULL,
  `Temus S1mple` text NOT NULL,
  `CPOT` text NOT NULL,
  `Suttogos MM` text NOT NULL,
  `1000-7` text NOT NULL,
  `WWTeam` text NOT NULL,
  `HMT` text NOT NULL,
  `Danube Turul eSport` text NOT NULL,
  `whystopnow` text NOT NULL,
  `Relic Alpha` text NOT NULL,
  `Bundáskenyerek` text NOT NULL,
  `Vertex Elite` text NOT NULL,
  `NFBC` text NOT NULL,
  `fektsz` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
