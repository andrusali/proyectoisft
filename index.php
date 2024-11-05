<!DOCTYPE html>
<?php
session_start();
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas para Estudiantes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success" role="alert">
            <?php
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
            ?>
        </div>
    <?php endif; ?>
    
    <h1>Gestión de Tareas para Estudiantes</h1>
    <h5 class="card-title titulo-personalizado">Título de la Tarea</h5>

    <form action="procesar_tarea.php" method="POST" class="mb-4">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha Límite</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="prioridad">Prioridad</label>
            <select class="form-control" id="prioridad" name="prioridad" required>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Tarea</button>
    </form>

    <h2>Tareas:</h2>
    <ul id="taskList">
    <?php
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

        // Obtener las tareas
        $sql = "SELECT * FROM tareas";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Salida de cada fila
            while($row = $result->fetch_assoc()) {
                $prioridad = $row["prioridad"];
                $badgeClass = $prioridad === "alta" ? "badge-danger" : ($prioridad === "media" ? "badge-warning" : "badge-success");

                echo "<li class='card mb-3 border-" . $badgeClass . "'>
                        <div class='card-body'>
                            <h5 class='card-title'>" . $row["titulo"] . "</h5>
                            <p class='card-text'>" . $row["descripcion"] . "</p>
                            <p class='card-text'><small class='text-muted'>Fecha límite: " . $row["fecha"] . "</small></p>
                            <span class='badge badge-pill " . $badgeClass . "'>" . ucfirst($prioridad) . "</span>
                            <div class='mt-3'>
                                <a href='editar_tarea.php?id=" . $row["id"] . "' class='btn btn-outline-success'>Editar</a>
                                <a href='eliminar_tarea.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta tarea?\");' class='btn btn-outline-danger'>Eliminar</a>
                            </div>
                        </div>
                      </li>";
            }
        } else {
            echo "<li>No hay tareas.</li>";
        }

        $conn->close();
    ?>
    </ul>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
