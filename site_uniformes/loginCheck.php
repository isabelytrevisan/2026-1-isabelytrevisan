<?php
session_start();
require_once __DIR__ . "/conexao.php";

$login = $_POST["login"];

// procura o login no banco
$sql = "SELECT * FROM cliente WHERE login = '$login'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {

    $usuario = mysqli_fetch_assoc($resultado);

    // cria exatamente o que seu verificador precisa
    $_SESSION['idCliente'] = $usuario['idCliente'];
    $_SESSION['tipo_acesso'] = $usuario['tipo_acesso'];

    header("Location: pagina-inicial.html");
    exit();

} else {
    echo "<script>
            alert('Login não encontrado! Crie uma conta.');
            window.location.href='criar-cliente.php';
          </script>";
}