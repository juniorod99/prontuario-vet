<?php
class EditarController
{
    function ListarDadosAnimal($id)
    {
        $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
        $usuario = 'root';
        $senha = 'root';

        try {
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cSQL = $pdo->prepare('SELECT cd_animal, nm_animal, cd_especie, ft_animal FROM animal WHERE cd_animal = :codigo');
            $cSQL->bindParam('codigo', $id);
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
            }
            $pdo = null;
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getMessage();
        }
        return $animal;
    }

    function PegarEspecies()
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

            while ($dados = $cSQL->fetch(PDO::FETCH_ASSOC)) {
                $codigo = $dados['cd_especie'];
                $nome = $dados['nm_especie'];

                $especie = new Especie($codigo, $nome);
                array_push($lista, $especie);
            };
            $pdo = null;
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getMessage();
        }
        return $lista;
    }

    function AlterarDados($id, $nome, $idEspecie, $imagem)
    {
        session_start();
        $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
        $usuario = 'root';
        $senha = 'root';

        try {
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getMessage();
        }
        $stmt = $pdo->prepare('SELECT ft_animal FROM animal WHERE cd_animal = :codigo');
        $stmt->bindParam(':codigo', $id);
        $stmt->execute();

        $antigaFoto = $stmt->fetch(PDO::FETCH_ASSOC);
        $diretorio = 'images/';
        $caminhoCompleto = $diretorio . $antigaFoto['ft_animal'];
        echo $caminhoCompleto . '<br>';
        echo (realpath($diretorio));
        var_dump(file_exists($caminhoCompleto));

        if (file_exists($caminhoCompleto)) {
            if (is_writable($caminhoCompleto)) {
                if (unlink($caminhoCompleto)) {
                    $arquivoTmp = $imagem['tmp_name'];
                    $nomeOriginal = $imagem['name'];
                    $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
                    $novoNome = md5(uniqid()) . '.' . $extensao;
                    $caminhoCompleto = $diretorio . $novoNome;

                    if (move_uploaded_file($arquivoTmp, $caminhoCompleto)) {
                        $stmt2 = $pdo->prepare('UPDATE animal SET nm_animal = :nome, cd_especie = :especie, ft_animal = :foto WHERE cd_animal = :id');
                        $stmt2->bindParam(':nome', $nome);
                        $stmt2->bindParam(':especie', $idEspecie);
                        $stmt2->bindParam(':foto', $novoNome);
                        $stmt2->bindParam(':id', $id);
                        $stmt2->execute();
                    }
                }
            }
        }

        if ($stmt2->rowCount() > 0) {
            $_SESSION['mensagem'] = "Cadastro atualizado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Nenhum registro foi atualizado.";
        }
        header('Location: gerenciar.php');
        exit();
    }

    function AlterarNomeEspecie($id, $nome, $especie)
    {
        session_start();
        $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
        $usuario = 'root';
        $senha = 'root';

        try {
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('UPDATE animal SET nm_animal = :nome, cd_especie = :especie WHERE cd_animal = :codigo');
            $stmt->bindParam(':codigo', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':especie', $especie);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['mensagem'] = "Dados atualizados com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Nenhum registro foi atualizado.";
            }
            header('Location: gerenciar.php');
            exit();
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getMessage();
        }
    }

    function AlterarFoto($id, $imagem)
    {
        session_start();
        $servidor = 'mysql:host=localhost;dbname=prontuario_vet';
        $usuario = 'root';
        $senha = 'root';

        try {
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('SELECT ft_animal FROM animal WHERE cd_animal = :codigo');
            $stmt->bindParam(':codigo', $id);
            $stmt->execute();

            $antigaFoto = $stmt->fetch(PDO::FETCH_ASSOC);
            $diretorio = 'images/';
            $caminhoCompleto = $diretorio . $antigaFoto['ft_animal'];

            if (file_exists($caminhoCompleto)) {
                if (is_writable($caminhoCompleto)) {
                    if (unlink($caminhoCompleto)) {
                        $arquivoTmp = $imagem['tmp_name'];
                        $nomeOriginal = $imagem['name'];
                        $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
                        $novoNome = md5(uniqid()) . '.' . $extensao;
                        $caminhoCompleto = $diretorio . $novoNome;

                        if (move_uploaded_file($arquivoTmp, $caminhoCompleto)) {
                            $stmt2 = $pdo->prepare('UPDATE animal SET ft_animal = :foto WHERE cd_animal = :id');
                            $stmt2->bindParam(':foto', $novoNome);
                            $stmt2->bindParam(':id', $id);
                            $stmt2->execute();
                        }
                    }
                }
            }

            if ($stmt2->rowCount() > 0) {
                $_SESSION['mensagem'] = "Foto alterada com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Nenhum registro foi atualizado.";
            }
            header('Location: gerenciar.php');
            exit();
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getMessage();
        }
    }
}
