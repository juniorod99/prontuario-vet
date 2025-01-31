<?php
require_once('config.php');

$buscar = true;
$valor = "";
if (isset($_GET['valorBusca'])) {
  // $buscar = true;
  if ($_GET['valorBusca'] != "") {
    $valor = $_GET['valorBusca'];
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prontuário Veterinário</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <div id="logo">
      <img src="./images/petcare.png" alt="">
    </div>

    <form action="index.php" method="get" id="area-busca">
      <input type="text" name="valorBusca" placeholder="Informe o nome do animal" name="" id="">
      <button class="btn">Buscar</button>
    </form>

    <div id="cadastro">
      <a class="botao" href="cadastro.php">Cadastrar pet</a>
      <a class="botao" href="gerenciar.php">Gerênciar</a>
    </div>
  </header>

  <section id="resultados">

    <?php
    if ($buscar) {
      $animalView = new AnimalView();
      if ($valor == "") {
        $animalView->ExibirTodosAnimais();
      } else {
        $animalView->BuscarPeloNome($valor);
      }
    }
    ?>
  </section>

  <?php
  $teste = new Animal();
  ?>
</body>

</html>