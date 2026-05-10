<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_acesso'] != 2) {
    http_response_code(404);
    
    // Se o 404.php estiver na mesma pasta que este arquivo:
    include(__DIR__ . "/404.html"); 
    
    exit();
}
?>