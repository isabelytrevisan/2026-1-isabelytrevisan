<!-- VERIFICACAO DE LOGIN -->

<?php
session_start();
require_once __DIR__ . "/conexao.php"; //conexão com o bd


/* RECEBE DADOS DO FORM */

$login = $_POST["login"];
$senha = $_POST["senha"];

/* PROCURA LOGIN E SENHA */

$sql = "SELECT * FROM cliente
        WHERE login = '$login'
        AND senha = '$senha'";

$resultado = mysqli_query($conexao, $sql);

/* VERIFICA SE ENCONTROU */

if(mysqli_num_rows($resultado) > 0){

    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION['idCliente'] = $usuario['idCliente'];
    $_SESSION['tipo_acesso'] = $usuario['tipo_acesso'];
    $_SESSION['nome'] = $usuario['nome'];
//$_SESSION comando para fazerlogin com dados e info
// que serão usadas enquanto o cliente estiver logado

    header("Location: pagina-inicial.php");
    exit();

}else{

    echo "<script>
            alert('Login ou senha incorretos!');
            window.location.href='index.php';
          </script>";
}
?>