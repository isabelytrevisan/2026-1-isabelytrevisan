<?php
session_start(); // inicia a sessão
$_SESSION = array(); //lista vazia(login é feito com 
                    // uma lista de informações) 
session_destroy(); //limpa a lista para novo login 
echo `
    <script>
        alert('Logout realizado com sucesso!');
    </script>
`;
header("Location: index.php");
exit();
?>