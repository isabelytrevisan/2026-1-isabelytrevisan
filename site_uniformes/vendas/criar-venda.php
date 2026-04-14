<?php
include(__DIR__ . "/../conexao.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Cliente_idCliente = $_POST["Cliente_idCliente"];
    $ident_produto = $_POST["ident_produto"];
    $venda_data = $_POST["venda_data"];
    $valor = $_POST["valor"];
    $forma_pag = $_POST["forma_pag"];
    $quantidade = $_POST["quantidade"];
    $desconto = $_POST["desconto"];


    $sql = "INSERT INTO estoque (Cliente_idCliente, ident_produto, venda_data, valor, forma_pag, quantidade, desconto)
            VALUES ('$Cliente_idCliente', '$ident_produto', '$venda_data', '$valor', '$forma_pag', 'quantidade', 'desconto')";

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
<title>Cadastro Vendas</title>
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
                <li><a href="../index.html">Início</a></li>
                <li><a href="../estoque/criar-estoque.php">Cadastro de estoque</a></li>
                <li><a href="../estoque/lista-estoque.php">Lista de estoque</a></li>
                <li><a href="../vendas/criar-venda.php">Cadastro de vendas</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Cadastro de Vendas</h2>

        <?php if ($msg != "")?>
            <p><?= $msg ?></p>
        <?php?>

        <form method="POST">
            <!-- arrumar -->
            <input type="text" name="Cliente_idCliente" placeholder="Nome do Produto" required>
            <input type="number" name="ident_produto" placeholder="Quantidade" required>
            <input type="number" name="venda_data" placeholder="Valor Unitário" required>
            <input type="date" name="valor" placeholder="Data Última Compra" required>
            <select name="forma_pag">
                <option value=1>Cartão de Crédito</option>
                <option value=2>Débito</option>
                <option value=3>PIX</option>
                <option value=4>Boleto</option>
            </select>
            <input type="date" name="quantidade" placeholder="Quantidade" required>
            <input type="date" name="desconto" placeholder="Desconto" required>

            <button class="botao-adicionar" type="submit">Salvar</button>
        </form>

    </main>

</div>

</body>
</html>