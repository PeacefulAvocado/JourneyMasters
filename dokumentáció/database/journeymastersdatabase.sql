-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Feb 29. 13:47
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
  `csomagid` int(11) NOT NULL,
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

INSERT INTO `csomagok` (`csomagid`, `honnan`, `celpont`, `mettol`, `meddig`, `utazasmod`, `ar`, `aktiv`) VALUES
(1, 'New York', 'Cityscape Hotel', '2024-02-04', '2024-02-14', 'Busz', 200000, b'1'),
(2, 'Budapest', 'Bayview Retreat', '2024-05-06', '2024-05-10', 'Repülő', 330000, b'1'),
(3, 'Budapest', 'Bondi Beach House', '2024-05-08', '2024-05-16', 'Repülő', 158000, b'1'),
(4, 'Prága', 'Central Hotel', '2024-02-01', '2024-02-08', 'Vonat', 143000, b'1'),
(5, 'Budapest', 'Magnificent Mile Inn', '2024-04-10', '2024-04-15', 'Repülő', 400000, b'1'),
(6, 'Sydney', 'Golden Gate Hotel', '2024-03-01', '2024-03-10', 'Repülő', 280000, b'1'),
(7, 'Vienna', 'Danube View Hotel', '2024-04-15', '2024-04-20', 'Repülő', 400000, b'1'),
(8, 'Sydney', 'Harbor Lights Inn', '2024-06-01', '2024-06-10', 'Repülő', 280000, b'1'),
(9, 'Paris', 'Montmartre Retreat', '2024-08-10', '2024-08-20', 'Vonat', 350000, b'1');

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
('Central Hotel', 'Budapest', 'Károly körút 10', 'Hotel', 4, 'Discover the charm of the Central Hotel in the heart of Budapest. Situated on Károly körút, this historic hotel offers elegant accommodations and easy access to the city\'s iconic landmarks.', b'1'),
('Cityscape Hotel', 'Chicago', 'Michigan Ave 500', 'Hotel', 4, 'Explore the vibrant city life of Chicago with a stay at the Cityscape Hotel. Conveniently located on Michigan Avenue, enjoy easy access to the city\'s top attractions and stunning views of the skyline.', b'1'),
('Danube View Hotel', 'Vienna', 'Donaukanal Promenade 8', 'Hotel', 4, 'Experience the breathtaking views of the Danube River from the Danube View Hotel in Vienna. Located on Donaukanal Promenade, this hotel offers luxurious accommodations and easy access to Vienna\'s top attractions.', b'1'),
('Golden Gate Hotel', 'San Francisco', 'Lombard Street 100', 'Hotel', 4, 'Discover the charm of San Francisco at the Golden Gate Hotel. Situated on Lombard Street, this historic hotel offers elegant accommodations and easy access to San Francisco\'s top attractions.', b'1'),
('Grand Central Hotel', 'New York City', '123 Broadway Ave', 'Hotel', 4, 'Experience the excitement of New York City at the Grand Central Hotel. Located on Broadway Ave, this iconic hotel offers luxurious accommodations and unparalleled hospitality.', b'1'),
('Harbor Lights Inn', 'San Francisco', 'Pier 39 1', 'Hotel', 4, 'Indulge in the tranquility of San Francisco Bay with a stay at the Harbor Lights Inn. Nestled on Pier 39, this charming inn offers cozy rooms and stunning views of the bay.', b'1'),
('Harborview Suites', 'Sydney', 'Circular Quay 2', 'Hotel', 4, 'Escape to the serene beauty of Sydney at the Harborview Suites. Located on Circular Quay, this hotel offers modern amenities and stunning views of Sydney Harbour.', b'1'),
('Hotel Elegance', 'Vienna', 'Hauptstraße 12', 'Hotel', 4, 'Experience the sophistication of Vienna at Hotel Elegance. Situated on Hauptstraße, this boutique hotel offers stylish accommodations and modern amenities.', b'1'),
('Imperial Residence', 'Vienna', 'Schönbrunn Palace 1', 'Hotel', 5, 'Indulge in luxury at the Imperial Residence in Vienna. Located near Schönbrunn Palace, this hotel offers opulent accommodations and impeccable service.', b'1'),
('Lakeview Lodge', 'Chicago', 'Lake Shore Drive 22', 'Apartman', 3, 'Experience the hustle and bustle of Chicago at the Lakeview Lodge. Situated on Lake Shore Drive, this lodge offers cozy accommodations and stunning views of Lake Michigan.', b'1'),
('Le Château Belle', 'Paris', 'Rue de Rivoli 1', 'Hotel', 5, 'Immerse yourself in the elegance of Paris at Le Château Belle. Located on Rue de Rivoli, this historic hotel offers lavish accommodations and breathtaking views of the city.', b'1'),
('Luxus Palace Hotel', 'Budapest', 'Váci utca 22', 'Hotel', 5, 'Explore the beauty of Budapest at the Luxus Palace Hotel. Situated on Váci utca, this luxurious hotel offers upscale accommodations and exceptional service.', b'1'),
('Magnificent Mile Inn', 'Chicago', 'Wacker Drive 8', 'Hotel', 4, 'Experience the vibrant atmosphere of Chicago at the Magnificent Mile Inn. Situated on Wacker Drive, this boutique hotel offers stylish accommodations and easy access to the Magnificent Mile\'s shops and restaurants.', b'1'),
('Manhattan Tower Suites', 'New York City', '5th Avenue 55', 'Hotel', 4, 'Enjoy the ultimate New York experience at Manhattan Tower Suites. Located on 5th Avenue, this luxury hotel offers spacious accommodations and stunning views of Manhattan\'s iconic skyline.', b'1'),
('Montmartre Retreat', 'Paris', 'Rue des Abbesses 10', 'Hotel', 3, 'Enjoy a peaceful retreat at the Montmartre Retreat in Paris. Located on Rue des Abbesses, this charming hotel offers cozy accommodations and a serene atmosphere.', b'1'),
('Riverside Suites', 'Budapest', 'Bem rakpart 15', 'Hotel', 4, 'Discover the beauty of Budapest at the Riverside Suites. Situated on Bem rakpart, this boutique hotel offers modern accommodations and stunning views of the Danube River.', b'1'),
('Seine River B&B', 'Paris', 'Quai de la Tournelle 5', 'Hotel', 4, 'Indulge in luxury at the Seine River B&B in Paris. Located on Quai de la Tournelle, this elegant bed and breakfast offers cozy accommodations and picturesque views of the Seine River.', b'1'),
('Sunshine Hotel', 'Sydney', 'Beach Road 45', 'Hotel', 4, 'Experience the warmth and hospitality of Sydney at the Sunshine Hotel. Situated on Beach Road, this boutique hotel offers comfortable accommodations and easy access to Sydney\'s top attractions.', b'1'),
('Times Square View Hotel', 'New York City', '7th Avenue 20', 'Hotel', 4, 'Discover the charm of New York City at the Times Square View Hotel. Located on 7th Avenue, this modern hotel offers stylish accommodations and breathtaking views of Times Square.', b'1');

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

