<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "uniformes";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Falha na conexão.");
}

mysqli_set_charset($conexao, "utf8");
?>