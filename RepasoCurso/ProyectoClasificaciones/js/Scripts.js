
// TODO Quedaría pendiente poner un timer para actualizar lo local si actualizan el servidor. Una solución óptima sería poner timestamp de modificación en la tabla y pedir ligaObtenerModificadasDesde(timestamp), donde timestamp es la última vez que he pedido algo.



window.onload = inicializar;



// ---------- VARIABLES GLOBALES ----------

var divLigasDatos;
var divEquiposDatos;
var inputLigaNombre;
var inputEquipoNombre;
var inputEquipoPuntos;
var inputEquipoLigaId;



// ---------- VARIOS DE BASE/UTILIDADES ----------

function notificarUsuario(texto) {
    // TODO En lugar del alert, habría que añadir una línea en una zona de notificaciones, arriba, con un temporizador para que se borre solo en ¿5? segundos.
    alert(texto);
}

function llamadaAjax(url, parametros, manejadorOK, manejadorError) {
    //TODO PARA DEPURACIÓN: alert("Haciendo ajax a " + url + "\nCon parámetros " + parametros);

    var request = new XMLHttpRequest();

    request.open("POST", url);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (request.status == 200) {
                manejadorOK(request.responseText);
            } else {
                if (manejadorError != null) manejadorError(request.responseText);
            }
        }
    };

    request.send(parametros);
}

function extraerId(texto) {
    return texto.split('-')[1];
}

function objetoAParametrosParaRequest(objeto) {
    // Esto convierte un objeto JS en un listado de clave1=valor1&clave2=valor2&clave3=valor3
    return new URLSearchParams(objeto).toString();
}

function debug() {
    // Esto es útil durante el desarrollo para programar el disparado de acciones concretas mediante un simple botón.
}



// ---------- MANEJADORES DE EVENTOS / COMUNICACIÓN CON PHP ----------

// TODO Estaría genial que estos métodos no metieran la mano para nada en el DOM, sino que lo hicieran todo a través de métodos domTalCosa:
// Por ejemplo: disablearCamposequipoCrear(), enablearCamposequipoCrear(), obtenerObjetoequipoDeCamposequipoCrear()...

