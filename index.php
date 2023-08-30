<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Conexion a Bootstrap e Icono de Borrar ----->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <title>Tareas</title>
</head>
<body>
     <nav class="navbar navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" id="datosLink">Tareas</a>
      </div>    
    </nav> 
    <!-----------------Creacion de Tabla--------------->
    <div class="container">
        <div class="row">            
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tarea</th>
      <th scope="col">Estado</th>
      <th scope="col">Accion</th> 
    </tr>
  </thead>
  <tbody>
    <!----------------Inyeccion de Datos en la Tabla------------>
    <?php
       include "conexion.php";

       $query = $conexion->query("SELECT * FROM tasks");

       foreach ($query as $key => $value) {      

    ?>
    <tr class="<?= ($value['Completada'] == 1) ? 'table-success' : 'table-danger'; ?>">
        <th scope="row"><?= $value['ID']; ?></th>
        <td><?= $value['Tarea']; ?></td>
        <td>
            <div class="form-check">
                <input class="form-check-input task-checkbox" type="checkbox" <?= ($value['Completada'] == 1) ? 'checked' : ''; ?>>
            </div>
        </td>
        <!--------------Llamado al icono de Borrar------------>
        <td>
    <a href="#" class="delete-task" data-task-id="<?= $value['ID']; ?>">
        <i class="fas fa-trash"></i>
    </a>
</td>
        
    </tr>
    
    
    
    <?php } ?>
    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#agregarTareaModal">
    Agregar Tarea
</button>
  </tbody>

  <!------------------------Ventana emergente para agregar nueva tarea-------------------------->

  <div class="modal fade" id="agregarTareaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agregarTareaForm">
                    <div class="form-group">
                        <label for="nuevaTarea">Tarea</label>
                        <input type="text" class="form-control" id="nuevaTarea" name="nuevaTarea" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarTareaBtn">Guardar Tarea</button>
            </div>
        </div>
    </div>
</div>

  <!--------------------Script JS para el estado de las tareas------------------>
  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll(".task-checkbox");

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const taskId = this.closest("tr").querySelector("th").innerText;
                const completed = this.checked ? 1 : 0;

                //---------- Uso de AJAX para actualizar las filas dependiendo el estado de la tarea----------------
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "estado_tarea.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        
                        const row = checkbox.closest("tr");
                        row.classList.toggle("table-success", completed === 1);
                        row.classList.toggle("table-danger", completed === 0);
                    }
                };
                xhr.send(`task_id=${taskId}&completed=${completed}`);
            });
        });
    });
</script>

<!--------------------------Script JS para borrar tareas---------------------------------->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteLinks = document.querySelectorAll(".delete-task");

        deleteLinks.forEach((deleteLink) => {
            deleteLink.addEventListener("click", function (e) {
                e.preventDefault();
                const taskId = this.getAttribute("data-task-id");

                // -------------------------Uso de AJAX para actualizar la tabla despues de eliminar tareas--------------
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "borrar_tarea.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                      
                        const row = deleteLink.closest("tr");
                        row.remove();
                    }
                };
                xhr.send(`task_id=${taskId}`);
            });
        });
    });
</script>

<!-------------------------Script JS para actualizar la tabla con las nuevas tareas agregadas---------------------------->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const guardarTareaBtn = document.getElementById("guardarTareaBtn");
        const agregarTareaForm = document.getElementById("agregarTareaForm");
        
//-------------------------Validacion para no agregar campos vacios---------------------------------------
        guardarTareaBtn.addEventListener("click", function () {
            const nuevaTareaInput = document.getElementById("nuevaTarea");
            const nuevaTarea = nuevaTareaInput.value.trim(); 

            if (nuevaTarea === "") {
                alert("Error, Campo Vacio");
                return;
            }

            // Uso de AJAX para actualizar la tabla con las nuevas tareas
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "agregar_tarea.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send(`nueva_tarea=${nuevaTarea}`);
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</table>
</html>