<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>
    <section id="area-titulo">
        <h1>Cadastro de Animais</h1>
        <a href="index.php" class="botao">Voltar</a>
    </section>

    <section id="area-cadastro">
        <h1>Cadastrar Pet</h1>
        <form action="">

            <div class="input_file">
                <label for="file" id="label_img" class="form_label file_input">
                    <div class="drop_zone" id="drop_zone">
                        <input type="file" name="" id="file">
                        <img src="./images/photo.png" id="cover" alt="">
                    </div>
                </label>
            </div>

            <div class="input-control">
                <label>Nome</label>
                <input type="text" name="nome" required>

            </div>

            <div class="input-control">
                <label for="">Espécie</label>
                <select name="" id="">
                    <option value="">Cachorro</option>
                    <option value="">Gato</option>
                    <option value="">Colho</option>
                </select>
            </div>

            <button class="botao botao-cadastro" type="submit" name="salvar">Salvar</button>
        </form>
    </section class="area-cadastro">

    <script src="./js/script.js"></script>
</body>

</html>