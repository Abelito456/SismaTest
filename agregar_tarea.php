<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nueva_tarea"])) {
    $nuevaTarea = $_POST["nueva_tarea"];

    include "conexion.php"; 

    $stmt = $conexion->prepare("INSERT INTO tasks (Tarea, Completada) VALUES (?, 0)");
    $stmt->bind_param("s", $nuevaTarea);
    
    if ($stmt->execute()) {
        echo "Tarea agregada exitosamente";
    } else {
        echo "Error al agregar la tarea: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Solicitud no válida";
}
?>