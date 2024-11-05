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

// Obtener la tarea por ID
$id = $_GET['id'];
$sql = "SELECT * FROM tareas WHERE id=$id";
$result = $conn->query($sql);
$tarea = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $prioridad = $_POST['prioridad'];

    $sql = "UPDATE tareas SET titulo='$titulo', descripcion='$descripcion', fecha='$fecha', prioridad='$prioridad' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
</head>
<body>
    <h1>Editar Tarea</h1>
    <form method="POST">
        <input type="text" name="titulo" value="<?php echo $tarea['titulo']; ?>" required>
        <textarea name="descripcion" required><?php echo $tarea['descripcion']; ?></textarea>
        <input type="date" name="fecha" value="<?php echo $tarea['fecha']; ?>" required>
        <select name="prioridad">
            <option value="alta" <?php echo $tarea['prioridad'] == 'alta' ? 'selected' : ''; ?>>Alta</option>
            <option value="media" <?php echo $tarea['prioridad'] == 'media' ? 'selected' : ''; ?>>Media</option>
            <option value="baja" <?php echo $tarea['prioridad'] == 'baja' ? 'selected' : ''; ?>>Baja</option>
        </select>
        <button type="submit">Actualizar Tarea</button>
    </form>
    <a href="index.php">Volver</a>
</body>
</html>
