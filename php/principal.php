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
            <div class="col-12">
                <h1 class="titulo">Noticias RSS.</h1>
            </div>
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="principal.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <!-- Botón para mostrar el formulario para agregar Feeds -->
                        <a class="nav-link" href="#" onclick="mostrarForms()">Agregar nuevo Feed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">Opción 3</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="content" class="container-fluid">
            <table>
                <tr>
                    <td>
                        Buscador:
                        <input id="buscador" type="text">
                    </td>
                    <td>
                        <div class="contenedor">
                            <button onclick="mostrarLista()">Mostrar Lista</button>
                            <div id="listaDesplegable" class="listaDesplegable">
                                <button onclick="ordenarTitulo()">Titulo</button>
                                <button onclick="ordenarFecha()">Fecha</button>
                                <button>Algo más?</button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button onclick="update()">Actualizar</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="feed"></div>
                    </td>
                </tr>
            </table>
            <a href="../php/logout.php" id="btnSalir" name="">Salir</a>
        </div>
        <div id="div_noticias" class="container-fluid"></div>
        <!-- Formulario para agregar Feeds (oculto inicialmente) -->
        <div id="agregarFeed">
            <h2>Agrega un nuevo Feed</h2>
            <p>Escribe el link al Feed Rss</p>
            <form id="FormFeed">
                <input type="text" name="feed" placeholder="Usuario" required>
                <button onclick="ocultarConfirmacion()">Cancelar</button>
                <button type="submit" id="feed_button">Agregar Feed</button>
            </form>

        </div>
</body>

</html>