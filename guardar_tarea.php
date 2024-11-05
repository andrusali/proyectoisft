<?php
$servername = "localhost";
$username = "root"; // Por defecto en XAMPP
$password = ""; // Sin contraseña por defecto
$dbname = "gestion_tareas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_limite = $_POST['fecha_limite'];
$materia = $_POST['materia'];
$prioridad = $_POST['prioridad'];

// Insertar tarea
$sql = "INSERT INTO tareas (titulo, descripcion, fecha_limite, materia, prioridad) VALUES ('$titulo', '$descripcion', '$fecha_limite', '$materia', '$prioridad')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva tarea agregada";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: index.php"); // Redirige de vuelta a la página principal
?>