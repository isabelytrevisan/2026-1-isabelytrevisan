<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

$sql = "SELECT * FROM estoque";
$resultado = mysqli_query($conexao, $sql);

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    mysqli_query($conexao, "DELETE FROM estoque WHERE idEstoque = $id");
    header("Location: lista-estoque.php");
    exit();
}

if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nomeProduto'];
    $quantidade = $_POST['quantidade'];

    mysqli_query($conexao, "
        UPDATE Estoque
        SET 
            nomeProduto = '$nome',
            quantidade = '$quantidade'
        WHERE idEstoque = $id
    ");

    header("Location: lista-estoque.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Estoque</title>
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

        <div class="select-filtro">

            <input type="text"
                placeholder="Buscar produto..."
                class="campo-filtro">

            <input type="text"
                placeholder="Cliente..."
                class="campo-filtro">

            <input type="date"
                class="campo-filtro">

            <select class="campo-filtro">
                <option>Categoria</option>
                <option>Camiseta</option>
                <option>Moletom</option>
                <option>Esportivo</option>
            </select>

            <input type="number"
                placeholder="Quantidade mínima"
                class="campo-filtro">

            <button class="btn-filtro">
                Buscar
            </button>

        </div>

        <h2>Lista de Estoque</h2>

        <div style="margin-bottom: 15px;">
            <a href="/2026-1-isabelytrevisan/site_uniformes/estoque/criar-estoque.php" class="botao-adicionar">+ Novo Produto</a>
        </div>

        <table class="tabela">
            <tr>
                <th>Id</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unit.</th>
                <th>Data Última Compra</th>
                <th>Data Próxima Compra</th>
                <th>Ações</th>
            </tr>

            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($item = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$item['idEstoque']}</td>
                        <td>{$item['nomeProduto']}</td>
                        <td>{$item['quantidade']}</td>
                        <td>{$item['valor_unitario']}</td>
                        <td>{$item['data_compra']}</td>
                        <td>{$item['data_prox_compra']}</td>
                        <td>
                            <a href='?editar={$item['idEstoque']}'>Editar</a> |
                            <a href='?excluir={$item['idEstoque']}' 
                            onclick=\"return confirm('Excluir produto?')\">Excluir</a>
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