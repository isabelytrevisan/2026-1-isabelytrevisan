<?php
include(__DIR__ . "/../conexao.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $carga_horaria = $_POST["carga_horaria"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nasc"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO funcionario (nome, carga_horaria, cpf, data_nasc, endereco, email, telefone)
            VALUES ('$nome', '$carga_horaria', '$cpf', '$data_nasc', '$endereco', '$email', '$telefone')";

    if (mysqli_query($conexao, $sql)) {
        $msg = "✔ Funcionário cadastrado com sucesso!";
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
                <li><a href="../estoque/criar-estoque.php">Cadastro de estoque</a></li>
                <li><a href="../estoque/lista-estoque.php">Lista de estoque</a></li>
                <li><a href="../vendas/criar-venda.php">Cadastro de vendas</a></li>
                <li><a href="../funcionarios/criar-funcionarios.php">Cadastro de funcionários</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Cadastro de Funcionário</h2>

        <?php if ($msg != "")?>
            <p><?= $msg ?></p>

        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="datetime" name="carga_horaria" placeholder="Carga horaria" required>
            <input type="number" name="cpf" placeholder="CPF" required>
            <input type="date" name="data_nasc" placeholder="Data de nascimento" required>
            <input type="text" name="endereco" placeholder="Endereço" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="number" name="telefone" placeholder="Telefone" required>

            <button class="botao-adicionar" type="submit">Salvar</button>
        </form>

    </main>

</div>

</body>
</html>