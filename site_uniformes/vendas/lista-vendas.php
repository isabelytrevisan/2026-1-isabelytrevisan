<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

$sql = "SELECT * FROM vendas";
$resultado = mysqli_query($conexao, $sql);

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    mysqli_query($conexao, "DELETE FROM vendas WHERE idVendas = $id");
    header("Location: lista-vendas.php");
    exit();
}

if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $cliente = $_POST['Cliente_idCliente'];
    $produto = $_POST['idEstoque'];
    $data = $_POST['venda_data'];
    $valor = $_POST['valor'];
    $forma = $_POST['forma_pag'];
    $quantidade = $_POST['quantidade'];
    $desconto = $_POST['desconto'];

    mysqli_query($conexao, "
        UPDATE Vendas 
        SET 
            Cliente_idCliente = '$cliente',
            idEstoque = '$produto',
            venda_data = '$data',
            valor = '$valor',
            forma_pag = '$forma',
            quantidade = '$quantidade',
            desconto = '$desconto'
        WHERE idVendas = $id
    ");

    header("Location: lista-vendas.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title></title>
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
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/index.php">Login</a></li>
                    
            </ul>
        </nav>
    </aside>

    <main class="conteudo">

        <h2>Lista de Vendas</h2>

        <div style="margin-bottom: 15px;">
            <a href="/2026-1-isabelytrevisan/site_uniformes/vendas/criar-venda.php" class="botao-adicionar">+ Nova Venda</a>
        </div>

        <table class="tabela">
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Id. Produto</th>    
                <th>Data</th>
                <th>Valor</th>
                <th>Forma Pag.</th>
                <th>Quantidade</th>
                <th>Desconto (%)</th>
                <th>Ações</th>
            </tr>

            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($item = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$item['idVendas']}</td>
                        <td>{$item['Cliente_idCliente']}</td>
                        <td>{$item['idEstoque']}</td>
                        <td>{$item['venda_data']}</td>
                        <td>{$item['valor']}</td>
                        <td>{$item['forma_pag']}</td>
                        <td>{$item['quantidade']}</td>
                        <td>{$item['desconto']}</td>
                        <td>
                            <a href='?editar={$item['idVendas']}'>Editar</a> |
                            <a href='?excluir={$item['idVendas']}' 
                            onclick=\"return confirm('Excluir venda?')\">Excluir</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum produto cadastrado</td></tr>";
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
                <img src="/site_uniformes/img/iconContato.png">
                <h3>Contato</h3>
                </div>
                <p>(49) 99999-9999</p>
                <p>contato@coresepadroes.com</p>
                <p>Chapecó - SC</p>
            </div>

            <div class="footer-coluna">
                <div class="footer-coluna-icon">
                <img src="/site_uniformes/img/iconRelogio.png">
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