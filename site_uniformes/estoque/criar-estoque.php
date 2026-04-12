<?php
include(__DIR__ . "/../conexao.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = $_POST["data"];
    $codigo = $_POST["codigo"];
    $produto = $_POST["produto"];
    $tamanho = $_POST["tamanho"];
    $cor = $_POST["cor"];
    $quantidade = $_POST["quantidade"];

    $sql = "INSERT INTO estoque (data, codigo, produto, tamanho, cor, quantidade)
            VALUES ('$data', '$codigo', '$produto', '$tamanho', '$cor', '$quantidade')";

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
                <li><a href="../index.html">Início</a></li>
                <li><a href="criar-estoque.php">Cadastro de estoque</a></li>
                <li><a href="lista-estoque.php">Lista de estoque</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Cadastro de Estoque</h2>

        <?php if ($msg != "") { ?>
            <p><?= $msg ?></p>
        <?php } ?>

        <form method="POST">
            <input type="date" name="data" required>
            <input type="text" name="codigo" placeholder="Código" required>

            <select name="produto">
                <option>Camisa</option>
                <option>Camiseta</option>
                <option>Regata</option>
                <option>Baby look</option>
            </select>

            <input type="text" name="tamanho" placeholder="Tamanho" required>
            <input type="text" name="cor" placeholder="Cor" required>
            <input type="number" name="quantidade" placeholder="Qtd" required>

            <button class="botao-adicionar" type="submit">Salvar</button>
        </form>

    </main>

</div>

</body>
</html>