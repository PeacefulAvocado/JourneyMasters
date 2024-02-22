-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Feb 22. 12:08
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `journeymastersdatabase`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csomagok`
--

CREATE TABLE `csomagok` (
  `honnan` varchar(50) NOT NULL,
  `celpont` varchar(50) NOT NULL,
  `mettol` date NOT NULL,
  `meddig` date NOT NULL,
  `utazasmod` varchar(50) NOT NULL,
  `ar` double NOT NULL,
  `aktiv` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `csomagok`
--

INSERT INTO `csomagok` (`honnan`, `celpont`, `mettol`, `meddig`, `utazasmod`, `ar`, `aktiv`) VALUES
('Budapest', 'Bayview Retreat', '2024-05-06', '2024-05-10', 'Repülő', 93000, b'1'),
('Budapest', 'Bondi Beach House', '2024-05-08', '2024-05-16', 'Repülő', 158000, b'1'),
('Prága', 'Central Hotel', '2024-02-01', '2024-02-22', 'Vonat', 100000, b'1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csoport`
--

CREATE TABLE `csoport` (
  `utasid` int(11) NOT NULL,
  `utazasid` int(11) NOT NULL,
  `csoportid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `helyszin`
--

CREATE TABLE `helyszin` (
  `nev` varchar(50) NOT NULL,
  `varos` varchar(50) DEFAULT NULL,
  `cim` varchar(50) NOT NULL,
  `minoseg` varchar(50) DEFAULT NULL,
  `csillag` int(11) DEFAULT NULL,
  `leiras` varchar(500) NOT NULL,
  `aktiv` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `helyszin`
--

INSERT INTO `helyszin` (`nev`, `varos`, `cim`, `minoseg`, `csillag`, `leiras`, `aktiv`) VALUES
('Bayview Retreat', 'San Francisco', 'Ocean Beach 15', 'Apartman', 3, 'Fedezd fel a világ legikonikusabb operaházát!\r\nAhol az elegancia és a kifinomultság találkozik a lenyűgöző kilátással a Sydney kikötőre! Fedezze fel velünk az exkluzív kényelem és a páratlan vendégszeretet harmonikus összhangját.', b'1'),
('Bondi Beach House', 'Sydney', 'Campbell Parade 20', 'Apartman', 3, 'Élvezze az arab világ csendes luxusát. \r\nÉlvezze az arab világ csendes luxusát. Fedezze fel a világ legnagyobb sivatagának határvidékét!', b'1'),
('Central Hotel', 'Budapest', 'Károly körút 10', 'Hotel', 4, 'Teszt.\r\nTeszlek. Megteszlek. Szétteszlek.', b'1'),
('Cityscape Hotel', 'Chicago', 'Michigan Ave 500', 'Hotel', 4, '', b'1'),
('Danube View Hotel', 'Vienna', 'Donaukanal Promenade 8', 'Hotel', 4, '', b'1'),
('Golden Gate Hotel', 'San Francisco', 'Lombard Street 100', 'Hotel', 4, '', b'1'),
('Grand Central Hotel', 'New York City', '123 Broadway Ave', 'Hotel', 4, '', b'1'),
('Harbor Lights Inn', 'San Francisco', 'Pier 39 1', 'Hotel', 4, '', b'1'),
('Harborview Suites', 'Sydney', 'Circular Quay 2', 'Hotel', 4, '', b'1'),
('Hotel Elegance', 'Vienna', 'Hauptstraße 12', 'Hotel', 4, '', b'1'),
('Imperial Residence', 'Vienna', 'Schönbrunn Palace 1', 'Hotel', 5, '', b'1'),
('Lakeview Lodge', 'Chicago', 'Lake Shore Drive 22', 'Apartman', 3, '', b'1'),
('Le Château Belle', 'Paris', 'Rue de Rivoli 1', 'Hotel', 5, '', b'1'),
('Luxus Palace Hotel', 'Budapest', 'Váci utca 22', 'Hotel', 5, '', b'1'),
('Magnificent Mile Inn', 'Chicago', 'Wacker Drive 8', 'Hotel', 4, '', b'1'),
('Manhattan Tower Suites', 'New York City', '5th Avenue 55', 'Hotel', 4, '', b'1'),
('Montmartre Retreat', 'Paris', 'Rue des Abbesses 10', 'Hotel', 3, '', b'1'),
('Riverside Suites', 'Budapest', 'Bem rakpart 15', 'Hotel', 4, '', b'1'),
('Seine River B&B', 'Paris', 'Quai de la Tournelle 5', 'Hotel', 4, '', b'1'),
('Sunshine Hotel', 'Sydney', 'Beach Road 45', 'Hotel', 4, '', b'1'),
('Times Square View Hotel', 'New York City', '7th Avenue 20', 'Hotel', 4, '', b'1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szolgaltatasok`
--

CREATE TABLE `szolgaltatasok` (
  `nev` varchar(50) NOT NULL,
  `sajat_furdo` bit(1) NOT NULL DEFAULT b'0',
  `terasz` bit(1) NOT NULL DEFAULT b'0',
  `franciaagy` bit(1) NOT NULL DEFAULT b'0',
  `gyerekbarat` bit(1) NOT NULL DEFAULT b'0',
  `ac` bit(1) NOT NULL DEFAULT b'0',
  `konyha` bit(1) NOT NULL DEFAULT b'0',
  `parkolas` bit(1) NOT NULL DEFAULT b'0',
  `tv` bit(1) NOT NULL DEFAULT b'0',
  `gym` bit(1) NOT NULL DEFAULT b'0',
  `medence` bit(1) NOT NULL DEFAULT b'0',
  `bar` bit(1) NOT NULL DEFAULT b'0',
  `internet` bit(1) NOT NULL DEFAULT b'0',
  `szef` bit(1) NOT NULL DEFAULT b'0',
  `akadalymentes` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `userdata`
--

CREATE TABLE `userdata` (
  `utasid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jelszo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `utasok`
--

CREATE TABLE `utasok` (
  `utasazon` int(11) NOT NULL,
  `nev` varchar(50) DEFAULT NULL,
  `szulev` int(11) DEFAULT NULL,
  `szulho` int(11) DEFAULT NULL,
  `szulnap` int(11) DEFAULT NULL,
  `kor` int(11) DEFAULT NULL,
  `nem` varchar(50) DEFAULT NULL,
  `igtipus` varchar(50) DEFAULT NULL,
  `igszam` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `orszag` varchar(50) DEFAULT NULL,
  `irszam` varchar(50) DEFAULT NULL,
  `varos` varchar(50) DEFAULT NULL,
  `utca` varchar(50) DEFAULT NULL,
  `erttel` varchar(50) DEFAULT NULL,
  `ertemail` varchar(50) DEFAULT NULL,
  `biztnev` varchar(50) DEFAULT NULL,
  `fizmod` varchar(50) DEFAULT NULL,
  `aktiv` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `utasok`
--

INSERT INTO `utasok` (`utasazon`, `nev`, `szulev`, `szulho`, `szulnap`, `kor`, `nem`, `igtipus`, `igszam`, `tel`, `email`, `orszag`, `irszam`, `varos`, `utca`, `erttel`, `ertemail`, `biztnev`, `fizmod`, `aktiv`) VALUES
(1, 'Maria Garcia', 1988, 11, 3, 35, 'Nő', 'Személyi igazolvány', '876543210', '+36123456787', 'mariagarcia@example.com', 'Magyarország', '4321', 'Szeged', 'Kossuth tér 2', '+36123456787', 'ertesitesi3@example.com', 'Biztosító Kft.', 'Banki átutalás', b'1'),
(2, 'Robert Johnson', 1979, 9, 25, 44, 'Férfi', 'Személyi igazolvány', '543210987', '+36123456786', 'robertjohnson@example.com', 'Magyarország', '1234', 'Budapest', 'Erzsébet tér 3', '+36123456786', 'ertesitesi4@example.com', 'Insurance Co.', 'Banki átutalás', b'1'),
(3, 'Jennifer Martinez', 1995, 4, 12, 28, 'Nő', 'Útlevél', '789012345', '+36123456785', 'jennifermartinez@example.com', 'Magyarország', '5678', 'Debrecen', 'Arany János utca 4', '+36123456785', 'ertesitesi5@example.com', 'Journey Masters', 'Készpénz', b'1'),
(4, 'William Smith', 1983, 2, 18, 38, 'Férfi', 'Útlevél', '654321098', '+36123456784', 'williamsmith@example.com', 'Magyarország', '9876', 'Szeged', 'Száchenyi tér 5', '+36123456784', 'ertesitesi6@example.com', 'Biztosító Kft.', 'Banki átutalás', b'1'),
(5, 'Linda Davis', 2001, 6, 7, 22, 'Nő', 'Személyi igazolvány', '123456789', '+36123456783', 'lindadavis@example.com', 'Magyarország', '3456', 'Pécs', 'Ady Endre utca 6', '+36123456783', 'ertesitesi7@example.com', 'Guardian Insurance', 'Készpénz', b'1'),
(6, 'David Smith', 1990, 3, 30, 31, 'Férfi', 'Személyi igazolvány', '234567891', '+36123456782', 'davidsmith@example.com', 'Magyarország', '8765', 'Győr', 'Szent István tér 7', '+36123456782', 'ertesitesi8@example.com', 'Maple Insurance', 'Hitelkártya', b'1'),
(7, 'Sophia Brown', 1986, 1, 15, 37, 'Nő', 'Útlevél', '345678912', '+36123456781', 'sophiabrown@example.com', 'Magyarország', '2345', 'Miskolc', 'Péterfy Sándor utca 8', '+36123456781', 'ertesitesi9@example.com', 'BiztoSeguros', 'Készpénz', b'1'),
(8, 'Michael Johnson', 1997, 7, 24, 26, 'Férfi', 'Személyi igazolvány', '456789123', '+36123456780', 'michaeljohnson@example.com', 'Magyarország', '5432', 'Eger', 'Dobó tér 1', '+36123456780', 'ertesitesi10@example.com', 'Biztosító Kft.', 'Banki átutalás', b'1'),
(9, 'Sarah Wilson', 1993, 8, 13, 30, 'Nő', 'Személyi igazolvány', '654987321', '+36123456779', 'sarahwilson@example.com', 'Magyarország', '1234', 'Budapest', 'Rákóczi út 5', '+36123456779', 'ertesitesi11@example.com', 'Journey Masters', 'Banki átutalás', b'1'),
(10, 'James Anderson', 1987, 4, 21, 36, 'Férfi', 'Személyi igazolvány', '987654123', '+36123456778', 'jamesanderson@example.com', 'Magyarország', '5678', 'Debrecen', 'Piac utca 4', '+36123456778', 'ertesitesi12@example.com', 'SeguroUno', 'PayPal', b'1'),
(11, 'Olivia Smith', 2003, 2, 5, 20, 'Nő', 'Útlevél', '321654987', '+36123456777', 'oliviasmith@example.com', 'Magyarország', '9876', 'Szeged', 'Dugonics tér 1', '+36123456777', 'ertesitesi13@example.com', 'Biztosító Kft.', 'Hitelkártya', b'1'),
(12, 'Robert White', 1992, 10, 30, 29, 'Férfi', 'Útlevél', '456987321', '+36123456776', 'robertwhite@example.com', 'Magyarország', '3456', 'Pécs', 'Király utca 6', '+36123456776', 'ertesitesi14@example.com', 'BiztoSeguros', 'Készpénz', b'1'),
(13, 'Sophia Martinez', 2004, 7, 15, 19, 'Nő', 'Személyi igazolvány', '654321987', '+36123456775', 'sophiamartinez@example.com', 'Magyarország', '8765', 'Győr', 'Káptalan utca 2', '+36123456775', 'ertesitesi15@example.com', 'Biztosító Kft.', 'Banki átutalás', b'1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `utazas`
--

CREATE TABLE `utazas` (
  `utazasazon` int(11) NOT NULL,
  `utasazon` int(11) NOT NULL,
  `honnan` varchar(50) DEFAULT NULL,
  `celpont` varchar(50) DEFAULT NULL,
  `mettol` date NOT NULL,
  `meddig` date DEFAULT NULL,
  `utazasmod` varchar(50) DEFAULT NULL,
  `ellatas` varchar(50) DEFAULT NULL,
  `ar` double DEFAULT NULL,
  `aktiv` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `utazas`
--

INSERT INTO `utazas` (`utazasazon`, `utasazon`, `honnan`, `celpont`, `mettol`, `meddig`, `utazasmod`, `ellatas`, `ar`, `aktiv`) VALUES
(3, 1, 'Budapest, Magyarország', 'Lakeview Lodge', '2023-11-01', '2023-11-07', 'Repülő', 'All inclusive', 1200, b'1'),
(5, 2, 'New York City, Egyesült Államok', 'Central Hotel', '2023-12-15', '2023-12-25', 'Repülő', 'Félpanzió', 1500, b'1'),
(4, 4, 'London, Egyesült Királyság', 'Imperial Residence', '2023-12-05', '2023-09-12', 'Vonat', 'Szállás és Reggeli', 300, b'1'),
(6, 5, 'Paris, Franciaország', 'Le Château Belle', '2024-02-20', '2024-02-28', 'Egyéni', 'Csak Szállás', 400, b'1'),
(7, 6, 'San Francisco, Egyesült Államok', 'Cityscape Hotel', '2023-11-08', '2023-08-10', 'Busz', 'All inclusive', 500, b'1'),
(2, 6, 'Berlin, Németország', 'Sunshine Hotel', '2024-04-01', '2024-04-05', 'Repülő', 'Félpanzió', 350, b'1'),
(9, 7, 'Tokió, Japán', 'Riverside Suites', '2024-01-10', '2024-01-18', 'Repülő', 'Teljes panzió', 1800, b'1'),
(8, 7, 'Sydney, Ausztrália', 'Central Hotel', '2024-03-15', '2024-03-20', 'Repülő', 'All inclusive', 600, b'1'),
(1, 8, 'Barcelona, Spanyolország', 'Cityscape Hotel', '2023-10-25', '2023-10-30', 'Repülő', 'Szállás és Reggeli', 400, b'1'),
(10, 10, 'Vienna, Ausztria', 'Montmartre Retreat', '2023-10-25', '2023-10-30', 'Vonat', 'Félpanzió', 1000, b'1');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `csomagok`
--
ALTER TABLE `csomagok`
  ADD PRIMARY KEY (`honnan`,`celpont`,`mettol`),
  ADD KEY `celpont` (`celpont`);

--
-- A tábla indexei `csoport`
--
ALTER TABLE `csoport`
  ADD PRIMARY KEY (`utasid`,`utazasid`),
  ADD KEY `utazasid` (`utazasid`);

--
-- A tábla indexei `helyszin`
--
ALTER TABLE `helyszin`
  ADD PRIMARY KEY (`nev`,`cim`);

--
-- A tábla indexei `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  ADD PRIMARY KEY (`nev`);

--
-- A tábla indexei `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`utasid`);

--
-- A tábla indexei `utasok`
--
ALTER TABLE `utasok`
  ADD PRIMARY KEY (`utasazon`);

--
-- A tábla indexei `utazas`
--
ALTER TABLE `utazas`
  ADD PRIMARY KEY (`utasazon`,`mettol`),
  ADD KEY `fk_helyszin` (`celpont`),
  ADD KEY `utazasazon` (`utazasazon`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `utasok`
--
ALTER TABLE `utasok`
  MODIFY `utasazon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `csomagok`
--
ALTER TABLE `csomagok`
  ADD CONSTRAINT `csomagok_ibfk_1` FOREIGN KEY (`celpont`) REFERENCES `helyszin` (`nev`);

--
-- Megkötések a táblához `csoport`
--
ALTER TABLE `csoport`
  ADD CONSTRAINT `csoport_ibfk_1` FOREIGN KEY (`utasid`) REFERENCES `utasok` (`utasazon`),
  ADD CONSTRAINT `csoport_ibfk_2` FOREIGN KEY (`utazasid`) REFERENCES `utazas` (`utazasazon`);

--
-- Megkötések a táblához `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  ADD CONSTRAINT `szolgaltatasok_ibfk_1` FOREIGN KEY (`nev`) REFERENCES `helyszin` (`nev`);

--
-- Megkötések a táblához `userdata`
--
ALTER TABLE `userdata`
  ADD CONSTRAINT `userdata_ibfk_1` FOREIGN KEY (`utasid`) REFERENCES `utasok` (`utasazon`);

--
-- Megkötések a táblához `utazas`
--
ALTER TABLE `utazas`
  ADD CONSTRAINT `fk_helyszin` FOREIGN KEY (`celpont`) REFERENCES `helyszin` (`nev`),
  ADD CONSTRAINT `fk_utas` FOREIGN KEY (`utasazon`) REFERENCES `utasok` (`utasazon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
