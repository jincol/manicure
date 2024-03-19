document.addEventListener('DOMContentLoaded',function(){
    iniciarApp();
})

function iniciarApp(){
    menuMobile();
    seleecionarFecha();
}

function menuMobile() {
    const menu = document.querySelector('.menu');
    const nav = document.querySelector('.navegacion');
    const body = document.querySelector('body');

    menu.addEventListener('click', function (e) {
        nav.classList.toggle('mostrar');
        body.classList.toggle('ow');

        if (window.innerWidth > 480) {
            console.log('es mayor')
        }
    })
}

function seleecionarFecha(){
    const fechaInput = document.querySelector('#fecha');

    fechaInput.addEventListener('change', function (e) {
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    })
}