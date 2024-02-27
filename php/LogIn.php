<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

session_start();

function connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rss";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
        return null;
    }
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

if (isset($_GET['login'])) {
    $data = json_decode(file_get_contents("php://input"));
    $conn = connection();
    $username = $data->user;
    $password = $data->password;

    $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE Usuario = '$username' AND Contraseña = '$password'");
    $row = mysqli_fetch_assoc($sql);
    // Verificar si se encontró un usuario
    if ($row) {
        // Acceder al valor de la columna 'id_usuario'
        $_SESSION['id_usuario'] = $row['id_usuario'];
        if (mysqli_num_rows($sql) > 0) {
            $response = [
                'success' => true,
                'message' => 'User logged in successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to log in user.'
            ];
        }

        echo json_encode($response);
    }
}
?>