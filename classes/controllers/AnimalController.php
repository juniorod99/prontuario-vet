<?php
class AnimalController
{
  function Listar()
  {
    $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
    $usuario = 'root';
    $senha = 'root';
    $lista = [];

    try {
      $pdo = new PDO($servidor, $usuario, $senha);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $cSQL = $pdo->prepare('SELECT cd_animal, nm_animal, cd_especie, ft_animal FROM animal');
      $cSQL->execute();

      while ($dados = $cSQL->fetch(PDO::FETCH_ASSOC)) {
        $codigo = $dados['cd_animal'];
        $nome = $dados['nm_animal'];
        $codigoEspecie = $dados['cd_especie'];
        $foto = $dados['ft_animal'];

        $cSQL_Especie = $pdo->prepare('SELECT nm_especie FROM especie WHERE cd_especie = :codigo');
        $cSQL_Especie->bindParam('codigo', $codigoEspecie);
        $cSQL_Especie->execute();

        $dadosEspecie = $cSQL_Especie->fetch(PDO::FETCH_ASSOC);
        $nomeEspecie = $dadosEspecie['nm_especie'];

        $especie = new Especie($codigoEspecie, $nomeEspecie);

        $animal = new Animal($codigo, $nome, $especie, $foto);
        array_push($lista, $animal);
      };
      $pdo = null;
    } catch (PDOException $e) {
      echo 'Erro:' . $e->getMessage();
    }
    return $lista;
  }

  function BuscarPeloNome($nome)
  {
    $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
    $usuario = 'root';
    $senha = 'root';
    $lista = [];

    try {
      $pdo = new PDO($servidor, $usuario, $senha);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $termo = "%{$nome}%";
      $cSQL = $pdo->prepare('SELECT cd_animal, nm_animal, cd_especie, ft_animal FROM animal WHERE nm_animal LIKE :termo');
      $cSQL->bindParam('termo', $termo);
      $cSQL->execute();

      while ($dados = $cSQL->fetch(PDO::FETCH_ASSOC)) {
        $codigo = $dados['cd_animal'];
        $nome = $dados['nm_animal'];
        $codigoEspecie = $dados['cd_especie'];
        $foto = $dados['ft_animal'];

        $cSQL_Especie = $pdo->prepare('SELECT nm_especie FROM especie WHERE cd_especie = :codigo');
        $cSQL_Especie->bindParam('codigo', $codigoEspecie);
        $cSQL_Especie->execute();

        $dadosEspecie = $cSQL_Especie->fetch(PDO::FETCH_ASSOC);
        $nomeEspecie = $dadosEspecie['nm_especie'];

        $especie = new Especie($codigoEspecie, $nomeEspecie);

        $animal = new Animal($codigo, $nome, $especie, $foto);
        array_push($lista, $animal);
      };
      $pdo = null;
    } catch (PDOException $e) {
      echo 'Erro:' . $e->getMessage();
    }
    return $lista;
  }
}
