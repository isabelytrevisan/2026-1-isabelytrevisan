<?php
session_start();
$_SESSION = array();
session_destroy();
echo `
    <script>
        alert('Logout realizado com sucesso!');
    </script>
`;
header("Location: index.php");
exit();
?>