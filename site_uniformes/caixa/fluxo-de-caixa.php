<?php
session_start();
include(__DIR__ . "/../verifica-login.php");
include(__DIR__ . "/../conexao.php");

/* ENTRADAS - VENDAS */
$sqlEntradas = "SELECT SUM(valor) AS total_entradas FROM vendas";
$resultadoEntradas = mysqli_query($conexao, $sqlEntradas);
$dadosEntradas = mysqli_fetch_assoc($resultadoEntradas);

$entradas = $dadosEntradas['total_entradas'] ?? 0;

/* SAÍDAS - ESTOQUE */
$sqlSaidas = "SELECT SUM(valor_unitario * quantidade) AS total_saidas FROM estoque";
$resultadoSaidas = mysqli_query($conexao, $sqlSaidas);
$dadosSaidas = mysqli_fetch_assoc($resultadoSaidas);

$saidas = $dadosSaidas['total_saidas'] ?? 0;

/* VALOR EM CAIXA E SALDO FINAL */
$valorCaixa = $entradas - $saidas;
$saldoFinal = $valorCaixa;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluxo de Caixa</title>

    <link rel="stylesheet" href="../styles.css">

    <link rel="icon" type="image/x-icon"
    href="/2026-1-isabelytrevisan/site_uniformes/img/logotp.png">
</head>

<body>

<header>
    <h1>Fluxo de Caixa</h1>
</header>

<main class="conteudo">

    <h2>Relatório de Fluxo de Caixa</h2>

    <table class="resumo">

        <tr>
            <th>Valor em caixa</th>
            <td>
                R$ <?php echo number_format($valorCaixa, 2, ',', '.'); ?>
            </td>
        </tr>

        <tr>
            <th>Entradas</th>
            <td>
                R$ <?php echo number_format($entradas, 2, ',', '.'); ?>
            </td>
        </tr>

        <tr>
            <th>Saídas</th>
            <td>
                R$ <?php echo number_format($saidas, 2, ',', '.'); ?>
            </td>
        </tr>

        <tr>
            <th>Saldo final</th>
            <td>
                R$ <?php echo number_format($saldoFinal, 2, ',', '.'); ?>
            </td>
        </tr>

    </table>

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