-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 07:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazapodataka`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `ime_korisnika` varchar(45) DEFAULT NULL,
  `email_korisnika` varchar(255) NOT NULL,
  `korisnicko_ime` varchar(16) NOT NULL,
  `telefon_korisnika` varchar(45) NOT NULL,
  `korisnicka_lozinka` varchar(32) NOT NULL,
  `ulica` varchar(45) NOT NULL,
  `postanski_broj` varchar(45) DEFAULT NULL,
  `grad` varchar(45) NOT NULL,
  `drzava` varchar(45) DEFAULT NULL,
  `funkcija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `ime_korisnika`, `email_korisnika`, `korisnicko_ime`, `telefon_korisnika`, `korisnicka_lozinka`, `ulica`, `postanski_broj`, `grad`, `drzava`, `funkcija`) VALUES
(1, 'Mirza Ljubijankić', 'mirza.ljubijankic@gmail.com', 'Mizra', '062617293', '123456', 'Harmanska', '77000', 'Bihać', 'BiH', 1),
(2, 'Eniz Ičanović', 'eniz_eno@live.com', 'Eniz', '061726382', '12345', '5. Korpusa', '77000', 'Bihać', 'BiH', 1),
(3, 'Emina Midžić', 'emina_282@gmail.com', 'Emina', '0608273920', '7654', 'Korpusa', '77000', 'Bihać', 'BiH', 2),
(4, 'Aldin Begić', 'aldin_begic@gmail.com', 'Aldin', '062827392', '23456', 'Bosanskih Branilaca', '77000', 'Bihać', 'BiH', 2),
(5, 'Edin Murtić', 'edin_murta@gmail.com', 'Murta', '061029384', '876543', 'Harmanska', '77000', 'Bihać', 'BiH', 2),
(6, 'Ismail Suljić', 'cajo.suljic@outlook.com', 'Smajo', '062839204', '098765', 'Korpusa', '77000', 'Bihać', 'BiH', 2),
(7, 'Benjamin Galić', 'benjo_galic@outlook.com', 'Benjo', '062928102', '765467', 'Bosanskih branilaca', '77000', 'Bihać', 'BiH', 2),
(8, 'Amira Midžić', 'amira_mirka@gmail.com', 'Amy', '062837402', '9594940', 'Korpusa', '77000', 'Bihać', 'BiH', 2),
(9, 'Nejra Melkić', 'melkic.nejra@outlook.com', 'Nejra', '0608271920', '98765', 'Harmanska', '77000', 'Bihać', 'BiH', 2),
(10, 'Amar Bratić', 'bratex56@gmail.com', 'Amar', '061028373', '987654', 'Bosanskih branilaca', '77000', 'Bihać', 'BiH', 2),
(11, 'Benjmin Bender', 'ben.ben@outlook.com', 'Benjamin', '062828495', '87654', 'Bosanskih branilaca', '77000', 'Bihać', 'BiH', 2),
(12, 'Sandra Knežević', 'sandra.knezevic@gmail.com', 'Sandra', '0602829304', '98765', 'Korpusa', '77000', 'Bihać', 'BiH', 2),
(13, 'Ivan Ivušić', 'ivan_ivy@gmail.com', 'Ivan', '061928283', '98765', 'Harmanska', '77000', 'Bihać', 'BiH', 2),
(14, 'Elvis Hodžić', 'ely_arsenal@gmail.com', 'Eli', '062192839', '987654', 'Korpusa', '77000', 'Bihać', 'BiH', 1),
(15, 'Husnija Hafurić', 'husnija_hafuric@outlook.com', 'Huska', '062010245', '9876587', 'Harmanska', '77000', 'Bihać', 'BiH', 1),
(17, 'test', 'test@test.com', 'test2', '0000', 'test2', 'test', '77000', 'Bihać', 'BiH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `narudzba_id` int(11) NOT NULL,
  `datum_narudzbe` datetime NOT NULL DEFAULT current_timestamp(),
  `status_narudzbe` tinyint(4) NOT NULL DEFAULT 0,
  `iznos_uplate` decimal(7,2) DEFAULT 0.00,
  `datum_uplate` datetime DEFAULT current_timestamp(),
  `nacin_placanja` int(11) DEFAULT 1,
  `rezervisano` tinyint(4) DEFAULT 1,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`narudzba_id`, `datum_narudzbe`, `status_narudzbe`, `iznos_uplate`, `datum_uplate`, `nacin_placanja`, `rezervisano`, `korisnik_id`) VALUES
