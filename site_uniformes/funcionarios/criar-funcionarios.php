<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

if (!isset($_SESSION["idCliente"])) {
    header("Location: /2026-1-isabelytrevisan/site_uniformes/index.php");
    exit();
}


if ($_SESSION["tipo_acesso"] == 1) {
    echo "<script>
            alert('Apenas funcionários podem acessar o estoque!');
            window.location.href='/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.php';
          </script>";
    exit();
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = preg_replace('/[^a-zA-ZÀ-ÿ\s]/', '', $nome);
    $carga_horaria = $_POST["carga_horaria"];
    $cpf = preg_replace('/\D/', '', $cpf);
    $data_nasc = $_POST["data_nasc"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];
    $telefone = preg_replace('/\D/', '', $telefone);

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
        <button id="toggleMenu" class="menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <img src="../img/logotp.png" class="header-logo" alt="Logo Cores & Padrões">
        <h1>Cores & Padrões</h1>
        <div class="user-info">
            <?php if (isset($_SESSION['nome'])): ?>
                <span class="user-name"><?php echo $_SESSION['nome']; ?></span>
                <a href="../logoutCheck.php" class="logout-link">Sair</a>
            <?php endif; ?>
        </div>
    </header>
<div class="main">

    <aside class="menu-aside">
        <nav>
            <ul>
                <li><a href="/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.php">Início</a></li>

                <details class="menu-grupo">
                    <summary>Clientes</summary>
                    <ul>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php">Cadastro de Cliente</a></li>
                        <?php if(isset($_SESSION['tipo_acesso']) && $_SESSION['tipo_acesso'] == 2): ?>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/lista-clientes.php">Lista de Clientes</a></li>
                        <?php endif; ?>
                    </ul>
                </details>

                <?php if (isset($_SESSION['tipo_acesso']) && $_SESSION['tipo_acesso'] == 2): ?>

                <details class="menu-grupo">
                    <summary>Estoque</summary>
                    <ul>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/criar-estoque.php">Cadastro de Estoque</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/lista-estoque.php">Lista de Estoque</a></li>
                    </ul>
                </details>

                <details class="menu-grupo">
                    <summary>Vendas</summary>
                    <ul>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/criar-venda.php">Cadastro de Venda</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/lista-vendas.php">Lista de Vendas</a></li>
                    </ul>
                </details>

                <details class="menu-grupo">
                    <summary>Funcionários</summary>
                    <ul>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/criar-funcionarios.php">Cadastro de Funcionários</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/lista-funcionarios.php">Lista de Funcionários</a></li>
                    </ul>
                </details>

                <details class="menu-grupo">
                    <summary>Financeiro</summary>
                    <ul>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/caixa/fluxo-de-caixa.php">Fluxo de Caixa</a></li>
                    </ul>
                </details>

                <details class="menu-grupo">
                    <summary>Sistema</summary>
                    <ul>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/logins/lista-logins.php">Logins Cadastrados</a></li>
                    </ul>
                </details>

                <?php endif; ?>

                <li><a href="/2026-1-isabelytrevisan/site_uniformes/index.php">Login</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Cadastro de Funcionário</h2>

        <?php if ($msg != "") { ?>
            <p><?= $msg ?></p>
        <?php } ?>

        <form method="POST" class="form-clean">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Nome" required>

            <label>Carga Horária (horas por dia):</label>
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
    <footer class="footer-site">

        <div class="footer-container">

            <div class="footer-coluna">
                <h3>Cores & Padrões</h3>
                <p>
                    Uniformes que vestem identidades, histórias e conexões.
                </p>
            </div>

            <div class="footer-coluna">
                <div class="footer-coluna-icon">
                <img src="\2026-1-isabelytrevisan\site_uniformes\img\iconContato.png">
                <h3>Contato</h3>
                </div>
                <p>(49) 99999-9999</p>
                <p>contato@coresepadroes.com</p>
                <p>Chapecó - SC</p>
            </div>

            <div class="footer-coluna">
                <div class="footer-coluna-icon">
                <img src="\2026-1-isabelytrevisan\site_uniformes\img\iconRelogio.png">
                <h3>Horários</h3>
                </div>
                <p>Segunda a Sexta</p>
                <p>08h às 18h</p>
            </div>

            </div>

            <div class="footer-bottom">
                Sistema desenvolvido por estudantes do Técnico em Desenvolvimento de Sistemas —
                isabely.ot@aluno.ifsc.edu.br
            </div>

    </footer>
      <script src="../ScriptIndex.js"></script>
</body>
</html>