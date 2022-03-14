let btn_close = document.querySelector("#btn_close");
let btn_open = document.querySelector("#btn_open");
let menu = document.querySelector(".menu");

btn_close.onclick = function() {
    menu.classList.toggle("active");
}
btn_open.onclick = function() {
    menu.classList.toggle("active");
}