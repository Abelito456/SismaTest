<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task_id'])) {
        $taskId = $_POST['task_id'];
        include "conexion.php";

        $deleteQuery = $conexion->prepare("DELETE FROM tasks WHERE ID = ?");
        $deleteQuery->execute([$taskId]);
    }
}
?>
