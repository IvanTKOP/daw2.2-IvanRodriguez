// ----------------------------------- PROYECTO LIGAS ------------------------------------------

window.onload = inicializar;



// ---------- VARIABLES GLOBALES ----------

var divEquiposDatos;


// ---------- FUNCIONES GENERALES ----------

function notificarUsuario(texto) {
    alert(texto);
}

function llamadaAjax(url, parametros, manejadorOK, manejadorError) {
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


function inicializar() {
    divEquiposDatos = document.getElementById("equiposDatos");

    document.getElementById("esp").addEventListener('click', btnLiga);
    document.getElementById("ru").addEventListener('click', btnLiga);
    document.getElementById("it").addEventListener('click', btnLiga);
    document.getElementById("al").addEventListener('click', btnLiga);
    document.getElementById("fr").addEventListener('click', btnLiga);
    document.getElementById("eu").addEventListener('click', btnEu);

}

function btnLiga(ligaId) {
    divEquiposDatos.innerHTML = ""; // boramos lo que había para pintar lo nuevo
    crearCabecera();

    llamadaAjax("EquipoObtenerPorLigaId.php", "ligaId=" + (this.value || ligaId),
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
    divEquiposDatos.innerHTML = "";
    crearCabecera();

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
   
    if (comprobarRequest(equipo.nombre) && comprobarRequest(equipo.puntos) && comprobarRequest(equipo.dg) != null) { // Comprobamos que no sea campo vacío

        llamadaAjax("EquipoActualizar.php", objetoAParametrosParaRequest(equipo),
            function(texto) {
                if (texto != "null") {
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

    } else {
        alert("No puedes dejar el campo vacío")
        btnLiga(equipo.ligaId);
    }
}


// ---------- DOM GENERAL ----------

function domCrearDivInputText(textoValue, codigoOnblur) {
    let div = document.createElement("div");
        let input = document.createElement("input");
                input.setAttribute("type", "text");
                input.setAttribute("value", textoValue);
                input.setAttribute("onblur", codigoOnblur + " return false;");
                input.setAttribute("style", "text-align: center;");
    div.appendChild(input);

    return div;
}

function domCrearDivImg(urlSrc, codigoOnclick, textoId) {
    let div = document.createElement("div");
        div.setAttribute("id", textoId); // llevamos ligaId aquí ya que en img no deja recogerlo
        let img = document.createElement("img");
                img.setAttribute("src", urlSrc);
                img.setAttribute("width", "20");
                img.setAttribute("height", "20");
                img.setAttribute("onclick", codigoOnclick + " return false;");
    div.appendChild(img);

    return div;
}



// -------------------DOM EQUIPO----------------------

function domEquipoObjetoADiv(equipo) {
    let div = document.createElement("div");
            div.setAttribute("id", "equipo-" + equipo.id);
    div.appendChild(domCrearDivInputText(equipo.nombre, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivInputText(equipo.puntos, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivInputText(equipo.dg, "blurEquipoModificar(this);"));
    div.appendChild(domCrearDivImg(asignarImgLigaId(equipo.ligaId), "btnLiga(" + equipo.ligaId + ");", equipo.ligaId));

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
        "dg": div.children[2].children[0].value,
        "ligaId": div.children[3].id, // en <img> no se puede recoger asique lo llevamos a traves del id del div
    };
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

function domEquipoInsertar(equipoNuevo) {
    domEquipoEjecutarInsercion(divEquiposDatos.children.length, equipoNuevo);
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
    btnLiga(equipo.ligaId);
}


// ---------------- FUNCIONES UTILIDADES ----------------------

function asignarBtnLigaId(ligaId) {
    if (ligaId == 1){
        btnLiga(1);
    } else if (ligaId == 2) {
        btnLiga(2);
    } else if (ligaId == 3) {
        btnLiga(3);
    } else if (ligaId == 4) {
        btnLiga(4);
    } else if (ligaId == 5) {
        btnLiga(5);
    } 
}

function asignarImgLigaId(ligaId) {
    if (ligaId == 1){
       return "img/esp.png";
    } else if (ligaId == 2) {
        return "img/ru.png";
    } else if (ligaId == 3) {
        return "img/it.png";
    } else if (ligaId == 4) {
        return "img/al.png";
    } else if (ligaId == 5) {
        return "img/fr.png";
    }
}

function comprobarRequest(value) {
    if (value != "" || null) {
        return value;
    } else {
        return null;
    }
}

function crearCabecera() {
    var divCabecera = document.getElementById("divCabecera");   
    divCabecera.innerHTML = '<h2 style="text-align: center;">Clasificación</h2>';

    var divEquiposCabecera = document.getElementById("equiposCabecera");
    divEquiposCabecera.innerHTML = "<div><div>Nombre</div><div>Puntos</div><div>Diferencia de Goles</div><div>País</div></div>";

}