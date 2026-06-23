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
    
    <style>
        .cards-financeiros {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            margin-top: 20px;
        }
        .card-fin {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(5px);
        }
        .card-fin h3 {
            margin: 0 0 10px 0;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #ccc;
        }
        .card-fin p {
            margin: 0;
            font-size: 1.4rem;
            font-weight: bold;
        }
        .positivo { color: #4edf7e; }
        .negativo { color: #ff6b6b; }
        .neutro { color: #4da3ff; }
    </style>
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

            <h2>Relatório de Fluxo de Caixa</h2>

            <div class="cards-financeiros">
                <div class="card-fin">
                    <h3>Entradas</h3>
                    <p class="positivo">R$ <?php echo number_format($entradas, 2, ',', '.'); ?></p>
                </div>
                <div class="card-fin">
                    <h3>Saídas</h3>
                    <p class="negativo">R$ <?php echo number_format($saidas, 2, ',', '.'); ?></p>
                </div>
                <div class="card-fin">
                    <h3>Saldo Atual</h3>
                    <p class="<?php echo $saldoFinal >= 0 ? 'positivo' : 'negativo'; ?>">
                        R$ <?php echo number_format($saldoFinal, 2, ',', '.'); ?>
                    </p>
                </div>
            </div>

            <table class="tabela">
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: center;">Detalhamento dos Valores</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Valor em caixa</th>
                        <td>R$ <?php echo number_format($valorCaixa, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Entradas</th>
                        <td class="positivo">R$ <?php echo number_format($entradas, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Saídas</th>
                        <td class="negativo">R$ <?php echo number_format($saidas, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Saldo final</th>
                        <th class="<?php echo $saldoFinal >= 0 ? 'positivo' : 'negativo'; ?>">
                            R$ <?php echo number_format($saldoFinal, 2, ',', '.'); ?>
                        </th>
                    </tr>
                </tbody>
            </table>

        </main>

    </div>

    <footer class="footer-site">

        <div class="footer-container">

            <div class="footer-coluna">
                <h3>Cores & Padrões</h3>
                <p>Uniformes que vestem identidades, histórias e conexões.</p>
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
            Sistema desenvolvido por estudantes do Técnico em Desenvolvimento de Sistemas — isabely.ot@aluno.ifsc.edu.br
        </div>

    </footer>

    <script src="../ScriptIndex.js"></script>
</body>
</html>