-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 06:37 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adoptii`
--

-- --------------------------------------------------------

--
-- Table structure for table `administratori`
--

CREATE TABLE `administratori` (
  `id_administrator` varchar(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `prenume` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administratori`
--

INSERT INTO `administratori` (`id_administrator`, `nume`, `prenume`, `email`, `parola`, `telefon`) VALUES
('1', 'Diana Mihaela', 'Hasna', 'diana.hasna00@e-uvt.ro', '123456789', '0761959262');

-- --------------------------------------------------------

--
-- Table structure for table `adoptii`
--

CREATE TABLE `adoptii` (
  `id_adoptie` varchar(255) NOT NULL,
  `id_utilizator` varchar(255) NOT NULL,
  `id_animal` varchar(255) NOT NULL,
  `data_adoptie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoptii`
--

INSERT INTO `adoptii` (`id_adoptie`, `id_utilizator`, `id_animal`, `data_adoptie`) VALUES
('1', '2', '2', '21-Jun-2022'),
('2', '2', '11', '12-Jul-2022'),
('3', '1', '8', '12-Jul-2022'),
('4', '1', '10', '12-Jul-2022');

-- --------------------------------------------------------

--
-- Table structure for table `animale`
--

CREATE TABLE `animale` (
  `id_animal` varchar(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `tip_animal` varchar(255) NOT NULL,
  `rasa` varchar(255) NOT NULL,
  `gen` varchar(255) NOT NULL,
  `varsta` varchar(255) NOT NULL,
  `mediu_viata` varchar(255) NOT NULL,
  `acomodabil` varchar(255) NOT NULL,
  `descriere` text NOT NULL,
  `adoptat` varchar(255) NOT NULL,
  `imagine_ref` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animale`
--

INSERT INTO `animale` (`id_animal`, `nume`, `tip_animal`, `rasa`, `gen`, `varsta`, `mediu_viata`, `acomodabil`, `descriere`, `adoptat`, `imagine_ref`) VALUES
('10', 'Sisi', 'Pisica', 'Metis', 'F', '2 luni', 'Casa si bloc', 'da', 'Sisi, pe cât de mică pe atât de energică este.\r\nAre nevoie de o familie iubitoare,cu multă răbdare și puține locuri strâmte în care se poate ascunde.\r\n                    ', 'da', '../incarcari/imagine10.jpg'),
('11', 'Kiki', 'Caine', 'Metis', 'F', '2 luni', 'Casa', 'da', 'Mezina adăpostului,Kiki,este acum suficient de mare pentru a-și urma propriul drum alături de viitoarea ei familie.\r\n                    ', 'da', '../incarcari/imagine11.jpg'),
('12', 'Leila', 'Pisica', 'Metis', 'F', '4 ani', 'Casa', 'da', 'Leila este o pisicăm în căutarea unei familii.\r\n                    ', 'nu', '../incarcari/no_image.jpg'),
('13', 'Simba', 'Caine', 'Labrador', 'F', '4 luni', 'Casa', 'da', 'Simba  este dovada vie că, rasa din care faci parte nu contează când vine  vorba de abandon. \r\nSperăm să fii tu cel care îi va schimba viața !\r\n                    ', 'nu', '../incarcari/imagine13.jpg'),
('2', 'Cora', 'Caine', 'Bichon', 'F', '4', 'Casa si bloc', 'da', '\r\n        Animalul este prietenos cu toata lumea            ', 'da', '../incarcari/imagine2.jpg'),
('4', 'Cora', 'Caine', 'Bichon havanez', 'F', '4 ani', 'Casa si bloc', 'da', '\r\n                    Catelusa in varsta de 4 ani isi cauta viitorul stapan si prieten.', 'da', '../incarcari/imagine4.jpg'),
('6', 'Athos', 'Pisica', 'Metis', 'M', '1 an', 'Casa si bloc', 'da', 'Motanelul Athos doreste sa faca cunostiinta cu tine si viitor sai prieteni. \r\n                    ', 'nu', '../incarcari/imagine6.jpg'),
('7', 'Misha', 'Caine', 'Ciobanesc german', 'F', '7 ani', 'Casa', 'nu', ' Prietenoasa cu oamenii,dar nu si cu alte animale. Misha este un ciobanesc german in varsta de 7 ani care isi cauta o familie iubitoare', 'nu', '../incarcari/imagine7.jpg'),
('8', 'Eli', 'Caine', 'Metis', 'F', '1 an', 'Casa', 'da', 'Eli este o cățelușă în vârstă de 1 an, care își caută o familie la fel de iubitoare și veselă precum ea                     ', 'da', '../incarcari/imagine8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `anunturi`
--

CREATE TABLE `anunturi` (
  `id_anunt` varchar(255) NOT NULL,
  `id_utilizator` varchar(255) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `descriere` varchar(255) NOT NULL,
  `imagine_ref` varchar(255) NOT NULL,
  `tip_anunt` varchar(255) NOT NULL,
  `locatie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anunturi`
--

INSERT INTO `anunturi` (`id_anunt`, `id_utilizator`, `titlu`, `descriere`, `imagine_ref`, `tip_anunt`, `locatie`) VALUES
('1', '1', 'Caut pisica', '\r\n                    Buna ziua, caut o pisica', '../incarcari/no_image.jpg', 'cautare_animal_nou', 'Timisoara'),
('4', '3', 'Gasit catel', '\r\n             Buna ziua, am gasit un catel ratacind in zona Buziasului. \r\nDaca il recunoaste cineva  rog sa ma contacteze. \r\nMUltumesc!       ', '../incarcari/fundal4.jpg', 'cautare_animal_nou', 'Calea Buziasului Timisoara');

-- --------------------------------------------------------

--
-- Table structure for table `boli`
--

CREATE TABLE `boli` (
  `id_boala` varchar(255) NOT NULL,
  `nume_boala` varchar(255) NOT NULL,
  `durata` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boli`
--

INSERT INTO `boli` (`id_boala`, `nume_boala`, `durata`) VALUES
('1', 'raceala acuta', 'doua saptamani'),
('2', 'Babesioza', 'o luna si 3 saptamani'),
('3', 'Infestare cu pureci', 'trei saptamani'),
('4', 'Paralizie', ''),
('5', 'Febra', '1-2 zile');

-- --------------------------------------------------------

--
-- Table structure for table `fisa_medicala`
--

CREATE TABLE `fisa_medicala` (
  `id_fisa` varchar(255) NOT NULL,
  `id_animal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fisa_medicala`
--

INSERT INTO `fisa_medicala` (`id_fisa`, `id_animal`) VALUES
('5', '13'),
('2', '2'),
('1', '3'),
('3', '4'),
('4', '5');

-- --------------------------------------------------------

--
-- Table structure for table `mapare_boala_medicament`
--

CREATE TABLE `mapare_boala_medicament` (
  `id_mapare` varchar(255) NOT NULL,
  `id_boala` varchar(255) NOT NULL,
  `id_medicament` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapare_boala_medicament`
--

INSERT INTO `mapare_boala_medicament` (`id_mapare`, `id_boala`, `id_medicament`) VALUES
('1', '1', '6'),
('2', '1', '7'),
('3', '3', '5'),
('4', '2', '3'),
('5', '2', '2'),
('6', '2', '4'),
('7', '5', '8');

-- --------------------------------------------------------

--
-- Table structure for table `mapare_fisa_boala`
--

CREATE TABLE `mapare_fisa_boala` (
  `id_mapare` varchar(255) NOT NULL,
  `id_fisa` varchar(255) NOT NULL,
  `id_boala` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapare_fisa_boala`
--

INSERT INTO `mapare_fisa_boala` (`id_mapare`, `id_fisa`, `id_boala`) VALUES
('1', '1', '4'),
('2', '2', '3'),
('3', '2', '1'),
('4', '3', '1'),
('5', '3', '4'),
('6', '3', '3'),
('7', '4', '3'),
('8', '5', '3');

-- --------------------------------------------------------

--
-- Table structure for table `medicamente`
--

CREATE TABLE `medicamente` (
  `id_medicament` varchar(255) NOT NULL,
  `denumire` varchar(255) NOT NULL,
  `ratie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicamente`
--

INSERT INTO `medicamente` (`id_medicament`, `denumire`, `ratie`) VALUES
('1', 'CystoPro', '1 pe zi'),
('2', 'Aptus', '2 pe zi'),
('3', 'ProMax', '1 la doua zile'),
('4', 'Scipet', '2 pe saptamana'),
('5', 'Parakill', 'o data la 3 zile'),
('6', 'Parasinus', 'o data pe zi'),
('7', 'Strepsils', 'o pastila pe zi'),
('8', 'Parasinus', '2/zi');

-- --------------------------------------------------------

--
-- Table structure for table `parole_securitate`
--

CREATE TABLE `parole_securitate` (
  `parola1` varchar(255) NOT NULL,
  `parola2` varchar(255) NOT NULL,
  `parola3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parole_securitate`
--

INSERT INTO `parole_securitate` (`parola1`, `parola2`, `parola3`) VALUES
('123', '456', '789');

-- --------------------------------------------------------

--
-- Table structure for table `semnalari`
--

CREATE TABLE `semnalari` (
  `id_semnalare` varchar(255) NOT NULL,
  `id_utilizator` varchar(255) NOT NULL,
  `tip_semnalare` varchar(255) NOT NULL,
  `locatie` varchar(255) NOT NULL,
  `descriere` text NOT NULL,
  `tip_animal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semnalari`
--

INSERT INTO `semnalari` (`id_semnalare`, `id_utilizator`, `tip_semnalare`, `locatie`, `descriere`, `tip_animal`) VALUES
('2', '1', 'abandon', 'Ploiesti', '\r\n                    Buna ziua, am gasit o pisica abandonata pe sosea langa oras', 'pisica'),
('3', '2', 'abandon', 'Deva', 'Buna ziua, am gasit abandonate 3 catei pe marginea soselei\r\n                    ', 'caine'),
('4', '3', 'abandon', 'Sannicolau Mare', 'Catel gasit la marginea drumului   de camp. \r\n                    ', 'caine');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id_utilizator` varchar(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `prenume` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id_utilizator`, `nume`, `prenume`, `email`, `parola`, `telefon`) VALUES
('1', 'Andrei', 'Andrei', 'andrei.pop@gmail.com', '123456789', '0761959267'),
('2', 'Utilizator', 'Norbert', 'user2@gmail.com', '123456789', '0761234567'),
('3', 'Popescu', 'Anamaria', 'ana.maria@yahoo.com', 'zapada', '0786543679');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratori`
--
ALTER TABLE `administratori`
  ADD PRIMARY KEY (`id_administrator`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `adoptii`
--
ALTER TABLE `adoptii`
  ADD PRIMARY KEY (`id_adoptie`);

--
-- Indexes for table `animale`
--
ALTER TABLE `animale`
  ADD PRIMARY KEY (`id_animal`);

--
-- Indexes for table `anunturi`
--
ALTER TABLE `anunturi`
  ADD PRIMARY KEY (`id_anunt`),
  ADD KEY `id_utilizator` (`id_utilizator`);

--
-- Indexes for table `boli`
--
ALTER TABLE `boli`
  ADD PRIMARY KEY (`id_boala`);

--
-- Indexes for table `fisa_medicala`
--
ALTER TABLE `fisa_medicala`
  ADD PRIMARY KEY (`id_fisa`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Indexes for table `mapare_boala_medicament`
--
ALTER TABLE `mapare_boala_medicament`
  ADD PRIMARY KEY (`id_mapare`);

--
-- Indexes for table `mapare_fisa_boala`
--
ALTER TABLE `mapare_fisa_boala`
  ADD PRIMARY KEY (`id_mapare`);

--
-- Indexes for table `medicamente`
--
ALTER TABLE `medicamente`
  ADD PRIMARY KEY (`id_medicament`);

--
-- Indexes for table `semnalari`
--
ALTER TABLE `semnalari`
  ADD PRIMARY KEY (`id_semnalare`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id_utilizator`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
