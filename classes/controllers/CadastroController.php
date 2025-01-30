<?php
class CadastroController
{
    function Gerar()
    {
        $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
        $usuario = 'root';
        $senha = 'root';
        $lista = [];

        try {
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cSQL = $pdo->prepare('SELECT cd_especie, nm_especie FROM especie');
            $cSQL->execute();

            while ($especies = $cSQL->fetch(PDO::FETCH_ASSOC)) {
                $codigoEspecie = $especies['cd_especie'];
                $nomeEspecie = $especies['nm_especie'];

                $especie = new Especie($codigoEspecie, $nomeEspecie);
                array_push($lista, $especie);
            }
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getMessage();
        }
        return $lista;
    }

    function CadastrarAnimal($nome, $idEspecie, $imagem)
    {
        $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
        $usuario = 'root';
        $senha = 'root';

        try {
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getMessage();
        }

        $diretorioDestino = 'images/';

        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0755, true);
            echo 'n existe';
        }

        $arquivoTmp = $imagem['tmp_name'];
        $nomeOriginal = $imagem['name'];
        $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
        $novoNome = md5(uniqid()) . '.' . $extensao;
        $caminhoCompleto = $diretorioDestino . $novoNome;

        if (move_uploaded_file($arquivoTmp, $caminhoCompleto)) {
            $stmt = $pdo->prepare('INSERT INTO animal (nm_animal, cd_especie, ft_animal) VALUES (:nome, :cd_especie, :imagem)');
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cd_especie', $idEspecie);
            $stmt->bindParam(':imagem', $novoNome);
            $stmt->execute();
            echo "Upload realizado com sucesso! O arquivo foi renomeado para: " . $novoNome;
        } else {
            echo "Erro ao mover o arquivo para o diretório de destino.";
        }
    }
}
