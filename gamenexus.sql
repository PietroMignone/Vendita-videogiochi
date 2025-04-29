-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 27, 2025 alle 17:02
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videogiochi_store`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) DEFAULT NULL,
  `data_ordine` date DEFAULT curdate(),
  `totale` decimal(10,2) DEFAULT NULL,
  `stato` varchar(20) NOT NULL DEFAULT 'attivo',
  `quantita` int(11) DEFAULT 1,
  `id_gioco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `giochi`
--

CREATE TABLE `giochi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `prezzo` decimal(10,2) NOT NULL,
  `sconto_percentuale` int(11) DEFAULT 0,
  `data_uscita` date DEFAULT NULL,
  `piattaforma` varchar(255) DEFAULT NULL,
  `immagine` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `giochi`
--

INSERT INTO `giochi` (`id`, `nome`, `descrizione`, `prezzo`, `sconto_percentuale`, `data_uscita`, `piattaforma`, `immagine`, `id_categoria`) VALUES
(1, 'Assassin\'s Creed Shadows', NULL, 49.49, 0, NULL, NULL, NULL, NULL),
(2, 'The Last Of Us Part II Remastered', NULL, 35.69, 0, NULL, NULL, NULL, NULL),
(3, 'Cyberpunk 2077: Ultimate Edition', NULL, 32.99, 0, NULL, NULL, NULL, NULL),
(5, 'UNCHARTED: Raccolta L\'eredità dei ladri', NULL, 49.49, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) DEFAULT NULL,
  `id_gioco` int(11) DEFAULT NULL,
  `voto` int(11) DEFAULT NULL CHECK (`voto` >= 1 and `voto` <= 5),
  `commento` text DEFAULT NULL,
  `data_recensione` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `recensioni`
--

INSERT INTO `recensioni` (`id`, `id_utente`, `id_gioco`, `voto`, `commento`, `data_recensione`) VALUES
(4, 1, 3, 5, 'bellos', '2025-04-26'),
(5, 1, 3, 1, 'sfs<', '2025-04-26'),
(6, 1, 3, 4, 'asfghhf', '2025-04-26'),
(7, 3, 3, 4, 'ggggg', '2025-04-26');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `data_registrazione` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `email`, `password`, `data_registrazione`) VALUES
(1, 'Pietro', 'pietro.mignone06@gmail.com', '$2y$10$bahuuq5oW/kUiNhDdwHfFeeveebd4GyZe1rhXp6qFt2LRfLIcSOLq', '2025-04-17'),
(2, 'carlos', 'carlos@gmail.com', '$2y$10$9ocbTBXz0rV/8HIKJzpGS.JDIBESLc4eUzdFUb6FkUGY8SFj/LS5u', '2025-04-22'),
(3, 'mario', 'mario@gmail.com', '$2y$10$Xxigu0ar8HlKIH3epHthB.I8iKYlWH1GzEinRT8JYI7U81MKVZuD6', '2025-04-24');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `giochi`
--
ALTER TABLE `giochi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_gioco` (`id_gioco`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `giochi`
--
ALTER TABLE `giochi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`),
  ADD CONSTRAINT `fk_id_gioco` FOREIGN KEY (`id_gioco`) REFERENCES `giochi` (`id`);

--
-- Limiti per la tabella `giochi`
--
ALTER TABLE `giochi`
  ADD CONSTRAINT `giochi_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorie` (`id`);

--
-- Limiti per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  ADD CONSTRAINT `recensioni_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`),
  ADD CONSTRAINT `recensioni_ibfk_2` FOREIGN KEY (`id_gioco`) REFERENCES `giochi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
