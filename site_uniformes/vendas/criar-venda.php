<?php
session_start();
include(__DIR__ . "/../conexao.php");

if (!isset($_SESSION["idCliente"])) {
    header("Location: /2026-1-isabelytrevisan/site_uniformes/index.php");
    exit();
}

// cliente não pode acessar
if ($_SESSION["tipo_acesso"] == 1) {
    echo "<script>
            alert('Apenas funcionários podem acessar o estoque!');
            window.location.href='/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.html';
          </script>";
    exit();
}

// carregar produtos e clientes
$sql_produtos = "SELECT idEstoque, nomeProduto, quantidade FROM estoque WHERE quantidade > 0";
$produtos = mysqli_query($conexao, $sql_produtos);

$sql_clientes = "SELECT idCliente, nome FROM cliente";
$clientes = mysqli_query($conexao, $sql_clientes);

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idEstoque = $_POST["idEstoque"];
    $venda_data = $_POST["venda_data"];
    $valor = $_POST["valor"];
    $forma_pag = $_POST["forma_pag"];
    $quantidade = $_POST["quantidade"];
    $desconto = $_POST["desconto"];
    $idCliente = $_POST["idCliente"];

    $sql_check = "SELECT quantidade FROM estoque WHERE idEstoque = $idEstoque";
    $res_check = mysqli_query($conexao, $sql_check);
    $estoque_atual = mysqli_fetch_assoc($res_check)['quantidade'];

    if ($quantidade > $estoque_atual) {
        $msg = "Estoque insuficiente! Só existem $estoque_atual unidades.";
    } else {

        $sql_venda = "INSERT INTO vendas 
        (idEstoque, Cliente_idCliente, venda_data, quantidade, valor, forma_pag, desconto)
        VALUES 
        ('$idEstoque', '$idCliente', '$venda_data', '$quantidade', '$valor', '$forma_pag', '$desconto')";

        if (mysqli_query($conexao, $sql_venda)) {

            $sql_estoque = "UPDATE estoque
                            SET quantidade = quantidade - $quantidade
                            WHERE idEstoque = $idEstoque";

            mysqli_query($conexao, $sql_estoque);

            $msg = "Venda registrada e estoque atualizado!";
        } else {
            $msg = "Erro ao salvar venda: " . mysqli_error($conexao);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro Vendas</title>
<link rel="stylesheet" href="../styles.css">
<link rel="icon" type="image/x-icon" href="/2026-1-isabelytrevisan/site_uniformes/img/logotp.png">
</head>

<body>

<header>
    <h1>Sistema de Uniformes</h1>
</header>

<div class="main">

    <aside class="menu-aside">
        <nav>
            <ul>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.html">Início</a></li>
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

        <h2>Cadastro de Vendas</h2>

        <?php if ($msg != "") { ?>
            <p><?= $msg ?></p>
        <?php } ?>

        <form method="POST" class="form-clean">

            <label>Produto:</label>
            <select name="idEstoque" required>
                <?php while($p = mysqli_fetch_assoc($produtos)) { ?>
                    <option value="<?= $p['idEstoque'] ?>">
                        <?= $p['nomeProduto'] ?> (<?= $p['quantidade'] ?> em estoque)
                    </option>
                <?php } ?>
            </select>

            <label>Quantidade vendida:</label>
            <input type="number" name="quantidade" placeholder="Quantidade vendida" required>

            <label>Data da venda:</label>
            <input type="date" name="venda_data" required>

            <label>Valor total:</label>
            <input type="number" step="0.01" name="valor" placeholder="Valor total" required>

            <label>Forma de Pagamento:</label>
            <select name="forma_pag">
                <option value=1>Cartão de Crédito</option>
                <option value=2>Débito</option>
                <option value=3>PIX</option>
                <option value=4>Boleto</option>
            </select>

            <label>Desconto (em %):</label>
            <input type="number" name="desconto" placeholder="Desconto">

            <label>Cliente:</label>
            <select name="idCliente" required>
                <?php while($p = mysqli_fetch_assoc($clientes)) { ?>
                    <option value="<?= $p['idCliente'] ?>">
                        <?= $p['idCliente'] ?> - <?= $p['nome'] ?>
                    </option>
                <?php } ?>
            </select>

            <button class="botao-adicionar" type="submit">Salvar</button>

        </form>

    </main>

</div>

</body>
</html>