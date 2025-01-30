<?php
class Animal
{
  public $Codigo;
  public $Nome;
  public $Especie;
  public $Foto;

  function __construct($codigo = null, $nome = null, Especie $especie = null, $foto = null)
  {
    $this->Codigo =  $codigo;
    $this->Nome = $nome;
    $this->Foto = $foto;
    if ($especie != null)
      $this->Especie = $especie;
    else
      $this->Especie = new Especie();
  }

  public function setNome($nome)
  {
    $this->Nome = $nome;
  }
}
