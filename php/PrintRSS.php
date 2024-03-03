<?php
session_start();
if (empty($_SESSION["id_usuario"])) {
    header("location: ../html/Login.html");
}

readFromDB();

function readFromDB()
{
    require 'databaseConnection.php';
    $id_usuario = $_SESSION["id_usuario"];

    try {
        $stmt = $conexion->prepare(
            "SELECT url_sitio
            FROM sitios s
            JOIN sitiosporusuario su on su.id_sitio = s.id_sitio
            WHERE su.id_usuario = $id_usuario
            ;"
        );
        $stmt->execute();
        $feeds = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($feeds)) {
            foreach ($feeds as $urlFeed) {
                $url = $urlFeed['url_sitio'];
                readRSS($url);
            }
        } else {
            echo "<p>No se encontraron feeds para este usuario.</p>";
        }
    } catch (PDOException $e) {
        echo "Error de consulta: " . $e->getMessage();
    }
}

function readRSS($link)
{
    require_once 'autoloader.php';

    $rss_feed_url = $link;

    // Crear una nueva instancia de SimplePie
    $feed = new SimplePie();
    $feed->set_feed_url($rss_feed_url);
    $feed->init();
    $feed->handle_content_type();

    // Muestra las noticias
    echo '<div class="item">';
    foreach ($feed->get_items() as $item) {
        $descripcion = $item->get_description();
        // Extraer el enlace de la imagen (si existe)
        $enlace_imagen = '';
        preg_match('/<img[^>]+src="([^"]+)"/', $descripcion, $matches);
        if (!empty($matches[1])) {
            $enlace_imagen = $matches[1];
            // Eliminar la etiqueta <img> de la descripción
            $descripcion = preg_replace('/<img[^>]+>/', '', $descripcion);
        }

        echo '<h2><a href="' . $item->get_permalink() . '">' . $item->get_title() . '</a></h2>';
        echo '<img src="' . $enlace_imagen . '" width="25%" heigth="25%" alt="Imagen de la noticia">';
        echo '<p>' . $descripcion . '</p>';
        echo '<p><small>Posted on' . $item->get_date('j F Y | g:i a') . '</small></p>';
    }
    echo '</div>';
}
