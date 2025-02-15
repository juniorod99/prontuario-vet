<?php
require_once('config.php');

if (isset($_GET['id'])) {
  $idAnimal = $_GET['id'];
}
$atendimentoView = new AtendimentoView();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clínica Veterinária</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <section id="area-titulo">
    <h1>Atendimento</h1>
    <a href="index.php" class="botao">Voltar</a>
  </section>

  <section id="area-tratamento">
    <h1>Registro de atendimento</h1>
    <form action="atendimento.php?id=<?= $idAnimal ?>" method="POST">

      <?php
      $atendimentoView->ExibirDadosAnimal($idAnimal);
      ?>

      <div class="item-form">
        <label>Data:</label>
        <input type="datetime-local" name="data" value="2024-08-04" required>
      </div>

      <?php
      $atendimentoView->ListarTratamentos();
      ?>

      <div class="item-form-bloco">
        <label>Descrição do Tratamento:</label>
        <textarea id="descricao" rows="2" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere ducimus saepe eum ea id, ex, deleniti non repellendus impedit provident laborum perferendis excepturi voluptate voluptatum magnam dolor rerum, laudantium velit?</textarea>
      </div>

      <div class="item-form-bloco">
        <label>Descrição do Atendimento:</label>
        <textarea id="mensagem" name="descricao" rows="6"></textarea>
      </div>

      <button class="botao" type="submit" name="salvar">Salvar</button>
    </form>

    <?php
    if (isset($_POST['salvar'])) {
      if (isset($_POST['tratamento'], $_POST['data'])) {
        $atendimentoView->SalvarAtendimento($idAnimal, $_POST['tratamento'], $_POST['data'], $_POST['descricao']);
      } else {
        echo '<p>Selecione o Tratamento!</p>';
      }
    }
    ?>
  </section>

  <section id="area-historico">
    <h1>Histórico</h1>
    <?php
    $atendimentoView->ExibirHistorico($idAnimal);
    ?>
  </section>
  <script defer src="js/script.js"></script>
</body>

</html>
