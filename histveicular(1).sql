-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Maio-2019 às 01:14
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `histveicular`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) NOT NULL,
  `sobrenome` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `rg` char(10) NOT NULL,
  `cpf` char(11) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_rg` (`rg`),
  UNIQUE KEY `unique_cpf` (`cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `sobrenome`, `email`, `rg`, `cpf`, `senha`) VALUES
(1, 'joao', 'aaa', '2222@gmail.com', '1234567890', '12345678900', 'coxinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

DROP TABLE IF EXISTS `veiculo`;
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placa` char(7) NOT NULL,
  `renavam` char(11) NOT NULL,
  `marca` varchar(24) NOT NULL,
  `modelo` varchar(128) NOT NULL,
  `anoModelo` char(4) NOT NULL,
  `anoFabricacao` char(4) NOT NULL,
  `idCliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_placa` (`placa`),
  UNIQUE KEY `unique_renavam` (`renavam`),
  KEY `fk_veiculo_idCliente_cliente` (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `placa`, `renavam`, `marca`, `modelo`, `anoModelo`, `anoFabricacao`, `idCliente`) VALUES
(1, '123abcd', '12345678900', 'marca bolada', 'carrao', '2000', '2000', 1),
(3, 'ddd1234', '00987654321', 'forde', 'fffff', '2000', '2000', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
