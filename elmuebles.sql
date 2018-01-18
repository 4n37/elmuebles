-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Jan 2018 um 15:23
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `elmuebles`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `CatNo` int(11) NOT NULL,
  `CatName_DE` text NOT NULL,
  `CatName_EN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`CatNo`, `CatName_DE`, `CatName_EN`) VALUES
(1, 'Stühle', 'Chairs'),
(2, 'Tische', 'Tables'),
(3, 'Sofa', 'Sofa'),
(4, 'Lampen', 'Lights');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE `customer` (
  `CustomerNo` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Surname` text NOT NULL,
  `Street` text NOT NULL,
  `Citycode` int(11) NOT NULL,
  `City` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`CustomerNo`, `Name`, `Surname`, `Street`, `Citycode`, `City`, `Email`, `Password`, `IsAdmin`) VALUES
(1, 'Müller', 'Max', 'Musterstrasse 10', 3000, 'Bern', 'maxmuster@url.ch', '1234', 0),
(2, 'Mock', 'Random', 'Quallgasse', 3600, 'Bern', 'mock@domain.ch', '1234', 1),
(3, 'Testmann', 'Testo', 'Test', 3000, 'Test', 'testuser@test.ch', '$2y$10$nBzlJeptmPfszZM8Qtrmz.GxYsdPvr9rVzVPXaVxtOiUFihXEOBNi', 1),
(4, 'Egli', 'Lukas', 'Grossenstrasse ', 2300, 'Biel', 'admin@bfh.ch', '$2y$10$CfeEbOJHJoJizK7gi/mdAepaRVbV2K51Kv3txUInTadGr4.Seh4Hm', 1),
(7, 'Hofer', 'Tod', 'Test', 3200, 'Thun', 'testadmin@bfh.ch', '$2y$10$CTrcIzEuDWevMiiaEinVrumX7BZTKoQ6ApIGG.lJIWfcSE0ejKhM.', 0),
(10, 'Test', 'a', 'Test', 3000, 'Bern', 'v@i.ch', '$2y$10$tjqYJRwljPU35yOOTrRrPeUbqN4vsqXaDscScLocHSCXTU31ioW6W', 0),
(11, 'Klossner', 'lena', 'test234', 1200, 'Thun', 'lena@cool.ch', '$2y$10$qS9fyUiQxKtdWTAuXWeyCuzvb15ig6U2BCwG/mpAyi5jeTLxU8/dq', 0),
(13, 'Hofer', 'Lukas', 'Sulgenauweg', 3008, 'Bern', 'lukashofer@bluemail.ch', '$2y$10$Hd1g4qzrCWP3VXXz3FtStuo2AM.PS79Wpjeu4qCaDPprDzt7q0aty', 0),
(14, '', '', '', 0, '', 'lkjl@bfh.ch', '$2y$10$MrKauL.GWCKOUyc3Qa3YKeZuWRbwIw0LqFAA8e6p5XKeGCJ6CBb6i', 0),
(15, 'asdf', 'af', 'asdf', 3600, 'asdf', 'test@bhf.ch', '$2y$10$0ih.mnIGMMqN1DygwPzcMeQn/FFVSSnw0h8Ye4lN61Bb/yboS8gYO', 0),
(16, 'sdfsf', 'ihk', 'iiuiuhc', 3000, 'sfvd', 's@s.com', '$2y$10$9x42JOrqrs1KAypH9SlRJuhRxuU4YE67kv9BeZBewy13.MJZizyha', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orderpositions`
--

CREATE TABLE `orderpositions` (
  `pos_no` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `product_no` int(11) NOT NULL,
  `product_opt_no` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `orderpositions`
--

INSERT INTO `orderpositions` (`pos_no`, `order_no`, `product_no`, `product_opt_no`, `quantity`) VALUES
(13, 1007, 8, 5, 2),
(14, 1007, 6, 5, 2),
(16, 1011, 7, 5, 1),
(39, 1013, 7, 5, 1),
(40, 1014, 6, 5, 1),
(41, 1014, 12, 5, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `OrderNo` int(11) NOT NULL,
  `OrderDate` date DEFAULT NULL,
  `CustomerNo` int(11) DEFAULT NULL,
  `IsFinished` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`OrderNo`, `OrderDate`, `CustomerNo`, `IsFinished`) VALUES
(1000, '2018-01-16', NULL, 0),
(1001, '2018-01-16', 13, 1),
(1002, '2018-01-16', 13, 1),
(1003, '2018-01-16', NULL, 0),
(1004, '2018-01-16', 13, 1),
(1005, '2018-01-16', 13, 1),
(1006, '2018-01-16', NULL, 0),
(1007, '2018-01-16', NULL, 0),
(1008, '2018-01-16', NULL, 0),
(1009, '2018-01-16', NULL, 0),
(1010, '2018-01-16', 16, 1),
(1011, '2018-01-16', NULL, 0),
(1012, '2018-01-16', 13, 1),
(1013, '2018-01-18', NULL, 0),
(1014, '2018-01-18', NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `ProdNo` int(11) NOT NULL,
  `P_CategoryNo` int(11) NOT NULL,
  `P_desc_DE` longtext NOT NULL,
  `P_desc_EN` longtext NOT NULL,
  `P_Title_DE` longtext NOT NULL,
  `P_Title_EN` longtext NOT NULL,
  `P_Pictures_Big` longtext NOT NULL,
  `P_Pictures_Small` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`ProdNo`, `P_CategoryNo`, `P_desc_DE`, `P_desc_EN`, `P_Title_DE`, `P_Title_EN`, `P_Pictures_Big`, `P_Pictures_Small`) VALUES
(6, 1, 'Stuhl Softleder. Dieser schöne Stuhl verwandelt Sitzen in ein Erlebniss. Die Kombination aus Hochwertgen Materialien und elegantem Design ist ein Schmaus fürs Auge.', 'Chair from Soft Leather. This elegant Chair convers a boring Room in to a spectacle. The elegant design combined with modern technologie makes this Chair a truly great chair.', 'Heces', 'Heces', 'pictures\\Chairs\\heces_2.jpg', 'pictures\\Chairs\\heces.jpg'),
(7, 1, 'Silla ist der Stuhl der ihre Sinne berührt. Die gewählten Materialien lassen sich kaum an Kompfort und Stabilität übertrumpfen. Dieser Stuhl wird sie niemals im Stich lassen.', 'Silla is the Chair who tickels your senses. The choosen Materials are top notch and this chair is never ever going to let you down', 'Silla', 'Silla', 'pictures\\Chairs\\silla.jpg', 'pictures\\Chairs\\silla_2.jpg'),
(8, 1, 'Cocodrillasilla ist nicht nur ein ausergewöhnlicher Name sondern auch ein ausergewähnlicher Stuhl! Mit der Wahl einer ergonomischen Rückenstruktur wird ihre Wirbelsäule fantastisch gestützt.', 'Cocodrillasilla is not only a fancy name further more it is a incredible chair! By supporting your lower back, this chair makes sitting for hours an pleasuring event for your spine. Orthopeds hate this chair.', 'Cocodrillasilla', 'Cocodrillasilla', 'pictures\\Chairs\\cocodrillasilla.jpg', 'pictures\\Chairs\\cocodrillasilla_2.jpg'),
(9, 1, 'Jahrtausende Kultureller ereignisse führten dazu das wir in unserer kleinen Manufaktur disen Stuhl der Geschichte nachgebildet haben. Seine Füsse stehen fest wie die menschliche Geschichte.', 'This Chair resembels thousends of years of cultural evolution. This chair stands as impressive as human culture itself. Get your piece of history now with this astonising chair.', 'Escultura', 'Escultura', 'pictures\\Chairs\\escultura.jpg', 'pictures\\Chairs\\escultura_2.jpg'),
(11, 1, 'Polipel ist der Vorname des Holzfällers welcher das Material dieses Stuhles in stundenlanger Handarbeit zur Vollendung gebracht hat. Holen sie sich dieses Stück Handwerkskunst in ihr Zimmer.', 'Polipiel is the Name of the Man who crafted this Chair by bare Handy. Get this piece of astonising handwork now.', 'Polipiel', 'Polipiel', 'pictures\\Chairs\\polipiel.jpg', 'pictures\\Chairs\\polipiel_2.jpg'),
(12, 2, 'Dieser Tisch beeindruckt durch seine vollendete Form und herausragende Verarbeitungsqualität. Dieser Tisch wird garantiert das neue Highlight in ihrem Zimmer.\r\n', 'This Table is an masterpiece an homage to craftmansship. This Table will most certanly set a new highligt in your room.', 'Al contado\r\n', 'Al contado\r\n', 'pictures\\Tables\\contaible_2.jpg', 'pictures\\Tables\\contaible.jpg'),
(14, 2, 'Mesa de comedor ist ein Tisch aus italienschem Feinholz. Die struktur dieses Holzes beeindruckt durch stilvolle muster und jeder Tisch ist durch die Struktur ein Unikat. ', 'Mesa de comedor is a Table made out of italian finewood. This wood is very stylish and every piece is truly unique.', 'Mesa de comedor', 'Mesa de comedor', 'pictures\\Tables\\mesa_de_comed_3.jpg', 'pictures\\Tables\\mesa_de_comed_2.jpg'),
(15, 2, 'Madera der Tisch der Ihre Sinne tickelt. Ein so sinnlicher Tisch aus den sinnlichsten Materialen mag sich für besonnene am besten eignen. Ein Meisterstück.', 'Madera is a sensual experience. A so truly sensible table should sensibly be put in an sensible location inside your room.', 'Madera', 'Madera', 'pictures\\Tables\\madera_4.jpg', 'pictures\\Tables\\madera_3.jpg'),
(16, 3, 'Das Lacama Ecksofa aus feinem Ledder-Nappa dem teuerstem Leder vom Nappa Rind eignet sich mehr fürs anschauen als fürs Sitzen. Ein Muss für alle Designer.', 'The Lacama leather sofa is made out of fine Nappa-leather. This sofa is so expensive you really dont want to sit on it.', 'Lacama', 'Lacama', 'pictures\\Sofas\\sofa_lacama.jpg', 'pictures\\Sofas\\sofa_lacama.jpg'),
(17, 4, 'Lampara aus Edelstahl und Titanium ist mit einer silberiod eloxierten Schicht gefertigt und strahlt dadurch nicht nur Licht sondern Wohlhabenheit aus.', 'Lampara made from stainless steel and titanium consists out of an silveriod layer wich reflects not only light but your wealth.', 'Lampara', 'Lampara', 'pictures\\Lights\\lampara.jpg', 'pictures\\Lights\\lampara_2.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `productopt`
--

CREATE TABLE `productopt` (
  `ProdOptNo` int(11) NOT NULL,
  `ProdNo` int(11) NOT NULL,
  `Color` text NOT NULL,
  `PO_Price` float NOT NULL,
  `PO_Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `productopt`
--

INSERT INTO `productopt` (`ProdOptNo`, `ProdNo`, `Color`, `PO_Price`, `PO_Stock`) VALUES
(1, 8, 'Schwarz', 498, 200),
(3, 12, 'Schwarz', 4788, 100),
(4, 9, 'Schwarz', 690, 100),
(5, 17, 'Schwarz', 2999, 100),
(6, 15, 'Schwarz', 5786, 100),
(7, 14, 'Schwarz', 4566, 100),
(8, 11, 'Schwarz', 400, 50),
(9, 7, 'Schwarz', 500, 80),
(10, 6, 'Schwarz', 320, 100),
(11, 16, 'Schwarz', 3244, 100),
(12, 6, 'Weiss', 355, 100);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CatNo`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerNo`,`Email`(50)) USING BTREE;

