<?php
include(__DIR__ . "/../conexao.php");

$sql = "SELECT * FROM funcionario ORDER BY idFuncionario ASC";
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
                <li><a href="../index.html">Início</a></li>
                <li><a href="../estoque/criar-estoque.php">Cadastro de estoque</a></li>
                <li><a href="../estoque/lista-estoque.php">Lista de estoque</a></li>
                <li><a href="../vendas/criar-venda.php">Cadastro de vendas</a></li>
                <li><a href="../funcionarios/criar-funcionarios.php">Cadastro de funcionários</a></li>
                <li><a href="../funcionarios/lista-funcionarios.php">Lista de funcionários</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Lista de Funcionários</h2>

        <div style="margin-bottom: 15px;">
            <a href="criar-funcionarios.php" class="botao-adicionar">+ Novo Funcionário</a>
        </div>

        <table class="tabela">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Carga Horária</th>
                <th>CPF</th>
                <th>Data de Nasc.</th>
                <th>Endereço</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>

            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($item = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$item['idFuncionario']}</td>
                        <td>{$item['nome']}</td>
                        <td>{$item['carga_horaria']}</td>
                        <td>{$item['cpf']}</td>
                        <td>{$item['data_nasc']}</td>
                        <td>{$item['endereco']}</td>
                        <td>{$item['email']}</td>
                        <td>{$item['telefone']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum funcionario cadastrado</td></tr>";
            }
            ?>

        </table>

    </main>

</div>

</body>
</html>