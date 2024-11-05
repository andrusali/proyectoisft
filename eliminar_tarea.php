<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_tareas";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar tarea por ID
$id = $_GET['id'];
$sql = "DELETE FROM tareas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error al eliminar: " . $conn->error;
}

$conn->close();
?>