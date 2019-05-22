-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 22-Maio-2019 às 20:56
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
-- Database: `historicoveicular`
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `sobrenome`, `email`, `rg`, `cpf`, `senha`) VALUES
(1, 'joao', 'aaa', '2222@gmail.com', '1234567890', '12345678900', 'coxinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(64) NOT NULL,
  `nomeFantasia` varchar(128) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao`
--

DROP TABLE IF EXISTS `manutencao`;
CREATE TABLE IF NOT EXISTS `manutencao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `km` int(11) NOT NULL,
  `data` date NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idVeiculo` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresa_idEmpresa_manutencao` (`idEmpresa`),
  KEY `fk_produto_idProduto_manutencao` (`idProduto`),
  KEY `fk_veiculo_idVeiculo_manutencao` (`idVeiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao_servico`
--

DROP TABLE IF EXISTS `manutencao_servico`;
CREATE TABLE IF NOT EXISTS `manutencao_servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idManutencao` int(11) NOT NULL,
  `idServico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_servico_idServico_manutencaoServico` (`idServico`),
  KEY `fk_manutencao_idManutencao_manutencaoServico` (`idManutencao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(128) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  KEY `fk_veiculo_idCliente` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `placa`, `renavam`, `marca`, `modelo`, `anoModelo`, `anoFabricacao`, `idCliente`) VALUES
(1, '123abcd', '12345678900', 'marca bolada', 'carrao', '2000', '2000', 1),
(3, 'ddd1234', '00987654321', 'forde', 'fffff', '2000', '2000', 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD CONSTRAINT `fk_empresa_idEmpresa_manutencao` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_idProduto_manutencao` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_veiculo_idVeiculo_manutencao` FOREIGN KEY (`idVeiculo`) REFERENCES `veiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `manutencao_servico`
--
ALTER TABLE `manutencao_servico`
  ADD CONSTRAINT `fk_manutencao_idManutencao_manutencaoServico` FOREIGN KEY (`idManutencao`) REFERENCES `manutencao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servico_idServico_manutencaoServico` FOREIGN KEY (`idServico`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_veiculo_idCliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
