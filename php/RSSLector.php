<?php
if (empty($_SESSION["id_usuario"])) {
    header("location: ../html/Login.html");
}

$id_usuario = $_SESSION["id_usuario"];

function readFromDB(){
    require '';
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
        echo '<h2><a href="' . $item->get_permalink() . '">' . $item->get_title() . '</a></h2>';
        echo '<p>' . $item->get_description() . '</p>';
        echo '<p><small>Posted on' . $item->get_date('j F Y | g:i a') . '</small></p>';
    }
    echo '</div>';
}
