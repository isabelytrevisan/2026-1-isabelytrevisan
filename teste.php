<?php
$conexao = mysqli_connect("localhost", "root", "", "uniformes");

if (!$conexao) {
    die("ERRO CONEXÃO: " . mysqli_connect_error());
}

$sql = "INSERT INTO estoque (data, codigo, produto, tamanho, cor, quantidade)
        VALUES ('2026-04-12', '999', 'Camisa', 'M', 'Preta', 10)";

if(mysqli_query($conexao, $sql)){
    echo "FUNCIONOU! Salvou no banco.";
} else {
    echo "ERRO SQL: " . mysqli_error($conexao);
}
?>