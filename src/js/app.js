let paso = 1;
const inicial = 1;
const final = 3;


//OBJETO CITAS
const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}


document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
})

function iniciarApp() {
    menuMobile();
    mostrandoSeccion();
    tabs();
    botonespaginador();
    btnanterior();
    btnsiguiente();
    ConsultarApi();
    ObtenerIdCliente();
    ObtenerNombreCliente();
    ObtenerFecha();
    ObtenerHora();
    mostrarResumen();
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

function mostrandoSeccion() {
    //QUITA LA CLASE "mostrar"
    const ocuMostrar = document.querySelector('.mostrar');
    if (ocuMostrar) {
        ocuMostrar.classList.remove('mostrar')
    }

    //OCULTA Y AGREGA LA CLASE "mostrar" depende del ID
    const seccion = document.querySelector(`#paso-${paso}`)
    seccion.classList.add('mostrar');


    //MOSTRANDO Y REMOVIENDO LA CLASE "actual"
    const tabActual = document.querySelector('.actual');
    if (tabActual) {
        tabActual.classList.remove('actual')
    }

    //QUITA Y AGREGA LA CLASE DEL BTN "actual juntoa su css"
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {
    /** Tabs en cada click , cambia el paso y muestra la seccion y oculta el boton sy es priemro o ultimo */
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', (e) => {
            paso = parseInt(e.target.dataset.paso)
            mostrandoSeccion();
            botonespaginador()
        })
    })
}

function botonespaginador() {
    const anterior = document.querySelector('#anterior');
    const siguiente = document.querySelector('#siguiente');

    if (paso === 1) {
        anterior.classList.add('ocultar')
        siguiente.classList.remove('ocultar')
    } else if (paso === 3) {
        anterior.classList.remove('ocultar')
        siguiente.classList.add('ocultar')
        mostrarResumen();
    } else {
        anterior.classList.remove('ocultar')
        siguiente.classList.remove('ocultar')
    }
    mostrandoSeccion();

}

function btnanterior() {
    const anterior = document.querySelector('#anterior');

    anterior.addEventListener('click', function () {
        if (paso <= inicial) return;
        paso--;
        botonespaginador();
    })
}

function btnsiguiente() {
    const siguiente = document.querySelector('#siguiente');

    siguiente.addEventListener('click', function () {
        if (paso >= final) return;
        paso++;
        botonespaginador();
    })

}

