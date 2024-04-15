<?php
session_start();
if (empty($_SESSION["id_usuario"])) {
    header("location: ../html/Login.html");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Noticias RSS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url("../styles/main2.css");
    </style>
</head>

<body>
    <div class="header">
        <img src="../img/RSS.avif" alt="Logo" id="logo">
        <h1 id="tituloSitio">Lector RSS</h1>
        <div class="headerButtons">
            <!-- Botón para mostrar el formulario para agregar Feeds -->
            <a class="nav-link" href="#" onclick="mostrarForms()">
                <img src="../img/agregar.avif" alt="Agregar Feed">
            </a>
            <!-- Formulario para agregar Feeds (oculto inicialmente) -->
            <div id="agregarFeed">
                <h2>Agrega un nuevo Feed</h2>
                <form id="FormFeed">
                    <input id="input_link" type="text" name="feed" placeholder="Link" required>
                    <button id="btn_agregar" type="submit" id="feed_button">Agregar</button>
                    <button id="btn_cancelar" onclick="ocultarConfirmacion()">Cancelar</button>
                </form>
            </div>
            <a class="nav-link" href="../php/logout.php" id="btnSalir" name="">
                <img src="../img/salir.avif" alt="Salir">
            </a>
        </div>
    </div>
    <div class="noticias">
        <div class="barraBusqueda">
            <label for="buscador">Buscador</label>
            <img src="../img/buscar.avif" alt="Búsqueda">
            <input type="search" id="buscador" data-search>
        </div>
        <div class="botones">
            <button id="btn_ordenar" onclick="mostrarLista()">
                <img src="../img/ordenar.avif" alt="Ordenar">
            </button>
            <div id="listaDesplegable" class="listaDesplegable">
                <button id="btn_titulo" onclick="ordenarTitulo()">Titulo</button>
                <button id="btn_fecha" onclick="ordenarFecha()">Fecha</button>
            </div>
            <button id="btn_actualizar" onclick="update()">
                <img src="../img/actualizar.avif" alt="Actualizar Feed">
            </button>
        </div>
        <div class="feed"></div>
    </div>
    <div id="div_noticias"></div>
    <div id="no-results"></div>

    <script src="../js/busqueda.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/generarNoticias.js"></script>
</body>

</html>