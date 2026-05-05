<?php
include(__DIR__ . "/../conexao.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomeProduto = $_POST["nomeProduto"];
    $quantidade = $_POST["quantidade"];
    $valor_unitario = $_POST["valor_unitario"];
    $data_compra = $_POST["data_compra"];
    $data_prox_compra = $_POST["data_prox_compra"];

    $sql = "INSERT INTO estoque (nomeProduto, quantidade, valor_unitario, data_compra, data_prox_compra)
            VALUES ('$nomeProduto', '$quantidade', '$valor_unitario', '$data_compra', '$data_prox_compra')";

    if (mysqli_query($conexao, $sql)) {
        $msg = "✔ Produto cadastrado com sucesso!";
    } else {
        $msg = "✖ Erro ao salvar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro Estoque</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<header>
    <h1>Sistema de Uniformes</h1>
</header>

<div class="main">

    <aside class="menu-aside">
        <nav>
            <ul>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/index.html">Início</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/criar-estoque.php">Cadastro de estoque</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/lista-estoque.php">Lista de estoque</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/criar-venda.php">Cadastro de vendas</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/lista-vendas.php">Lista de vendas</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php">Cadastro de cliente</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/lista-clientes.php">Lista de clientes</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/criar-funcionarios.php">Cadastro de funcionários</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/lista-funcionarios.php">Lista de funcionários</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/logins/lista-logins.php">Lista de logins</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Cadastro de Estoque</h2>

        <?php if ($msg != "")?>
            <p><?= $msg ?></p>

        <form method="POST" class="form-clean">
            <input type="text" name="nomeProduto" placeholder="Nome do Produto" required>
            <input type="number" name="quantidade" placeholder="Quantidade" required>

            <input type="number" name="valor_unitario" placeholder="Valor Unitário" required>
            <input type="date" name="data_compra" placeholder="Data Última Compra" required>
            <input type="date" name="data_prox_compra" placeholder="Data Próxima Compra" required>

            <button class="botao-adicionar" type="submit">Salvar</button>
        </form>

    </main>

</div>

</body>
</html>