<?php
class AtendimentoController
{
  function ListarNomeAnimal($id)
  {
    $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
    $usuario = 'root';
    $senha = 'root';

    try {
      $pdo = new PDO($servidor, $usuario, $senha);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $cSQL = $pdo->prepare('SELECT nm_animal FROM animal WHERE cd_animal = :codigo');
      $cSQL->bindParam('codigo', $id);
      $cSQL->execute();

      $nomeAnimal = $cSQL->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Erro:' . $e->getMessage();
    }
    return $nomeAnimal;
  }

  function ListarTratamentos()
  {
    $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
    $usuario = 'root';
    $senha = 'root';

    try {
      $pdo = new PDO($servidor, $usuario, $senha);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $cSQL = $pdo->prepare('SELECT cd_tratamento, nm_tratamento, ds_tratamento FROM tratamento');
      $cSQL->execute();

      $tratamentos = $cSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Erro:' . $e->getMessage();
    }
    return $tratamentos;
  }

  function AlterarDescricaoTratamento() {}

  function SalvarAtendimento($idAnimal, $idTratamento, $data, $descricao)
  {
    $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
    $usuario = 'root';
    $senha = 'root';

    try {
      $pdo = new PDO($servidor, $usuario, $senha);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $cSQL = $pdo->prepare('INSERT INTO prontuario(cd_animal, cd_tratamento, dt_tratamento, ds_observacao) VALUES (:idAnimal, :idTratamento, :dataTratamento, :descricao)');
      $cSQL->bindParam(':idAnimal', $idAnimal);
      $cSQL->bindParam(':idTratamento', $idTratamento);
      $cSQL->bindParam(':dataTratamento', $data);
      $cSQL->bindParam(':descricao', $descricao);
      $cSQL->execute();

      $pdo = null;
      $resultado = '<p>Tratamento salvo com sucesso.</p>';
    } catch (PDOException $e) {
      echo 'Erro:' . $e->getMessage();
    }
    return $resultado;
  }

  function ExibirHistorico($idAnimal)
  {
    $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
    $usuario = 'root';
    $senha = 'root';
    $lista = [];

    try {
      $pdo = new PDO($servidor, $usuario, $senha);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $cSQL = $pdo->prepare('SELECT tratamento.nm_tratamento, 
                                    prontuario.dt_tratamento, 
                                    prontuario.ds_observacao
                             FROM
                                    prontuario
                             INNER JOIN
                                    tratamento
                             ON
                                    prontuario.cd_tratamento = tratamento.cd_tratamento
                             WHERE
                                    prontuario.cd_animal = :idAnimal');
      $cSQL->bindParam(':idAnimal', $idAnimal);
      $cSQL->execute();

      while ($dados = $cSQL->fetch(PDO::FETCH_ASSOC)) {
        $dataTratamento = $dados['dt_tratamento'];
        $nomeTratamento = $dados['nm_tratamento'];
        $observacao = $dados['ds_observacao'];

        $historico = new Historico($dataTratamento, $nomeTratamento, $observacao);
        array_push($lista, $historico);
      };
      // $pdo = null;
      // $resultado = $cSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Erro:' . $e->getMessage();
    }
    return $lista;
  }
}