--
-- Indizes für die Tabelle `orderpositions`
--
ALTER TABLE `orderpositions`
  ADD PRIMARY KEY (`pos_no`),
  ADD KEY `PosOrderNo_OrderNo` (`order_no`),
  ADD KEY `PosProdNo_ProdNo` (`product_no`),
  ADD KEY `PosOptNo_ProdOptNo` (`product_opt_no`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderNo`),
  ADD KEY `CustomerNo` (`CustomerNo`);

--
-- Indizes für die Tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProdNo`) USING BTREE,
  ADD KEY `ProdCatNo_CatNo` (`P_CategoryNo`);

--
-- Indizes für die Tabelle `productopt`
--
ALTER TABLE `productopt`
  ADD PRIMARY KEY (`ProdOptNo`),
  ADD KEY `ProdNo` (`ProdNo`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `CatNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `orderpositions`
--
ALTER TABLE `orderpositions`
  MODIFY `pos_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `ProdNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `productopt`
--
ALTER TABLE `productopt`
  MODIFY `ProdOptNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `orderpositions`
--
ALTER TABLE `orderpositions`
  ADD CONSTRAINT `PosOptNo_ProdOptNo` FOREIGN KEY (`product_opt_no`) REFERENCES `productopt` (`ProdOptNo`),
  ADD CONSTRAINT `PosOrderNo_OrderNo` FOREIGN KEY (`order_no`) REFERENCES `orders` (`OrderNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PosProdNo_ProdNo` FOREIGN KEY (`product_no`) REFERENCES `product` (`ProdNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `OrderCustNo_CustNo` FOREIGN KEY (`CustomerNo`) REFERENCES `customer` (`CustomerNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `ProdCatNo_CatNo` FOREIGN KEY (`P_CategoryNo`) REFERENCES `category` (`CatNo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `productopt`
--
ALTER TABLE `productopt`
  ADD CONSTRAINT `ProdOptProdNo_ProdNo` FOREIGN KEY (`ProdNo`) REFERENCES `product` (`ProdNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
