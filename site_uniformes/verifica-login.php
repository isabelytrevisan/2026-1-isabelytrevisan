<!-- VERIFICACAO DE PERMISSAO -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idCliente']) || $_SESSION['tipo_acesso'] != 2) {
    http_response_code(404);
    include(__DIR__ . "/404.html"); 
    exit();
}
?>