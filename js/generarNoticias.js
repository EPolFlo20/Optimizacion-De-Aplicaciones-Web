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
    const noticiasDiv = document.getElementById("div_noticias");
    noticiasDiv.innerHTML = "";

    const noticiasHTML = datos.map(entrada => `
        <div class="noticia">
            <div class="titulo_fecha">
                <div class="titulo"><a href="${entrada.url}">${entrada.titulo}</a></div>
                <div class="fecha">${entrada.fecha}</div>
            </div>
            <div class="contenido">
                <div class="imagen"><img src="${entrada.img}" alt="Imagen del suceso"></div>
                <div class="descripcion">${entrada.descripcion}</div>
                <div class="categorias">
                    Categoría: ${listCat(entrada.categorias)}
                </div>
            </div>
        </div>
    `).join('');

    noticiasDiv.innerHTML = noticiasHTML;
}

function listCat(categorias) {
    if (!categorias) {
        return "(Sin Categoria)";
    }

    return categorias.map(categoria => `${categoria.term}`).join(' | ');
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
    if (Array.isArray(datos_Feeds)) {
        datos_Feeds.sort(function (a, b) {
            var cadena1 = a.fecha.toLowerCase(), cadena2 = b.fecha.toLowerCase();
            if (cadena1 < cadena2)
                return -1;
            if (cadena1 > cadena2)
                return 1;
            return 0;
        });
    } else {
        console.error('datos_Feeds no es un array');
    }
    MostrarNoticias(datos_Feeds);
}

window.onload = function () {
    cargarFeeds();
}