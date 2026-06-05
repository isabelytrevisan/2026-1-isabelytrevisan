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
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    mysqli_query($conexao, "
        UPDATE cliente 
        SET nome='$nome', email='$email', telefone='$telefone'
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
                    <?php if (isset($_SESSION['tipo_acesso']) && $_SESSION['tipo_acesso'] == 2): ?>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/criar-estoque.php">Cadastro de estoque</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/estoque/lista-estoque.php">Lista de estoque</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/criar-venda.php">Cadastro de vendas</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/vendas/lista-vendas.php">Lista de vendas</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/lista-clientes.php">Lista de clientes</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/criar-funcionarios.php">Cadastro de funcionários</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/funcionarios/lista-funcionarios.php">Lista de funcionários</a></li>
                        <li><a href="/2026-1-isabelytrevisan/site_uniformes/caixa/fluxo-de-caixa.php">Fluxo de caixa</a></li>
                        <?php endif; ?>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php">Cadastro de cliente</a></li>
                    <li><a href="/2026-1-isabelytrevisan/site_uniformes/logins/lista-logins.php">Lista de logins cadastrados</a></li>
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
                placeholder="CPF"
                class="campo-filtro">

            <input type="date"
                class="campo-filtro">

            <input type="text"
                placeholder="Email"
                class="campo-filtro">

            <select class="campo-filtro">
                <option>Tipo de Acesso</option>
                <option>2 - Funcionario</option>
                <option>1 - Cliente</option>
            </select>
            
            <input type="text"
                placeholder="Login"
                class="campo-filtro">

            <button class="btn-filtro">
                Buscar
            </button>

        </div>

        <h2>Lista de Clientes</h2>

        <div style="margin-bottom: 15px;">
            <a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php" class="botao-adicionar">+ Novo Cliente</a>
        </div>

        <?php if (isset($_GET['editar'])):
            $id = $_GET['editar'];
            $res = mysqli_query($conexao, "SELECT * FROM cliente WHERE idCliente = $id");
            $c = mysqli_fetch_assoc($res);
        ?>

        <div id="modalEditar" class="modal">
            <div class="modal-conteudo">
                <span class="fechar" onclick="fecharModal()">&times;</span>


                    <h3>Editar Cliente</h3>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $c['idCliente'] ?>">
                        <input name="nome" value="<?= $c['nome'] ?>">
                        <input name="cpf" value="<?= $c['cpf'] ?>">
                        <input name="data_nasc" value="<?= $c['data_nasc'] ?>">
                        <input name="endereco" value="<?= $c['endereco'] ?>">
                        <input name="email" value="<?= $c['email'] ?>">
                        <input name="telefone" value="<?= $c['telefone'] ?>">
                        <input name="login" value="<?= $c['login'] ?>">
                        <button name="salvar">Salvar</button>
                    </form>
                    <hr>
            </div>
        </div>

        <?php endif; ?>

        <script>
            function editarCliente(id, nome, email, telefone) {

                document.getElementById("id").value = id;
                document.getElementById("nome").value = nome;
                document.getElementById("cpf").value = cpf;
                document.getElementById("data_nasc").value = data_nasc;
                document.getElementById("endereco").value = endereco;
                document.getElementById("email").value = email;
                document.getElementById("telefone").value = telefone;
                document.getElementById("login").value = login;

                document.getElementById("modalEditar").style.display = "block";
            }

            function fecharModal() {
                document.getElementById("modalEditar").style.display = "none";
            }
        </script>

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
                            <a href='?editar={$item['idCliente']}'>Editar</a> |
                            <a href='?excluir={$item['idCliente']}' 
                            onclick=\"return confirm('Excluir cliente?')\">Excluir</a>
                        </td>
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
 <script src="../ScriptIndex.js"></script>
</body>
</html>