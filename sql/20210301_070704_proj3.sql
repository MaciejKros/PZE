-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Mar 2021, 07:06
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `proj3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`login`, `password`, `email`, `salt`) VALUES
('admin', '56fc9aed1026cd5023c0a3c85b769b64', 'admin@pseudosklep.pl', 'Fe5hpRFziy866mBZgc5a');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
(1, 'Antywirusy'),
(2, 'Graficzne'),
(3, 'Systemy Operacyjne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_produkty`
--

CREATE TABLE `kategorie_produkty` (
  `kat_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `kategorie_produkty`
--

INSERT INTO `kategorie_produkty` (`kat_id`, `prod_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(7,2) NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `opis`, `img`, `data`) VALUES
(1, 'Norton Security Standard', '119.00', 'Antywirus, ochrona przed oprogramowaniem destrukcyjnym, ochrona przed oprogramowaniem szpiegującym, ochrona przed wyłudzaniem danych, ochrona przeglądarki i nie tylko.', 'A01-0.jpg', '2020-02-03 00:09:32'),
(2, 'Kaspersky Anti-Virus', '69.00', 'Nasz skuteczny antywirus dla komputera PC z systemem Windows  Blokuje najnowsze wirusy, ransomware, spyware, kryptolokery itp. Blokuje generowanie kryptowalut obniżające wydajność komputera PC', 'A02-0.jpg', '2020-02-03 01:04:45'),
(3, 'McAfee® Total Protection', '69.00', 'Chroń siebie i całą rodzinę przed atakami najnowszych wirusów, oprogramowania szpiegującego, złośliwego i ransomware i bądź na bieżąco ze swoją prywatnością i tożsamością.', 'A03-0.jpg', '2020-02-03 01:35:22'),
(4, 'Avast Premium Security', '179.00', 'Skup się na pracy — zabezpieczenia pozostaw nam. Nasze rozwiązania dostosowują się do specyfiki każdej firmy (obsługujemy zarówno infrastrukturę lokalną, jak i w chmurze) — bez względu na jej rozmiar, typ sieci i używane urządzenia.', 'A04-0.jpg', '2020-02-03 01:37:31'),
(5, 'ESET Internet Security', '170.00', 'Wszechstronna ochrona dla domowego komputera - Kup teraz! Bezpiecznie korzystaj z Internetu! Zainstaluj i zapomnij. Polski support. Nr 1 na rynku. Nr 1 w Polsce.', 'A05-0.jpg', '2020-02-03 01:52:26'),
(6, 'AVG Internet Security', '199.00', 'Jedna subskrypcja. Zawsze aktualny. Nie musisz czekać na jedno duże wydanie raz w roku. Aktualizacje są automatycznie udostępniane na bieżąco. Zrezygnowaliśmy z umieszczania roku w nazwach naszych produktów, ponieważ dzięki subskrypcji Twoja ochrona AVG jest zawsze aktualna. A nowe funkcje? Uzyskasz je automatycznie, kiedy tylko będą dostępne.', 'A06-0.jpg', '2020-02-03 14:14:06'),
(7, 'Adobe Photoshop CS5 Extended', '15299.00', 'Adobe Photoshop CS5 Extended - najnowsza wersja najbardziej popularnego programu do edycji grafiki rastrowej. Potężny Adobe Photoshop posiada mnóstwo opcji ułatwiających pracę z grafiką. Programem można stworzyć najbardziej zaawansowane projekty, fotomontaże które można wykorzystać w druku oraz na stronach internetowych. W tej odsłonie programu został zmodyfikowany i usprawniony interfejs oraz nawigacja, przesuwania i skalowania podglądu.', 'G01-0.jpg', '2020-02-03 17:25:12'),
(8, 'Autodesk SketchBok Pro 2016', '209.00', 'Autodesk SketchBook Pro to idealne narzędzie do szkicowania, umożliwia artystom grafiki komputerowej na łatwe tworzenie projektów na każdym poziomie zaawansowania. Znane artystom z realnego świata narzędzia typu pędzli oraz wsparcie dla wielu tabletów graficznych czyni z tego programu wysoce intuicyjne narzędzie pracy już od pierwszego kontaktu. SketchBook Pro jest szczególnie wskazany jako potężne narzędzie do projektowania koncepcyjnego i iteracyjnego komponowania obrazów i komunikacji graficznej.', 'G02-0.jpg', '2020-02-03 17:25:42'),
(9, 'Autodesk Autocad LT 2015', '1499.00', 'Twórz precyzyjne rysunki 2D szybciej dzięki łatwym w użyciu narzędziom kreślarskim. Łatwo identyfikuj i dokumentuj różnice graficzne między dwiema wersjami rysunku. Ciesz się szybszym zoomem i panoramowaniem, a także zmieniaj kolejność rysowania i właściwości warstw dzięki ulepszeniom graficznym 2D. Zabierz swoją pracę ze sobą dzięki nowym aplikacjom internetowym i mobilnym AutoCAD. Subskrybowanie programu AutoCAD LT oznacza, że zawsze będziesz mieć najnowsze aktualizacje funkcji, niezawodność technologii TrustedDWG i możliwość projektowania z dowolnego miejsca, w dowolnym momencie za pomocą aplikacji internetowych i mobilnych.', 'G03-0.jpg', '2020-02-03 17:25:50'),
(10, 'ZWSoft ZWCAD 2020', '1799.00', 'Najnowszy ZWCAD jest licencją wieczystą i nigdy nie wygasa. Nowa wersja ZWCAD 2020 zawiera wiele dodatkowych, przydatnych a także oszczędzających czas funkcji których opis zamieszczamy poniżej.', 'G04-0.jpg', '2020-02-03 17:25:59'),
(11, 'Microsoft Windows 10 Home', '519.00', 'System operacyjny Windows 10 Home oferuje wbudowane zabezpieczenia i aplikacje, takie jak Poczta, Kalendarz, Zdjęcia, Microsoft Edge i inne, aby zapewnić Ci bezpieczeństwo i produktywność. Licencjonowany dla 1 komputera PC lub MAC', 'S01-0.jpg', '2020-02-03 17:26:05'),
(12, 'Microsoft Windows 10 Pro', '1099.00', 'Wszystkie funkcje systemu Windows 10 Home oraz funkcje dla firm, takie jak m.in. szyfrowanie, logowanie zdalne i tworzenie maszyn wirtualnych.', 'S02-0.jpg', '2020-02-03 17:26:15'),
(13, 'Microsoft Windows 8.1 Pro Pack', '619.00', 'Za pomocą systemu Windows 8.1 możesz szybko przeglądać strony internetowe, oglądać filmy, grać w gry, dopracowywać swoje CV i tworzyć atrakcyjne prezentacje na tym samym komputerze. Nowością jest możliwość rozmieszczenia na ekranie nawet trzech aplikacji na raz', 'S03-0.jpg', '2020-02-03 17:26:19'),
(14, 'Windows Server 2019 Essentials', '1180.00', 'Ci, którzy chcą kupić Windows Server 2019 Essentials wybrali przyjazną dla konsumenta edycję serii od 2019 roku. Jest to szczególnie odpowiednie dla mniejszych firm, dla tych, które mają maksymalnie 25 użytkowników i 50 komputerów PC lub równoważnych Urządzenia. Tutaj zaspokojone są potrzeby zarządzanej sieci, a funkcje są łatwe w użyciu. ', 'S04-0.jpg', '2020-02-03 17:26:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `imie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `adres` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `zip` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`login`, `password`, `email`, `imie`, `nazwisko`, `city`, `adres`, `zip`, `phone`) VALUES
('aaaaaa', 'aaaaaa', 'aa@aa.aa', 'aaaaaa', 'aaaaaa', 'aaa', 'aaa 12', '12-123', 123123123),
('bbbbbb', 'bbbbbb', 'bb@bb.bb', 'bbb', 'bbb', 'bbb', 'bbb 12', '13-123', 123321321),
('cccccc', 'cccccc', 'cc@cc.cc', 'ccc', 'ccc', 'ccc', 'ccc 33', '33-123', 444555666),
('unlogged', 'unlogged', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `login` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `imie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `adres` text COLLATE utf8_unicode_ci NOT NULL,
  `zip` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `telefon` int(11) NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `login`, `imie`, `nazwisko`, `city`, `adres`, `zip`, `email`, `telefon`, `status`, `data`) VALUES
(1, 'aaaaaa', 'Aaaa', 'Eeeeee', '', 'aaaaaaaaaaaa', '', 'asda@aaa.aaa', 123123125, 'done', '2020-02-03 19:59:06'),
(2, 'aaaaaa', 'Aaaa', 'Bbbb', 'miasto', 'aaaaaaaaa', '321-12', 'aa@aa.aaaaa', 321321321, 'pending', '2020-02-03 21:58:10'),
(3, 'bbbbbb', 'Rrrrrr', 'Ffffff', '', 'adfsadf 222/43', '', 'ee@ee.ee', 432432423, 'sent', '2020-02-03 22:05:56'),
(4, 'bbbbbb', 'Aaaa', 'sdada', '', 'wqeqwe522', '', 'aa@aa.aa', 323232323, 'pending', '2020-02-04 00:26:36'),
(8, 'unlogged', 'aaaa', 'aaa', 'aaaa', 'ccc 33', '33-123', 'cc@cc.cc', 134123123, 'pending', '2021-02-21 23:57:37'),
(9, 'aaaaaa', 'aaaaaa', 'aaaaaa', 'aaa', 'aaa 12', '12-123', 'aa@aa.aa', 123123123, 'pending', '2021-02-22 00:29:30'),
(10, 'unlogged', 'Michał', 'Kowalski', 'Warszawa', 'bbb 12', '00-000', 'testowy@gmail.com', 123321321, 'pending', '2021-02-28 13:52:02');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_produkty`
--

CREATE TABLE `zamowienia_produkty` (
  `zam_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `ilosc_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `zamowienia_produkty`
--

INSERT INTO `zamowienia_produkty` (`zam_id`, `prod_id`, `ilosc_prod`) VALUES
(2, 7, 4),
(2, 13, 3),
(2, 1, 1),
(2, 2, 1),
(3, 9, 4),
(3, 13, 2),
(4, 3, 1),
(4, 12, 1),
(4, 11, 1),
(1, 1, 3),
(1, 2, 2),
(1, 3, 4),
(1, 4, 3),
(8, 12, 1),
(9, 1, 1),
(10, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeksy dla tabeli `kategorie_produkty`
--
ALTER TABLE `kategorie_produkty`
  ADD KEY `kat_id` (`kat_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `login` (`login`);

--
-- Indeksy dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  ADD KEY `zam_id` (`zam_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kategorie_produkty`
--
ALTER TABLE `kategorie_produkty`
  ADD CONSTRAINT `kategorie_produkty_ibfk_1` FOREIGN KEY (`kat_id`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategorie_produkty_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `produkty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`login`) REFERENCES `users` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  ADD CONSTRAINT `zamowienia_produkty_ibfk_1` FOREIGN KEY (`zam_id`) REFERENCES `zamowienia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zamowienia_produkty_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `produkty` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
