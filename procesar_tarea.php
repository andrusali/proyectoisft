<?php
session_start();

// Definición de variables de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_tareas";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha']; // Asegúrate de que este nombre coincida con el del formulario
$prioridad = $_POST['prioridad'];

// Insertar datos en la base de datos
$sql = "INSERT INTO tareas (titulo, descripcion, fecha, prioridad) VALUES ('$titulo', '$descripcion', '$fecha', '$prioridad')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['mensaje'] = "Nueva tarea agregada con éxito.";
} else {
    $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();

// Redirigir de vuelta a index.php
header("Location: index.php");
exit();
?>
