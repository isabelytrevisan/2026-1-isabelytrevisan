CREATE DATABASE IF NOT EXISTS uniformes;
USE uniformes;

CREATE TABLE Cliente (
  idCliente INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Logins_idLogins INTEGER UNSIGNED NOT NULL,
  nome VARCHAR(50) NULL,
  cpf INTEGER UNSIGNED NULL,
  data_nasc DATE NULL,
  endereco VARCHAR(50) NULL,
  email VARCHAR(30) NULL,
  telefone INTEGER UNSIGNED NULL,
  PRIMARY KEY(idCliente),
  INDEX Cliente_FKIndex1(Logins_idLogins)
);

CREATE TABLE Estoque (
  idEstoque INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nomeProduto VARCHAR(30) NULL,
  quantidade INTEGER UNSIGNED NULL,
  valor_unitario INTEGER UNSIGNED NULL,
  data_compra DATE NULL,
  data_prox_compra DATE NULL,
  PRIMARY KEY(idEstoque)
);

CREATE TABLE Funcionario (
  idFuncionario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome INTEGER UNSIGNED NULL,
  carga_horaria INTEGER UNSIGNED NULL,
  cpf INTEGER UNSIGNED NULL,
  data_nasc DATE NULL,
  endereco VARCHAR(50) NULL,
  email VARCHAR(30) NULL,
  telefone INTEGER UNSIGNED NULL,
  PRIMARY KEY(idFuncionario)
);

CREATE TABLE Logins (
  idLogins INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  tipo_acesso INTEGER UNSIGNED NULL,
  login VARCHAR(50) NULL,
  PRIMARY KEY(idLogins)
);

CREATE TABLE Vendas (
  idVendas INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Cliente_idCliente INTEGER UNSIGNED NOT NULL,
  ident_produto VARCHAR(50) NULL,
  venda_data DATE NULL,
  valor REAL NULL,
  forma_pag INTEGER UNSIGNED NULL,
  quantidade INTEGER UNSIGNED NULL,
  desconto INTEGER UNSIGNED NULL,
  PRIMARY KEY(idVendas),
  INDEX Vendas_FKIndex1(Cliente_idCliente)
);


