<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

if (!isset($_SESSION["idCliente"])) {
    header("Location: /2026-1-isabelytrevisan/site_uniformes/index.php");
    exit();
}

// cliente não pode acessar
if ($_SESSION["tipo_acesso"] == 1) {
    echo "<script>
            alert('Apenas funcionários podem acessar o estoque!');
            window.location.href='/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.php';
          </script>";
    exit();
}

// consulta dos logins
$sql = "SELECT idCliente, nome, login FROM cliente";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Clientes</title>
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

        <div class="select-filtro">

            <input type="text"
                placeholder="Buscar id..."
                class="campo-filtro">

            <input type="text"
                placeholder="Nome..."
                class="campo-filtro">

            <input type="text"
                class="Login">
            
            <button class="btn-filtro">
                Buscar
            </button>

        </div>

        <h2>Lista de Logins</h2>

        <table class="tabela">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Login</th>
            </tr>

            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($item = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$item['idCliente']}</td>
                        <td>{$item['nome']}</td>
                        <td>{$item['login']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum cliente cadastrado</td></tr>";
            }
            ?>

        </table>

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
</body>
</html>