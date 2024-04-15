var datos_Feeds;function update(){datos_Feeds=null;cargarFeeds()}function cargarFeeds(){var a=new XMLHttpRequest;a.open("GET","../php/RSSLector.php",!0);a.onload=function(){200<=a.status&&300>a.status?(datos_Feeds=JSON.parse(a.responseText),console.log("Datos recibidos:",datos_Feeds),ordenarFecha(),MostrarNoticias(datos_Feeds)):console.error("Error al cargar las noticias:",a.statusText)};a.onerror=function(){console.error("Error al realizar la solicitud.")};a.send()}
function MostrarNoticias(a){const b=document.getElementById("div_noticias");b.innerHTML="";a=a.map(c=>`
        <div class="noticia">
            <div class="titulo_fecha">
                <div class="titulo"><a href="${c.url}">${c.titulo}</a></div>
                <div class="fecha">${c.fecha}</div>
            </div>
            <div class="contenido">
                <div class="imagen"><img src="${""!==c.img?c.img:"../img/predeterminada.avif"}" alt="Imagen del suceso" style="width: auto; height: 200px;"></div>
                <div class="descripcion">${c.descripcion}</div>
                <div class="categorias">
                    Categor\u00eda: ${listCat(c.categorias)}
                </div>
            </div>
        </div>
    `).join("");b.innerHTML=a}function listCat(a){return a?a.map(b=>`${b.term}`).join(" | "):"(Sin Categoria)"}function ordenarTitulo(){datos_Feeds.sort(function(a,b){a=a.titulo.toLowerCase();b=b.titulo.toLowerCase();return a<b?-1:a>b?1:0});MostrarNoticias(datos_Feeds)}function ordenarFecha(){Array.isArray(datos_Feeds)?datos_Feeds.sort(function(a,b){a=a.fecha.toLowerCase();b=b.fecha.toLowerCase();return a<b?-1:a>b?1:0}):console.error("datos_Feeds no es un array");MostrarNoticias(datos_Feeds)}
window.onload=function(){cargarFeeds()};
