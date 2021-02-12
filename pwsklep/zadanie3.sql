-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Cze 2020, 21:02
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
-- Baza danych: `zadanie2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Antywirusy'),
(2, 'Systemy operacyjne'),
(3, 'Graficzne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `address` text COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`order_id`, `customer`, `address`, `email`) VALUES
(1, 'Patryk Wysłobocki', 'testowy adres', 'testowy@gmail.com'),
(2, 'Patryk Wysłobocki', 'Adres', 'testowy@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ordersproducts`
--

CREATE TABLE `ordersproducts` (
  `ordersproducts_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ordersproducts`
--

INSERT INTO `ordersproducts` (`ordersproducts_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 11, 2),
(2, 1, 14, 1),
(3, 2, 10, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `indeks` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(160) COLLATE utf8_polish_ci NOT NULL,
  `net_price` double NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `indeks`, `name`, `net_price`, `description`, `category_id`) VALUES
(1, 'A01', 'Norton Security Standard', 119, 'Antywirus, ochrona przed oprogramowaniem destrukcyjnym, ochrona przed oprogramowaniem szpiegującym, ochrona przed wyłudzaniem danych, ochrona przeglądarki i nie tylko.', 1),
(2, 'A02', 'Kaspersky Anti-Virus', 69, 'Nasz skuteczny antywirus dla komputera PC z systemem Windows\r\n\r\nBlokuje najnowsze wirusy, ransomware, spyware, kryptolokery itp. Blokuje generowanie kryptowalut obniżające wydajność komputera PC', 1),
(3, 'A03', 'McAfee® Total Protection', 129, 'Chroń siebie i całą rodzinę przed atakami najnowszych wirusów, oprogramowania szpiegującego, złośliwego i ransomware i bądź na bieżąco ze swoją prywatnością i tożsamością.', 1),
(4, 'A04', 'Avast Premium Security', 179, 'Skup się na pracy — zabezpieczenia pozostaw nam. Nasze rozwiązania dostosowują się do specyfiki każdej firmy (obsługujemy zarówno infrastrukturę lokalną, jak i w chmurze) — bez względu na jej rozmiar, typ sieci i używane urządzenia.', 1),
(5, 'A05', 'ESET Internet Security', 170, 'Wszechstronna ochrona dla domowego komputera - Kup teraz! Bezpiecznie korzystaj z Internetu! Zainstaluj i zapomnij. Polski support. Nr 1 na rynku. Nr 1 w Polsce.', 1),
(6, 'A06', 'AVG Internet Security', 199, 'Jedna subskrypcja. Zawsze aktualny.\r\nNie musisz czekać na jedno duże wydanie raz w roku. Aktualizacje są\r\nautomatycznie udostępniane na bieżąco. Zrezygnowaliśmy z umieszczania roku w nazwach naszych produktów,\r\nponieważ dzięki subskrypcji Twoja ochrona AVG jest zawsze aktualna.\r\nA nowe funkcje? Uzyskasz je automatycznie, kiedy tylko będą dostępne.', 1),
(7, 'S01', 'Microsoft Windows 10 Home', 519, 'System operacyjny Windows 10 Home oferuje wbudowane zabezpieczenia i aplikacje, takie jak Poczta, Kalendarz, Zdjęcia, Microsoft Edge i inne, aby zapewnić Ci bezpieczeństwo i produktywność. Licencjonowany dla 1 komputera PC lub MAC', 2),
(8, 'S02', 'Microsoft Windows 10 Pro', 1099, 'Wszystkie funkcje systemu Windows 10 Home oraz funkcje dla firm, takie jak m.in. szyfrowanie, logowanie zdalne i tworzenie maszyn wirtualnych.', 2),
(9, 'S03', 'Microsoft Windows 8.1 Pro Pack', 619, 'Za pomocą systemu Windows 8.1 możesz szybko przeglądać strony internetowe, oglądać filmy, grać w gry, dopracowywać swoje CV i tworzyć atrakcyjne prezentacje na tym samym komputerze. Nowością jest możliwość rozmieszczenia na ekranie nawet trzech aplikacji na raz.', 2),
(10, 'S04', 'Windows Server 2019 Essentials', 1180, 'Ci, którzy chcą kupić Windows Server 2019 Essentials wybrali przyjazną dla konsumenta edycję serii od 2019 roku. Jest to szczególnie odpowiednie dla mniejszych firm, dla tych, które mają maksymalnie 25 użytkowników i 50 komputerów PC lub równoważnych Urządzenia. Tutaj zaspokojone są potrzeby zarządzanej sieci, a funkcje są łatwe w użyciu. ', 2),
(11, 'G01', 'Adobe Photoshop CS5 Extended', 15299, 'Adobe Photoshop CS5 Extended - najnowsza wersja najbardziej popularnego programu do edycji grafiki rastrowej. Potężny Adobe Photoshop posiada mnóstwo opcji ułatwiających pracę z grafiką. Programem można stworzyć najbardziej zaawansowane projekty, fotomontaże które można wykorzystać w druku oraz na stronach internetowych. W tej odsłonie programu został zmodyfikowany i usprawniony interfejs oraz nawigacja, przesuwania i skalowania podglądu.', 3),
(12, 'G02', 'Autodesk SketchBok Pro 2016', 209, 'Autodesk SketchBook Pro to idealne narzędzie do szkicowania, umożliwia artystom grafiki komputerowej na łatwe tworzenie projektów na każdym poziomie zaawansowania. Znane artystom z realnego świata narzędzia typu pędzli oraz wsparcie dla wielu tabletów graficznych czyni z tego programu wysoce intuicyjne narzędzie pracy już od pierwszego kontaktu. SketchBook Pro jest szczególnie wskazany jako potężne narzędzie do projektowania koncepcyjnego i iteracyjnego komponowania obrazów i komunikacji graficznej.', 3),
(13, 'G03', 'Autodesk Autocad LT 2015', 1499, 'Twórz precyzyjne rysunki 2D szybciej dzięki łatwym w użyciu narzędziom kreślarskim. Łatwo identyfikuj i dokumentuj różnice graficzne między dwiema wersjami rysunku. Ciesz się szybszym zoomem i panoramowaniem, a także zmieniaj kolejność rysowania i właściwości warstw dzięki ulepszeniom graficznym 2D. Zabierz swoją pracę ze sobą dzięki nowym aplikacjom internetowym i mobilnym AutoCAD. Subskrybowanie programu AutoCAD LT oznacza, że zawsze będziesz mieć najnowsze aktualizacje funkcji, niezawodność technologii TrustedDWG i możliwość projektowania z dowolnego miejsca, w dowolnym momencie za pomocą aplikacji internetowych i mobilnych.', 3),
(14, 'G04', 'ZWSoft ZWCAD 2020', 1799, 'Najnowszy ZWCAD jest licencją wieczystą i nigdy nie wygasa. Nowa wersja ZWCAD 2020 zawiera wiele dodatkowych, przydatnych a także oszczędzających czas funkcji których opis zamieszczamy poniżej.', 3),
(25, 'G05', 'Testowy Produkt', 1230, 'Testowy opis', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessioncart`
--

CREATE TABLE `sessioncart` (
  `id` int(11) NOT NULL,
  `session_id` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `updated_at` int(11) NOT NULL,
  `salt_token` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `uniq_info` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `browser` text COLLATE utf8_polish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sessions`
--

INSERT INTO `sessions` (`session_id`, `updated_at`, `salt_token`, `user_id`, `uniq_info`, `browser`, `ip`) VALUES
('nUhoGtG9Ijx7oDn49r8JDJiv8LDs7P1592420273', 1592420516, 'epvOZZNZrX', 0, '5b11e3ad746d1271cb22d7028e6d9427', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36 OPR/68.0.361', '::1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeksy dla tabeli `ordersproducts`
--
ALTER TABLE `ordersproducts`
  ADD PRIMARY KEY (`ordersproducts_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeksy dla tabeli `sessioncart`
--
ALTER TABLE `sessioncart`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `ordersproducts`
--
ALTER TABLE `ordersproducts`
  MODIFY `ordersproducts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `sessioncart`
--
ALTER TABLE `sessioncart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
