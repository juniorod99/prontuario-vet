<?php
class AtendimentoView
{
  function ExibirDadosAnimal($id)
  {
    $atendimentoController = new AtendimentoController();
    $nomeAnimal = $atendimentoController->ListarNomeAnimal($id);
    // var_dump($nomeAnimal);
    echo "
      <div class='item-form'>
        <label>Nome do animal:</label>
        <input type='text' disabled placeholder='{$nomeAnimal['nm_animal']}'>
      </div>";
  }

  function ListarTratamentos()
  {
    $atendimentoController = new AtendimentoController();
    $listaTratamentos = $atendimentoController->ListarTratamentos();
    // var_dump($listaTratamentos);
    echo "
      <div class='item-form'>
        <label>Tratamento:</label>
        <select name='tratamento' required>
          <option selected disabled>Selecione o Tratamento</option>
    ";

    for ($i = 0; $i < count($listaTratamentos); $i++) {
      echo "
        <option value='{$listaTratamentos[$i]['cd_tratamento']}' >{$listaTratamentos[$i]['nm_tratamento']}</option>
      ";
    }

    echo "
        </select>
      </div>
    ";
  }

  function AlterarDescricaoTratamento($descricao)
  {
    $atendimentoController = new AtendimentoController();
    $alterarDescricao = $atendimentoController->AlterarDescricaoTratamento($descricao);
  }

  function SalvarAtendimento($idAnimal, $idTratamento, $data, $descricao)
  {
    $atendimentoController = new AtendimentoController();
    $salvarAtendimento = $atendimentoController->SalvarAtendimento($idAnimal, $idTratamento, $data, $descricao);

    echo $salvarAtendimento;
    // echo $idAnimal;
    // echo '<br>';
    // echo $idTratamento;
    // echo '<br>';
    // echo $data;
    // echo '<br>';
    // echo $descricao;
  }
}
