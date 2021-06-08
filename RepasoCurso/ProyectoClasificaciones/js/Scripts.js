
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

    document.getElementById("esp").addEventListener('click', btnEsp);
    document.getElementById("ru").addEventListener('click', btnRu);
    document.getElementById("it").addEventListener('click', btnIt);
    document.getElementById("al").addEventListener('click', btnAl);
    document.getElementById("fr").addEventListener('click', btnFr);
    document.getElementById("eu").addEventListener('click', btnEu);

}

function btnEsp() {
    document.getElementById("equiposDatos").innerHTML = "";

    llamadaAjax("EquipoObtenerPorLigaId.php", "ligaId=" + 1,
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

function btnRu() {
    document.getElementById("equiposDatos").innerHTML = "";

    llamadaAjax("EquipoObtenerPorLigaId.php", "ligaId=" + 2,
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

function btnIt() {
    document.getElementById("equiposDatos").innerHTML = "";

    llamadaAjax("EquipoObtenerPorLigaId.php", "ligaId=" + 3,
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

function btnAl() {
    document.getElementById("equiposDatos").innerHTML = "";

    llamadaAjax("EquipoObtenerPorLigaId.php", "ligaId=" + 4,
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

function btnFr() {
    document.getElementById("equiposDatos").innerHTML = "";

    llamadaAjax("EquipoObtenerPorLigaId.php", "ligaId=" + 5,
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
function btnEu() {
    document.getElementById("equiposDatos").innerHTML = "";

    llamadaAjax("EquipoObtenerTodos.php", "",
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


function blurEquipoModificar(input) {
    let divEquipo = input.parentElement.parentElement;
    let equipo = domEquipoDivAObjeto(divEquipo);

    llamadaAjax("EquipoActualizar.php", objetoAParametrosParaRequest(equipo),
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

// ---------DOM-EQUIPO------------------

function domEquipoObjetoADiv(equipo) {
    let div = document.createElement("div");
            div.setAttribute("id", "equipo-" + equipo.id);
    div.appendChild(domCrearDivInputText(equipo.nombre, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivInputText(equipo.puntos, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivInputText(equipo.ligaId, "blurEquipoModificar(this);"));

    return div;
}

function domEquipoObtenerDiv(pos) {
    return divEquiposDatos.children[pos];
}

function domEquipoDivAObjeto(div) {
    return { // Devolvemos un objeto recién creado con los datos que hemos obtenido.
        "id": extraerId(div.id),
        "nombre": div.children[0].children[0].value,
        "puntos": div.children[1].children[0].value,
        "ligaId": div.children[2].children[0].value,
    }
}

function domEquipoObtenerObjeto(pos) {
    let divEquipo = domEquipoObtenerDiv(pos);
    return domEquipoDivAObjeto(divEquipo);
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
    asignarBtnLigaId(equipo.ligaId);
    // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
    //domEquipoInsertar(equipo, true);
}

function asignarBtnLigaId(ligaId) {
    if (ligaId == 1){
        btnEsp();
    } else if (ligaId == 2) {
        btnRu();
    } else if (ligaId == 3) {
        btnIt();
    } else if (ligaId == 4) {
        btnAl();
    } else if (ligaId == 5) {
        btnFr();
    }
}
