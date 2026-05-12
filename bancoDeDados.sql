-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 04:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uniformes`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `tipo_acesso` int(10) UNSIGNED DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `cpf`, `data_nasc`, `endereco`, `email`, `telefone`, `tipo_acesso`, `login`) VALUES
(1, 'Murilo Thomé', '04545689086', '2008-09-27', 'Rua Orelho Estevao Fontana', 'muristop@gmail.com', '54996848291', 2, 'muristop10');

-- --------------------------------------------------------

--
-- Table structure for table `estoque`
--

CREATE TABLE `estoque` (
  `idEstoque` int(10) UNSIGNED NOT NULL,
  `nomeProduto` varchar(50) DEFAULT NULL,
  `quantidade` int(10) UNSIGNED DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `data_compra` date DEFAULT NULL,
  `data_prox_compra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estoque`
--

INSERT INTO `estoque` (`idEstoque`, `nomeProduto`, `quantidade`, `valor_unitario`, `data_compra`, `data_prox_compra`) VALUES
(1, 'Moletom G', 10, 150.00, '2026-04-20', '2026-06-20'),
(2, 'Moletom M', 9, 119.00, '2026-04-15', '2026-06-20'),
(3, 'Camiseta Polo', 13, 50.00, '2026-02-15', '2026-07-15'),
(4, 'Calça Cargo', 3, 200.00, '2026-01-15', '2026-06-15'),
(5, 'Calça Jeans G', 20, 167.00, '2026-04-20', '2026-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `carga_horaria` int(10) UNSIGNED DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `carga_horaria`, `cpf`, `data_nasc`, `endereco`, `email`, `telefone`) VALUES
(1, 'Eloiza T Carli', 20, '95295295268', '2008-04-04', 'Rua Osvaldo Garibaldi', 'teste@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `vendas`
--

CREATE TABLE `vendas` (
  `idVendas` int(10) UNSIGNED NOT NULL,
  `Cliente_idCliente` int(10) UNSIGNED NOT NULL,
  `idEstoque` int(10) UNSIGNED NOT NULL,
  `venda_data` date DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `forma_pag` int(10) UNSIGNED DEFAULT NULL,
  `quantidade` int(10) UNSIGNED DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendas`
--

INSERT INTO `vendas` (`idVendas`, `Cliente_idCliente`, `idEstoque`, `venda_data`, `valor`, `forma_pag`, `quantidade`, `desconto`) VALUES
(1, 1, 3, '2026-05-02', 500.00, 3, 10, 0.00),
(2, 1, 4, '2026-05-07', 400.00, 4, 2, 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`idEstoque`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idVendas`),
  ADD KEY `fk_Vendas_Cliente` (`Cliente_idCliente`),
  ADD KEY `fk_Vendas_Estoque` (`idEstoque`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `idEstoque` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `idVendas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_Vendas_Cliente` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_Vendas_Estoque` FOREIGN KEY (`idEstoque`) REFERENCES `estoque` (`idEstoque`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
