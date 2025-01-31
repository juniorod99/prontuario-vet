<?php
session_start();
require_once('config.php');

$gerenciarView = new GerenciarView();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Gerênciar Animais</title>
</head>

<body>
    <section id="area-titulo">
        <h1>Gerênciar Animais</h1>
        <a href="index.php" class="botao">Voltar</a>
    </section>

    <section id="lista_animais">
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="notificacao">
                <p><?= $_SESSION['mensagem'] ?></p>
                <i class="fa-solid fa-xmark fechar_notificacao"></i>
            </div>
        <?php
        endif;
        unset($_SESSION['mensagem']);
        ?>
        <table>
            <thead>
                <tr>
                    <td>Foto</td>
                    <td>Nome</td>
                    <td>Espécie</td>
                    <td>Comando</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $gerenciarView->ExibirTabelaAnimais();
                ?>
            </tbody>
        </table>
    </section>

    <script src="./js/fecharNotificacao.js"></script>
</body>

</html>