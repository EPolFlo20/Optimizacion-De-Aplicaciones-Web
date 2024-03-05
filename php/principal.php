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
    <link rel="stylesheet" href="../styles/simplepie.css">
    <link rel="stylesheet" href="../styles/index.css">
    <script src="../js/index.js"></script>
    <script src="../js/generateNews.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div id="titulo" class="col-12">
                <h1 class="tituloSitio">Lector RSS</h1>
            </div>
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="principal.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <!-- Botón para mostrar el formulario para agregar Feeds -->
                        <a class="nav-link" href="#" onclick="mostrarForms()">Agregar nuevo Feed</a>
                        <!-- Formulario para agregar Feeds (oculto inicialmente) -->
                        <div id="agregarFeed">
                            <h2>Agrega un nuevo Feed</h2>
                            <form id="FormFeed">
                                <input id="input_link" type="text" name="feed" placeholder="Link" required>
                                <button id= "btn_agregar" type="submit" id="feed_button">Agregar</button>
                                <button id="btn_cancelar" onclick="ocultarConfirmacion()">Cancelar</button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../php/logout.php" id="btnSalir" name="">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="content" class="container-fluid">
            <table>
                <tr>
                    <td>
                        <label for="buscador">Buscador</label>
                        <input type="search" id="buscador" data-search>
                    </td>
                    <td>
                        <div class="contenedor">
                            <button id= "btn_ordenar" onclick="mostrarLista()">Ordenar</button>
                            <div id="listaDesplegable" class="listaDesplegable">
                                <button id="btn_titulo" onclick="ordenarTitulo()">Titulo</button>
                                <button id="btn_fecha" onclick="ordenarFecha()">Fecha</button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button id="btn_actualizar" onclick="update()">Actualizar</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="feed"></div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="div_noticias" class="container-fluid"></div>
        <script src="../js/search.js"></script>
</body>

</html>