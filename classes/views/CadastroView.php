<?php
class CadastroView
{
    function gerarOpcoesEspecie()
    {
        $cadastroController = new CadastroController();
        $gerarOptions = $cadastroController->Gerar();

        echo "
        <div class='input-control'>
            <label for=''>Espécie</label>
            <select name='especie' id='' required>
        ";

        for ($i = 0; $i < count($gerarOptions); $i++) {
            echo "
                <option value='{$gerarOptions[$i]->Codigo}'>{$gerarOptions[$i]->Nome}</option>
            ";
        }

        echo "
            </select>
        </div>
        ";
    }

    function CadastrarAnimal($nome, $idEspecie, $imagem)
    {
        $cadastroController = new CadastroController();
        $cadastrarAnimal = $cadastroController->CadastrarAnimal($nome, $idEspecie, $imagem);
    }
}
