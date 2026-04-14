<?php
include(__DIR__ . "/../conexao.php");

$produtos = mysqli_query($conexao, "SELECT * FROM estoque WHERE quantidade > 0");
?>
$msg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id_estoque = $_POST['id_estoque'];
    $qtd = $_POST['quantidade_vendida'];

    // Pega dados do produto escolhido
    $busca = mysqli_query($conexao, "SELECT * FROM estoque WHERE id = $id_estoque");
    $produto = mysqli_fetch_assoc($busca);

    // Salva na tabela vendas
    mysqli_query($conexao, "INSERT INTO vendas 
        (data_venda, codigo, produto, tamanho, cor, quantidade_vendida)
        VALUES (NOW(),
        '{$produto['codigo']}',
        '{$produto['produto']}',
        '{$produto['tamanho']}',
        '{$produto['cor']}',
        '$qtd'
    )");

    // Dá baixa no estoque
    mysqli_query($conexao, "UPDATE estoque 
        SET quantidade = quantidade - $qtd 
        WHERE id = $id_estoque");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro Venda</title>
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

        <h2>Cadastro de Venda</h2>

        <?php if ($msg != "") { ?>
            <p><?= $msg ?></p>
        <?php } ?>

        <form method="POST">

            <input type="date" name="data" required>
            <input type="text" name="codigo" placeholder="Código" required>
            <input type="text" name="nomeCliente" placeholder="Nome do Cliente" required>
            <label>Produto</label>
            <select name="id_estoque" required>
                <option value="">Selecione um produto</option>

                <?php while($p = mysqli_fetch_assoc($produtos)) { ?>
                    <option value="<?= $p['id'] ?>">
                        <?= $p['codigo'] ?> - <?= $p['produto'] ?> - <?= $p['tamanho'] ?> - <?= $p['cor'] ?> (<?= $p['quantidade'] ?> em estoque)
                    </option>
                <?php } ?>

            </select>

            <input type="number" name="quantidade_vendida" placeholder="Quantidade" required>

            <button type="submit" class="botao-adicionar">Vender</button>
        </form>

    </main>

</div>

</body>
</html>