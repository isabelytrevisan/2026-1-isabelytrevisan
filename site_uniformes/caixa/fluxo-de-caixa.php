<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

$sqlEntradas = "SELECT SUM(valor) AS total_entradas FROM vendas";
$resultadoEntradas = mysqli_query($conexao, $sqlEntradas);
$dadosEntradas = mysqli_fetch_assoc($resultadoEntradas);

$entradas = $dadosEntradas['total_entradas'] ?? 0;

$sqlSaidas = "SELECT SUM(valor_unitario * quantidade) AS total_saidas FROM estoque";
$resultadoSaidas = mysqli_query($conexao, $sqlSaidas);
$dadosSaidas = mysqli_fetch_assoc($resultadoSaidas);

$saidas = $dadosSaidas['total_saidas'] ?? 0;

$valorCaixa = $entradas - $saidas;
$saldoFinal = $valorCaixa;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluxo de Caixa</title>

    <link rel="stylesheet" href="../styles.css">

    <link rel="icon" type="image/x-icon"
    href="/2026-1-isabelytrevisan/site_uniformes/img/logotp.png">
</head>

<body>

    <header>
        <button id="toggleMenu" class="menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <h1>Sistema de Uniformes</h1>
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

    <h2>Relatório de Fluxo de Caixa</h2>

    <table class="tabela">

        <tr>
            <th>Valor em caixa</th>
            <td>
                R$ <?php echo number_format($valorCaixa, 2, ',', '.'); ?>
            </td>
        </tr>

        <tr>
            <th>Entradas</th>
            <td>
                R$ <?php echo number_format($entradas, 2, ',', '.'); ?>
            </td>
        </tr>

        <tr>
            <th>Saídas</th>
            <td>
                R$ <?php echo number_format($saidas, 2, ',', '.'); ?>
            </td>
        </tr>

        <tr>
            <th>Saldo final</th>
            <td>
                R$ <?php echo number_format($saldoFinal, 2, ',', '.'); ?>
            </td>
        </tr>

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
                    <img src="../img/iconContato.png" alt="Ícone de contato">
                    <h3>Contato</h3>
                </div>

                <p>(49) 99999-9999</p>
                <p>contato@coresepadroes.com</p>
                <p>Chapecó - SC</p>
            </div>

            <div class="footer-coluna">
                <div class="footer-coluna-icon">
                    <img src="../img/iconRelogio.png" alt="Ícone de horário">
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