async function ConsultarApi() {
    try {
        // const url = 'http://localhost:3000/api/servicios' //URL de la API  
        // const url = `${location.origin}/api/servicios` //URL de la API  
        const url = '/api/servicios' //URL de la API  
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        MostrandoServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function MostrandoServicios(servicios) {

    servicios.forEach((servicio) => {

        const { id, nombre, precio } = servicio

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = '$ ' + precio


        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio_div');
        servicioDiv.dataset.idServicio = id;

        servicioDiv.onclick = function () {
            seleccionarServicio(servicio)
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    })

}

function seleccionarServicio(servicio) {

    const { id } = servicio;
    const { servicios } = cita;
    const servicioDiv = document.querySelector(`[data-id-servicio="${id}"]`)


    if (servicios.some(agregado => agregado.id === id)) { //Si un ID es igual al id del arreglo
        cita.servicios = servicios.filter(agregado => agregado.id !== id) //Crea un nuevo array con los que no son igual al ID

        servicioDiv.classList.remove('seleccionado')    //Remueve la clase "seleccionado"
    } else {
        cita.servicios = [...servicios, servicio]; // uñamarron -> 12 | 
        servicioDiv.classList.add('seleccionado')    //Agrega la clase "seleccionado"
    }

}

function ObtenerIdCliente() {
    const id = document.querySelector('#id').value;
    cita.id = id;
}

function ObtenerNombreCliente() {
    const nombre = document.querySelector('#nombre').value;
    cita.nombre = nombre;
}

function ObtenerFecha() {
    const fecha = document.querySelector("#fecha");

    fecha.addEventListener("input", function (e) {

        const dia = new Date(e.target.value).getUTCDay(); //DEVUELVE EL NUMERO DE DIA DOM=O LUN=1
        if (dia === 0 || dia === 6) {
            e.target.value = "";
            MostrarAlerta("Fines de semana no se atiende", 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }
    })
}

function ObtenerHora() {
    const hora = document.querySelector('#hora');

    hora.addEventListener('input', function (e) {
        horaCita = e.target.value;
        horadiv = horaCita.split(":")[0];

        if (horadiv < 9 || horadiv > 19) {
            MostrarAlerta("Este Horario se encuentra cerrado", 'error', '.formulario');
            e.target.value = "";
        } else {
            cita.hora = e.target.value
        }
    })
}

function MostrarAlerta(mensaje, tipo, luar, tiempoactivo = true) {

    const alerta = document.querySelector('.alerta')

    if (alerta) {
        alerta.remove(); //Si hay una alerta elimna la anterior
    }
    // SCRIPTING PARA CREAR ALERTA
    const contidoalerta = document.createElement('DIV');
    contidoalerta.textContent = mensaje;
    contidoalerta.classList.add('alerta')
    contidoalerta.classList.add(tipo)

    const referencia = document.querySelector(luar);
    referencia.appendChild(contidoalerta);

    if (tiempoactivo) {
        // ELIMINAMOS DESPUES DE UNOS SEGUNDOS LA ALERTA 
        setTimeout(() => {
            contidoalerta.remove();
        }, 3000)
    }
}

function mostrarResumen() {
    const contenedorResumen = document.querySelector('.contenido-resumen');

    //LIMPIAR CONTENEDOR 
    while (contenedorResumen.firstChild) {
        contenedorResumen.removeChild(contenedorResumen.firstChild);
    }

    //Buscamos si falta un dato
    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        MostrarAlerta("Datos vacios - No procede..", 'error', '.contenido-resumen', false);
        return;
    } else if (Object.values(cita).includes('')) {
        MostrarAlerta("Fecha u Hora Incorrecto", 'error', '.contenido-resumen', false);
        return;
    } else if (cita.servicios.length === 0) {
        MostrarAlerta("No eligio su servicio", 'error', '.contenido-resumen', false);
        return;
    }

    const { nombre, fecha, hora, servicios } = cita;
    //HEADING PARA SERVICIO-RESUMEN
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = "Resumen de servicios";
    contenedorResumen.appendChild(headingServicios);

    servicios.forEach((servicio) => {

        const { id, nombre, precio } = servicio;

        //CREAMOS EL CONTENDOR PARA LA SECCION DE SERVICIOS
        const contenedorServicios = document.createElement('DIV');
        contenedorServicios.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio :</span> $ ${precio}`

        contenedorServicios.appendChild(textoServicio);
        contenedorServicios.appendChild(precioServicio);

        contenedorResumen.appendChild(contenedorServicios);

    });


    // CABECERA EL CONTENEDOR PARA LA SECCION DE CITA
    const headingCita = document.createElement('H3');
    headingCita.textContent = "Resumen de Cita";
    contenedorResumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.inner

    //FORMATEAR FECHA
    const objFecha = new Date(fecha); //Obetenemos el objeto date pasando la fecha de resgitrso como parametro
    const mes = objFecha.getMonth(); //Sumamos Uno para igual el mes y no salaga uno anterior

    //EN CADA new Date se resta un dia , si declaras 3 date suma mas 3
    const dia = objFecha.getDate() + 2; //Sumanos el 1 para iguaa y no devuelva un anterior
    const year = objFecha.getFullYear(); //devuelve el año 2024

    const fechaUTC = new Date(Date.UTC(year, mes, dia)); //Retorna la fecha en UTC codigo 

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const fechaFormateada = fechaUTC.toLocaleDateString("es-PE", opciones)


    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha Reserva: </span> ${fechaFormateada}`;


    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora : </span> ${hora}`;

    // BOTON PARA CITA
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.classList.add('btn_r');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita; //LLAMAMOS A LA FUNCION SI () SE LLAMARA EN CADA CLIK



    contenedorResumen.appendChild(nombreCliente);
    contenedorResumen.appendChild(fechaCita);
    contenedorResumen.appendChild(horaCita);
    contenedorResumen.appendChild(botonReservar);
}

async function reservarCita() {
    const { id, fecha, hora, servicios } = cita;

    const idServicio = servicios.map(servicio => servicio.id) //MAP DEVUELVE NUEVO ARRAY CON LOS RESULTADOS DE UNA FUNCION

    const datos = new FormData();
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioid', id);
    datos.append('servicios', idServicio);

    // console.log([...datos]) PARA DEVUGEAR LO QUE SE ENVIA A DATOS

    try {
        //Peticion post 
        // url = `${location.origin}/api/citas`
        url = '/api/citas' //Solo si en el mismo servidor va estar el dominio y archivos
        
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        })
        
        const resultados = await respuesta.json();
        
        if (resultados.resultado) {
            Swal.fire({
                icon: "success",
                title: "Cita Creada",
                text: "Tu cita fue registrada correctamente !",
                boton: 'Ok'
            }).then(() => {
                window.location.reload();
            });
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error de Creacion",
            text: "Algo sucedio en el registro!",
        })
    }
}

