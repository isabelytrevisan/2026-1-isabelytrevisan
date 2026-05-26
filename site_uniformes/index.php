<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Uniformes</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" type="image/x-icon" href="/2026-1-isabelytrevisan/site_uniformes/img/logotp.png">
    </head>

    <body class="bodylogin">
        <header>
            <img src="/site_uniformes/img/logotp.png" class="header-logo" alt="Logo Cores & Padrões">
            <h1>Cores & Padrões</h1>
        </header>
        
    <div class="login-box">

    <div class="login-left">
        <h2>Login</h2>
        <p>Digite seu usuário para entrar no sistema<br><br>
        CORES & PADRÕES</p>
    </div>

    <div class="login-right">

        <form action="loginCheck.php" method="POST">
            <input type="text" name="login" placeholder="Digite seu login" required>
            <input type="password" name="senha" placeholder="Digite sua senha" required>
            <button type="submit">Entrar</button>
        </form>

        <p class="rodape-login">
            Não possui conta? 
            <a href="/2026-1-isabelytrevisan/site_uniformes/clientes/criar-cliente.php">Cadastre-se aqui</a>
        </p>

        <a class="btn-voltar" href="/2026-1-isabelytrevisan/site_uniformes/pagina-inicial.php">Voltar</a>

    </div>  
    
    </body>
</html>