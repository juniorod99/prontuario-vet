<?php
require_once('config.php');

if (isset($_GET['id'])) {
    $idAnimal = $_GET['id'];
}

$editarView = new EditarView();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Editar Cadastro de Animais</title>
</head>

<body>
    <section id="area-titulo">
        <h1>Editar Cadastro de Animais</h1>
        <a href="gerenciar.php" class="botao">Voltar</a>
    </section>

    <section id="area-cadastro">
        <h1>Editar Pet</h1>
        <?php
        echo "<form action='editar.php?id={$idAnimal}' method='POST' enctype='multipart/form-data'>";
        ?>

        <?php
        $dados = $editarView->ExibirDadosAnimal($idAnimal);
        ?>
        <button class="botao botao-cadastro" type="submit" name="salvar">Salvar</button>

        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
            if ($dados->Nome != $_POST['nome'] || $dados->Especie->Codigo != $_POST['especie']) {
                if ($_FILES['file']['tmp_name']) {
                    $editarView->AlterarDados($idAnimal, $_POST['nome'], $_POST['especie'], $_FILES['file']);
                    exit();
                } else {
                    $editarView->AlterarNomeEspecie($idAnimal, $_POST['nome'], $_POST['especie']);
                }
            }

            if ($_FILES['file']['tmp_name']) {
                $editarView->AlterarFoto($idAnimal, $_FILES['file']);
            }
        }
        ?>
    </section class="area-cadastro">

    <script src="./js/script.js"></script>
</body>

</html>