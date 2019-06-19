-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jun-2019 às 05:55
-- Versão do servidor: 10.3.15-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `historicoveicular`
--
CREATE DATABASE IF NOT EXISTS `historicoveicular` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `historicoveicular`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `sobrenome` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `rg` char(10) NOT NULL,
  `cpf` char(11) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nivelAcesso` int(11) NOT NULL DEFAULT 1,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `sobrenome`, `email`, `rg`, `cpf`, `senha`, `nivelAcesso`, `ativo`) VALUES
(1, 'Charlan ', 'Matter', 'charlan.matter@ibiruba.ifrs.edu.br', '1122334455', '04224478030', 'coxinha121', 2, 1),
(2, 'Andrei ', 'Matter', 'andrei@teste', '1234', '123', '123', 2, 1),
(3, 'Solange', 'Matter', 'teeste@gggg', '123445', '111', '111', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `razaoSocial` varchar(64) NOT NULL,
  `nomeFantasia` varchar(128) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `razaoSocial`, `nomeFantasia`, `cnpj`, `email`) VALUES
(1, 'Cooperativa Agricola Mista General Osório', 'Cotriba', '111', 'email@cotriba.com.br'),
(2, 'IFRS', 'IFRS', '9933099', 'teste@teste.com.br'),
(3, 'Coprell', 'Coprell', '99330399', 'teste@teste3.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idusuario` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idusuario`, `idempresa`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao`
--

CREATE TABLE `manutencao` (
  `id` int(11) NOT NULL,
  `idveiculo` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `km` int(11) DEFAULT NULL,
  `dataInicial` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `dataAtribuida` date DEFAULT NULL,
  `realizado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `manutencao`
--

INSERT INTO `manutencao` (`id`, `idveiculo`, `idempresa`, `km`, `dataInicial`, `dataFinal`, `dataAtribuida`, `realizado`) VALUES
(1, 1, 1, 2000, '2019-06-18', '2019-06-25', '2019-06-20', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `marca` varchar(80) DEFAULT 'Nenhuma marca',
  `quantidade` int(11) DEFAULT 1,
  `ativo` tinyint(1) DEFAULT 1,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `marca`, `quantidade`, `ativo`, `valor`) VALUES
(2, 'Óleo', 'OilMaster', 1, 1, 12.33),
(5, 'Troca de Pneu', 'Nenhuma marca', 1, 1, 12),
(9, 'teste 4', 'Troca de Óleo', 1, 1, 1.23),
(10, 'Troca de Pneu 2', 'Nenhuma marca', 1, 1, 12.34),
(11, 'texte', 'Nenhuma marca', 1, 1, 12.33),
(13, 'teste', 'teste', 1234, 1, 12.33),
(14, 'charlan', 'charlan', 1233, 1, 4.44),
(15, 'Charalan', 'Nenhuma marca', 1233, 1, 12.34);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_manutencao`
--

CREATE TABLE `produto_manutencao` (
  `idmanutencao` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id`, `ativo`, `nome`) VALUES
(12, 1, 'Geometria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_empresa`
--

CREATE TABLE `servico_empresa` (
  `id` int(11) NOT NULL,
  `idservico` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico_empresa`
--

INSERT INTO `servico_empresa` (`id`, `idservico`, `idempresa`) VALUES
(2, 12, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_manutencao`
--

CREATE TABLE `servico_manutencao` (
  `idmanutencao` int(11) NOT NULL,
  `idservico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `placa` varchar(7) NOT NULL,
  `renavam` varchar(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anoModelo` varchar(4) NOT NULL,
  `anoFabricacao` varchar(4) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `placa`, `renavam`, `modelo`, `anoModelo`, `anoFabricacao`, `marca`, `idcliente`) VALUES
(1, 'ABC1234', '1111111', 'GOLF GTI 1.8T', '2004', '2004', 'VOLKSWAGEN', 1),
(2, 'BDC1111', '123444', 'JETTA', '2012', '2011', 'VOLKSWAGEN', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_funcionario_empresa` (`idempresa`);

--
-- Índices para tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_manutencaoveiculo` (`idveiculo`),
  ADD KEY `fk_manutencaoempresa` (`idempresa`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto_manutencao`
--
ALTER TABLE `produto_manutencao`
  ADD KEY `fk_manutencaoProduto` (`idmanutencao`),
  ADD KEY `fk_produtoManutencao` (`idproduto`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servico_empresa`
--
ALTER TABLE `servico_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicoEmpresa` (`idservico`),
  ADD KEY `fk_empresaServico` (`idempresa`);

--
-- Índices para tabela `servico_manutencao`
--
ALTER TABLE `servico_manutencao`
  ADD KEY `fk_manutencaoServico` (`idmanutencao`),
  ADD KEY `fk_servicoManutencao` (`idservico`);

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`),
  ADD UNIQUE KEY `renavam` (`renavam`),
  ADD KEY `fk_veiculo_id` (`idcliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `manutencao`
--
ALTER TABLE `manutencao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `servico_empresa`
--
ALTER TABLE `servico_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_cliente` FOREIGN KEY (`idusuario`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_funcionario_empresa` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`);

--
-- Limitadores para a tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD CONSTRAINT `fk_manutencaoempresa` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `fk_manutencaoveiculo` FOREIGN KEY (`idveiculo`) REFERENCES `veiculo` (`id`);

--
-- Limitadores para a tabela `produto_manutencao`
--
ALTER TABLE `produto_manutencao`
  ADD CONSTRAINT `fk_manutencaoProduto` FOREIGN KEY (`idmanutencao`) REFERENCES `manutencao` (`id`),
  ADD CONSTRAINT `fk_produtoManutencao` FOREIGN KEY (`idproduto`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `servico_empresa`
--
ALTER TABLE `servico_empresa`
  ADD CONSTRAINT `fk_empresaServico` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `fk_servicoEmpresa` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`);

--
-- Limitadores para a tabela `servico_manutencao`
--
ALTER TABLE `servico_manutencao`
  ADD CONSTRAINT `fk_manutencaoServico` FOREIGN KEY (`idmanutencao`) REFERENCES `manutencao` (`id`),
  ADD CONSTRAINT `fk_servicoManutencao` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`);

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_veiculo_id` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
