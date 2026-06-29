<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

// Busca todos os funcionários
$sql = "SELECT * FROM funcionario";
$resultado = mysqli_query($conexao, $sql);

// Lógica de Exclusão
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    mysqli_query($conexao, "DELETE FROM funcionario WHERE idFuncionario = $id");
    header("Location: lista-funcionarios.php");
    exit();
}

if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $carga = $_POST['carga_horaria'];
    $cpf = $_POST['cpf'];
    $data = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];


    mysqli_query($conexao, "
        UPDATE Funcionario
        SET
            nome = '$nome',
            carga_horaria = '$carga',
            cpf = '$cpf',
            data_nasc = '$data',
            endereco = '$endereco',
            email = '$email',
            telefone = '$telefone'
        WHERE idFuncionario = $id

    ");

    header("Location: lista-funcionarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Funcionários</title>
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

                    <details class="menu-grupo" open>
                        <summary>Funcionários</summary>
                        <ul>
                            <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/criar-funcionarios.php">Cadastro de Funcionários</a></li>
                            <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/lista-funcionarios.php">Lista de Funcionários</a></li>
                        </ul>
                    </details>

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
                <input type="text" id="filtro-nome" placeholder="Nome..." class="campo-filtro">
                <input type="text" id="filtro-cpf" placeholder="CPF" class="campo-filtro">

                <button type="button" class="btn-filtro" onclick="filtrarTabela()">Buscar</button>
                <button type="button" class="btn-limpar" onclick="limparFiltros()">Limpar</button>
            </div>

            <h2>Lista de Funcionários</h2>

            <div style="margin-bottom: 15px;">
                <a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/criar-funcionarios.php" class="botao-adicionar">+ Novo Funcionário</a>
            </div>

            <?php if (isset($_GET['editar'])):
                $id = $_GET['editar'];
                $res = mysqli_query($conexao, "SELECT * FROM funcionario WHERE idFuncionario = $id");
                $f = mysqli_fetch_assoc($res);
            ?>

            <style>
                .modal {
                    display: block;
                    position: fixed;
                    top: 0; left: 0;
                    width: 100%; height: 100%;
                    background: rgba(0, 0, 0, 0.6);
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
                    top: 10px; right: 15px;
                    font-size: 28px;
                    cursor: pointer;
                    color: #666;
                    text-decoration: none;
                }
                .fechar:hover { color: #000; }
            </style>

            <div id="modalEditar" class="modal">
                <div class="modal-conteudo">
                    <a href="lista-funcionarios.php" class="fechar">&times;</a>
                    <h3>Editar Funcionário</h3>

                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $f['idFuncionario'] ?>">

                        <label>Nome</label>
                        <input type="text" name="nome" value="<?= $f['nome'] ?>">
                        
                        <label>Carga Horária</label>
                        <input type="text" name="carga_horaria" value="<?= $f['carga_horaria'] ?>">

                        <label>CPF</label>
                        <input type="text" name="cpf" value="<?= $f['cpf'] ?>">

                        <label>Data de Nascimento</label>
                        <input type="date" name="data_nasc" value="<?= $f['data_nasc'] ?>">

                        <label>Endereço</label>
                        <input type="text" name="endereco" value="<?= $f['endereco'] ?>">

                        <label>Email</label>
                        <input type="email" name="email" value="<?= $f['email'] ?>">

                        <label>Telefone</label>
                        <input type="text" name="telefone" value="<?= $f['telefone'] ?>">

                        <button type="submit" name="salvar" style="margin-top: 15px; width: 100%; padding: 10px; cursor: pointer;">
                            Salvar Alterações
                        </button>
                    </form>
                </div>
            </div>
            <?php endif; ?>

            <table class="tabela" id="tabela-funcionarios">
                <thead>
                    <tr>
                       <th>Id</th>
                        <th>Nome</th>
                        <th>Carga Horária</th>
                        <th>CPF</th>
                        <th>Data de Nasc.</th>
                        <th>Endereço</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($resultado) > 0) {
                    while ($item = mysqli_fetch_assoc($resultado)) {
                        echo "<tr class='linha-usuario'>
                            <td>{$item['idFuncionario']}</td>
                            <td class='celula-nome'>{$item['nome']}</td>
                            <td>{$item['carga_horaria']}</td>
                            <td class='celula-cpf'>{$item['cpf']}</td>
                            <td class='celula-data-nasc' data-data-original='{$item['data_nasc']}'>" . (!empty($item['data_nasc']) ? implode('/', array_reverse(explode('-', $item['data_nasc']))) : '') . "</td>
                            <td>{$item['endereco']}</td>
                            <td>{$item['email']}</td>
                            <td>{$item['telefone']}</td>
                            <td>
                                <a href='?editar={$item['idFuncionario']}' style='text-decoration: none; color: #0064c8; font-size: 18px;'>&#9998;</a>
                                <a href='?excluir={$item['idFuncionario']}' style='text-decoration: none; color: #ba0c00; font-size: 20px;' onclick=\"return confirm('Excluir funcionário?')\">&#128465;</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum funcionário cadastrado</td></tr>";
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
                    <img src="../img/iconContato.png">
                    <h3>Contato</h3>
                </div>
                <p>(49) 99999-9999</p>
                <p>contato@coresepadroes.com</p>
                <p>Chapecó - SC</p>
            </div>
            <div class="footer-coluna">
                <div class="footer-coluna-icon">
                    <img src="../img/iconRelogio.png">
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

    <script>
        function filtrarTabela() {
            const filtroNome = document.getElementById('filtro-nome').value.toLowerCase().trim();
            const filtroCpf = document.getElementById('filtro-cpf').value.replace(/\D/g, ''); 

            const linhas = document.querySelectorAll('#tabela-funcionarios tbody .linha-usuario');

            linhas.forEach(linha => {
                const nomeTxt = linha.querySelector('.celula-nome').textContent.toLowerCase();
                const cpfTxt = linha.querySelector('.celula-cpf').textContent.replace(/\D/g, ''); 

                const bateuNome = filtroNome === '' || nomeTxt.includes(filtroNome);
                const bateuCpf = filtroCpf === '' || cpfTxt.includes(filtroCpf);

                if (bateuNome && bateuCpf) {
                    linha.style.display = ''; 
                    linha.style.backgroundColor = '#e2f0d9'; 
                } else {
                    linha.style.display = 'none'; 
                }
            });
        }

        function limparFiltros() {
            document.getElementById('filtro-nome').value = '';
            document.getElementById('filtro-cpf').value = '';

            const linhas = document.querySelectorAll('#tabela-funcionarios tbody .linha-usuario');
            linhas.forEach(linha => {
                linha.style.display = '';
                linha.style.backgroundColor = '';
            });
        }
    </script>
    <script src="../ScriptIndex.js"></script>
</body>
</html>