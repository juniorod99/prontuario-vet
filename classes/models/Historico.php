<?php
class Historico
{
  public $Data;
  public $Tratamento;
  public $Descricao;

  function __construct($data = null, $tratamento = null, $descricao = null)
  {
    $this->Data = $data;
    $this->Tratamento = $tratamento;
    $this->Descricao = $descricao;
  }
}
