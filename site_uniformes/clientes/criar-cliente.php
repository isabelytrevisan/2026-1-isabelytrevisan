<?php
session_start();
include(__DIR__ . "/../conexao.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nasc"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $tipo_acesso = 1;
    $login = $_POST["login"];

    $sql = "INSERT INTO cliente (nome, cpf, data_nasc, endereco, email, telefone, tipo_acesso, login)
            VALUES ('$nome', '$cpf', '$data_nasc', '$endereco', '$email', '$telefone', '$tipo_acesso', '$login')";

    if (mysqli_query($conexao, $sql)) {
        $msg = "✔ Cliente cadastrado com sucesso!";
    } else {
        $msg = "Erro: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de Cliente</title>
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
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.php">Início</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/criar-estoque.php">Cadastro de estoque</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/lista-estoque.php">Lista de estoque</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/criar-venda.php">Cadastro de vendas</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/lista-vendas.php">Lista de vendas</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php">Cadastro de cliente</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/lista-clientes.php">Lista de clientes</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/criar-funcionarios.php">Cadastro de funcionários</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/lista-funcionarios.php">Lista de funcionários</a></li>
                    
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Cadastro de Cliente</h2>

        <?php if ($msg != "")?>
            <p><?= $msg ?></p>

        <form method="POST" class="form-clean">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Nome" required>

            <label>CPF:</label>
            <input type="text" name="cpf" placeholder="CPF" required>

            <label>Data de Nascimento:</label>
            <input type="date" name="data_nasc" placeholder="Data de nascimento" required>

            <label>Endereço:</label>
            <input type="text" name="endereco" placeholder="Endereço" required>

            <label>Email:</label>
            <input type="text" name="email" placeholder="Email" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" placeholder="Telefone" required>

            <label>Login:</label>
            <input type="text" name="login" placeholder="Login" required>

            <button class="botao-adicionar" type="submit">Salvar</button>
        </form>

    </main>

</div>

    <footer class="footer-site">

        <div class="footer-container">

            <div class="footer-coluna">
                <h3>Cores & Padrões</h3>
                <p>
                    Uniformes que vestem identidades, histórias e conexões.
                </p>
            </div>

            <div class="footer-coluna">
                <h3>Contato</h3>
                <p>(49) 99999-9999</p>
                <p>contato@coresepadroes.com</p>
                <p>Chapecó - SC</p>
            </div>

            <div class="footer-coluna">
                <h3>Horários</h3>
                <p>Segunda a Sexta</p>
                <p>08h às 18h</p>
            </div>

            </div>

            <div class="footer-bottom">
                Sistema desenvolvido por estudantes do Técnico em Desenvolvimento de Sistemas —
                isabely.ot@aluno.ifsc.edu.br
            </div>

    </footer>

</body>
</html>