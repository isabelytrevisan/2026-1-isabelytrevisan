<?php
include(__DIR__ . "/conexao.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Site uniformes</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" type="image/x-icon" href="/2026-1-isabelytrevisan/site_uniformes/img/logotp.png">
</head>

<body>

    <header>
        <button id="toggleMenu" class="menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <img src="img\logotp.png" class="header-logo" alt="Logo Cores & Padrões">
        <h1>Cores & Padrões</h1>
        <div class="user-info">
            <?php if (isset($_SESSION['nome'])): ?>
                <span class="user-name"><?php echo $_SESSION['nome']; ?></span>
                <a href="logoutCheck.php" class="logout-link">Sair</a>
            <?php endif; ?>
        </div>
    </header>
    
    <div class="main">
        <aside class="menu-aside">
            <nav>
                <ul>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.php">Início</a></li>
                    <!-- esconde caso nao adm -->
                    <?php if (isset($_SESSION['tipo_acesso']) && $_SESSION['tipo_acesso'] == 2): ?>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/criar-estoque.php">Cadastro de estoque</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/lista-estoque.php">Lista de estoque</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/criar-venda.php">Cadastro de vendas</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/lista-vendas.php">Lista de vendas</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/lista-clientes.php">Lista de clientes</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/criar-funcionarios.php">Cadastro de funcionários</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/lista-funcionarios.php">Lista de funcionários</a></li>
                    <?php endif; ?>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php">Cadastro de cliente</a></li>
                     <li><a href="/2026-1-isabelytrevisan/site_uniformes/logins/lista-logins.php">Lista de logins cadastrados</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/index.php">Login</a></li>
                </ul>
            </nav>
        </aside>
    
        <main class="conteudo">
            <h2 id="subtitulo">Bem-vindo ao sistema de uniformes</h2>
    
            <div class="carrossel">

                <div class="slides fade">
                    <img src="img/primeiraFotoCarrossel.png" alt="">
                </div>

                <div class="slides fade">
                    <img src="img/segundaFotoCarrossel.png" alt="">
                </div>

                <div class="slides fade">
                    <img src="img/terceiraFotoCarrossel.png" alt="">
                </div>

                <button class="anterior" onclick="mudarSlide(-1)">❮</button>
                <button class="proximo" onclick="mudarSlide(1)">❯</button>

            </div>
        </main>
    </div>



    <section class="secao-moda">

        <h2>Conheça algumas categorias confeccionadas pela loja:</h2>

        <div class="cards-categorias">

            <div class="card-categoria">
                <img src="img/MoletomLilas.png">
                <div class="card-info">
                    <h3>Moletom</h3>
                    <p>Conforto e identidade para sua equipe.</p>
                </div>
            </div>

            <div class="card-categoria">
                <img src="img/CamisetaCasual.png">
                <div class="card-info">
                    <h3>Moda Casual</h3>
                    <p>Peças versáteis e personalizadas.</p>
                </div>
            </div>

            <div class="card-categoria">
                <img src="img/CalcaPretaMoletom.png">
                <div class="card-info">
                    <h3>Esportivo</h3>
                    <p>Uniformes leves e modernos.</p>
                </div>
            </div>

        </div>   

    </section>
        
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
                <img src="img/iconContato.png">
                <h3>Contato</h3>
                </div>
                <p>(49) 99999-9999</p>
                <p>contato@coresepadroes.com</p>
                <p>Chapecó - SC</p>
            </div>

            <div class="footer-coluna">
                <div class="footer-coluna-icon">
                <img src="img/iconRelogio.png">
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
 <script src="ScriptIndex.js"></script>
</body>
</html>
