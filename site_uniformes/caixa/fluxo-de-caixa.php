<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

// Apenas administrativo
if (!isset($_SESSION['tipo_acesso']) || $_SESSION['tipo_acesso'] != 2) {
    echo "Acesso negado!";
    exit();
}

$valorCaixa = 1000;

// Entradas (vendas)
$sqlEntradas = "SELECT SUM(valor) AS totalEntradas FROM vendas";
$resEntradas = mysqli_query($conexao, $sqlEntradas);
$entradas = mysqli_fetch_assoc($resEntradas)['totalEntradas'];

if (!$entradas) {
    $entradas = 0;
}

// Saídas (estoque)
$sqlSaidas = "SELECT SUM(quantidade * valor_unitario) AS totalSaidas FROM estoque";
$resSaidas = mysqli_query($conexao, $sqlSaidas);
$saidas = mysqli_fetch_assoc($resSaidas)['totalSaidas'];

if (!$saidas) {
    $saidas = 0;
}

// Saldo final
$saldoFinal = $valorCaixa + $entradas - $saidas;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluxo de Caixa</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="../styles.css">

    <link rel="icon"
    type="image/x-icon"
    href="/2026-1-isabelytrevisan/site_uniformes/img/logotp.png">
</head>

<body>

<header>
    <h1>Fluxo de Caixa</h1>
</header>

<main class="conteudo">

    <h2>Relatório de Fluxo de Caixa</h2>

    <section class="resumo">

        <p>
            <strong>Valor em caixa:</strong>
            R$ <?= number_format($valorCaixa, 2, ',', '.') ?>
        </p>

        <p>
            <strong>Entradas:</strong>
            R$ <?= number_format($entradas, 2, ',', '.') ?>
        </p>

        <p>
            <strong>Saídas:</strong>
            R$ <?= number_format($saidas, 2, ',', '.') ?>
        </p>

        <p>
            <strong>Saldo final:</strong>
            R$ <?= number_format($saldoFinal, 2, ',', '.') ?>
        </p>

    </section>

</main>

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
                <img src="/site_uniformes/img/iconContato.png">
                <h3>Contato</h3>
            </div>

            <p>(49) 99999-9999</p>
            <p>contato@coresepadroes.com</p>
            <p>Chapecó - SC</p>
        </div>

        <div class="footer-coluna">
            <div class="footer-coluna-icon">
                <img src="/site_uniformes/img/iconRelogio.png">
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

</body>
</html>