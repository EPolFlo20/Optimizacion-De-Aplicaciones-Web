<?php
session_start();

readFeedsFromDB();

function readFeedsFromDB()
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
            generateFeedsArray($feeds);
        } else {
            $mensaje_error = '<p>No se encontraron feeds para este usuario.</p>';
            echo json_encode(array('error' => $mensaje_error));
        }
    } catch (PDOException $e) {
        $mensaje_error = 'Error de consulta: ' . $e->getMessage();
        echo json_encode(array('error' => $mensaje_error));
    }
}

function generateFeedsArray($feeds)
{
    require_once 'autoloader.php';

    $datos_feed = array();

    // Procesar cada URL del feed
    foreach ($feeds as $urlFeed) {
        $url = $urlFeed['url_sitio'];
        
        // Crear una nueva instancia de SimplePie
        $feed = new SimplePie();
        $feed->set_feed_url($url);
        $feed->init();
        $feed->handle_content_type();

        foreach ($feed->get_items() as $item) {
            $descripcion = $item->get_description();
            $enlace_imagen = '';
            // Extraer el enlace de la imagen (si existe)
            preg_match('/<img[^>]+src="([^"]+)"/', $descripcion, $matches);
            if (!empty($matches[1])) {
                $enlace_imagen = $matches[1];
                // Eliminar la etiqueta <img> de la descripción
                $descripcion = preg_replace('/<img[^>]+>/', '', $descripcion);
            }

            // Extraer datos relevantes de cada entrada del feed
            $entrada = array(
                'titulo' => $item->get_title(),
                'fecha' => $item->get_date('j F Y | g:i a'),
                'descripcion' => $descripcion,
                'img' => $enlace_imagen,
                'categorias' => $item->get_categories(),
                'url' => $item->get_permalink()
            );

            // Agregar la entrada al array de datos del feed
            $datos_feed[] = $entrada;
        }
    }

    // Convertir el array de datos del feed a JSON
    $datos_feed_json = json_encode($datos_feed);

    echo $datos_feed_json;
}
