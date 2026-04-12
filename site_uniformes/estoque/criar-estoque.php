<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
    $codigo = $_POST["codigo"];
    $produto = $_POST["produto"];
    $tamanho = $_POST["tamanho"];
    $cor = $_POST["cor"];
    $quantidade = $_POST["quantidade"];

    $sql = "INSERT INTO estoque (data, codigo, produto, tamanho, cor, quantidade)
            VALUES ('$data', '$codigo', '$produto', '$tamanho', '$cor', '$quantidade')";

    mysqli_query($conexao, $sql);

    header("Location: lista-estoque.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Estoque</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<h1>Cadastro de Estoque</h1>

        <main class="main">
            <aside class="menu-aside">
                <ul>
                    <li><a href="/site_uniformes/index.html">Início</a></li>
                    <li><a href="/site_uniformes/logins/criar-logins.html">Criação de logins</a></li>
                    <li><a href="/site_uniformes/logins/lista-logins.html">Lista de logins</a></li>
                    <li><a href="/site_uniformes/vendas/criar-venda.html">Registrar vendas</a></li>
                    <li><a href="/site_uniformes/vendas/lista-vendas.html">Relatório de vendas</a></li>
                    <li><a href="/site_uniformes/clientes/criar-cliente.html">Cadastro clientes</a></li>
                    <li><a href="/site_uniformes/clientes/lista-clientes.html">Lista de clientes</a></li>
                    <li><a href="/site_uniformes/funcionarios/criar-funcionarios.html">Cadastro funcionários</a></li>
                    <li><a href="/site_uniformes/funcionarios/lista-funcionarios.html">Lista de funcionários</a></li>
                    <li><a href="/site_uniformes/estoque/criar-estoque.php">Cadastro de estoque</a></li>
                    <li><a href="/site_uniformes/estoque/lista-estoque.php">Lista de estoque</a></li>
                    <li><a href="/site_uniformes/caixa/fluxo-de-caixa.html">Fluxo de caixa</a></li>
                </ul>
            </aside>
        </main>

<form method="POST">
    <label>Data</label>
    <input type="date" name="data" required>

    <label>Código</label>
    <input type="text" name="codigo" required>

    <label>Produto</label>
    <select name="produto">
        <option>Camisa</option>
        <option>Regata</option>
        <option>Camiseta</option>
        <option>Baby look</option>
    </select>

    <label>Tamanho</label>
    <input type="text" name="tamanho" required>

    <label>Cor</label>
    <input type="text" name="cor" required>

    <label>Quantidade</label>
    <input type="number" name="quantidade" required>

    <button type="submit">Salvar</button>
</form>

</body>
</html>