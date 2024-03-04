var datos_Feeds;

function update() {
    datos_Feeds = null;
    cargarFeeds();
}

function cargarFeeds() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/RSSLector.php', true);
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            datos_Feeds = JSON.parse(xhr.responseText);
            console.log('Datos recibidos:', datos_Feeds);
            ordenarFecha();
            MostrarNoticias(datos_Feeds);
        } else {
            console.error('Error al cargar las noticias:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error al realizar la solicitud.');
    };
    xhr.send();
}

function MostrarNoticias(datos) {
    document.getElementById("div_noticias").innerHTML = "";
    var datosObjeto = datos;
    cadena = "";
    for (var i = 0; i < datosObjeto.length; i++) {
        cadena += "<table class=\"tabla_noticias\"><tr>";
        var entrada = datosObjeto[i];
        cadena += "<td colspan=\"2\" class=\"titulo\">" + entrada.titulo + "</td>";
        cadena += "<td></td>";
        cadena += "<td colspan=\"2\" class=\"fecha\">" + entrada.fecha + "</td>";
        cadena += "</tr><tr>";
        cadena += "<td colspan=\"2\" rowspan=\"3\" class=\"imagen\"><img src=\"" + entrada.img + "\" width=\"100%\" heigth=\"100%\" alt=\"Imagen del suceso\"</td>";
        cadena += "<td colspan=\"2\" rowspan=\"3\" class=\"descripcion\">" + entrada.descripcion + "</td>";
        cadena += "<td rowspan=\"3\" class=\"url\" class=\"categorias\"><ul> "
            + listCat(entrada.categorias)
            + "</td>";
        cadena += "</tr><tr></tr><tr></tr><tr>";
        cadena += "<td colspan=\"5\" class=\"url\"><a href=\""
            + entrada.url
            + "\">Referencia</a><ul>";
        cadena += " </tr></table><br>";
    }

    document.getElementById("div_noticias").innerHTML = cadena;
}

function listCat(categorias) {
    cadena = "";
    if (categorias != null) {
        categorias.forEach(element => {
            cadena += "<li>" + element.term + "</li>";
        });
    }
    else {
        cadena = "(Sin Categoria)"
    }
    return cadena;
}

function ordenarTitulo() {
    datos_Feeds.sort(function (a, b) {
        var cadena1 = a.titulo.toLowerCase(), cadena2 = b.titulo.toLowerCase();
        if (cadena1 < cadena2)
            return -1;
        if (cadena1 > cadena2)
            return 1;
        return 0;
    });
    MostrarNoticias(datos_Feeds);
}

function ordenarFecha() {
    datos_Feeds.sort(function (a, b) {
        var cadena1 = a.fecha.toLowerCase(), cadena2 = b.fecha.toLowerCase();
        if (cadena1 < cadena2)
            return -1;
        if (cadena1 > cadena2)
            return 1;
        return 0;
    });
    MostrarNoticias(datos_Feeds);
}

window.onload = function () {
    cargarFeeds();
}