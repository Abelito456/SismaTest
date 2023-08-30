<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task_id']) && isset($_POST['completed'])) {
        $taskId = $_POST['task_id'];
        $completed = $_POST['completed'];
        include "conexion.php";

        $updateQuery = $conexion->prepare("UPDATE tasks SET Completada = ? WHERE ID = ?");
        $updateQuery->execute([$completed, $taskId]);
    }
}
?>