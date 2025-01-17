function atualizarDescricao() {
  const select = document.getElementById('tratamento');
  const descricao =
    select.options[select.selectedIndex].getAttribute('descricao');
  document.getElementById('descricao').value = descricao;
}
