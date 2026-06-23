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
    $nomeProduto = $_POST['nomeProduto'];
    $quantidade = $_POST['quantidade'];
    $valor_unitario = $_POST['valor_unitario'];
    $data_compra = $_POST['data_compra'];
    $data_prox_compra = $_POST['data_prox_compra'];

    mysqli_query($conexao, "
        UPDATE Estoque
        SET 
            nomeProduto = '$nomeProduto',
            quantidade = '$quantidade',
            valor_unitario = '$valor_unitario',
            data_compra = '$data_compra',
            data_prox_compra = '$data_prox_compra'
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
                <input type="text" id="filtro-nomeProduto" placeholder="Nome Do Produto" class="campo-filtro">

                <input type="text" id="filtro-valor_unitario" placeholder="Valor" class="campo-filtro">

                <button type="button" class="btn-filtro" onclick="filtrarTabela()">
                    Buscar
                </button>
                
                <button type="button" class="btn-limpar" onclick="limparFiltros()">Limpar</button>
            </div>


        <h2>Lista de Estoque</h2>

        <div style="margin-bottom: 15px;">
            <a href="/2026-1-isabelytrevisan/site_uniformes/estoque/criar-estoque.php" class="botao-adicionar">+ Novo Produto</a>
        </div>

        <?php if (isset($_GET['editar'])):
                $id = $_GET['editar'];
                $res = mysqli_query($conexao, "SELECT * FROM estoque WHERE idEstoque = $id");
                $c = mysqli_fetch_assoc($res);
        ?>

        <style>
                .modal {
                    display: block; /* Força o modal a aparecer */
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.6); /* Fundo escuro semi-transparente */
                    z-index: 1000;
                    display: flex;
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

                    <a href="lista-estoque.php" class="fechar">&times;</a>

                    <h3>Editar Estoque</h3>

                    <form method="POST">

                        <input type="hidden" name="id" value="<?= $c['idEstoque'] ?>">

                        <label>Nome</label>
                        <input type="text" name="nomeProduto" value="<?= $c['nomeProduto'] ?>">

                        <label>Quantidade</label>
                        <input type="number" name="quantidade" value="<?= $c['quantidade'] ?>">

                        <label>Valor Unitário</label>
                        <input type="number" name="valor_unitario" value="<?= $c['valor_unitario'] ?>">

                        <label>Data Compra</label>
                        <input type="date" name="data_compra" value="<?= $c['data_compra'] ?>">

                        <label>Data Próxima Compra</label>
                        <input type="date" name="data_prox_compra" value="<?= $c['data_prox_compra'] ?>">

                        <button type="submit" name="salvar" style="margin-top: 15px; width: 100%; padding: 10px; cursor: pointer;">
                            Salvar Alterações
                        </button>

                    </form>

                </div>
            </div>
            <?php endif; ?>

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
                            <a href='?editar={$item['idEstoque']}' style='text-decoration: none; color: #0064c8; font-size: 18px;'>&#9998;</a>
                            <a href='?excluir={$item['idEstoque']}' style='text-decoration: none; color: #ba0c00; font-size: 20px;' onclick=\"return confirm('Excluir produto?')\">&#128465;</a>
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
     <script>
        function filtrarTabela() {
            const filtroNomeProduto = document.getElementById('filtro-nomeProduto').value.toLowerCase().trim();
            const filtroValor = document.getElementById('filtro-valor_unitario').value.replace(/\D/g, ''); 

            // Mapeia as linhas de dentro da sua tabela
            const linhas = document.querySelectorAll('#tabela-clientes tbody .linha-usuario');

            linhas.forEach(linha => {
                const nomeTxt = linha.querySelector('.celula-nomeProduto').textContent.toLowerCase();
                const cpfTxt = linha.querySelector('.celula-valor').textContent.replace(/\D/g, ''); 
               

                const bateuNome = filtroNomeProduto === '' || nomeTxt.includes(filtroNomeProduto);
                const bateuCpf = filtroValor === '' || cpfTxt.includes(filtroValor);

                if (bateuNomeProduto && bateuValor) {
                    linha.style.display = ''; 
                    linha.style.backgroundColor = '#e2f0d9'; // Destaca levemente a linha encontrada
                } else {
                    linha.style.display = 'none'; 
                }
            });
        }

        function limparFiltros() {
            // Limpa os campos do formulário
            document.getElementById('filtro-nomeProduto').value = '';
            document.getElementById('filtro-valor_unitario').value = '';

            // Torna todas as linhas visíveis novamente e remove a cor de fundo de destaque
            const linhas = document.querySelectorAll('#tabela-clientes tbody .linha-usuario');
            linhas.forEach(linha => {
                linha.style.display = '';
                linha.style.backgroundColor = '';
            });
        }
    </script>
      <script src="../ScriptIndex.js"></script>
</body>
</html>