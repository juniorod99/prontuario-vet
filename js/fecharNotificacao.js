//Fechar notificacao
const notificacao = document.querySelector('.notificacao');
const btnFechar = document.querySelector('.fechar_notificacao');
if (notificacao) {
  btnFechar.addEventListener('mousedown', (event) => {
    event.preventDefault;
    notificacao.style.display = 'none';
  });
}
