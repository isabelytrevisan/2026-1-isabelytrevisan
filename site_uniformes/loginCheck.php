<!-- VERIFICACAO DE LOGIN -->

<?php
session_start();
require_once __DIR__ . "/conexao.php"; //conexão com o bd

$login = $_POST["login"];//cria variavel login

// procura o login no banco
$sql = "SELECT * FROM cliente WHERE login = '$login'";
$resultado = mysqli_query($conexao, $sql);

//faz a busca e joga o resultado para o teste
if (mysqli_num_rows($resultado) > 0) {

    $usuario = mysqli_fetch_assoc($resultado);

    // cria exatamente o que seu verificador precisa
    $_SESSION['idCliente'] = $usuario['idCliente'];
    $_SESSION['tipo_acesso'] = $usuario['tipo_acesso'];

    header("Location: pagina-inicial.php");
    exit();

} else {
    echo "<script>
            alert('Login não encontrado! Crie uma conta.');
            window.location.href='criar-cliente.php';
          </script>";
}