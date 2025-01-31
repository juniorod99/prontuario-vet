<?php
class GerenciarView
{
    function ExibirTabelaAnimais()
    {
        $gerenciarController = new GerenciarController();
        $exibirTabelaAnimais = $gerenciarController->Listar();

        for ($i = 0; $i < count($exibirTabelaAnimais); $i++) {
            echo "
                <tr>
                    <td><img class='foto_animal' src='images/{$exibirTabelaAnimais[$i]->Foto}' alt=''></td>
                    <td>{$exibirTabelaAnimais[$i]->Nome}</td>
                    <td>{$exibirTabelaAnimais[$i]->Especie->Nome}</td>
                    <td class='opcoes'>
                        <a href='editar.php?id={$exibirTabelaAnimais[$i]->Codigo}'><i class='fa-solid fa-pen-to-square'></i></a>
                        <a href=''><i class='fa-solid fa-trash'></i></a>
                    </td>
                </tr>
            ";
        }
    }
}
