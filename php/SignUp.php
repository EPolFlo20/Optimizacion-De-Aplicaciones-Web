<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: access, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

session_start();

function connection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rss";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
        return null;
    }
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    
    return $conn;
}

if(isset($_GET['signup'])){
    $data = json_decode(file_get_contents("php://input"));
    $conn = connection();
    $username = $data->user;
    $password = $data->password;
    $email = $data->email;
    $name = $data->firstName;
    $lastname = $data->lastName;

    $sql = mysqli_query($conn, "INSERT INTO usuarios (Usuario, Contraseña, Correo, Nombre, Apellido) VALUES ('$username', '$password', '$email', '$name', '$lastname')");

    if($sql){
        $response = [
            'success' => true,
            'message' => 'User registered successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to register user.'
        ];
    }

    echo json_encode($response);
}

?>