--
-- A tábla adatainak kiíratása `szolgaltatasok`
--

INSERT INTO `szolgaltatasok` (`nev`, `sajat_furdo`, `terasz`, `franciaagy`, `gyerekbarat`, `ac`, `konyha`, `parkolas`, `tv`, `gym`, `medence`, `bar`, `internet`, `szef`, `akadalymentes`) VALUES
('Bayview Retreat', b'0', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'1', b'1', b'1', b'0'),
('Bondi Beach House', b'0', b'0', b'1', b'0', b'0', b'0', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'1'),
('Central Hotel', b'1', b'1', b'1', b'1', b'1', b'0', b'1', b'1', b'0', b'1', b'1', b'0', b'0', b'0'),
('Cityscape Hotel', b'0', b'0', b'1', b'0', b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'1'),
('Danube View Hotel', b'1', b'0', b'1', b'1', b'0', b'1', b'1', b'0', b'1', b'0', b'0', b'0', b'0', b'1'),
('Golden Gate Hotel', b'0', b'1', b'1', b'1', b'1', b'1', b'1', b'0', b'1', b'0', b'0', b'1', b'1', b'1'),
('Grand Central Hotel', b'0', b'0', b'0', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0'),
('Harbor Lights Inn', b'1', b'1', b'1', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'0', b'1', b'0', b'0'),
('Harborview Suites', b'1', b'1', b'1', b'0', b'0', b'0', b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'1'),
('Hotel Elegance', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'1', b'1', b'1', b'0', b'1', b'1', b'0'),
('Imperial Residence', b'0', b'0', b'0', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', b'1', b'1'),
('Lakeview Lodge', b'0', b'1', b'1', b'1', b'0', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'0', b'0'),
('Le Château Belle', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'1', b'0', b'0', b'1', b'0', b'0'),
('Luxus Palace Hotel', b'0', b'1', b'1', b'1', b'0', b'0', b'0', b'1', b'1', b'0', b'1', b'0', b'1', b'1'),
('Magnificent Mile Inn', b'0', b'1', b'0', b'0', b'0', b'1', b'0', b'0', b'1', b'1', b'0', b'1', b'0', b'1'),
('Manhattan Tower Suites', b'1', b'1', b'1', b'0', b'1', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'1', b'1'),
('Montmartre Retreat', b'0', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'1', b'0', b'0', b'0', b'1', b'1'),
('Riverside Suites', b'0', b'1', b'0', b'1', b'1', b'1', b'1', b'0', b'1', b'0', b'1', b'1', b'1', b'1'),
('Seine River B&B', b'0', b'0', b'0', b'0', b'0', b'1', b'1', b'0', b'0', b'0', b'1', b'0', b'0', b'0'),
('Sunshine Hotel', b'1', b'0', b'0', b'0', b'0', b'0', b'1', b'1', b'1', b'0', b'1', b'0', b'1', b'0'),
('Times Square View Hotel', b'1', b'1', b'1', b'0', b'1', b'1', b'1', b'0', b'1', b'1', b'0', b'0', b'0', b'0');

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
  ADD PRIMARY KEY (`csomagid`),
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
-- AUTO_INCREMENT a táblához `csomagok`
--
ALTER TABLE `csomagok`
  MODIFY `csomagid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