function inicializar() {
    divLigasDatos = document.getElementById("ligasDatos");
    divEquiposDatos = document.getElementById("equiposDatos");

    inputLigaNombre = document.getElementById("ligaNombre");
    inputEquipoNombre = document.getElementById("equipoNombre");
    inputEquipoPuntos = document.getElementById("equipoPuntos");
    inputEquipoligaId = document.getElementsByName("equipoLigaId");


/*
    document.getElementById('btnLigaCrear').addEventListener('click', clickLigaCrear);
    document.getElementById('btnEquipoCrear').addEventListener('click', clickEquipoCrear);
*/


    // En los "Insertar" de a continuación no se fuerza la ordenación, ya que PHP
    // nos habrá dado los elementos en orden correcto y sería una pérdida de tiempo.

    llamadaAjax("ligaObtenerTodas.php", "",
        function(texto) {
            var ligas = JSON.parse(texto);

            for (var i=0; i<ligas.length; i++) {
                domLigaInsertar(ligas[i]);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar ligas al inicializar: " + texto);
        }
    );

    llamadaAjax("equipoObtenerTodas.php", "",
        function(texto) {
            var equipos = JSON.parse(texto);

            for (var i=0; i<equipos.length; i++) {
                domEquipoInsertar(equipos[i]);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar equipos al inicializar: " + texto);
        }
    );
}
/*
function clickLigaCrear() {
    inputLigaNombre.disabled = true;

    llamadaAjax("ligaCrear.php", "nombre=" + inputLigaNombre.value,
        function(texto) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var liga = JSON.parse(texto);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            domligaInsertar(liga, true);

            inputLigaNombre.value = "";
            inputLigaNombre.disabled = false;
        },
        function(texto) {
            notificarUsuario("Error Ajax al crear: " + texto);
            inputLigaNombre.disabled = false;
        }
    );
}

function clickEquipoCrear() {
    inputEquipoNombre.disabled = true;
    inputEquipoPuntos.disabled = true;
    inputEquipoligaId.disabled = true;

    let equipo = {
        "id" : -1,
        "nombre" : inputEquipoNombre.value,
        "puntos" : inputEquipoPuntos.value,
        "ligaId" : inputEquipoligaId.value,
    }

    llamadaAjax("equipoCrear.php", objetoAParametrosParaRequest(equipo),
        function(texto) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var equipo = JSON.parse(texto);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            domEquipoInsertar(equipo, true);

            inputEquipoNombre.value = "";
            inputEquipoNombre.disabled = false;
            inputEquipoPuntos.value = "";
            inputEquipoPuntos.disabled = false;
            inputEquipoLigaId.value = "";
            inputEquipoLigaId.disabled = false;
        },
        function(texto) {
            notificarUsuario("Error Ajax al crear: " + texto);
            inputEquipoNombre.disabled = false;
            inputEquipoPuntos.disabled = false;
            inputEquipoligaId.disabled = false;
        }
    );
}

function blurLigaModificar(input) {
    let divLiga = input.parentElement.parentElement;
    let liga = domLigaDivAObjeto(divLiga);

    llamadaAjax("ligaActualizar.php", objetoAParametrosParaRequest(liga),
        function(texto) {
            if (texto != "null") {
                // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
                liga = JSON.parse(texto);
                domLigaModificar(liga);
            } else {
                notificarUsuario("Error Ajax al modificar: " + texto);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al modificar: " + texto);
        }
    );
}

// TODO Si escribo false en el input para "quitar" la estrella, no se quita (se queda en true). Pasa algo. Depurar.
function blurEquipoModificar(input) {
    let divEquipo = input.parentElement.parentElement;
    let equipo = domEquipoDivAObjeto(divEquipo);

    llamadaAjax("equipoActualizar.php", objetoAParametrosParaRequest(equipo),
        function(texto) {
            if (texto != "null") {
                // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
                equipo = JSON.parse(texto);
                domEquipoModificar(equipo);
            } else {
                notificarUsuario("Error Ajax al modificar: " + texto);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al modificar: " + texto);
        }
    );
}

function clickLigaEliminar(id) {
    llamadaAjax("ligaEliminar.php", "id="+id,
        function(texto) {
            var operacionOK = JSON.parse(texto);
            if (operacionOK) {
                domLigaEliminar(id);
            } else {
                notificarUsuario("Error Ajax al eliminar: " + texto);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al eliminar: " + texto);
        }
    );
}

function clickEquipoEliminar(id) {
    llamadaAjax("equipoEliminar.php", "id="+id,
        function(texto) {
            var operacionOK = JSON.parse(texto);
            if (operacionOK) {
                domEquipoEliminar(id);
            } else {
                notificarUsuario("Error Ajax al eliminar: " + texto);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al eliminar: " + texto);
        }
    );
}
*/


// ---------- GESTIÓN DEL DOM ----------

function domCrearDivInputText(textoValue, codigoOnblur) {
    let div = document.createElement("div");
        let input = document.createElement("input");
                input.setAttribute("type", "text");
                input.setAttribute("value", textoValue);
                input.setAttribute("onblur", codigoOnblur + " return false;");
    div.appendChild(input);

    return div;
}

function domCrearDivImg(urlSrc, codigoOnclick) {
    let div = document.createElement("div");
        let img = document.createElement("img");
                img.setAttribute("src", urlSrc);
                img.setAttribute("onclick", codigoOnclick + " return false;");
    div.appendChild(img);

    return div;
}



function domLigaObjetoADiv(liga) {
    let div = document.createElement("div");
            div.setAttribute("id", "liga-" + liga.id);
    div.appendChild(domCrearDivInputText(liga.nombre, "blurLigaModificar(this);"));
    div.appendChild(domCrearDivImg("img/Eliminar.png", "clickligaEliminar(" + liga.id + ");"));

    return div;
}

function domLigaObtenerDiv(pos) {
    return divLigasDatos.children[pos];
}

function domLigaDivAObjeto(div) {
    return { // Devolvemos un objeto recién creado con los datos que hemos obtenido.
        "id": extraerId(div.id),
        "nombre": div.children[0].children[0].value,
    };
}

function domLigaObtenerObjeto(pos) {
    let divliga = domLigaObtenerDiv(pos);
    return domLigaDivAObjeto(divliga);
}

function domLigaEjecutarInsercion(pos, liga) {
    let divReferencia = domLigaObtenerDiv(pos);
    let divNuevo = domLigaObjetoADiv(liga);

    divLigasDatos.insertBefore(divNuevo, divReferencia);
}

function domLigaInsertar(ligaNueva, enOrden=false) {
    // Si piden insertar en orden, se buscará su lugar. Si no, irá al final.
    if (enOrden) {
        for (let pos=0; pos < divLigasDatos.children.length; pos++) {
            let ligaActual = domligaObtenerObjeto(pos);

            if (ligaNueva.nombre.localeCompare(ligaActual.nombre) == -1) {
                // Si la liga nueva va ANTES que la actual, este es el punto en el que insertarla.
                domLigaEjecutarInsercion(pos, ligaNueva);
                return;
            }
        }
    }

    // Si llegamos hasta aquí, insertamos al final.
    domLigaEjecutarInsercion(divLigasDatos.children.length, ligaNueva);
}

function domLigaLocalizarPosicion(idBuscado) {
    var divsLigas = divLigasDatos.children;

    for (var pos=0; pos < divsLigas.length; pos++) {
        let divLiga = divsLigas[pos];
        let ligaActualId = extraerId(divLiga.id);

        if (ligaActualId == idBuscado) return (pos);
    }

    return -1;
}

function domligaEliminar(id) {
    let pos = domLigaLocalizarPosicion(id);
    let div = domLigaObtenerDiv(pos);
    div.remove();
}

function domLigaModificar(liga) {
    domLigaEliminar(liga.id);

    // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
    domLigaInsertar(liga, true);
}



function domEquipoObjetoADiv(equipo) {
    let div = document.createElement("div");
            div.setAttribute("id", "equipo-" + equipo.id);
    div.appendChild(domCrearDivInputText(equipo.nombre, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivInputText(equipo.puntos, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivInputText(equipo.ligaId, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivImg("img/Eliminar.png", "clickEquipoEliminar(" + equipo.id + ");"));

    return div;
}

function domEquipoObtenerDiv(pos) {
    return divEquiposDatos.children[pos];
}

function domEquipoDivAObjeto(div) {
    return { // Devolvemos un objeto recién creado con los datos que hemos obtenido.
        "id": extraerId(div.id),
        "nombre": div.children[1].children[0].value,
        "puntos": div.children[2].children[0].value,
        "ligaId": div.children[4].children[0].value,
    }
}

function domEquipoObtenerObjeto(pos) {
    let divEquipo = domEquipoObtenerDiv(pos);
    return domEquipoDivAObjeto(divequipo);
}

function domEquipoEjecutarInsercion(pos, equipo) {
    let divReferencia = domEquipoObtenerDiv(pos);
    let divNuevo = domEquipoObjetoADiv(equipo);

    divEquiposDatos.insertBefore(divNuevo, divReferencia);
}

function domEquipoInsertar(equipoNueva, enOrden=false) {
    // Si piden insertar en orden, se buscará su lugar. Si no, irá al final.
    if (enOrden) {
        for (let pos=0; pos < divEquiposDatos.children.length; pos++) {
            let equipoActual = domEquipoObtenerObjeto(pos);

            // Se generan cadenas compuestas por los campos clave para ordenar.
            let cadenaActual = equipoActual.nombre + equipoActual.puntos + equipoActual.id;
            let cadenaNueva = equipoNueva.nombre + equipoNueva.puntos + equipoNueva.id;

            if (cadenaNueva.localeCompare(cadenaActual) == -1) {
                // Si la equipo nueva va ANTES que la actual, este es el punto en el que insertarla.
                domEquipoEjecutarInsercion(pos, equipoNueva);
                return;
            }
        }
    }

    // Si llegamos hasta aquí, insertamos al final.
    domEquipoEjecutarInsercion(divEquiposDatos.children.length, equipoNueva);
}

function domEquipoLocalizarPosicion(idBuscado) {
    var divsEquipos = divEquiposDatos.children;

    for (var pos=0; pos < divsEquipos.length; pos++) {
        let divEquipo = divsEquipos[pos];
        let equipoActualId = extraerId(divEquipo.id);

        if (equipoActualId == idBuscado) return (pos);
    }

    return -1;
}

function domEquipoEliminar(id) {
    let pos = domEquipoLocalizarPosicion(id);
    let div = domEquipoObtenerDiv(pos);
    div.remove();
}

function domEquipoModificar(equipo) {
    domEquipoEliminar(equipo.id);

    // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
    domEquipoInsertar(equipo, true);
}