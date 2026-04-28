CREATE DATABASE IF NOT EXISTS uniformes;
USE uniformes;

CREATE TABLE Estoque (
  idEstoque INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nomeProduto VARCHAR(50) NULL,
  quantidade INTEGER UNSIGNED NULL,
  valor_unitario DECIMAL(10,2) NULL,
  data_compra DATE NULL,
  data_prox_compra DATE NULL,
  PRIMARY KEY(idEstoque)
);

CREATE TABLE Funcionario (
  idFuncionario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NULL,
  carga_horaria INTEGER UNSIGNED NULL,
  cpf VARCHAR(14) NULL,
  data_nasc DATE NULL,
  endereco VARCHAR(100) NULL,
  email VARCHAR(50) NULL,
  telefone VARCHAR(15) NULL,
  PRIMARY KEY(idFuncionario)
);

CREATE TABLE Cliente (
  idCliente INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NULL,
  cpf VARCHAR(14) NULL,
  data_nasc DATE NULL,
  endereco VARCHAR(100) NULL,
  email VARCHAR(50) NULL,
  telefone VARCHAR(15) NULL,
  tipo_acesso INTEGER UNSIGNED NULL,
  login VARCHAR(50) NULL,
  PRIMARY KEY(idCliente)
);

CREATE TABLE Vendas (
  idVendas INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Cliente_idCliente INTEGER UNSIGNED NOT NULL,
  idEstoque INTEGER UNSIGNED NOT NULL,
  venda_data DATE NULL,
  valor DECIMAL(10,2) NULL,
  forma_pag INTEGER UNSIGNED NULL,
  quantidade INTEGER UNSIGNED NULL,
  desconto DECIMAL(10,2) NULL,
  PRIMARY KEY(idVendas),
  CONSTRAINT fk_Vendas_Cliente FOREIGN KEY (Cliente_idCliente) REFERENCES Cliente(idCliente),
  CONSTRAINT fk_Vendas_Estoque FOREIGN KEY (idEstoque) REFERENCES Estoque(idEstoque)
);