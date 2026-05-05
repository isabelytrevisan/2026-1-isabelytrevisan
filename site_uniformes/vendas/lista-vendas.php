<?php
include(__DIR__ . "/../conexao.php");

$sql = "SELECT * FROM vendas ORDER BY idVendas ASC";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title></title>
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

        <h2>Lista de Estoque</h2>

        <div style="margin-bottom: 15px;">
            <a href="criar-estoque.php" class="botao-adicionar">+ Novo Produto</a>
        </div>

        <table class="tabela">
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Id. Produto</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Forma Pag.</th>
                <th>Quantidade</th>
                <th>Desconto</th>
            </tr>

            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($item = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$item['idVendas']}</td>
                        <td>{$item['Cliente_idCliente']}</td>
                        <td>{$item['ident_produto']}</td>
                        <td>{$item['venda_data']}</td>
                        <td>{$item['valor']}</td>
                        <td>{$item['forma_pag']}</td>
                        <td>{$item['quantidade']}</td>
                        <td>{$item['desconto']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum produto cadastrado</td></tr>";
            }
            ?>

        </table>

    </main>

</div>

</body>
</html>