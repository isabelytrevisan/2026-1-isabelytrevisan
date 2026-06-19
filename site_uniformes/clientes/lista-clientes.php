<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

$sql = "SELECT * FROM cliente";
$resultado = mysqli_query($conexao, $sql);

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    mysqli_query($conexao, "DELETE FROM cliente WHERE idCliente = $id");
    header("Location: lista-clientes.php");
    exit();
}

if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $login = $_POST['login'];

    mysqli_query($conexao, "
        UPDATE cliente
        SET
            nome='$nome',
            cpf='$cpf',
            data_nasc='$data_nasc',
            endereco='$endereco',
            email='$email',
            telefone='$telefone',
            login='$login'
        WHERE idCliente = $id
    ");

    header("Location: lista-clientes.php");
    exit();
}
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

            <form action="" method="GET" class="select-filtro">

                <input type="text" name="nome" placeholder="Nome..." class="campo-filtro" 
                    value="<?php echo isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : ''; ?>">

                <input type="text" name="cpf" placeholder="CPF" class="campo-filtro" 
                    value="<?php echo isset($_GET['cpf']) ? htmlspecialchars($_GET['cpf']) : ''; ?>">

                <select name="tipo_acesso" class="campo-filtro">
                    <option value="">Tipo de Acesso</option>
                    <option value="2" <?php echo (isset($_GET['tipo_acesso']) && $_GET['tipo_acesso'] == '2') ? 'selected' : ''; ?>>2 - Funcionario</option>
                    <option value="1" <?php echo (isset($_GET['tipo_acesso']) && $_GET['tipo_acesso'] == '1') ? 'selected' : ''; ?>>1 - Cliente</option>
                </select>

                <input type="text" name="login" placeholder="Login" class="campo-filtro" 
                    value="<?php echo isset($_GET['login']) ? htmlspecialchars($_GET['login']) : ''; ?>">

                <button type="submit" class="btn-filtro">
                    Buscar
                </button>
                
                <a href="?" class="btn-limpar" style="text-decoration: none; padding: 5px; background: #eee; border: 1px solid #ccc; margin-left: 5px; color: #333; font-size: 13px;">Limpar</a>

            </form>

            <?php

                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $banco = "uniformes";

                try {
                    $pdo = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Erro: " . $e->getMessage());
                }

                $sql = "SELECT * FROM cliente WHERE 1=1";
                $params = []; 

                if (!empty($_GET['nome'])) {
                    $sql .= " AND nome LIKE :nome";
                    $params[':nome'] = "%" . trim($_GET['nome']) . "%";
                }

                if (!empty($_GET['cpf'])) {
                    $sql .= " AND cpf = :cpf";
                    $params[':cpf'] = trim($_GET['cpf']);
                }

                if (!empty($_GET['tipo_acesso'])) {
                    $sql .= " AND tipo_acesso = :tipo_acesso";
                    $params[':tipo_acesso'] = $_GET['tipo_acesso'];
                }

                if (!empty($_GET['login'])) {
                    $sql .= " AND login LIKE :login";
                    $params[':login'] = "%" . trim($_GET['login']) . "%";
                }

                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($resultados) > 0) {
                    foreach ($resultados as $cliente) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($cliente['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['cpf']) . "</td>";
                        echo "<td>" . ($cliente['tipo_acesso'] == 2 ? 'Funcionário' : 'Cliente') . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['login']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p style='margin-top:20px;'>Nenhum usuário encontrado com os filtros aplicados.</p>";
                }
            ?>

            <h2>Lista de Clientes</h2>

            <div style="margin-bottom: 15px;">
                <a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php" class="botao-adicionar">+
                    Novo Cliente</a>
            </div>

            <?php if (isset($_GET['editar'])):
                $id = $_GET['editar'];
                $res = mysqli_query($conexao, "SELECT * FROM cliente WHERE idCliente = $id");
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

                    <a href="lista-clientes.php" class="fechar">&times;</a>

                    <h3>Editar Cliente</h3>

                    <form method="POST">

                        <input type="hidden" name="id" value="<?= $c['idCliente'] ?>">

                        <label>Nome</label>
                        <input type="text" name="nome" value="<?= $c['nome'] ?>">

                        <label>CPF</label>
                        <input type="text" name="cpf" value="<?= $c['cpf'] ?>">

                        <label>Data de Nascimento</label>
                        <input type="date" name="data_nasc" value="<?= $c['data_nasc'] ?>">

                        <label>Endereço</label>
                        <input type="text" name="endereco" value="<?= $c['endereco'] ?>">

                        <label>Email</label>
                        <input type="email" name="email" value="<?= $c['email'] ?>">

                        <label>Telefone</label>
                        <input type="text" name="telefone" value="<?= $c['telefone'] ?>">

                        <label>Login</label>
                        <input type="text" name="login" value="<?= $c['login'] ?>">

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
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Endereço</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Tipo de acesso</th>
                    <th>Login</th>
                    <th>Ações</th>
                </tr>

                <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($item = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$item['idCliente']}</td>
                        <td>{$item['nome']}</td>
                        <td>{$item['cpf']}</td>
                        <td>{$item['data_nasc']}</td>
                        <td>{$item['endereco']}</td>
                        <td>{$item['email']}</td>
                        <td>{$item['telefone']}</td>
                        <td>{$item['tipo_acesso']}</td>
                        <td>{$item['login']}</td>
                        <td>
                            <a href='?editar={$item['idCliente']}' style='text-decoration: none; color: #0064c8; font-size: 18px;'>&#9998;</a>
                            <a href='?excluir={$item['idCliente']}' style='text-decoration: none; color: #ba0c00; font-size: 20px;' onclick=\"return confirm('Excluir cliente?')\">&#128465;</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Nenhum cliente cadastrado</td></tr>";
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