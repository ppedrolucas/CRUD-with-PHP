-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/05/2023 às 03:47
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdawp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusers`
--

CREATE TABLE `tbusers` (
  `idUser` int(100) NOT NULL,
  `nameUser` varchar(100) NOT NULL,
  `emailUser` varchar(100) NOT NULL,
  `passUser` varchar(100) NOT NULL,
  `fotoUser` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbusers`
--

INSERT INTO `tbusers` (`idUser`, `nameUser`, `emailUser`, `passUser`, `fotoUser`) VALUES
(1, 'Pedro', 'pedro@gmail.com', '123456', ''),
(2, 'Pedro', 'pedro@gmail.com', '123456', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbusers`
--
ALTER TABLE `tbusers`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbusers`
--
ALTER TABLE `tbusers`
  MODIFY `idUser` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
