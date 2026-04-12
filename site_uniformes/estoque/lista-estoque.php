<?php
include("../conexao.php");
$sql = "SELECT * FROM estoque ORDER BY id DESC";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Estoque</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<h1>Lista de Estoque</h1>

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

<table border="1" cellpadding="10">
    <tr>
        <th>Código</th>
        <th>Produto</th>
        <th>Tamanho</th>
        <th>Cor</th>
        <th>Quantidade</th>
        <th>Data</th>
    </tr>

    <?php while($item = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?= $item['codigo'] ?></td>
            <td><?= $item['produto'] ?></td>
            <td><?= $item['tamanho'] ?></td>
            <td><?= $item['cor'] ?></td>
            <td><?= $item['quantidade'] ?></td>
            <td><?= $item['data'] ?></td>
        </tr>
    <?php } ?>

</table>

</body>
</html>