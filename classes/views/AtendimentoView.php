<?php
class AtendimentoView
{
  function ExibirDadosAnimal($id)
  {
    $atendimentoController = new AtendimentoController();
    $nomeAnimal = $atendimentoController->ListarNomeAnimal($id);
    // print_r($nomeAnimal);
    echo "
      <div class='item-form'>
        <label>Nome do animal:</label>
        <input type='text' disabled placeholder='{$nomeAnimal->Nome}'>
      </div>";
  }

  function ListarTratamentos()
  {
    $atendimentoController = new AtendimentoController();
    $listaTratamentos = $atendimentoController->ListarTratamentos();
    echo "
      <div class='item-form'>
        <label>Tratamento:</label>
        <select name='tratamento' id='tratamento' onchange='atualizarDescricao()' required>
          <option selected disabled>Selecione o Tratamento</option>
    ";

    for ($i = 0; $i < count($listaTratamentos); $i++) {
      echo "
        <option value='{$listaTratamentos[$i]->Codigo}' descricao='{$listaTratamentos[$i]->Descricao}' >{$listaTratamentos[$i]->Nome}</option>
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
    header('Location: atendimento.php?id=' . $idAnimal);
  }

  function ExibirHistorico($idAnimal)
  {
    $atendimentoController = new AtendimentoController();
    $exibirHistorico = $atendimentoController->ExibirHistorico($idAnimal);

    if (count($exibirHistorico) > 0) {

      echo '
        <table>
          <thead>
            <th>Data</th>
            <th>Tratamento</th>
            <th>Descrição do Tratamento</th>
          </thead>
          <tbody>
      ';
      for ($i = 0; $i < count($exibirHistorico); $i++) {
        $dataObjeto = new DateTime($exibirHistorico[$i]->Data);
        $dataFormatada = $dataObjeto->format('d/m/Y \á\s H:i');

        echo "
          <tr>
            <td class='data'>{$dataFormatada}</td>
            <td>{$exibirHistorico[$i]->Tratamento}</td>
            <td>{$exibirHistorico[$i]->Descricao}</td>
          </tr>
        ";
      }

      echo '
          </tbody>
        </table>
      ';
    } else {
      echo '<p>Este animal não possui histórico de tratamento.</p>';
    }
  }
}
