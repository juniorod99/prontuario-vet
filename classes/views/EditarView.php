<?php
class EditarView
{
    function ExibirDadosAnimal($id)
    {
        $editarController = new EditarController();
        $dadosAnimal = $editarController->ListarDadosAnimal($id);
        $listarEspecies = $editarController->PegarEspecies();

        echo "
            <div class='input_file'>
                <label for='file' id='label_img' class='form_label file_input'>
                    <div class='drop_zone' id='drop_zone'>
                        <input type='file' name='file' id='file'>
                        <img src='./images/{$dadosAnimal->Foto}' id='cover' alt=''>
                    </div>
                </label>
            </div>

            <div class='input-control'>
                <label>Nome</label>
                <input type='text' name='nome' required value='{$dadosAnimal->Nome}'>
            </div>

            <div class='input-control'>
                <label for=''>Espécie</label>
                <select name='especie' id='' required>
                    <option selected value='{$dadosAnimal->Especie->Codigo}'>{$dadosAnimal->Especie->Nome}</option>

        ";

        for ($i = 0; $i < count($listarEspecies); $i++) {
            if ($listarEspecies[$i]->Codigo != $dadosAnimal->Especie->Codigo) {
                echo "
                    <option value='{$listarEspecies[$i]->Codigo}'>{$listarEspecies[$i]->Nome}</option>
                ";
            };
        }

        echo "
                </select>
            </div>
        ";

        return $dadosAnimal;
    }

    function AlterarDados($id, $nome, $idEspecie, $imagem)
    {
        $editarController = new EditarController();
        $editarCadastro = $editarController->AlterarDados($id, $nome, $idEspecie, $imagem);
    }

    function AlterarNomeEspecie($id, $nome, $especie)
    {
        $editarController = new EditarController();
        $editarCadastro = $editarController->AlterarNomeEspecie($id, $nome, $especie);
    }

    function AlterarFoto($id, $imagem)
    {
        $editarController = new EditarController();
        $editarCadastro = $editarController->AlterarFoto($id, $imagem);
    }
}
