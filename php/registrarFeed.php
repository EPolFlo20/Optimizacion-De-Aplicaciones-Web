<?php
require_once 'databaseConnection.php';
session_start();
$id_usuario = $_SESSION["id_usuario"];

// Verifica si se han recibido datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $feed = $_POST['feed']; // Nombre del campo 'feed' en el formulario HTML

    try {
        $conexion->beginTransaction();

        $sql1 = $conexion->prepare(
            "INSERT INTO sitios(url_sitio) 
            VALUES (?)"
        );
        $sql1->bindParam(1, $feed);
        $sql1->execute();

        // Obtener el último ID insertado
        $ultimoID = $conexion->lastInsertId();

        $sql2 = $conexion->prepare("INSERT INTO sitiosporusuario (id_usuario, id_sitio) VALUES (?, ?)");
        $sql2->bindParam(1, $id_usuario);
        $sql2->bindParam(2, $ultimoID);
        $sql2->execute();

        $conexion->commit();
        echo 'Nuevo Feed agregado exitosamente';
    } catch (PDOException $e) {
        $conexion->rollBack();
        echo 'Error al insertar datos: ' . $e->getMessage();
    }
} else {
    // Si no se reciben datos por POST, muestra un mensaje de error
    echo "No se han recibido datos del formulario";
}
