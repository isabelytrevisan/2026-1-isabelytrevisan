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
<title>Lista de Vendas</title>
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

        <div class="select-filtro">
            <input type="text" id="filtro-cliente" placeholder="Cliente" class="campo-filtro">
            <input type="text" id="filtro-produto" placeholder="Produto" class="campo-filtro">
            <input type="date" id="filtro-data" class="campo-filtro">
            <input type="text" id="filtro-forma-pag" placeholder="Forma de Pagamento" class="campo-filtro">

            <button type="button" class="btn-filtro" onclick="filtrarTabela()">
                Buscar
            </button>

            <button type="button" class="btn-limpar" onclick="limparFiltros()">Limpar</button>
        </div>

        <h2>Lista de Vendas</h2>

        <div style="margin-bottom: 15px;">
            <a href="/2026-1-isabelytrevisan/site_uniformes/vendas/criar-venda.php" class="botao-adicionar">+ Nova Venda</a>
        </div>

        <?php if (isset($_GET['editar'])):
                $id = $_GET['editar'];
                $res = mysqli_query($conexao, "SELECT * FROM vendas WHERE idVendas = $id");
                $c = mysqli_fetch_assoc($res);
            ?>

        <style>
                .modal {
                    display: flex; /* Alterado para flex para alinhar corretamente */
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.6); 
                    z-index: 1000;
                    justify-content: center;
                    align-items: center;
                }

                .modal-conteudo {
                    background: #fff;
                    width: 500px;
                    max-width: 90%;
                    padding: 25px;
                    border-radius: 10px;
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
                    position: relative;
                }

                .modal-conteudo label {
                    display: block;
                    margin-top: 10px;
                    margin-bottom: 5px;
                    font-weight: bold;
                    color: #333;
                    text-align: left;
                }

                .modal-conteudo input {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 10px;
                    box-sizing: border-box;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                .fechar {
                    position: absolute;
                    top: 10px;
                    right: 15px;
                    font-size: 28px;
                    cursor: pointer;
                    color: #666;
                    text-decoration: none;
                }
                
                .fechar:hover {
                    color: #000;
                }
            </style>

        <div id="modalEditar" class="modal">
                <div class="modal-conteudo">

                    <a href="lista-vendas.php" class="fechar">&times;</a>

                    <h3>Editar Vendas</h3>

                    <form method="POST">

                        <input type="hidden" name="id" value="<?= $c['idVendas'] ?>">
                        <input type="hidden" name="Cliente_idCliente" value="<?= $c['Cliente_idCliente'] ?>">
                        <input type="hidden" name="idEstoque" value="<?= $c['idEstoque'] ?>">

                        <label>Data da Venda</label>
                        <input type="date" name="venda_data" value="<?= $c['venda_data'] ?>">

                        <label>Valor</label>
                        <input type="text" name="valor" value="<?= $c['valor'] ?>">

                        <label>Forma de Pagamento</label>
                        <input type="text" name="forma_pag" value="<?= $c['forma_pag'] ?>">

                        <label>Quantidade</label>
                        <input type="text" name="quantidade" value="<?= $c['quantidade'] ?>">

                        <label>Desconto (%)</label>
                        <input type="text" name="desconto" value="<?= $c['desconto'] ?>">

                        <button type="submit" name="salvar" style="margin-top: 15px; width: 100%; padding: 10px; cursor: pointer;">
                            Salvar Alterações
                        </button>

                    </form>

                </div>
            </div>
            <?php endif; ?>

        <table class="tabela" id="tabela-vendas">
            <thead>
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
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($resultado) > 0) {
                    while ($item = mysqli_fetch_assoc($resultado)) {
                        echo "<tr class='linha-venda'>
                            <td class='celula-idVendas'>{$item['idVendas']}</td>
                            <td class='celula-cliente'>{$item['Cliente_idCliente']}</td>
                            <td class='celula-produto'>{$item['idEstoque']}</td>
                            <td class='celula-data' data-data-original='{$item['venda_data']}'>" . (!empty($item              ['venda_data']) ? date('d/m/Y', strtotime($item['venda_data'])) : '') . "</td>
                            <td class='celula-valor'>{$item['valor']}</td>
                            <td class='celula-forma-pag'>{$item['forma_pag']}</td>
                            <td class='celula-quantidade'>{$item['quantidade']}</td>
                            <td class='celula-desconto'>{$item['desconto']}</td>
                            <td>
                                <a href='?editar={$item['idVendas']}' style='text-decoration: none; color: #0064c8; font-size: 18px;'>&#9998;</a>
                                <a href='?excluir={$item['idVendas']}' style='text-decoration: none; color: #ba0c00; font-size: 20px;' onclick=\"return confirm('Excluir venda?')\">&#128465;</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align:center;'>Nenhuma venda cadastrada</td></tr>";
                }
                ?>
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
     <script>
function filtrarTabela() {
    const filtroCliente = document.getElementById('filtro-cliente').value.toLowerCase().trim();
    const filtroProduto = document.getElementById('filtro-produto').value.toLowerCase().trim();
    const filtroData = document.getElementById('filtro-data').value.trim();
    const filtroFormaPag = document.getElementById('filtro-forma-pag').value.toLowerCase().trim();

    const linhas = document.querySelectorAll('#tabela-vendas tbody .linha-venda');

    linhas.forEach(linha => {
        const clienteTxt = linha.querySelector('.celula-cliente').textContent.toLowerCase();
        const produtoTxt = linha.querySelector('.celula-produto').textContent.toLowerCase();
        const dataTxt = linha.querySelector('.celula-data').getAttribute('data-data-original') || '';
        const formaPagTxt = linha.querySelector('.celula-forma-pag').textContent.toLowerCase();

        const bateuCliente = filtroCliente === '' || clienteTxt.includes(filtroCliente);
        const bateuProduto = filtroProduto === '' || produtoTxt.includes(filtroProduto);
        const bateuData = filtroData === '' || dataTxt.includes(filtroData);
        const bateuFormaPag = filtroFormaPag === '' || formaPagTxt.includes(filtroFormaPag);

        if (bateuCliente && bateuProduto && bateuData && bateuFormaPag) {
            linha.style.display = '';
            linha.style.backgroundColor = '#e2f0d9';
        } else {
            linha.style.display = 'none';
            linha.style.backgroundColor = '';
        }
    });
}

function limparFiltros() {
    document.getElementById('filtro-cliente').value = '';
    document.getElementById('filtro-produto').value = '';
    document.getElementById('filtro-data').value = '';
    document.getElementById('filtro-forma-pag').value = '';

    const linhas = document.querySelectorAll('#tabela-vendas tbody .linha-venda');
    linhas.forEach(linha => {
        linha.style.display = '';
        linha.style.backgroundColor = '';
    });
}
</script>
      <script src="../ScriptIndex.js"></script>
</body>
</html>