(1, '2022-03-20 20:00:00', 1, '80.00', '2023-03-20 20:00:00', 1, 1, 1),
(2, '2015-02-20 20:00:00', 0, '135.00', '2017-02-20 20:00:00', 0, 0, 2),
(3, '2001-03-20 20:00:00', 1, '75.00', '2001-03-20 20:00:00', 1, 1, 3),
(4, '2010-03-20 20:00:00', 1, '15.00', '2013-03-20 20:00:00', 1, 0, 4),
(5, '2031-03-20 20:00:00', 0, '44.50', '2031-03-20 20:00:00', 1, 0, 5),
(6, '2031-03-20 20:00:00', 0, '50.00', '2031-03-20 20:00:00', 0, 1, 6),
(7, '2028-02-20 20:00:00', 1, '150.00', '2028-02-20 20:00:00', 0, 1, 7),
(8, '2017-03-20 20:00:00', 0, '130.00', '2020-03-20 20:00:00', 1, 1, 8),
(9, '2021-03-20 20:00:00', 1, '225.00', '2021-03-20 20:00:00', 0, 0, 9),
(11, '2020-06-05 00:00:00', 1, '80.00', '2020-06-05 00:00:00', 0, 0, 1),
(14, '2020-06-05 18:16:38', 1, '80.00', '2020-06-05 18:16:38', 0, 0, 1),
(15, '2020-06-05 18:28:25', 1, '80.00', '2020-06-05 18:28:25', 0, 0, 1),
(16, '2020-06-05 18:28:25', 1, '80.00', '2020-06-05 18:28:25', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `narudzba_stavka`
--

CREATE TABLE `narudzba_stavka` (
  `idnarudzba_stavka` int(11) NOT NULL,
  `obuca_id` int(11) DEFAULT NULL,
  `kolicina_stavke` int(11) NOT NULL DEFAULT 0,
  `cijena_stavke` decimal(6,2) NOT NULL DEFAULT 0.00,
  `korisnik_id` int(11) NOT NULL,
  `narudzba_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `narudzba_stavka`
--

INSERT INTO `narudzba_stavka` (`idnarudzba_stavka`, `obuca_id`, `kolicina_stavke`, `cijena_stavke`, `korisnik_id`, `narudzba_id`) VALUES
(1, 2, 1, '99.90', 1, 1),
(2, 4, 2, '99.90', 2, 2),
(3, 3, 1, '99.90', 3, 3),
(4, 5, 1, '99.90', 4, 4),
(5, 6, 1, '99.90', 4, 4),
(6, 2, 1, '99.90', 5, 5),
(7, 4, 1, '99.90', 6, 6),
(8, 7, 1, '99.90', 7, 7),
(9, 5, 1, '99.90', 8, 8),
(10, 4, 1, '99.90', 9, 9),
(11, 1, 1, '80.00', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `obuca`
--

CREATE TABLE `obuca` (
  `obuca_id` int(11) NOT NULL,
  `naziv_obuce` varchar(255) NOT NULL,
  `opis_obuce` varchar(45) DEFAULT NULL,
  `godina_proizvodnje` varchar(45) DEFAULT NULL,
  `broj_obuce` varchar(45) DEFAULT NULL,
  `boja_obuce` varchar(45) DEFAULT NULL,
  `proizvodjac` varchar(45) DEFAULT NULL,
  `obuca_slika` varchar(45) DEFAULT NULL,
  `sastav` varchar(45) DEFAULT NULL,
  `cijena` decimal(6,2) NOT NULL,
  `stanje` int(11) NOT NULL,
  `korisnik_id` int(11) DEFAULT NULL,
  `trgovina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obuca`
--

INSERT INTO `obuca` (`obuca_id`, `naziv_obuce`, `opis_obuce`, `godina_proizvodnje`, `broj_obuce`, `boja_obuce`, `proizvodjac`, `obuca_slika`, `sastav`, `cijena`, `stanje`, `korisnik_id`, `trgovina_id`) VALUES
(1, 'patike', 'muške patike', '2020', '42', 'crna', 'Nike', 'sl1.jpg', 'teksil i vještačka koža', '80.00', 20, 1, 1),
(3, 'patike', 'ženske patike', '2020', '39', 'crvena', 'Adidas', 'sl2.jpg', 'teksil i vještačka koža', '99.90', 30, 2, 1),
(4, 'patike', 'muške patike', '2019', '44', 'plava', 'Nike', 'sl3.jpg', 'teksil i vještačka koža', '99.90', 10, 3, 1),
(5, 'patike', 'ženske patike', '2020', '38', 'crna', 'Reebok', 'sl4.jpg', 'teksil i vještačka koža', '99.90', 1, 4, 1),
(6, 'patike', 'ženske patike', '2020', '39', 'crvena', 'Nike', 'sl5.jpg', 'teksil i vještačka koža', '99.90', 5, 5, 1),
(7, 'patike', 'muške patike', '2020', '44', 'siva', 'Nike', 'sl6.jpg', 'teksil i vještačka koža', '99.90', 3, 6, 1),
(8, 'patike', 'ženske patike', '2020', '38', 'bijela', 'Adidas', 'sl7.jpg', 'teksil i vještačka koža', '99.90', 20, 7, 1),
(9, 'patike', 'muške patike', '2020', '44', 'crna', 'Nike', 'sl8.jpg', 'teksil i vještačka koža', '99.90', 6, 8, 1),
(10, 'patike', 'muške patike', '2019', '43', 'bijela', 'Reebok', 'sl8.jpg', 'teksil i vještačka koža', '99.90', 3, 9, 1),
(11, 'patike', 'muške patike', '2020', '40', 'crna', 'Adidas', 'sl10.jpg', 'teksil i vještačka koža', '99.90', 8, 10, 1),
(12, 'patike', 'ženske patike', '2020', '37', 'plava', 'Nike', 'sl11.jpg', 'teksil i vještačka koža', '99.90', 11, 11, 1),
(13, 'patike', 'ženske patike', '2019', '39', 'crna', 'Nike', 'sl12.jpg', 'teksil i vještačka koža', '99.90', 7, 12, 1),
(14, 'patike', 'muške patike', '2020', '42', 'crna', 'Adidas', 'sl13.jpg', 'teksil i vještačka koža', '99.90', 4, 13, 1),
(15, 'patike', 'ženske patike', '2020', '38', 'crvena', 'Adidas', 'sl14.jpg', 'teksil i vještačka koža', '99.90', 2, 14, 1),
(16, 'tenisice', 'tenisice polovne', '1996', '46', 'narandžasto-plava', 'Adidas', 'sl19.jpg', 'PVC ALU', '150.00', 45050, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trgovina`
--

CREATE TABLE `trgovina` (
  `idtrgovina` int(11) NOT NULL,
  `direktor` varchar(45) DEFAULT NULL,
  `telefon` varchar(45) DEFAULT NULL,
  `dodatne_informacije` varchar(45) DEFAULT NULL,
  `ulica` varchar(45) DEFAULT NULL,
  `postanski_broj` varchar(45) DEFAULT NULL,
  `grad` varchar(45) DEFAULT NULL,
  `drzava` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trgovina`
--

INSERT INTO `trgovina` (`idtrgovina`, `direktor`, `telefon`, `dodatne_informacije`, `ulica`, `postanski_broj`, `grad`, `drzava`) VALUES
(1, 'Husnija', '033928304', 'direktor trgovine 1', '5. korpusa', '77000', 'Bihać', 'BiH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`narudzba_id`),
  ADD KEY `fk_narudzba_idx` (`korisnik_id`);

--
-- Indexes for table `narudzba_stavka`
--
ALTER TABLE `narudzba_stavka`
  ADD PRIMARY KEY (`idnarudzba_stavka`),
  ADD KEY `fk_narudzba_korisnik_idx` (`korisnik_id`),
  ADD KEY `fk_narudzba_stavka_idx` (`narudzba_id`);

--
-- Indexes for table `obuca`
--
ALTER TABLE `obuca`
  ADD PRIMARY KEY (`obuca_id`),
  ADD KEY `fk_obuca_idx` (`korisnik_id`),
  ADD KEY `fk_obuca_trgovina_idx` (`trgovina_id`);

--
-- Indexes for table `trgovina`
--
ALTER TABLE `trgovina`
  ADD PRIMARY KEY (`idtrgovina`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `narudzba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `narudzba_stavka`
--
ALTER TABLE `narudzba_stavka`
  MODIFY `idnarudzba_stavka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `obuca`
--
ALTER TABLE `obuca`
  MODIFY `obuca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `trgovina`
--
ALTER TABLE `trgovina`
  MODIFY `idtrgovina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD CONSTRAINT `fk_narudzba` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`);

--
-- Constraints for table `narudzba_stavka`
--
ALTER TABLE `narudzba_stavka`
  ADD CONSTRAINT `fk_narudzba_korisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `fk_narudzba_stavka` FOREIGN KEY (`narudzba_id`) REFERENCES `narudzba` (`narudzba_id`);

--
-- Constraints for table `obuca`
--
ALTER TABLE `obuca`
  ADD CONSTRAINT `fk_obuca_korisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `fk_obuca_trgovina` FOREIGN KEY (`trgovina_id`) REFERENCES `trgovina` (`idtrgovina`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
