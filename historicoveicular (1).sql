-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Jun-2019 às 06:54
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
(1, 'Charlan ', 'Oliveira Matter', 'charlan.matter@ibiruba.ifrs.edu.br', '1122334455', '04224478030', 'coxinha12', 2, 1),
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
(3, 'Coprell', 'Coprell', '99330399', 'teste@teste3.com.br'),
(4, 'Cotrib a', 'ABDBABDADKJNLKM', '03.829.839/2392', 'chrlaneiaen@ibiruba.ifrs.edu.br');

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
  `idFuncionario` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `dthrSolicitacao` datetime NOT NULL DEFAULT current_timestamp(),
  `dthrConfirmacao` datetime DEFAULT NULL,
  `dthrUltimaModificacao` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `km` int(11) DEFAULT NULL,
  `dataInicial` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `dataAtribuida` date DEFAULT NULL,
  `realizado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `manutencao`
--

INSERT INTO `manutencao` (`id`, `idveiculo`, `idempresa`, `idFuncionario`, `idUsuario`, `dthrSolicitacao`, `dthrConfirmacao`, `dthrUltimaModificacao`, `km`, `dataInicial`, `dataFinal`, `dataAtribuida`, `realizado`) VALUES
(9, 2, 2, NULL, 1, '2019-06-23 18:05:09', NULL, '2019-06-23 19:07:35', NULL, '2019-06-26', '2019-06-27', NULL, 0),
(10, 7, 3, NULL, 1, '2019-06-23 22:17:23', NULL, '2019-06-23 22:17:23', NULL, '2019-06-29', '2019-06-29', NULL, 0),
(11, 1, 1, NULL, 1, '2019-06-23 22:19:38', NULL, '2019-06-23 22:19:38', NULL, '2019-06-30', '2019-06-30', NULL, 0),
(12, 7, 3, NULL, 1, '2019-06-23 22:21:14', NULL, '2019-06-23 22:21:14', NULL, '2019-06-28', '2019-06-28', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `marca` varchar(80) DEFAULT 'Nenhuma marca',
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `marca`, `ativo`) VALUES
(1, 'Óleo', 'OilMaster', 1),
(2, 'Troca de Pneu', 'Pirelli', 1),
(3, 'Mão de obra', 'Nenhuma marca', 1),
(4, 'Pneu 175/70R14', 'BRIDGESTONE', 1),
(5, 'Biela', 'Não definida', 1),
(6, 'Auto Falante 140q', 'JBL', 1),
(7, 'Teste', 'Fera', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_empresa`
--

CREATE TABLE `produto_empresa` (
  `id` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto_empresa`
--

INSERT INTO `produto_empresa` (`id`, `idempresa`, `idproduto`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 1, 6),
(4, 1, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_manutencao`
--

CREATE TABLE `produto_manutencao` (
  `id` int(11) NOT NULL,
  `idmanutencao` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `valor` double NOT NULL,
  `dthrAdicao` datetime NOT NULL DEFAULT current_timestamp()
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
(1, 1, 'Geometria'),
(2, 1, 'Configuração de som'),
(3, 1, 'Balanceamento'),
(4, 1, 'Lavagem'),
(5, 1, 'Troca de Oleo');

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
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 3, 1),
(5, 4, 2),
(6, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_manutencao`
--

CREATE TABLE `servico_manutencao` (
  `id` int(11) NOT NULL,
  `idmanutencao` int(11) NOT NULL,
  `idservico` int(11) NOT NULL,
  `dthrAdicao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico_manutencao`
--

INSERT INTO `servico_manutencao` (`id`, `idmanutencao`, `idservico`, `dthrAdicao`) VALUES
(1, 9, 2, '2019-06-23 18:05:09'),
(2, 9, 5, '2019-06-23 18:05:09'),
(3, 10, 3, '2019-06-23 22:17:23'),
(4, 10, 4, '2019-06-23 22:17:23'),
(5, 10, 5, '2019-06-23 22:17:23'),
(6, 12, 2, '2019-06-23 22:21:14');

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
(2, 'BDC1111', '123444', 'JETTA', '2012', '2011', 'VOLKSWAGEN', 1),
(7, 'abc7885', '14445454545', '500 Cult 1.4 Flex 8V EVO Mec.', '2015', '2014', 'FIAT', 1);

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
  ADD KEY `fk_manutencaoempresa` (`idempresa`),
  ADD KEY `fk_funcionarioManutencao` (`idFuncionario`),
  ADD KEY `fk_clienteManutencao` (`idUsuario`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto_empresa`
--
ALTER TABLE `produto_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produtoEmpresa` (`idempresa`),
  ADD KEY `fk_empresaProduto` (`idproduto`);

--
-- Índices para tabela `produto_manutencao`
--
ALTER TABLE `produto_manutencao`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `manutencao`
--
ALTER TABLE `manutencao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `produto_empresa`
--
ALTER TABLE `produto_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produto_manutencao`
--
ALTER TABLE `produto_manutencao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `servico_empresa`
--
ALTER TABLE `servico_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `servico_manutencao`
--
ALTER TABLE `servico_manutencao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `fk_clienteManutencao` FOREIGN KEY (`idUsuario`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_funcionarioManutencao` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`idusuario`),
  ADD CONSTRAINT `fk_manutencaoempresa` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `fk_manutencaoveiculo` FOREIGN KEY (`idveiculo`) REFERENCES `veiculo` (`id`);

--
-- Limitadores para a tabela `produto_empresa`
--
ALTER TABLE `produto_empresa`
  ADD CONSTRAINT `fk_empresaProduto` FOREIGN KEY (`idproduto`) REFERENCES `produto` (`id`),
  ADD CONSTRAINT `fk_produtoEmpresa` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`);

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