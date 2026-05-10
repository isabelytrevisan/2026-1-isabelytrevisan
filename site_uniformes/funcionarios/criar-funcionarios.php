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

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $carga_horaria = $_POST["carga_horaria"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nasc"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO funcionario 
            (nome, carga_horaria, cpf, data_nasc, endereco, email, telefone)
            VALUES 
            ('$nome', '$carga_horaria', '$cpf', '$data_nasc', '$endereco', '$email', '$telefone')";

    if (mysqli_query($conexao, $sql)) {
        $msg = "✔ Funcionário cadastrado com sucesso!";
    } else {
        $msg = "✖ Erro ao salvar: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro Estoque</title>
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

        <h2>Cadastro de Funcionário</h2>

        <?php if ($msg != "")?>
            <p><?= $msg ?></p>

        <form method="POST" class="form-clean">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Nome" required>

            <label>Carga Horária (horas por semana):</label>
            <input type="time" name="carga_horaria" placeholder="Carga horaria" required>

            <label>CPF:</label>
            <input type="number" name="cpf" placeholder="CPF" required>

            <label>Data de Nascimento:</label>
            <input type="date" name="data_nasc" placeholder="Data de nascimento" required>

            <label>Endereço</label>
            <input type="text" name="endereco" placeholder="Endereço" required>

            <label>Email:</label>
            <input type="text" name="email" placeholder="Email" required>

            <label>Telefone:</label>
            <input type="number" name="telefone" placeholder="Telefone" required>

            <button class="botao-adicionar" type="submit">Salvar</button>
        </form>

    </main>

</div>

</body>
</html>