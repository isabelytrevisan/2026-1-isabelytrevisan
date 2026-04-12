Lista estoque :
<?php
include(__DIR__ . "/../conexao.php");

$sql = "SELECT * FROM estoque ORDER BY id DESC";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista Estoque</title>
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

        <h2>Lista de Estoque</h2>

        <div style="margin-bottom: 15px;">
            <a href="criar-estoque.php" class="botao-adicionar">+ Novo Produto</a>
        </div>

        <table class="tabela">
            <tr>
                <th>Código</th>
                <th>Produto</th>
                <th>Tamanho</th>
                <th>Cor</th>
                <th>Quantidade</th>
                <th>Data</th>
            </tr>

            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($item = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$item['codigo']}</td>
                        <td>{$item['produto']}</td>
                        <td>{$item['tamanho']}</td>
                        <td>{$item['cor']}</td>
                        <td>{$item['quantidade']}</td>
                        <td>{$item['data']}</td>
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