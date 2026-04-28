<?php
include(__DIR__ . "/../conexao.php");

$sql_produtos = "SELECT idEstoque, nomeProduto, quantidade FROM Estoque WHERE quantidade > 0";
$produtos = mysqli_query($conexao, $sql_produtos);

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idEstoque = $_POST["idEstoque"];
    $venda_data = $_POST["venda_data"];
    $valor = $_POST["valor"];
    $forma_pag = $_POST["forma_pag"];
    $quantidade = $_POST["quantidade"];
    $desconto = $_POST["desconto"];
    $Cliente_idCliente = $_POST["Cliente_idCliente"];

    $sql_venda = "INSERT INTO Vendas (idEstoque, venda_data, quantidade, valor, forma_pag, desconto)
                  VALUES ('$idEstoque', '$venda_data', '$quantidade', '$valor', '$forma_pag', '$desconto', '$Cliente_idCliente')";

    if (mysqli_query($conexao, $sql_venda)) {

        $sql_estoque = "UPDATE Estoque
                        SET quantidade = quantidade - $quantidade
                        WHERE idEstoque = $idEstoque
                        AND Cliente_idCliente = $Cliente_idCliente";

        mysqli_query($conexao, $sql_estoque);

        $sql_produtos = "SELECT idEstoque, nomeProduto, quantidade FROM Estoque WHERE quantidade > 0";
        $produtos = mysqli_query($conexao, $sql_produtos);

        $msg = "✔ Venda registrada e estoque atualizado!";
    } else {
        $msg = "✖ Erro ao salvar venda.";
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
                <li><a href="../vendas/lista-vendas.php">Lista de vendas</a></li>
                <li><a href="../clientes/criar-cliente.php">Cadastro de cliente</a></li>
                <li><a href="../clientes/lista-clientes.php">Lista de clientes</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Cadastro de Vendas</h2>

        <?php if ($msg != "") { ?>
            <p><?= $msg ?></p>
        <?php } ?>

        <form method="POST">

            <label>Produto:</label>
            <select name="idEstoque" required>
                <?php while($p = mysqli_fetch_assoc($produtos)) { ?>
                    <option value="<?= $p['idEstoque'] ?>">
                        <?= $p['nomeProduto'] ?> (<?= $p['quantidade'] ?> em estoque)
                    </option>
                <?php } ?>
            </select>

            <input type="number" name="quantidade" placeholder="Quantidade vendida" required>

            <input type="date" name="venda_data" required>

            <input type="number" step="0.01" name="valor" placeholder="Valor total" required>

            <select name="forma_pag">
                <option value=1>Cartão de Crédito</option>
                <option value=2>Débito</option>
                <option value=3>PIX</option>
                <option value=4>Boleto</option>
            </select>

            <input type="number" name="desconto" placeholder="Desconto">

            <label>Cliente:</label>
            <select name="Cliente_idCliente" required>
                <?php while($p = mysqli_fetch_assoc($produtos)) { ?>
                    <option value="<?= $p['Cliente_idCliente'] ?>">
                        <?= $p['nome'] ?>
                    </option>
                <?php } ?>
            </select>

            <button class="botao-adicionar" type="submit">Salvar</button>

        </form>

    </main>

</div>

</body>
</html>