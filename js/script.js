function atualizarDescricao() {
  const select = document.getElementById('tratamento');
  const descricao =
    select.options[select.selectedIndex].getAttribute('descricao');
  document.getElementById('descricao').value = descricao;
}

//File input
const label = document.querySelector('#label_img');

function onEnter() {
  label.classList.add('active');
}

function onLeave() {
  label.classList.remove('active');
}

label.addEventListener('dragenter', onEnter);
label.addEventListener('drop', onLeave);
label.addEventListener('dragend', onLeave);
label.addEventListener('dragleave', onLeave);

const input = document.querySelector('#file');
const dropzone = document.querySelector('#drop_zone');

input.addEventListener('change', (event) => {
  if (input.isDefaultNamespace.length > 0) {
    const type = input.files[0].type;
    const formats = ['image/jpg', 'image/png', 'image/jpeg'];
    if (!formats.includes(type)) {
      alert('Esse formato não é permitido!');
      return;
    }

    if (document.querySelector('#cover')) {
      dropzone.removeChild(document.querySelector('#cover'));
    }
    const img = document.createElement('img');
    img.id = 'cover';
    img.src = URL.createObjectURL(input.files[0]);

    dropzone.appendChild(img);
  }
});
