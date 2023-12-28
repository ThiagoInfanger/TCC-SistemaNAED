-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 28/05/2023 às 01:04
-- Versão do servidor: 5.6.40
-- Versão do PHP: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `educ`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `escolas`
--

CREATE TABLE `escolas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `qtdalunos` int(11) NOT NULL,
  `endereco` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `escolas`
--

INSERT INTO `escolas` (`id`, `nome`, `qtdalunos`, `endereco`) VALUES
(1, 'Academia Estrelar de Aprendizagem', 2000, 'Via Láctea, 690 - Jardim Sistema Solar - São Paulo'),
(3, 'Colégio Harmonia das Artes', 2500, 'Rua Quadro Negro, 100 - Vila Tablado - São Paulo'),
(4, 'Escola dos Segredos Ocultos', 350, 'Alameda Ninguém Me Conta, S/N - Vila Psiu - São Paulo'),
(5, 'Escola Preparatória de Talentos Brilhantes', 1500, 'Avenida das Lantejoulas - Jardim Esplendor - São Paulo'),
(6, 'Instituto da Imaginação Criativa', 550, 'Rua Mundo do Bob - 177 - Vila BrainStorm  - São Paulo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fiscalizacoes`
--

CREATE TABLE `fiscalizacoes` (
  `id` int(11) NOT NULL,
  `idescola` int(11) NOT NULL,
  `nrmes` int(2) NOT NULL,
  `nrano` int(4) NOT NULL,
  `nrestruturaaluno` int(11) NOT NULL,
  `nrestruturaprofessor` int(11) NOT NULL,
  `nrestruturadiretor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `fiscalizacoes`
--

INSERT INTO `fiscalizacoes` (`id`, `idescola`, `nrmes`, `nrano`, `nrestruturaaluno`, `nrestruturaprofessor`, `nrestruturadiretor`) VALUES
(1, 1, 2, 2023, 0, 1, 1),
(3, 1, 1, 2023, 1, 1, 1),
(4, 5, 3, 2023, 0, 0, 1),
(7, 4, 3, 2023, 1, 1, 0),
(8, 4, 2, 2023, 0, 1, 0),
(11, 1, 3, 2023, 0, 0, 0),
(12, 6, 1, 2023, 1, 0, 0),
(13, 6, 2, 2023, 0, 1, 0),
(14, 6, 3, 2023, 1, 0, 1),
(15, 6, 4, 2023, 1, 0, 1),
(23, 1, 4, 2023, 1, 0, 0),
(28, 4, 1, 2023, 1, 0, 0),
(31, 4, 4, 2023, 1, 0, 0),
(32, 5, 4, 2023, 1, 1, 0),
(34, 5, 2, 2023, 1, 0, 0),
(35, 5, 10, 2023, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Pâmela Patrícia Penteado', 'ppp@gmail.com', '123'),
(5, 'Joaquim José Jumirim', 'jjj@gmail.com', '111');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `escolas`
--
ALTER TABLE `escolas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fiscalizacoes`
--
ALTER TABLE `fiscalizacoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idescola` (`idescola`,`nrmes`,`nrano`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `escolas`
--
ALTER TABLE `escolas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `fiscalizacoes`
--
ALTER TABLE `fiscalizacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `fiscalizacoes`
--
ALTER TABLE `fiscalizacoes`
  ADD CONSTRAINT `fk_escola` FOREIGN KEY (`idescola`) REFERENCES `escolas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
