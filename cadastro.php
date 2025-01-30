<?php
require_once('config.php');

$cadastroView = new CadastroView();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cadastrar Animal</title>
</head>

<body>
    <section id="area-titulo">
        <h1>Cadastro de Animais</h1>
        <a href="index.php" class="botao">Voltar</a>
    </section>

    <section id="area-cadastro">
        <h1>Cadastrar Pet</h1>
        <form action="cadastro.php" method="POST" enctype="multipart/form-data">

            <div class="input_file">
                <label for="file" id="label_img" class="form_label file_input">
                    <div class="drop_zone" id="drop_zone">
                        <input type="file" name="file" id="file">
                        <img src="./images/photo.png" id="cover" alt="">
                    </div>
                </label>
            </div>

            <div class="input-control">
                <label>Nome</label>
                <input type="text" name="nome" required>

            </div>

            <?php

            $cadastroView->gerarOpcoesEspecie();
            ?>

            <button class="botao botao-cadastro" type="submit" name="salvar">Salvar</button>

        </form>
        <?php


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
            if (isset($_POST['nome'], $_POST['especie'], $_FILES['file'])) {
                $cadastroView->CadastrarAnimal($_POST['nome'], $_POST['especie'], $_FILES['file']);
            }
        }
        ?>
    </section class="area-cadastro">

    <script src="./js/script.js"></script>
</body>

</html>