SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `uniformes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `uniformes`;

CREATE TABLE `cliente` (
  `idCliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `tipo_acesso` int(10) UNSIGNED DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(30) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cliente` (`idCliente`, `nome`, `cpf`, `data_nasc`, `endereco`, `email`, `telefone`, `tipo_acesso`, `login`, `senha`) VALUES
(1, 'ADM', '999.999.999-99', '9999-01-01', 'Rua Das Orquídeas', 'adm@gmail.com', '9999999999', 2, 'adm', 'adm'),
(2, 'Maria Silva', '123.456.789-00', '1990-03-15', 'Rua das Acácias, 45', 'maria.silva@gmail.com', '54999111222', 1, 'maria.silva', 'maria123'),
(3, 'João Pereira', '234.567.890-11', '1985-07-22', 'Av. Brasil, 200', 'joao.pereira@hotmail.com', '54998222333', 1, 'joao.pereira', 'joao456'),
(4, 'Ana Costa', '345.678.901-22', '1995-11-08', 'Rua das Flores, 78', 'ana.costa@gmail.com', '54997333444', 1, 'ana.costa', 'ana789'),
(5, 'Carlos Souza', '456.789.012-33', '1978-05-30', 'Rua do Comércio, 15', 'carlos.souza@yahoo.com', '54996444555', 1, 'carlos.souza', 'carlos321'),
(6, 'Fernanda Lima', '567.890.123-44', '2000-01-20', 'Av. Garibaldi, 300', 'fernanda.lima@gmail.com', '54995555666', 1, 'fernanda.lima', 'fern654');

CREATE TABLE `estoque` (
  `idEstoque` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(50) DEFAULT NULL,
  `quantidade` int(10) UNSIGNED DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `data_compra` date DEFAULT NULL,
  `data_prox_compra` date DEFAULT NULL,
  PRIMARY KEY (`idEstoque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `estoque` (`idEstoque`, `nomeProduto`, `quantidade`, `valor_unitario`, `data_compra`, `data_prox_compra`) VALUES
(1, 'Moletom G', 10, 150.00, '2026-04-20', '2026-06-20'),
(2, 'Moletom M', 9, 119.00, '2026-04-15', '2026-06-20'),
(3, 'Camiseta Polo', 13, 50.00, '2026-02-15', '2026-07-15'),
(4, 'Calça Cargo', 3, 200.00, '2026-01-15', '2026-06-15'),
(5, 'Calça Jeans G', 20, 167.00, '2026-04-20', '2026-07-20'),
(6, 'Camiseta Básica P', 25, 35.00, '2026-03-10', '2026-07-10'),
(7, 'Bermuda Tactel M', 15, 89.00, '2026-03-25', '2026-07-25'),
(8, 'Jaqueta Corta Vento P', 8, 220.00, '2026-04-05', '2026-08-05'),
(9, 'Meias Esportivas', 50, 18.00, '2026-05-01', '2026-08-01');

CREATE TABLE `funcionario` (
  `idFuncionario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `carga_horaria` int(10) UNSIGNED DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idFuncionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `carga_horaria`, `cpf`, `data_nasc`, `endereco`, `email`, `telefone`) VALUES
(1, 'Eloiza T Carli', 20, '952.952.952-68', '2008-04-04', 'Rua Osvaldo Garibaldi', 'eloiza.carli@gmail.com', '54991234567'),
(2, 'Pedro Alves', 40, '678.901.234-55', '1993-09-12', 'Rua Sete de Setembro, 90', 'pedro.alves@gmail.com', '54992345678'),
(3, 'Juliana Martins', 30, '789.012.345-66', '1997-02-28', 'Av. Independência, 450', 'juliana.martins@gmail.com', '54993456789'),
(4, 'Roberto Santos', 40, '890.123.456-77', '1988-06-17', 'Rua XV de Novembro, 33', 'roberto.santos@hotmail.com', '54994567890');

CREATE TABLE `vendas` (
  `idVendas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Cliente_idCliente` int(10) UNSIGNED NOT NULL,
  `idEstoque` int(10) UNSIGNED NOT NULL,
  `venda_data` date DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `forma_pag` int(10) UNSIGNED DEFAULT NULL,
  `quantidade` int(10) UNSIGNED DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idVendas`),
  KEY `fk_Vendas_Cliente` (`Cliente_idCliente`),
  KEY `fk_Vendas_Estoque` (`idEstoque`),
  CONSTRAINT `fk_Vendas_Cliente` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`),
  CONSTRAINT `fk_Vendas_Estoque` FOREIGN KEY (`idEstoque`) REFERENCES `estoque` (`idEstoque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `vendas` (`idVendas`, `Cliente_idCliente`, `idEstoque`, `venda_data`, `valor`, `forma_pag`, `quantidade`, `desconto`) VALUES
(1,  1, 3, '2026-05-02', 500.00, 3, 10, 0.00),
(2,  1, 4, '2026-05-07', 400.00, 4,  2, 0.00),
(3,  2, 1, '2026-05-10', 150.00, 1,  1, 0.00),
(4,  2, 6, '2026-05-10',  70.00, 1,  2, 0.00),
(5,  3, 5, '2026-05-12', 334.00, 2,  2, 0.00),
(6,  3, 7, '2026-05-12',  89.00, 2,  1, 0.00),
(7,  4, 2, '2026-05-14', 238.00, 3,  2, 0.00),
(8,  4, 8, '2026-05-15', 198.00, 1,  1, 22.00),
(9,  5, 3, '2026-05-18', 150.00, 4,  3, 0.00),
(10, 5, 9, '2026-05-18',  54.00, 4,  3, 0.00),
(11, 6, 1, '2026-05-20', 300.00, 2,  2, 0.00),
(12, 6, 4, '2026-05-22', 180.00, 3,  1, 20.00);