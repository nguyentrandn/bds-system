const open = document.getElementById('open');
const modal_container = document.getElementById('modal_container');

const closeimg = document.getElementById('closeimg');

open.addEventListener('click', () => {
    modal_container.classList.add('show');

});

closeimg.addEventListener('click', () => {
    modal_container.classList.remove('show');

});