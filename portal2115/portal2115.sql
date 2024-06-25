-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 20, 2024 at 04:04 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal2115`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author_id`, `category_id`, `image`, `created_at`, `updated_at`) VALUES
(3, 'tetsowy', 'Smutno mi, Boże! Dla mnie na zachodzie\r\nRozlałeś tęczę blasków promienistą;\r\nPrzede mną gasisz w lazurowej wodzie\r\nGwiazdę ognistą…\r\nChoć mi tak niebo Ty złocisz i morze,\r\nSmutno mi, Boże!\r\nJak puste kłosy z podniesioną głową,\r\nStoję rozkoszy próżen i dosytu…\r\nDla obcych ludzi mam twarz jednakową,\r\nCiszę błękitu.\r\nAle przed Tobą głąb serca otworzę:\r\nSmutno mi, Boże!\r\nJako na matki odejście się żali\r\nMała dziecina, tak ja płaczu bliski,\r\nPatrząc na słońce, co mi rzuca z fali\r\nOstatnie błyski,\r\nChoć wiem, że jutro błyśnie nowe zorze,\r\nSmutno mi, Boże! Dzisiaj na wielkiem morzu obłąkany, Sto mil od brzegu i sto mil przed brzegiem,\r\nWidziałem lotne w powietrzu bociany\r\nDługim szeregiem.\r\nŻem je znał kiedyś na polskim ugorze,\r\nSmutno mi, Boże!\r\nŻem często dumał nad mogiłą ludzi,\r\nŻem nie znał prawie rodzinnego domu,\r\nŻem był jak pielgrzym, co się w drodze trudzi\r\nPrzy blaskach gromu,\r\nŻe nie wiem, gdzie się w mogiłę położę,\r\nSmutno mi, Boże! Ty będziesz widział moje białe kości, W straż nieoddane kolumnowym czołom;\r\nAlem jest jako człowiek, co zazdrości\r\nMogił… popiołom.\r\nWięc, że nieznane gotujesz mi łoże,\r\nSmutno mi, Boże! \r\nKazano w kraju niewinnej dziecinie\r\nModlić się za mnie co dzień; a ja przecie\r\nWiem, że mój okręt nie do kraju płynie,\r\nPłynąc po świecie.\r\nWięc, że modlitwa dziecka nic nie może,\r\nSmutno mi, Boże!\r\nNa tęczę blasków, którą tak ogromnie\r\nAnieli twoi w niebie rozpostarli,\r\nNowi gdzieś ludzie w sto lat będą po mnie\r\nPatrzący — marli.\r\nNim się przed moją nicością ukorzę,\r\nSmutno mi, Boże!', 2, 1, 'https://www.google.com/url?sa=i&amp;url=https%3A%2F%2Fstock.adobe.com%2Fpl%2Fimages%2Fzaczepny-piesek-pies-psinka-m-ody-piesek-przyja-milusi-ski-milutki-mi-y-s-odki-sweet-little-dogs-pieski-w-koszu-kundelki-kundel-szczeniaczki-szczeniaczek-kompozycja-domo', '2024-06-17 21:57:41', '2024-06-17 21:57:41'),
(4, 'testowe zdrowie', 'bardzo ciekawy tekst', 2, 1, '', '2024-06-18 08:02:33', '2024-06-18 08:02:33'),
(5, 'twsoty lifestyle', 'sdadasdsadsafsa', 2, 3, '', '2024-06-18 08:06:25', '2024-06-18 08:06:25'),
(6, 'zdrowie  test', 'test zdrowie', 2, 2, '', '2024-06-18 18:53:45', '2024-06-18 18:53:45'),
(9, 'tetstowanie nazwy autora', 'dsadsasfas \r\nfasfsa\r\ndfasfsa\r\nfdasfsa\r\ndfasd', 3, 1, NULL, '2024-06-19 11:23:41', '2024-06-19 11:23:41'),
(10, 'sprawdzenie co i jak', 'dsadasds', 2, 1, NULL, '2024-06-19 12:24:18', '2024-06-19 12:24:18'),
(11, 'asdasdsa', 'adsfssafas', 3, 1, NULL, '2024-06-19 12:24:52', '2024-06-19 12:24:52'),
(13, 'ostatni', 'artykuł tetstowy bo wszystko bangla', 1, 1, NULL, '2024-06-19 15:33:35', '2024-06-19 15:33:35'),
(14, 'ostatni', 'artykuł tetstowy bo wszystko bangla', 2, 1, NULL, '2024-06-19 15:38:35', '2024-06-19 15:38:35'),
(15, 'psiaki', 'piesek', 2, 3, 'pobrane.webp', '2024-06-19 15:39:04', '2024-06-19 15:39:04'),
(16, 'kolejny giga cięzki', 'sajdsajhdsa', 6, 2, NULL, '2024-06-19 15:40:07', '2024-06-19 15:40:07'),
(17, 'do pliku danych', 'testowe przekazywanie danych do pliku', 2, 1, NULL, '2024-06-20 08:14:47', '2024-06-20 08:14:47');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Technologia'),
(2, 'Zdrowie'),
(3, 'Lifestyle');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `author`, `content`, `created_at`) VALUES
(1, 3, 'giga trudny', 'bardzo fajny wierszyk pitu pitu', '2024-06-17 21:58:37'),
(3, 3, 'admin', 'hlsahdaslhdsal sdajhbdkjashd sdakidshaljksdhlas', '2024-06-19 06:54:43'),
(5, 15, 'admin', 'fajny', '2024-06-19 15:39:23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `message_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `contact_name`, `contact_email`, `message_content`, `created_at`, `is_read`) VALUES
(1, 'dupa', 'dupa@example.com', 'dupa', '2024-06-19 15:24:51', 0),
(2, 'drugikontakt', 'tescik@example.com', 'speed', '2024-06-19 15:30:44', 1),
(3, 'wiadomosc', 'wiadomosci@example', 'wiadomosc', '2024-06-19 15:31:37', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@portal.com', '$2y$10$WzHntnN.w5G.OE7VYwL7KudwcpbA8I6/WrR6IEFEqC.bUl9i1jD3e', 'admin', '2024-06-17 21:49:06'),
(2, 'admin', 'admin@example.com', '$2y$10$TfKWk.SbZ3dIYu.Z/0CYmu9JeYf/ghdCRo5PS1O.Ptf9c6wLFUslO', 'admin', '2024-06-17 21:49:45'),
(3, 'test', 'test@example.com', '$2y$10$wFEOuZAWfMl7KuH1itT5IuGGn3pIWfpjoxqiVdtdJ3ufB3XPkdVZG', 'user', '2024-06-18 08:11:11'),
(6, 'author', 'author@example.com', '$2y$10$HvP0ys.X5jR0mjwHomvMaOumR9io8dTKdzaGjA09/lmvo7HrlGcCG', 'author', '2024-06-18 19:00:32');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
